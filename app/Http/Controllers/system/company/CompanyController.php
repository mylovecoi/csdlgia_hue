<?php

namespace App\Http\Controllers\system\company;

use App\GeneralConfigs;
use App\Http\Requests\system\CompanyRequest;
use App\Jobs\SendMail;
use App\Mail\MailDoanhNghiep;
use App\Mail\MailHeThong;
use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\Model\system\dmnganhnghekd\DmNganhKd;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdonvi;
use App\TtDnTd;
use App\TtDnTdCt;
use App\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level =='X') {
                $inputs = $request->all();
                $inputs['masothue'] = isset($inputs['masothue']) ? $inputs['masothue'] : '';
                $inputs['tendn'] = isset($inputs['tendn']) ? $inputs['tendn'] : '';
                $inputs['diachi'] = isset($inputs['diachi']) ? $inputs['diachi'] : '';
                $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 5;
                $model = Company::where('trangthai','Kích hoạt');
                if($inputs['tendn'] != '')
                    $model = $model->where('tendn','like', '%'.$inputs['tendn'].'%');
                if($inputs['masothue'] != '')
                    $model = $model->where('maxa','like', '%'.$inputs['masothue'].'%');
                if($inputs['diachi'] != '')
                    $model = $model->where('diachi','like', '%'.$inputs['diachi'].'%');
                $model = $model->paginate($inputs['paginate']);
                return view('system.company.index')
                    ->with('model', $model)
                    ->with('inputs',$inputs)
                    ->with('pageTitle', 'Danh sách doanh nghiệp cung cấp dịch vụ');
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level =='X') {
                $modeldel = CompanyLvCc::where('trangthai','CXD')->delete();
                $nganhs = DmNganhKd::where('theodoi','TD')
                    ->get();
                $inputs['mahs'] = getdate()[0];

                return view('system.company.create')
                    ->with('nganhs', $nganhs)
                    ->with('inputs',$inputs)
                    ->with('pageTitle', 'Thêm mới doanh nghiệp cung cấp dịch vụ');
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function store(CompanyRequest $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new Company();
            $inputs['trangthai'] = 'Kích hoạt';
            if(isset($inputs['tailieu'])){
                $ipf1 = $request->file('tailieu');
                $inputs['ipt1'] = $inputs['maxa'].'.'.$ipf1->getClientOriginalExtension();
                $ipf1->move(public_path() . '/data/doanhnghiep/', $inputs['ipt1']);
                $inputs['tailieu']= $inputs['ipt1'];
            }
            if($model->create($inputs)){
                $modeluser = new Users();
                $modeluser->username = $inputs['username'];
                $modeluser->password = md5($inputs['password']);
                $modeluser->maxa = $inputs['maxa'];
                $modeluser->level = 'DN';
                $modeluser->name = $inputs['tendn'];
                $modeluser->status = 'Kích hoạt';
                $modeluser->save();
                $modellvcc = CompanyLvCc::where('mahs',$inputs['mahs'])
                    ->update(['maxa' => $inputs['maxa'],'trangthai' => 'XD']);
            }
            return redirect('company');
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            $model = Company::findOrFail($id);
            $modellvcc = CompanyLvCc::where('madv',session('admin')->madv)->get();
            $nganhs = DmNganhKd::where('theodoi','TD')->get();
            return view('system.company.edit')
                ->with('model', $model)
                ->with('modellvcc',$modellvcc)
                ->with('nganhs',$nganhs)
                ->with('pageTitle', 'Chỉnh sửa thông tin doanh nghiệp cung cấp dịch vụ');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level =='X') {
                $inputs = $request->all();
                $model = Company::findOrFail($id);
                if(isset($inputs['tailieu'])){
                    $ipf1 = $request->file('tailieu');
                    $inputs['ipt1'] = $inputs['maxa'].'.'.$ipf1->getClientOriginalExtension();
                    $ipf1->move(public_path() . '/data/doanhnghiep/', $inputs['ipt1']);
                    $inputs['tailieu']= $inputs['ipt1'];
                }
                $model->update($inputs);
                return redirect('company');
            }else
                return view('errors.perm');

        }else
            return view('errors.notlogin');
    }

    public function ttdn(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = Company::where('madv',session('admin')->madv)->first();
            $modellvcc = CompanyLvCc::where('madv',session('admin')->madv)->get();

            $modeltttd = TtDnTd::where('madv',session('admin')->madv)->first();
            $modeltttdct = TtDnTdCt::where('madv',session('admin')->madv)->get();
            $a_nghe = array_column(DmNgheKd::all()->toArray(),'tennghe','manghe');
            $a_dv = array_column(dsdonvi::all()->toArray(),'tendv','madv');

            return view('manage.kkgia.ttdn.index')
                ->with('model', $model)
                ->with('modellvcc',$modellvcc)
                ->with('modeltttd', $modeltttd)
                ->with('modeltttdct',$modeltttdct)
                ->with('a_nghe',$a_nghe)
                ->with('a_dv',$a_dv)
                ->with('pageTitle', 'Thông tin doanh nghiệp');
        }else
            return view('errors.notlogin');
    }

    public function ttdnedit($id){
        if (Session::has('admin')) {
            //Kiểm tra thông tin có thuộc quyền quản lý hay k
            TtDnTdCt::where('trangthai', 'CXD')->delete();
            $model = Company::findOrFail($id);
            $modelgetlvcc = CompanyLvCc::where('madv', $model->madv)->get();
            foreach ($modelgetlvcc as $lvcc) {
                $modeladddf = new TtDnTdCt();
                $modeladddf->madv = $lvcc->madv;
                $modeladddf->manganh = $lvcc->manganh;
                $modeladddf->manghe = $lvcc->manghe;
                $modeladddf->mahuyen = $lvcc->mahuyen;
                $modeladddf->trangthai = 'CXD';
                $modeladddf->save();
            }
            $modellvcc = TtDnTdCt::where('madv', $model->madv)->get();
            $m_nganh = DmNganhKd::where('theodoi','TD')->get();
            $m_nghe = DmNgheKd::where('theodoi','TD')->get();
            return view('manage.kkgia.ttdn.edit')
                ->with('model', $model)
                ->with('modellvcc', $modellvcc)
                ->with('m_nganh', $m_nganh)
                ->with('m_nghe', $m_nghe)
                ->with('a_nghe', array_column($m_nghe->toArray(),'tennghe','manghe'))
                ->with('pageTitle', 'Thông tin doanh nghiệp chỉnh sửa');
        } else
            return view('errors.notlogin');
    }

    public function ttdnupdate(Request $request,$id){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new TtDnTd();
            $inputs['trangthai'] = 'CC';
            if(isset($inputs['tailieu'])){
                $ipf1 = $request->file('tailieu');
                $inputs['ipt1'] = $inputs['maxa'].'df.'.$ipf1->getClientOriginalExtension();
                $ipf1->move(public_path() . '/data/doanhnghiep/', $inputs['ipt1']);
                $inputs['tailieu']= $inputs['ipt1'];
            }else{
                $inputs['tailieu'] = Company::where('maxa',$inputs['maxa'])->first()->tailieu;
            }
            if($model->create($inputs))
                $modelct = TtDnTdCt::where('maxa',$inputs['maxa'])
                    ->update(['trangthai' => 'XD']);

            return redirect('thongtindoanhnghiep');
        } else
            return view('errors.notlogin');
    }

    public function ttdnchinhsua($id){
        if (Session::has('admin')) {
            //Kiểm tra thông tin có thuộc quyền quản lý hay k
            $model = TtDnTd::findOrFail($id);
            if(session('admin')->maxa == $model->maxa) {
                $modellvcc = TtDnTdCt::Leftjoin('town','town.maxa','=','ttdntdct.mahuyen')
                    ->join('dmnganhkd','dmnganhkd.manganh','=','ttdntdct.manganh')
                    ->join('dmnghekd','dmnghekd.manghe','=','ttdntdct.manghe')
                    ->select('ttdntdct.*','town.tendv','dmnganhkd.tennganh','dmnghekd.tennghe')
                    ->where('ttdntdct.maxa',$model->maxa)
                    ->get();
                $nganhs = DmNganhKd::where('theodoi','TD')
                    ->get();
                return view('manage.kkgia.ttdn.editdf')
                    ->with('model', $model)
                    ->with('modellvcc',$modellvcc)
                    ->with('nganhs',$nganhs)
                    ->with('pageTitle', 'Thông tin doanh nghiệp chỉnh sửa');
            }else
                return view('errors.noperm');
        }else
            return view('errors.notlogin');
    }

    public function ttdncapnhat($id,Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = TtDnTd::findOrFail($id);
            if(isset($inputs['tailieu']) && $inputs['tailieu'] != ''){
                $ipf1 = $request->file('tailieu');
                $inputs['ipt1'] = $inputs['maxa'].'df.'.$ipf1->getClientOriginalExtension();
                $ipf1->move(public_path() . '/data/doanhnghiep/', $inputs['ipt1']);
                $inputs['tailieu']= $inputs['ipt1'];
            }else{
                $inputs['tailieu'] = $model->tailieu;
            }
            if($model->update($inputs))
                $modelct = TtDnTdCt::where('maxa',$inputs['maxa'])
                    ->update(['trangthai' => 'XD']);

            return redirect('thongtindoanhnghiep');
        } else
            return view('errors.notlogin');
    }

    public function ttdnchuyen($id){
        if (Session::has('admin')) {
            $model = TtDnTd::find($id);
            $model->trangthai = 'CD';
            if($model->save()) {
                $modeldn = Company::where('maxa',$model->maxa)
                    ->first();
                $modeldv = GeneralConfigs::first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu thay đổi thông tin doanh nghiệp !!!';
                $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu thay đổi thông tin doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->maxa.' !!!';
                $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
                $run->handle();
                //dispatch($run);
            }
            return redirect('thongtindoanhnghiep');
        }else
            return view('errors.notlogin');
    }

    public function upavatar(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['id'];
            $model = Company::findOrFail($id);
            if(isset($inputs['avatar'])) {
                $avatar = $request->file('avatar');
                $inputs['avatar'] = $model->maxa . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path() . '/images/avatar/', $inputs['avatar']);
            }
            $model->update($inputs);
            return redirect('thongtindoanhnghiep');
        }else
            return view('errors.notlogin');
    }




}
