<?php

namespace App\Http\Controllers\system;
use App\Model\system\danhmucchucnang;
use App\Model\system\dsvanphong;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dsvanphongController extends Controller
{
    function hotro(){
        return view('thongtinhotro')
            ->with('pageTitle', 'Thông tin hỗ trợ');
    }

    public function index(){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'vanphong', 'index')) {
                return view('errors.noperm');
            }
            $model = dsvanphong::all();
            $a_vp = array_column($model->toArray(),'vanphong','vanphong');
            return view('system.vanphonghotro.index')
                ->with('model', $model)
                ->with('a_vp', $a_vp)
                ->with('pageTitle', 'Danh sách cán bộ hỗ trợ');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $check = dsvanphong::where('maso',$inputs['maso'])->first();

            if ($check == null) {
                $inputs['maso'] = getdate()[0];
                dsvanphong::create($inputs);
            } else {
                $check->update($inputs);
            }
            return redirect('/vanphonghotro/danhsach');
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {

        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = dsvanphong::where('maso', $inputs['maso'])->first();
        die($model);
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            dsvanphong::where('maso', $inputs['maso'])->first()->delete();
            return redirect('/vanphonghotro/danhsach');
        } else
            return view('errors.notlogin');
    }
}
