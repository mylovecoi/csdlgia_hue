<?php

namespace App\Http\Controllers\system;

use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class dsdonviController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdonvi', 'index')) {
                return view('errors.noperm');
            }

            //Tài khoản SSA; ADMIN => load toàn bộ địa bàn
            //Tài khoản # chỉ load các đơn vị trong địa bàn của mình
            if(session('admin')->level == 'SSA' || session('admin')->level == 'ADMIN'){
                $m_diaban = dsdiaban::all();
            }else{
                $m_diaban = dsdiaban::where('madiaban',session('admin')->madiaban)->get();
            }
            $inputs = $request->all();
            $inputs['madiaban'] = $inputs['madiaban'] ??  $m_diaban->first()->madiaban;
            //dd($inputs);
            $model = dsdonvi::where('madiaban', $inputs['madiaban'])->get();
            //dd($model);
            //dd(getPhanLoaiDonVi());
            return view('system.donvi.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('a_diaban', array_column($m_diaban->toArray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Danh sách đơn vị');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdonvi', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $m_diaban = dsdiaban::where('madiaban',$inputs['madiaban'])->get();
            return view('system.donvi.create')
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('a_diaban', array_column($m_diaban->toArray(),'tendiaban','madiaban'))
                ->with('pageTitle','Thêm mới thông tin đơn vị');

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdonvi', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $inputs['madv'] = getdate()[0];

            if (dsdonvi::create($inputs)) {
                $user = new Users();
                $user->madv = $inputs['madv'];
                $user->name = $inputs['tendv'];
                $user->username = chuanhoachuoi($inputs['username']);
                $user->password = md5($inputs['password']);
                $user->status = 'Kích hoạt';
                $user->save();
            }

            return redirect('/donvi/danhsach?madiaban=' . $inputs['madiaban']);
        } else
            return view('errors.notlogin');
    }

    public function modify(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdonvi', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsdonvi::where('madv', $inputs['madv'])->first();
            $m_diaban = dsdiaban::where('madiaban',$model->madiaban)->get();
            return view('system.donvi.edit')
                ->with('model', $model)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('a_diaban', array_column($m_diaban->toArray(),'tendiaban','madiaban'))
                ->with('pageTitle','Thêm mới thông tin đơn vị');

        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdonvi', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsdonvi::where('madv', $inputs['madv'])->first();
            $model->update($inputs);

            return redirect('/donvi/danhsach?madiaban=' . $inputs['madiaban']);
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachdiaban', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsdonvi::findorfail($inputs['iddelete']);
            DB::statement("Delete From users where madv ='" . $model->madv . "'");
            $model->delete();
            return redirect('/donvi/danhsach?madiaban=' . $model->madiaban);
        } else
            return view('errors.notlogin');
    }
}
