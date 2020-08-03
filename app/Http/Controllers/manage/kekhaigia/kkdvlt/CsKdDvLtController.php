<?php

namespace App\Http\Controllers\manage\kekhaigia\kkdvlt;

use App\DiaBanHd;
use App\Model\manage\kekhaigia\kkdvlt\CsKdDvLt;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CsKdDvLtController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_donvi = getDoanhNghiepNhapLieu(session('admin')->level, 'DVLT');
            $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(),'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modeldn = $m_donvi->where('madv', $inputs['madv'])->first();
            //dd($modeldn);
            $model = CsKdDvLt::where('madv', $inputs['madv'])->get();
            return view('manage.kkgia.dvlt.cskd.index')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('m_donvi', $m_donvi)
                ->with('a_diaban', array_column($m_diaban->toarray(),'tendiaban', 'madiaban'))
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Danh sách cơ sở kinh doanh dịch vụ lưu trú');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $modeldn = Company::where('madv', $inputs['madv'])->first();
            //dd($modeldn);
            return view('manage.kkgia.dvlt.cskd.create')
                ->with('modeldn', $modeldn)
                ->with('pageTitle', 'Thêm mới cơ sở kinh doanh dịch vụ lưu trú');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['macskd'] = getdate()[0];
            /*//dd($inputs);*/
            if (isset($inputs['avatar'])) {
                $avatar = $request->file('avatar');
                $inputs['avatar'] = $inputs['macskd'] . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path() . '/images/avatar/', $inputs['avatar']);
            } else {
                $inputs['avatar'] = 'no-image-available.jpg';
            }
            CsKdDvLt::create($inputs);
            return redirect('thongtincskd?madv='.$inputs['madv']);

        } else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            $model = CsKdDvLt::findOrFail($id);
            $modeldn = Company::where('madv',$model->madv)->first();
            return view('manage.kkgia.dvlt.cskd.edit')
                ->with('model',$model)
                ->with('modeldn',$modeldn)
                ->with('pageTitle', 'Chỉnh sửa cơ sở kinh doanh dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = CsKdDvLt::findOrFail($id);
            if (isset($inputs['avatar'])) {
                $avatar = $request->file('avatar');
                $inputs['avatar'] = $model->macskd . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path() . '/images/avatar/', $inputs['avatar']);
            }
            $model->update($inputs);
            return redirect('thongtincskd?madv=' . $model->madv);

        } else
            return view('errors.notlogin');
    }
}
