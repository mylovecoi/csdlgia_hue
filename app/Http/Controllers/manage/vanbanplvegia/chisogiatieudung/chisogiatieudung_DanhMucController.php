<?php

namespace App\Http\Controllers\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMuc;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMuc_ChiTiet;
use Illuminate\Support\Facades\Session;

class chisogiatieudung_DanhMucController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI';
            $model = chisogiatieudung_DanhMuc::all();
            return view('manage.vanbanqlnn.giatieudung.danhmuc.ThongTu')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin danh mục');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new chisogiatieudung_DanhMuc();
            $inputs['masodanhmuc'] = getdate()[0];
            $inputs['trangthai'] = 'TD';
            $model->create($inputs);
            return redirect('/ChiSoCPI/DanhMuc');
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model = chisogiatieudung_DanhMuc::findOrFail($id);
            $model->delete();
            chisogiatieudung_DanhMuc_ChiTiet::where('masodanhmuc', $model->masodanhmuc)->delete();
            return redirect('/ChiSoCPI/DanhMuc');
        } else
            return view('errors.notlogin');
    }


    public function ChiTiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI';
            $model = chisogiatieudung_DanhMuc_ChiTiet::where('masodanhmuc', $inputs['masodanhmuc'])->get();
            return view('manage.vanbanqlnn.giatieudung.danhmuc.ChiTiet')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin chi tiết danh mục');
        } else
            return view('errors.notlogin');
    }

    public function LuuChiTiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();

            $model = chisogiatieudung_DanhMuc_ChiTiet::findOrFail($inputs['id']);
            $inputs['quyensogoc'] = round($inputs['quyensogoc'], 3);
            $inputs['quyensogoc_thanhthi'] = round($inputs['quyensogoc_thanhthi'], 3);
            $inputs['quyensogoc_nongthon'] = round($inputs['quyensogoc_nongthon'], 3);

            $model->update($inputs);
            return redirect('/ChiSoCPI/ChiTietDM?masodanhmuc=' . $model->masodanhmuc);
        } else
            return view('errors.notlogin');
    }

    public function show_nhomdm(Request $request)
    {
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
        $model = chisogiatieudung_DanhMuc::where('masodanhmuc', $inputs['masodanhmuc'])->first();
        die($model);
    }

    public function show_hanghoa(Request $request)
    {
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
        $model = chisogiatieudung_DanhMuc_ChiTiet::where('id', $inputs['id'])->first();
        // $model->quyensogoc = dinhdangsothapphan($model->quyensogoc);
        //     $inputs['quyensogoc_thanhthi'] = $inputs['quyensogoc_thanhthi'];
        //     $inputs['quyensogoc_nongthon'] = $inputs['quyensogoc_nongthon'];
        die($model);
    }
}
