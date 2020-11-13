<?php

namespace App\Http\Controllers\Auth;


use App\GeneralConfigs;
use App\Http\Requests\system\RegisterRequest;
use App\Jobs\SendMail;
use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\User;
use App\Users;
use App\Model\system\dmnganhnghekd\DmNganhKd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
//    protected function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);
//    }

    public function create(){
        $inputs['mahs'] = getdate()[0];
        $inputs['url'] = '/doanhnghiep';
        $m_nganh = DmNganhKd::where('theodoi','TD')->get();
        $m_nghe = DmNgheKd::where('theodoi','TD')->get();
        //dd($m_nghe);
        //$m_donvi = getDonViXetDuyet(session('admin')->level);
        $m_donvi = view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
            ->wherein('level', ['T', 'H', 'X'])->get();
        $m_diaban = dsdiaban::wherein('level', ['T', 'H', 'X'])->get();

        return view('system.registers.dangkytk.create')
            ->with('m_nganh', $m_nganh)
            ->with('m_nghe', $m_nghe)
            ->with('inputs',$inputs)
            ->with('modelct',nullValue())
            ->with('m_diaban', $m_diaban)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle','Đăng ký tài khoản truy cập');
    }

    public function store(Request $request){
        $inputs = $request->all();
        $inputs['trangthai'] = 'Chưa kích hoạt';
        $inputs['level']  = 'DN';
        $model = new Company();
        if(isset($inputs['tailieu'])){
            $ipf1 = $request->file('tailieu');
            $inputs['ipt1'] = $inputs['madv'].'.'.$ipf1->getClientOriginalExtension();
            $ipf1->move(public_path() . '/data/doanhnghiep/', $inputs['ipt1']);
            $inputs['tailieu']= $inputs['ipt1'];
        }
        if($model->create($inputs)){
            $modeluser = new Users();
            $modeluser->username = $inputs['username'];
            $modeluser->password = md5($inputs['rpassword']);
            $modeluser->name = $inputs['tendn'];
            $modeluser->status = 'Chờ xét duyệt';
            $modeluser->level  = 'DN';
            $modeluser->madv  = $inputs['madv'];
            $modeluser->save();
            CompanyLvCc::where('mahs',$inputs['mahs'])
                ->update(['madv' => $inputs['madv'],'trangthai' => 'XD']);
        }
        $modeldn = Company::where('madv',$inputs['madv'])->first();
        $modeldv = GeneralConfigs::first();
        $tg = getDateTime(Carbon::now()->toDateTimeString());
        $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu đăng ký thông tin doanh nghiệp . Mã số đăng ký: '.$inputs['mahs'].'!!!';
        $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu thay đổi thông tin doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->madv.' Mã số đăng ký: '.$inputs['mahs'].' !!!';
        $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
        $run->handle();
        //dispatch($run);
        return view('system.registers.dangkytk.register-success')
            ->with('mahs',$inputs['mahs'])
            ->with('pageTitle','Đăng ký tài khoản truy cập thành công');
    }

    public function update(Request $request,$id){
        $inputs = $request->all();
        $model = Company::findOrFail($id);
        if(isset($inputs['tailieu'])){
            $ipf1 = $request->file('tailieu');
            $inputs['ipt1'] = $inputs['madv'].'.'.$ipf1->getClientOriginalExtension();
            $ipf1->move(public_path() . '/data/doanhnghiep/', $inputs['ipt1']);
            $inputs['tailieu']= $inputs['ipt1'];
        }
        $model->update($inputs);
        $modeldn = Company::where('madv',$inputs['madv'])
            ->first();
        $modeluserup = Users::where('madv',$inputs['madv'])
            ->where('level','DN')
            ->update(['status' => 'Chờ xét duyệt']);
        $modeldv = GeneralConfigs::first();
        $tg = getDateTime(Carbon::now()->toDateTimeString());
        $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu đăng ký thông tin doanh nghiệp . Mã số đăng ký: '.$model->mahs.'!!!';
        $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu thay đổi thông tin doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->madv.' Mã số đăng ký: '.$model->mahs.' !!!';
        $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
        $run->handle();
        //dispatch($run);

        return view('system.registers.dangkytk.register-success')
            ->with('mahs',$model->mahs)
            ->with('pageTitle','Đăng ký tài khoản truy cập thành công');
    }

    public function searchindex(){
        return view('system.registers.dangkytk.search')
            ->with('pageTitle','Kiểm tra tài khoản đăng ký');
    }

    public function search(Request $request){
        $inputs = $request->all();
        $modelcompany = Company::where('madv',$inputs['madv'])
            ->first();
        $modeluser = Users::where('madv',$inputs['madv'])
            ->where('level','DN')
            ->first();
        //dd($modelcompany);
        if(isset($modeluser)) {
            if ($modeluser->status == 'Chờ xét duyệt')
                return view('system.registers.dangkytk.register-choduyet')
                    ->with('modelcompany', $modelcompany)
                    ->with('pageTitle', 'Đăng ký tài khoản truy cập đang chờ xét duyệt');
            elseif ($modeluser->status == 'Bị trả lại')
                return view('system.registers.dangkytk.register-bitralai')
                    ->with('modelcompany', $modelcompany)
                    ->with('modeluser', $modeluser)
                    ->with('pageTitle', 'Đăng ký tài khoản truy cập bị trả lại')
                    ->with('mahs',$modelcompany->mahs);
            else
                return view('system.registers.dangkytk.register-usersuccess');
        }else
            return view('system.registers.dangkytk.register-errors-checkmadk');
    }

    public function checkmadk(Request $request){
        $inputs = $request->all();
        $modelcompany = Company::where('mahs',$inputs['mahs'])
            ->first();
        dd($modelcompany);
        return view('system.registers.dangkytk.checkmadk')
            ->with('pageTitle','Chỉnh sửa thông tin đăng ký tài khoản');
    }

    public function submitcheckmadk(Request $request){
        $inputs = $request->all();
        $model = Company::where('mahs',$inputs['mahs'])
            ->first();
        if($model != null ){
            $inputs['url'] = '/doanhnghiep';
            $modeluser = Users::where('madv',$model->madv)
                ->first();
            $modellvcc = CompanyLvCc::where('madv', $model->madv)
                ->get();
//            $nganhs = DmNganhKd::where('theodoi','TD')
//                ->get();
            $m_nganh = DmNganhKd::where('theodoi','TD')->get();
            $m_nghe = DmNgheKd::where('theodoi','TD')->get();
            //dd($m_nghe);
            //$m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi = view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
                ->wherein('level', ['T', 'H', 'X'])->get();
            $m_diaban = dsdiaban::wherein('level', ['T', 'H', 'X'])->get();
            $a_nghe = array_column( DmNgheKd::where('theodoi','TD')->get()->toarray(),'tennghe','manghe');
            return view('system.registers.dangkytk.edit')
                ->with('model', $model)
                ->with('modeluser',$modeluser)
                ->with('modellvcc',$modellvcc)
                //->with('nganhs',$nganhs)
                ->with('m_nganh', $m_nganh)
                ->with('m_nghe', $m_nghe)
                ->with('a_nghe', $a_nghe)
                ->with('inputs',$inputs)
                ->with('modelct',$modellvcc)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('inputs',$inputs)
                ->with('pageTitle','Chỉnh sửa đăng ký tài khoản truy cập');
        }else
            return view('system.registers.dangkytk.register-errors-checkmadk');
    }

    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/dangky';
            //load địa bàn, lấy thông tin đầu tiên, load đăng ký trên địa bàn
            //căn cứ level để lấy địa bàn SSA, ADMIN -> all
            //  lấy theo mã địa bàn

            $a_diaban = getDiaBan_HeThong(\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            $m_company = Company::where('madiaban', strtolower($inputs['madiaban']))->get();
            //dd($m_company);
            $model = Users::wherein('status', ['Chờ xét duyệt', 'Bị trả lại'])
                ->wherein('madv', array_column($m_company->toarray(),'madv'))
                ->where('level', 'DN')
                ->get();
            //dd($m_company);
            return view('system.registers.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_diaban', $a_diaban)
                ->with('pageTitle', 'Xét duyệt tài khoản đăng ký');

        } else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/dangky';
            if(!chkPer('hethong', 'hethong_pq', 'dangky', 'index')){
                return view('errors.perm');
            }

            $model = Users::where('madv', $inputs['madv'])->first();
            $m_company = Company::where('madv', $model->madv)->first();
            $m_lvkd = CompanyLvCc::where('madv', $model->madv)->get();
            $a_nghe = array_column( DmNgheKd::where('theodoi','TD')->get()->toarray(),'tennghe','manghe');
            $a_cqcq = array_column(view_dsdiaban_donvi::wherein('madv', array_column($m_lvkd->toarray(),'macqcq'))->get()->toarray(),'tendv','madv');
            //dd($m_company);
            return view('system.registers.xetduyet.show')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_company', $m_company)
                ->with('m_lvkd', $m_lvkd)
                ->with('a_nghe', $a_nghe)
                ->with('a_cqcq', $a_cqcq)
                ->with('pageTitle', 'Chi tiết doanh nghiệp đăng ký');

        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();

            if(!chkPer('hethong', 'hethong_pq', 'dangky', 'index')){
                return view('errors.perm');
            }
            //dd($inputs);
            $m_company = Company::where('mahs', $inputs['mahs'])->first();
            $m_user = Users::where('madv', $m_company->madv)->first();
            $m_user->lydo = $inputs['lydo'];
            $m_user->status = 'Bị trả lại';
            $m_user->save();
            $modeldv = GeneralConfigs::first();
            $tg = getDateTime(Carbon::now()->toDateTimeString());
            $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã trả lại yêu cầu đăng ký thông tin doanh nghiệp!!!';
            $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã trả lại yêu cầu thay đổi thông tin doanh nghiệp '.$m_company->tendn.' - mã số thuế '.$m_company->madv.' Mã số đăng ký: '
                .$m_company->mahs.'Lý do trả lại: '.$inputs['lydo'].' !!!';
            $run = new SendMail($m_company,$contentdn,$modeldv,$contentht);
            $run->handle();
            return redirect('dangky/danhsach?madiaban='.$m_company->madiaban);
        }else
            return view('errors.notlogin');
    }

    public function kichhoat(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            if (!chkPer('hethong', 'hethong_pq', 'dangky', 'index')) {
                return view('errors.perm');
            }
            $m_company = Company::where('mahs', $inputs['mahs'])->first();
            $m_user = Users::where('madv', $m_company->madv)->first();
            $m_user->status = 'Kích hoạt';
            if ($m_user->save()) {

                $m_company->trangthai = 'Kích hoạt';
                $m_company->save();
            }
            //dd($m_company);
            $modeldv = GeneralConfigs::first();
            $tg = getDateTime(Carbon::now()->toDateTimeString());
            $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã duyệt yêu cầu đăng ký thông tin doanh nghiệp!!!';
            $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã nhận yêu cầu thay đổi thông tin doanh nghiệp ' . $m_company->tendn . ' - mã số thuế ' . $m_company->madv . ' Mã số đăng ký: ' . $m_company->mahs . ' !!!';
            $run = new SendMail($m_company, $contentdn, $modeldv, $contentht);
            $run->handle();
            //dispatch($run);
            return redirect('dangky/danhsach?madiaban=' . $m_company->madiaban);

        } else
            return view('errors.notlogin');
    }

}
