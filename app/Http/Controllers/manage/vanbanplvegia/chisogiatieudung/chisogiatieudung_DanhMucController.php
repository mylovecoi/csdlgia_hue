<?php

namespace App\Http\Controllers\manage\vanbanplvegia\chisogiatieudung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMuc;
use App\Model\manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMuc_ChiTiet;
use Illuminate\Support\Facades\Session;

class chisogiatieudung_DanhMucController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] =  '/ChiSoCPI';
            $model = chisogiatieudung_DanhMuc::all();
            return view('manage.vanbanqlnn.giatieudung.danhmuc.ThongTu')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin danh mục');

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new chisogiatieudung_DanhMuc();
            $inputs['masodanhmuc'] = getdate()[0];
            $inputs['trangthai'] = 'TD';
            $model->create($inputs);
            return redirect('/ChiSoCPI/DanhMuc');

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model = chisogiatieudung_DanhMuc::findOrFail($id);            
            $model->delete();
            chisogiatieudung_DanhMuc_ChiTiet::where('masodanhmuc',$model->masodanhmuc)->delete();
            return redirect('/ChiSoCPI/DanhMuc');
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

    // public function edit(Request $request){
    //     $result = array(
    //         'status' => 'fail',
    //         'message' => 'error',
    //     );
    //     if (!Session::has('admin')) {
    //         $result = array(
    //             'status' => 'fail',
    //             'message' => 'permission denied',
    //         );
    //         die(json_encode($result));
    //     }

    //     $inputs = $request->all();
    //     $id = $inputs['id'];
    //     $model = BcThVeGiaDm::findOrFail($id);
    //     die($model);
    // }

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
