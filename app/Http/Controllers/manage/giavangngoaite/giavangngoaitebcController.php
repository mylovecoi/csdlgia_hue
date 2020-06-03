<?php

namespace App\Http\Controllers\manage\giavangngoaite;

use App\DiaBanHd;
use App\District;
use App\DmHhDvK;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaite;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaitect;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaitedm;
use App\Model\system\dsdiaban;
use App\NhomHhDvK;
use App\ThGiaHhDvK;
use App\ThGiaHhDvKCt;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\PhpWord;

class giavangngoaitebcController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            return view('manage.dinhgia.giavangngoaite.reports.index')
                ->with('pageTitle', 'Báo cáo tổng hợp giá vàng, ngoại tệ');
        } else
            return view('errors.notlogin');
    }

    public function bc1(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_hoso = giavangngoaite::wherebetween('thoidiem',[$inputs['ngaytu'],$inputs['ngayden']])->get();
            $m_hoso_ct = giavangngoaitect::wherein('mahs',array_column($m_hoso->toarray(),'mahs'))->get();
            $model = giavangngoaitedm::all();
            $col = count($m_hoso);
            $a_col= [];
            foreach($m_hoso as $hs){
                $a_col[$hs->mahs] = $hs->thoidiem;
            }
            foreach ($model as $dm){
                foreach ($m_hoso_ct->where('mahhdv',$dm->mahhdv) as $ct){
                    $maso = $ct->mahs;
                    $dm->$maso = $ct->gia;
                }
            }

            //dd($model);
            return view('manage.dinhgia.giavangngoaite.reports.bc1')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('col',$col)
                ->with('a_col',$a_col)
                ->with('pageTitle','Báo cáo giá vàng, ngoại tệ');
        }else
            return view('errors.notlogin');
    }

    public function bc2(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_hoso = giavangngoaite::wheremonth('thoidiem', $inputs['thang'])
                ->whereYear('thoidiem', $inputs['nam'])->get();
            $m_hoso_ct = giavangngoaitect::wherein('mahs',array_column($m_hoso->toarray(),'mahs'))->get();
            $model = giavangngoaitedm::all();
            foreach ($model as $dm){
                $dm->gia = $m_hoso_ct->where('mahhdv',$dm->mahhdv)->where('gia','>',0)->avg('gia');
            }
            return view('manage.dinhgia.giavangngoaite.reports.bc2')
                ->with('inputs',$inputs)
                ->with('model',$model)
                ->with('pageTitle','Tổng hợp giá vàng, ngoại tệ');
        }else
            return view('errors.notlogin');
    }
}
