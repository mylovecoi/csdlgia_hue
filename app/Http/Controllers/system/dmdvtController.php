<?php

namespace App\Http\Controllers\system;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\system\dmdvt;
use Illuminate\Support\Facades\Session;
use App\Imports\ColectionImport;
use Maatwebsite\Excel\Facades\Excel;

class dmdvtController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'index')) {
                return view('errors.noperm');
            }

            $model = dmdvt::all();
            $inputs = $request->all();
            //dd($model);
            return view('system.dmdvt.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi_DiaBan())
                ->with('pageTitle', 'Danh mục đơn vị tính');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dmdvt::where('madvt', $inputs['madvt'])->first();

            if ($model == null) {
                $inputs['madvt'] =  $inputs['madvt'] != '' ? $inputs['madvt'] : getdate()[0];
                dmdvt::create($inputs);
            } else {
                $model->dvt = $inputs['dvt'];
                $model->save();
            }

            return redirect('/dmdvt/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            dmdvt::findorfail($inputs['iddelete'])->delete();
            return redirect('/dmdvt/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function delete_all(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhmucdvt', 'modify')) {
                return view('errors.noperm');
            }
            dmdvt::truncate();
            return redirect('/dmdvt/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function create_excel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs["madvt"] = ord(strtoupper($inputs["madvt"])) - 65;
            $inputs["dvt"] = ord(strtoupper($inputs["dvt"])) - 65;

            $file = $request->file('fexcel');

            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0]; //Mặc định lấy Sheet 1            
            //Gán lại dòng
            //dd($data);
            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) : $inputs['dendong'];
            $a_dm = array();

            for ($i = $inputs['tudong'] - 1; $i <= ($inputs['dendong']); $i++) {
                //dd($data[$i]);
                if (!isset($data[$i][$inputs['dvt']])) {
                    continue; //Mã hàng hoá rỗng => thoát
                }

                $a_dm[] = array(
                    'dvt' => trim($data[$i][$inputs['dvt']] ?? ''),
                    'madvt' => trim($data[$i][$inputs['madvt']] ?? ''),
                );
            }
            //dd($a_dm);
            dmdvt::insert($a_dm);
            return redirect('/dmdvt/danhsach');
        } else
            return view('errors.notlogin');
    }
}
