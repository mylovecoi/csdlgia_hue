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
use App\Model\system\dsdiaban;
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

    //Tài khoản doanh nghiệp hoặc tài khoản SSA
    public function ttdn(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $m_doanhnghiep = getDoanhNghiep(session('admin')->level,session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_column($m_doanhnghiep->toarray(),'madiaban'))->get();

            $inputs['madv'] = $inputs['madv'] ?? $m_doanhnghiep->first()->madv;

            $model = Company::where('madv',$inputs['madv'])->first();
            $modellvcc = CompanyLvCc::where('madv',$inputs['madv'])->get();

            $modeltttd = TtDnTd::where('madv',$inputs['madv'])->first();
            $modeltttdct = TtDnTdCt::where('madv',$inputs['madv'])->get();
            $a_nghe = array_column(DmNgheKd::all()->toArray(),'tennghe','manghe');
            $a_dv = array_column(dsdonvi::all()->toArray(),'tendv','madv');

            return view('manage.kkgia.ttdn.index')
                ->with('model', $model)
                ->with('modellvcc',$modellvcc)
                ->with('modeltttd', $modeltttd)
                ->with('modeltttdct',$modeltttdct)
                ->with('a_nghe',$a_nghe)
                ->with('a_dv',$a_dv)
                ->with('m_doanhnghiep',$m_doanhnghiep)
                ->with('m_diaban',$m_diaban)
                ->with('a_diaban',array_column($m_diaban->toarray(), 'tendiaban', 'madiaban'))
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Thông tin doanh nghiệp');
        }else
            return view('errors.notlogin');
    }

    public function ttdnedit(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = TtDnTd::where('madv',$inputs['madv'])->first();

            if($model == null){
                TtDnTdCt::where('madv',$inputs['madv'])->delete();
                $model = Company::where('madv',$inputs['madv'])->first();
                $modelgetlvcc = CompanyLvCc::where('madv', $model->madv)->get();
                foreach ($modelgetlvcc as $lvcc) {
                    $modeladddf = new TtDnTdCt();
                    $modeladddf->madv = $lvcc->madv;
                    //$modeladddf->manganh = $lvcc->manganh;
                    $modeladddf->manghe = $lvcc->manghe;
                    //$modeladddf->mahuyen = $lvcc->mahuyen;
                    //$modeladddf->trangthai = 'CXD';
                    $modeladddf->save();
                }

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

    public function ttdnupdate(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = TtDnTd::where('madv',$inputs['madv'])->first();
            if($model == null){
                $inputs['trangthai'] = 'CC';
                TtDnTd::create($inputs);
            }else{
                $model->update($inputs);
            }

            if(isset($inputs['tailieu'])){
                $ipf1 = $request->file('tailieu');
                $inputs['ipt1'] = $inputs['madv'].'df.'.$ipf1->getClientOriginalExtension();
                $ipf1->move(public_path() . '/data/doanhnghiep/', $inputs['ipt1']);
                $inputs['tailieu']= $inputs['ipt1'];
            }else{
                $inputs['tailieu'] = Company::where('madv',$inputs['madv'])->first()->tailieu;
            }

            return redirect('/doanhnghiep/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function ttdnchinhsua(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = TtDnTd::where('madv',$inputs['madv'])->first();
            $m_nganh = DmNganhKd::where('theodoi','TD')->get();
            $m_nghe = DmNgheKd::where('theodoi','TD')->get();
            $modellvcc = TtDnTdCt::where('madv', $model->madv)->get();
            return view('manage.kkgia.ttdn.edit')
                ->with('model', $model)
                ->with('modellvcc', $modellvcc)
                ->with('m_nganh', $m_nganh)
                ->with('m_nghe', $m_nghe)
                ->with('a_nghe', array_column($m_nghe->toArray(),'tennghe','manghe'))
                ->with('pageTitle', 'Thông tin doanh nghiệp chỉnh sửa');

//            if(session('admin')->maxa == $model->maxa) {
//                $modellvcc = TtDnTdCt::Leftjoin('town','town.maxa','=','ttdntdct.mahuyen')
//                    ->join('dmnganhkd','dmnganhkd.manganh','=','ttdntdct.manganh')
//                    ->join('dmnghekd','dmnghekd.manghe','=','ttdntdct.manghe')
//                    ->select('ttdntdct.*','town.tendv','dmnganhkd.tennganh','dmnghekd.tennghe')
//                    ->where('ttdntdct.maxa',$model->maxa)
//                    ->get();
//                $nganhs = DmNganhKd::where('theodoi','TD')
//                    ->get();
//                return view('manage.kkgia.ttdn.editdf')
//                    ->with('model', $model)
//                    ->with('modellvcc',$modellvcc)
//                    ->with('nganhs',$nganhs)
//                    ->with('pageTitle', 'Thông tin doanh nghiệp chỉnh sửa');
//            }else
//                return view('errors.noperm');
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

    public function ttdnchuyen(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = TtDnTd::where('madv',$inputs['madv'])->first();
            $model->trangthai = 'CD';
            if($model->save()) {
                $modeldn = Company::where('madv',$model->madv)
                    ->first();
                $modeldv = GeneralConfigs::first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu thay đổi thông tin doanh nghiệp !!!';
                $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận yêu cầu thay đổi thông tin doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->madv.' !!!';
                $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
                $run->handle();
                //dispatch($run);
            }
            return redirect('doanhnghiep/danhsach');
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

    //xét duyệt thay đổi thông tin doanh nghiệp
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/doanhnghiep';
            $a_diaban = getDiaBan_HeThong(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $model = TtDnTd::where('madiaban', $inputs['madiaban'])->get();

            //dd($a_diaban);
            return view('manage.kkgia.ttdn.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', $a_diaban)
                ->with('pageTitle', 'Thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    public function chitiet(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = TtDnTd::where('madv',$inputs['madv'])->first();
            $modellvcc = TtDnTdCt::where('madv', $model->madv)->get();
            $m_nganh = DmNganhKd::where('theodoi','TD')->get();
            $m_nghe = DmNgheKd::where('theodoi','TD')->get();
            return view('manage.kkgia.ttdn.xetduyet.detail')
                ->with('model', $model)
                ->with('modellvcc', $modellvcc)
                ->with('m_nganh', $m_nganh)
                ->with('m_nghe', $m_nghe)
                ->with('a_nghe', array_column($m_nghe->toArray(),'tennghe','manghe'))
                ->with('pageTitle', 'Thông tin doanh nghiệp');
        } else
            return view('errors.notlogin');
    }

    public function thaydoi(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $model = TtDnTd::where('madv', $inputs['madv'])->first();
            $com = Company::where('madv', $inputs['madv'])->first();
            $com->tendn = $model->tendn;
            $com->tel = $model->tel;
            $com->fax = $model->fax;
            $com->diachi = $model->diachi;
            $com->email = $model->email;
            $com->chucdanh = $model->chucdanh;
            $com->nguoiky = $model->nguoiky;
            $com->diadanh = $model->diadanh;
            $com->save();
            $m_llvcc = TtDnTdCt::where('madv', $model->madv)->get();
            CompanyLvCc::where('madv', $model->madv)->delete();
            foreach ($m_llvcc as $lv) {
                $ct = new CompanyLvCc();
                $ct->madv = $lv->madv;
                $ct->manghe = $lv->manghe;
                $ct->save();
            }
            TtDnTdCt::where('madv', $model->madv)->delete();
            TtDnTd::where('madv', $model->madv)->delete();
            return redirect('doanhnghiep/xetduyet?madiaban=' . $model->madiaban);
        } else
            return view('errors.notlogin');
    }

}
