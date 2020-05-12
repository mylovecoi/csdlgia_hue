<?php

namespace App\Http\Controllers\manage\giaetanol;

use App\District;
use App\Model\manage\kekhaigia\kkgiaetanol\KkGiaEtanol;
use App\Model\manage\kekhaigia\kkgiaetanol\KkGiaEtanolCt;
use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_binhongia;
use App\Model\view\view_dmnganhnghe;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaEtanolController extends Controller
{
    public function ttdn(Request $request){
        if (Session::has('admin')) {

            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $inputs['mh'] = DmNgheKd::where('manghe','ETANOL')
                    ->first()->tennghe;
                $modeldmnghe = DmNgheKd::where('manghe','ETANOL')
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

                return view('manage.kkgia.dkg.kekhaigiaetanol.kekhai.ttdn')
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
            $inputs['url'] = '/giaetanol';
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            /*dd($m_donvi);*/
            $m_diaban = dsdiaban::wherein('madiaban', a_unique(array_column($m_donvi->toArray(),'madiaban')))->get();
            $m_donvi_th = getDonViTongHop_dn('giaetanol',session('admin')->level, session('admin')->madiaban);
            /*dd($m_donvi_th);*/

            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_donvi->first()->madiaban;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $m_etanol = view_dmnganhnghe::where('manghe', 'ETANOL')->get();

            $m_lvkd = CompanyLvCc::/*where('madv', $inputs['madv'])
                ->*/wherein('manghe',array_column($m_etanol->toarray(),'manghe'))->get();
            /*dd($m_lvkd);*/
            //lấy danh mục nghề theo đơn vị đăng ký
            $m_etanol = $m_etanol->wherein('manghe',array_column($m_lvkd->toarray(),'manghe'));
            /*dd($m_etanol);*/
            $model = KkGiaEtanol::where('maxa',$inputs['madv'])->get();
            /*dd($model);*/
            if ($inputs['nam'] != 'all')
                $model = KkGiaEtanol::where('maxa',$inputs['madv'])
                    ->whereYear('ngayhieuluc', $inputs['nam'])
                    ->get();

            return view('manage.giaetanol.kekhai.index')
                ->with('model', $model/*->get()->sortby('ngayhieuluc')*/)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_etanol', $m_etanol)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_phanloai',  array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá'))
                ->with('a_nghe',array_column($m_etanol->toarray(),'tennghe','manghe'))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ giá kê khai etanol');

        }else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new KkGiaEtanol();
            $model->madv = $inputs['madv'];
            $model->mahs = $inputs['madv'] . '_' . getdate()[0];
            $model->manghe = $inputs['manghe'];
            $m_nghe = DmNgheKd::where('manghe', $inputs['manghe'])->first();
            $m_dn = Company::where('madv', $inputs['madv'])->first();

            //xóa các chi tiết ko có hồ sơ (dữ liệu thừa do khi tạo mới thì tự thêm vào trong chi tiết mà ko cần lưu hồ sơ)
            /*DB::statement("DELETE FROM kkgiaetanolct WHERE mahs not in (SELECT mahs FROM kkgiaetanol where madv='" . $inputs['madv'] . "')");*/

            //lấy hồ sơ liền kề
            $hslk = KkGiaEtanol::where('trangthai', 'HT')
                ->where('maxa', $inputs['madv'])
                /*->where('manghe', $inputs['manghe'])*/
                ->orderby('ngayhieuluc','desc')->first();
            if($hslk != null){
                $model->socvlk = $hslk->socv;
                $model->ngaycvlk = $hslk->ngaynhap;
                $m_ct = KkGiaEtanolCt::where('mahs', $hslk->mahs)->get();
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
                KkGiaEtanolCt::insert($a_ct);
            }

            $inputs['url'] = '/giaetanol';
            return view('manage.giaetanol.kekhai.create')
                ->with('model', $model)
                ->with('model_ct', nullValue())
                ->with('m_nghe', $m_nghe)
                ->with('inputs', $inputs)
                ->with('m_dn', $m_dn)
                ->with('pageTitle', 'Giá kê khai etanol');

        }
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaEtanol::where('mahs',$inputs['mahs'])->first();
            if($model == null){
                $m_nghe = DmNgheKd::where('manghe', 'ETANOL')->first();
                $inputs['phanloai'] = $m_nghe->phanloai;
                $inputs['trangthai'] = 'CC';
                KkGiaEtanol::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('giaetanol/danhsach?madv='.$inputs['maxa']);

        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $mahs = $input['mahs'];
            $modelkk = KkGiaEtanol::where('mahs',$mahs)->first();
            //chưa gán lại số hồ sơ; thòi gian theo macqcq
            $modeldn = Company::where('madv',$modelkk->madv)->first();
            $modelkkct = KkGiaEtanolCt::where('mahs',$modelkk->mahs)->get();
            $modelcqcq = view_dsdiaban_donvi::where('madv', $modelkk->macqcq)->first();
            return view('manage.giaetanol.baocao.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Giá kê khai etanol');

        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (Session::has('admin')) {
            //Kiểm tra có thuộc sự quản lý hay k
            $inputs = $request->all();
            $model = KkGiaEtanol::where('mahs',$inputs['mahs'])->first();
            $modelct = KkGiaEtanolCt::where('mahs',$model->mahs)->get();
            $m_nghe = DmNgheKd::where('manghe', 'ETANOL')->first();
            $m_dn = Company::where('madv', $model->madv)->first();
            $inputs['url'] = '/giaetanol';
            return view('manage.giaetanol.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('m_nghe', $m_nghe)
                ->with('inputs', $inputs)
                ->with('m_dn', $m_dn)
                ->with('pageTitle', 'Chỉnh sửa hồ sơ giá etanol');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaEtanol::where('mahs',$inputs['mahs'])->first();
            if($model->delete()){
                KkGiaEtanolCt::where('mahs',$model->mahs)->delete();
            }
            return redirect('giaetanol/danhsach');
        }else
            return view('errors.notlogin');
    }

    public function timkiem(){
        if (Session::has('admin')) {
            //$inputs = $request->all();
            $inputs['url'] = '/giaetanol';
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', a_unique(array_column($m_donvi->toArray(),'madiaban')))->get();
            $m_dm = view_dmnganhnghe::where('manghe', 'ETANOL')->get();

            //dd($m_bog);
            return view('manage.giaetanol.timkiem.index')
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_dm', array_column($m_dm->toarray(),'tennghe','manghe'))
                ->with('m_donvi', $m_donvi)
                ->with('a_phanloai',  array('DK'=>'Đăng ký giá','KK'=>'Kê khai giá'))
                ->with('pageTitle', 'Tìm kiếm hồ sơ giá kê khai giá etanol');

        }else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request){
        if (Session::has('admin')) {
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $inputs['url'] = '/giaetanol';
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            $model = view_binhongia::wherein('madv ', array_column($m_donvi->toarray(), 'madv'));
            //dd($inputs);

            if ($inputs['madv'] != 'all') {
                $model = $model->where('madv', $inputs['madv']);
            }
            if ($inputs['manghe'] != 'all') {
                $model = $model->where('manghe', $inputs['manghe']);
            }

            if ($inputs['tenhh'] != '') {
                $model = $model->where('tenhh', 'like', getTimkiemLike($inputs['tenhh'], 1));
            }
            //dd($model);
            if (getDayVn($inputs['ngayapdung_tu']) != '') {
                $model = $model->where('ngayhieuluc', '>=', $inputs['ngayapdung_tu']);
            }

            if (getDayVn($inputs['ngayapdung_den']) != '') {
                $model = $model->where('ngayhieuluc', '<=', $inputs['ngayapdungden']);
            }

            $model = $model->where('giakk', '>=', chkDbl($inputs['giakk_tu']));
            if (chkDbl($inputs['giakk_den']) > 0) {
                $model = $model->where('giakk', '<=', chkDbl($inputs['giakk_den']));
            }

            $a_dm = array_column(view_dmnganhnghe::where('manghe', 'ETANOL')->get()->toArray(), 'tennghe', 'manghe');
            return view('manage.giaetanol.timkiem.result')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('a_diaban', array_column($m_donvi->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_donvi', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('a_dm', $a_dm)
                ->with('pageTitle', 'Tìm kiếm thông tin giá etanol');
        } else
            return view('errors.notlogin');
    }
}
