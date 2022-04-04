<?php

namespace App\Http\Controllers\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMuc_ChiTiet;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_TieuChi;
use Illuminate\Support\Facades\Session;

class chisogiatieudung_TieuChiController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI/TieuChi';
            $model = chisogiatieudung_TieuChi::all();
            $m_hanghoa = chisogiatieudung_DanhMuc_ChiTiet::all();
            return view('manage.vanbanqlnn.giatieudung.tieuchi.DanhSach')
                ->with('model',$model)
                ->with('m_hanghoa',$m_hanghoa)
                ->with('a_hanghoa',array_column($m_hanghoa->toArray(),'tenhanghoa','masohanghoa'))
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin tiêu chí thay đổi chỉ số CPI');

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = chisogiatieudung_TieuChi::where('id',$inputs['id'])->first();

            if($model == null){
                unset($inputs['id']);
                $model = new chisogiatieudung_TieuChi();           
                $model->create($inputs);
            }else{
                $model->update($inputs);
            }
           
            return redirect('/ChiSoCPI/TieuChi/DanhSach');

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['id'];
            $model = chisogiatieudung_TieuChi::findOrFail($id); 
            $model->delete();
            return redirect('ChiSoCPI/TieuChi/DanhSach');
        }else
            return view('errors.notlogin');
    }


    public function ChiTiet(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI';
            $model = chisogiatieudung_DanhMuc_ChiTiet::where('masodanhmuc',$inputs['masodanhmuc'])->get();
            return view('manage.vanbanqlnn.giatieudung.danhmuc.ChiTiet')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin chi tiết danh mục');

        }else
            return view('errors.notlogin');
    }

    public function layTieuChi(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $id = $inputs['id'];
        $model = chisogiatieudung_TieuChi::findOrFail($id);
        die($model);
    }

    // public function update(Request $request){
    //     if (Session::has('admin')) {
    //         $inputs = $request->all();
    //         $model = BcThVeGiaDm::where('id',$inputs['edit_id'])
    //             ->first();
    //         $model->phanloai = $inputs['edit_phanloai'];
    //         $model->mota = $inputs['edit_mota'];
    //         $model->theodoi = $inputs['edit_theodoi'];
    //         $model->save();
    //         return redirect('dmbaocaothvegia');
    //     }else
    //         return view('errors.notlogin');
    // }

}
