<?php

namespace App\Http\Controllers;

use App\Company;
use App\CsKdDvLt;
use App\DmDvQl;
use App\dmvitridat;
use App\DnDvGs;
use App\DnDvLt;
use App\DnDvLtReg;
use App\DonViDvVt;
use App\DonViDvVtReg;
use App\GeneralConfigs;
use App\KkDvVtKhac;
use App\KkDvVtXb;
use App\KkDvVtXk;
use App\KkDvVtXtx;
use App\KkGDvGs;
use App\KkGDvLt;
use App\KkGDvTaCn;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\TtDn;
use App\TtQd;
use App\Users;
use App\VanBanQlNn;
use App\ViewPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\DocBlock\Description;

class HomeController extends Controller
{
    /*
     * Thông tin email
     *
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=giadvvinhphuc@gmail.com
    MAIL_PASSWORD=giadvvinhphuc123456
    MAIL_ENCRYPTION=tls

    1. Please download the full version of the software at:
https://www.swordsky.com/F/PRO4/7FWODF59DF/dwfull/

2. Install the full version of the software on your computer.
** Administrator user is recommended

3. Start up the software and enter your registration information.

Your registration information is:

User name: Viet Hai Nguyen
User email: hainv@outlook.com
License code: PRO4-69G6Q4M-8YGNXX-M2N8-KCHVWYK

     * */

    /*
     * kknygia duyệt quyền của đơn vị để ra menu tương ứng
     * */
    public function index()
    {
        if (Session::has('admin')) {
            $a_giaodien = getGiaoDien();
            $m_bog = DmNgheKd::where('manganh', 'BOG')->where('theodoi', 'TD')->get();
            $a_kekhai = $a_giaodien['csdlmucgiahhdv']['kknygia'];
            $model = GeneralConfigs::first();
            unset($a_kekhai['index']);
            unset($a_kekhai['congbo']);
            //nếu SSA và tổng hợp mới chạy thống kê
            if (session('admin')->chucnang == 'TONGHOP' || session('admin')->level == 'SSA') {
                foreach ($a_kekhai as $key => $val) {
                    if(session('admin')->level == 'SSA' ){
                        if (!chkPer('csdlmucgiahhdv', 'kknygia', $key)) {
                            unset($a_kekhai[$key]);
                            continue;
                        }
                    }else{
                        if ((!chkPer('csdlmucgiahhdv', 'kknygia', $key) ||
                            !isset(session('admin')->permission[$key]['hoso']['approve'])
                            || session('admin')->permission[$key]['hoso']['approve'] == '0')
                        ) {
                            unset($a_kekhai[$key]);
                            continue;
                        }
                    }

                    $a_kekhai[$key]['hoso'] = 0;
                    if ($val['table'] != '') {
                        if($val['table'] == 'ttdntd'){
                            $sql = session('admin')->level == 'SSA' ? "select id from " . $val['table'] . " where trangthai in ('CD')"
                                : "select id from " . $val['table'] . " where trangthai in ('CD') and madiaban='" . session('admin')->madiaban . "'";

                        }else{
                            $sql = session('admin')->level == 'SSA' ? "select id from " . $val['table'] . " where trangthai in ('CD')"
                                : "select id from " . $val['table'] . " where trangthai in ('CD') and macqcq='" . session('admin')->madv . "'";

                        }

                        $hoso = DB::select($sql);
                        $a_kekhai[$key]['hoso'] = count($hoso);
                    }
                }
                foreach ($m_bog as $bog) {
                    $bog->hoso = 0;
                    $sql = session('admin')->level == 'SSA' ? "select macqcq from kkmhbog where trangthai in ('CD') and manghe = '" . $bog->manghe . "'"
                        : "select macqcq from kkmhbog where trangthai in ('CD') and macqcq='" . session('admin')->madv . "' and manghe = '" . $bog->manghe . "'";

                    $hoso = DB::select($sql);
                    $bog->hoso = count($hoso);
                }
            }

            //dd(session('admin'));
            return view('dashboard')
                ->with('model', $model)
                ->with('a_kekhai', $a_kekhai)
                ->with('a_bog', $m_bog->keyby('manghe')->toarray())
                ->with('pageTitle', 'Thông tin hỗ trợ');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
            $session = Session::getId();
            $model = ViewPage::where('ip', $ip)
                ->where('session', $session)->count();
            if ($model == 0) {
                $model = new ViewPage();
                $model->ip = $ip;
                $model->session = $session;
                $model->save();
            }
            return redirect('giahanghoadichvu');
        }
    }

    public function congbo(){
        $viewpage = ViewPage::count();
        $model = VanBanQlNn::orderBy('ngayapdung','desc')->take(10)->get();

        //dd(session('congbo'));
        return view('dashboardcb')
            ->with('viewpage', $viewpage)
            ->with('model', $model)
            //->with('a_setting', $a_setting)
            ->with('pageTitle', 'Cơ sở dữ liệu về giá');
    }

    public function forgotpassword(){
        return view('system.users.forgotpassword.index')
            ->with('pageTitle', 'Quên mật khẩu???');
    }

    public function forgotpasswordw(Request $request){
        $input = $request->all();
        $model = Users::where('username', $input['username'])->first();
        if (isset($model)) {
            if ($model->email == $input['email']) {
                $npass = getRandomPassword();
                $model->password = md5($npass);
                $model->save();

                $data = [];
                $data['tendn'] = $model->name;
                $data['username'] = $model->username;
                $data['npass'] = $npass;
                $maildn = $model->email;
                $tendn = $model->name;

                Mail::send('mail.successnewpassword', $data, function ($message) use ($maildn, $tendn) {
                    $message->to($maildn, $tendn)
                        ->subject('Thông báo thay đổi mật khẩu tài khoản');
                    $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                });
                return view('errors.forgotpass-success');
            } else
                return view('errors.forgotpass-errors');
        } else
            return view('errors.forgotpass-errors');
    }

    public function coming(){
        return view('congbo.coming')
            ->with('pageTitle','Dữ liệu đang cập nhật');
    }
}