<?php

namespace App\Http\Controllers;

use App\District;
use App\DmDvQl;
use App\DnDvGs;
use App\DnDvLt;
use App\DnDvLtReg;
use App\DnTaCn;
use App\DonViDvVt;
use App\DonViDvVtReg;
use App\GeneralConfigs;
use App\Model\system\company\Company;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Register;
use App\Users;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $inputs = $request->all();
        return view('system.users.login')
            ->with('inputs',$inputs)
            ->with('pageTitle', 'Đăng nhập hệ thống');
    }

    public function signin(Request $request)
    {
        $input = $request->all();
        $ttuser = Users::where('username', $input['username'])->first();
        //Tài khoản không tồn tại
        if ($ttuser == null) {
            return view('errors.invalid-user');
        }
        //Sai mật khẩu
        if (md5($input['password']) != $ttuser->password) {
            return view('errors.invalid-pass');
        }
        //Tài khoản đang bị khóa
        if ($ttuser->status != "Kích hoạt") {
            return view('errors.lockuser');
        }

        //kiểm tra tài khoản
        //1. level = SSA ->
        if ($ttuser->level != "SSA") {
            //2. level != SSA -> lấy thông tin đơn vị, hệ thống để thiết lập lại
            if($ttuser->level == "DN"){
                $m_donvi = Company::where('madv',$ttuser->madv)->first();
                //dd($m_donvi);
            }else{
                $m_donvi = dsdonvi::where('madv',$ttuser->madv)->first();
            }
            //dd($ttuser);
            $ttuser->madiaban = $m_donvi->madiaban;
            $ttuser->maqhns = $m_donvi->maqhns;
            $ttuser->tendv = $m_donvi->tendv;
            $ttuser->emailql = $m_donvi->emailql;
            $ttuser->emailqt = $m_donvi->emailqt;
            $ttuser->songaylv = $m_donvi->songaylv;
            $ttuser->tendvhienthi = $m_donvi->tendvhienthi;
            $ttuser->tendvcqhienthi = $m_donvi->tendvcqhienthi;
            $ttuser->chucvuky = $m_donvi->chucvuky;
            $ttuser->chucvukythay = $m_donvi->chucvukythay;
            $ttuser->nguoiky = $m_donvi->nguoiky;
            $ttuser->diadanh = $m_donvi->diadanh;
            $ttuser->chucnang = $m_donvi->chucnang;
            //Lấy thông tin địa bàn
            $m_diaban = dsdiaban::where('madiaban',$ttuser->madiaban)->first();
            $ttuser->tendiaban = $m_diaban->tendiaban;
            $ttuser->level = $m_diaban->level;
            //Lấy setting gán luôn vào phiên đăng nhập
            $ttuser->setting = json_decode(GeneralConfigs::first()->setting, true);
            $ttuser->permission = json_decode($ttuser->permission, true);
        }
        //dd($ttuser);
        Session::put('admin', $ttuser);
        return redirect('')
            ->with('pageTitle', 'Tổng quan');
    }

    public function cp()
    {
        if (Session::has('admin')) {
            return view('system.users.change-pass')
                ->with('pageTitle', 'Thay đổi mật khẩu');
        } else
            return view('errors.notlogin');
    }

    public function cpw(Request $request)
    {
        $update = $request->all();

        $username = session('admin')->username;

        $password = session('admin')->password;

        $newpass2 = $update['newpassword2'];

        $currentPassword = $update['current-password'];

        if (md5($currentPassword) == $password) {
            $ttuser = Users::where('username', $username)->first();
            $ttuser->password = md5($newpass2);
            if ($ttuser->save()) {
                Session::flush();
                return view('errors.changepassword-success');
            }
        } else {
            dd('Mật khẩu cũ không đúng???');
        }
    }

    public function checkpass(Request $request)
    {
        $input = $request->all();
        $passmd5 = md5($input['pass']);

        if (session('admin')->password == $passmd5) {
            echo 'ok';
        } else {
            echo 'cancel';
        }
    }

    public function logout()
    {
        if (Session::has('admin')) {
            Session::flush();
            return redirect('/login');
        } else {
            return redirect('');
        }
    }

    public function index(Request $request)
    {
        if (Session::has('admin')) {
            if (can('users','index')) {
                if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                    $inputs = $request->all();
                    $inputs['level'] = isset($inputs['level']) ? $inputs['level'] : '';
                    $model = Users::where('level', $inputs['level'])
                        ->orderBy('id', 'desc');
                    $districts = District::all();
                    $inputs['mahuyen'] = isset($inputs['mahuyen']) ? $inputs['mahuyen'] : $districts->first()->mahuyen;
                    if($inputs['level'] == 'X'){
                        if(session('admin')->level == 'H')
                            $inputs['mahuyen'] = session('admin')->mahuyen;
                        $model = $model->where('mahuyen',$inputs['mahuyen']);
                    }

                    $model = $model->get();

                    $index_unset = 0;
                    foreach ($model as $user) {
                        if ($user->username == 'minhtran') {
                            unset($model[$index_unset]);
                        }
                        $index_unset++;
                    }

                    return view('system.users.index')
                        ->with('model', $model)
                        ->with('inputs', $inputs)
                        ->with('districts',$districts)
                        ->with('pageTitle', 'Danh sách tài khoản đơn vị');
                }else
                    return view('errors.perm');
            }else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function create()
    {
        if (Session::has('admin')) {
            if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                return view('system.users.create')
                    ->with('pageTitle', 'Tạo mới thông tin tài khoản');
            }else{
                return view('errors.perm');
            }

        } else {
            return view('errors.notlogin');
        }
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            //quyền sa, ssa tạo tài khoản cấp tỉnh
            if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                $inputs = $request->all();
                $model = new Users();
                $inputs['ttnguoitao'] = '('.session('admin')->username.')'. getDateTime(Carbon::now()->toDateTimeString());
                //$inputs['ttnguoitao'] = session('admin')->name.'('.session('admin')->username.')'. getDateTime(Carbon::now()->toDateTimeString());
                $inputs['password'] = md5($inputs['password']);
                $model->create($inputs);
                return redirect('users');

            }else{
                return view('errors.perm');
            }

        } else {
            return view('errors.notlogin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Session::has('admin')) {

            $model = Users::findOrFail($id);
            return view('system.users.edit')
                ->with('model', $model)
                ->with('pageTitle', 'Chỉnh sửa thông tin tài khoản');
        } else
            return view('errors.notlogin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {
            $input = $request->all();
            $model = Users::findOrFail($id);
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                if ($input['newpass'] != '')
                    $input['password'] = md5($input['newpass']);
                $model->update($input);

                return redirect('users?&level='.$model->level);
            }else
                return view('errors.noperm');

        } else {
            return view('errors.notlogin');
        }
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->all()['iddelete'];
            $model = Users::findorFail($id);
            $model->delete();

            return redirect('users');

        } else
            return view('errors.notlogin');
    }

    public function permission($id)
    {
        if (Session::has('admin')) {

            $model = Users::findorFail($id);
            if ($model->level == 'DVVT') {
                $ttdn = Company::where('maxa', $model->maxa)
                    ->where('level', 'DVVT')
                    ->first();
                $setting = $ttdn->settingdvvt;
            } else
                $setting = '';
            $permission = !empty($model->permission) || $model->permission != '' ? $model->permission : getPermissionDefault($model->level);
            //dd(json_decode($permission));
            return view('system.users.perms')
                ->with('permission', json_decode($permission))
                ->with('setting', $setting)
                ->with('model', $model)
                ->with('pageTitle', 'Phân quyền cho tài khoản');
        } else
            return view('errors.notlogin');
    }

    public function uppermission(Request $request)
    {
        if (Session::has('admin')) {
            $update = $request->all();

            $id = $update['id'];

            $model = Users::findOrFail($id);
            //dd($model);
            if (isset($model)) {
                $update['roles'] = isset($update['roles']) ? $update['roles'] : null;

                $model->permission = json_encode($update['roles']);
                $model->save();
                return redirect('users?&level='.$model->level);

            } else
                dd('Tài khoản không tồn tại');

        } else
            return view('errors.notlogin');
    }

    public function lockuser($id)
    {

        $arrayid = explode('-', $id);
        foreach ($arrayid as $ids) {
            $model = Users::findOrFail($ids);
            if ($model->status != "Chưa kích hoạt") {
                $model->status = "Vô hiệu";
                $model->save();
            }
        }
        return redirect('users');

    }

    public function unlockuser($id)
    {
        $arrayid = explode('-', $id);
        foreach ($arrayid as $ids) {
            $model = Users::findOrFail($ids);

            if ($model->status != "Chưa kích hoạt") {

                $model->status = "Kích hoạt";
                $model->save();
            }
        }
        return redirect('users');

    }

    public function settinguser(){
        if (Session::has('admin')) {
            //$model = User::where('user',session('admin')->user)->first();
            return view('system.users.usersetting')
                ->with('pageTitle', 'Thông tin tài khoản');

        } else
            return view('errors.notlogin');

    }

    public function settinguserw(Request $request){
        $update = $request->all();

        $username = session('admin')->username;

        $password = session('admin')->password;

        $currentPassword = $update['current-password'];

        if (md5($currentPassword) == $password) {
            $ttuser = Users::where('username', $username)->first();
            $ttuser->email = $update['emailxt'];
            $ttuser->save();
            Session::flush();
            return redirect('/login');
        } else {
            dd('Mật khẩu cũ không đúng???');
        }
    }

    public function copy($id){
        if (Session::has('admin')) {
                $model = User::findOrFail($id);
                return view('system.users.copy')
                    ->with('model',$model)
                    ->with('pageTitle','Sao chép thông tin tài khoản');
        } else
            return view('errors.notlogin');
    }

    public function prints(Request $request){
        if (Session::has('admin')) {
                $inputs = $request->all();
                $inputs['level'] = isset($inputs['level']) ? $inputs['level'] : '';
                $inputs['mahuyen'] = isset($inputs['mahuyen']) ? $inputs['mahuyen'] : '';
                $model = new User();
                if($inputs['level'] != '')
                    $model = $model->where('level',$inputs['level']);
                if($inputs['mahuyen'] != '')
                    $model = $model->where('mahuyen',$inputs['mahuyen']);
                $model = $model->get();
                return view('system.users.prints')
                    ->with('model',$model)
                    ->with('pageTitle','Danh sách tài khoản');
        } else
            return view('errors.notlogin');
    }
}
