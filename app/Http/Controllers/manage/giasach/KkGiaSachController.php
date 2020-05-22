<?php

namespace App\Http\Controllers\manage\giasach;

use App\Model\manage\kekhaigia\kkgiasach\KkGiaSach;
use App\Model\manage\kekhaigia\kkgiasach\KkGiaSachCt;
use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_dmnganhnghe;
use App\District;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KkGiaSachController extends Controller
{
    public function ttdn(Request $request){
        if (Session::has('admin')) {

            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $inputs['mh'] = DmNgheKd::where('manghe','SACH')
                    ->first()->tennghe;
                $modeldmnghe = DmNgheKd::where('manghe','SACH')
                    ->first();
                if(session('admin')->level == 'T'){
                    $modeldv = Town::where('mahuyen',$modeldmnghe->mahuyen)->get();
                    $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : $modeldv->first()->maxa;
                }elseif(session('admin')->level == 'H'){
                    if(session('admin')->mahuyen == $modeldmnghe->mahuyen){
                        $modeldv = Town::where('mahuyen',$modeldmnghe->mahuyen)->get();
                        $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : $modeldv->first()->maxa;
                    }else
                        return view('errors.perm');
                }else{
                    if(session('admin')->mahuyen == $modeldmnghe->mahuyen){
                        $modeldv = Town::where('mahuyen',$modeldmnghe->mahuyen)->get();
                        $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : session('admin')->maxa;
                    }else
                        return view('errors.perm');
                }
                $model = Company::join('companylvcc','companylvcc.maxa','=','company.maxa')
                    ->join('town','town.maxa','=','companylvcc.mahuyen')
                    ->where('companylvcc.manghe',$inputs['manghe'])
                    ->where('companylvcc.mahuyen',$inputs['maxa'])
                    ->where('company.trangthai','Kích hoạt')
                    ->select('company.*','town.tendv')
                    ->get();

                $ttql = District::where('mahuyen',$modeldmnghe->mahuyen)
                    ->first();

                return view('manage.kkgia.dkg.kekhaigiasach.kekhai.ttdn')
                    ->with('model', $model)
                    ->with('modeldv',$modeldv)
                    ->with('ttql',$ttql)
                    ->with('inputs',$inputs)
                    ->with('pageTitle', 'Danh sách thông tin doanh nghiệp');
            } else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giasach';
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', a_unique(array_column($m_donvi->toArray(),'madiaban')))->get();
            $m_donvi_th = getDonViTongHop_dn('giasach',session('admin')->level, session('admin')->madiaban);

            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_donvi->first()->madiaban;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $m_sach = view_dmnganhnghe::where('manghe', 'SACH')->get();

            $m_lvkd = CompanyLvCc::where('madv', $inputs['madv'])
                ->wherein('manghe',array_column($m_sach->toarray(),'manghe'))->get();
            //lấy danh mục nghề theo đơn vị đăng ký
            $m_sach = $m_sach->wherein('manghe',array_column($m_lvkd->toarray(),'manghe'));
            $model = KkGiaSach::where('madv',$inputs['madv'])->get();
            if ($inputs['nam'] != 'all')
                $model = KkGiaSach::where('madv',$inputs['madv'])
                    ->whereYear('ngayhieuluc', $inputs['nam'])
                    ->get();

            return view('manage.giasach.kekhai.index')
                ->with('model', $model->sortby('ngayhieuluc'))
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_sach', $m_sach)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_phanloai',  array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá'))
                ->with('a_nghe',array_column($m_sach->toarray(),'tennghe','manghe'))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ giá kê khai sách');

        }else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new KkGiaSach();
            $model->madv = $inputs['madv'];
            $model->mahs = $inputs['madv'] . '_' . getdate()[0];
            $model->manghe = $inputs['manghe'];
            $m_nghe = DmNgheKd::where('manghe', $inputs['manghe'])->first();
            $m_dn = Company::where('madv', $inputs['madv'])->first();

            //xóa các chi tiết ko có hồ sơ (dữ liệu thừa do khi tạo mới thì tự thêm vào trong chi tiết mà ko cần lưu hồ sơ)
            DB::statement("DELETE FROM kkgiasachct WHERE mahs not in (SELECT mahs FROM kkgiasach where madv='" . $inputs['madv'] . "')");

            //lấy hồ sơ liền kề
            $hslk = KkGiaSach::where('trangthai', 'HT')
                ->where('madv', $inputs['madv'])
                ->orderby('ngayhieuluc','desc')->first();

            if($hslk != null){
                $model->socvlk = $hslk->socv;
                $model->ngaycvlk = $hslk->ngaynhap;
                $m_ct = KkGiaSachCt::where('mahs', $hslk->mahs)->get();
                $a_ct = array();
                foreach ($m_ct as $ct) {
                    $a_ct[] = ['tthhdv' => $ct->tthhdv,
                        'qccl' => $ct->qccl,
                        'dvt' => $ct->dvt,
                        'dongialk' => $ct->dongialk,
                        'dongia' => $ct->dongia,
                        'ghichu' => $ct->ghichu,
                        'madv' => $inputs['madv'],
                        'mahs' => $inputs['mahs'],
                        'trangthai' => 'CXD',
                    ];
                }
                KkGiaSachCt::insert($a_ct);
            }

            $inputs['url'] = '/giasach';
            return view('manage.giasach.kekhai.create')
                ->with('model', $model)
                ->with('model_ct', nullValue())
                ->with('m_nghe', $m_nghe)
                ->with('inputs', $inputs)
                ->with('m_dn', $m_dn)
                ->with('pageTitle', 'Giá kê khai sách');
        }
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaSach::where('mahs',$inputs['mahs'])->first();
            if($model == null){
                $inputs['phanloai'] = 'DK';
                $inputs['trangthai'] = 'CC';
                $inputs['congbo'] = 'CHUACONGBO';
                KkGiaSach::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('giasach/danhsach?madv='.$inputs['madv']);

        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $mahs = $input['mahs'];
            $modelkk = KkGiaSach::where('mahs',$mahs)->first();
            //chưa gán lại số hồ sơ; thòi gian theo macqcq
            $modeldn = Company::where('madv',$modelkk->madv)->first();
            $modelkkct = KkGiaSachCt::where('mahs',$modelkk->mahs)->get();
            $modelcqcq = view_dsdiaban_donvi::where('madv', $modelkk->macqcq)->first();
            return view('manage.giasach.baocao.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Giá kê khai sách');

        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (Session::has('admin')) {
            //Kiểm tra có thuộc sự quản lý hay k
            $inputs = $request->all();
            $model = KkGiaSach::where('mahs',$inputs['mahs'])->first();
            $modelct = KkGiaSachCt::where('mahs',$model->mahs)->get();
            $m_nghe = DmNgheKd::where('manghe', 'SACH')->first();
            $m_dn = Company::where('madv', $model->madv)->first();
            $inputs['url'] = '/giasach';
            return view('manage.giasach.kekhai.create')
                ->with('model', $model)
                ->with('model_ct', $modelct)
                ->with('m_nghe', $m_nghe)
                ->with('inputs', $inputs)
                ->with('m_dn', $m_dn)
                ->with('pageTitle', 'Chỉnh sửa hồ sơ giá sách');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaSach::where('mahs',$inputs['mahs'])->first();
            if($model->delete()){
                KkGiaSachCt::where('mahs',$model->mahs)->delete();
            }
            return redirect('giasach/danhsach?madv='.$model->madv);
        }else
            return view('errors.notlogin');
    }

    public function timkiem(){
        if (Session::has('admin')) {
            //$inputs = $request->all();
            $inputs['url'] = '/giasach';
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', a_unique(array_column($m_donvi->toArray(),'madiaban')))->get();
            $m_dm = view_dmnganhnghe::where('manghe', 'SACH')->get();

            return view('manage.giasach.timkiem.index')
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_dm', array_column($m_dm->toarray(),'tennghe','manghe'))
                ->with('m_donvi', $m_donvi)
                ->with('a_phanloai',  array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá'))
                ->with('pageTitle', 'Tìm kiếm hồ sơ giá sách');

        }else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request){
        if (Session::has('admin')) {
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $inputs['url'] = '/giasach';
            $model = KkGiaSachCt::join('kkgiasach','kkgiasach.mahs', '=', 'kkgiasachct.mahs')
                ->join('company', 'company.madv', '=', 'kkgiasach.madv')
                ->select('kkgiasachct.*','kkgiasach.ngayhieuluc','company.tendn');

            if ($inputs['tthhdv'] != '') {
                $model = $model->where('tthhdv','LIKE', "%{$inputs['tthhdv']}%");
            }

            if (getDayVn($inputs['ngayapdung_tu']) != '') {
                $model = $model->where('kkgiasach.ngayhieuluc', '>=', $inputs['ngayapdung_tu']);
            }

            if (getDayVn($inputs['ngayapdung_den']) != '') {
                $model = $model->where('kkgiasach.ngayhieuluc', '<=', $inputs['ngayapdung_den']);
            }

            $model = $model->where('kkgiasachct.dongia', '>=', chkDbl($inputs['dongia_tu']));
            if (chkDbl($inputs['dongia_den']) > 0) {
                $model = $model->where('kkgiasachct.dongia', '<=', chkDbl($inputs['dongia_den']));
            }
            $model = $model->get();

            $a_dm = array_column(view_dmnganhnghe::where('manghe', 'SACH')->get()->toArray(), 'tennghe', 'manghe');
            return view('manage.giasach.timkiem.result')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_dm', $a_dm)
                ->with('pageTitle', 'Tìm kiếm thông tin giá sách');
        } else
            return view('errors.notlogin');
    }
}
