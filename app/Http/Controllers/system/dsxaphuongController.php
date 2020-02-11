<?php

namespace App\Http\Controllers\system;

use App\Model\system\dsdiaban;
use App\Model\system\dsxaphuong;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dsxaphuongController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong', 'danhsachxaphuong', 'index')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->where('level','H')->get();
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            //dd($inputs);
            $model = dsxaphuong::where('madiaban',$inputs['madiaban'])->get();
            return view('system.xaphuong.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_diaban',array_column($m_diaban->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Danh sách xã phường');
        } else
            return view('errors.notlogin');
    }

    public function modify(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong', 'danhsachxaphuong', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsxaphuong::where('maxp', $inputs['maxp'])->first();

            if ($model == null) {
                $inputs['maxp'] = getdate()[0];
                dsxaphuong::create($inputs);
            } else {
                $model->tenxp = $inputs['tenxp'];
                $model->save();
            }

            return redirect('/xaphuong/danhsach?madiaban='.$inputs['madiaban']);
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong', 'danhsachxaphuong', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsxaphuong::findorfail($inputs['iddelete']);
            $model->delete();
            return redirect('/xaphuong/danhsach?madiaban='.$model->madiaban);
        } else
            return view('errors.notlogin');
    }
}
