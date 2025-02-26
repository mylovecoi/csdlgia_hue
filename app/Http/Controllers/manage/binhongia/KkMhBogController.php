<?php

namespace App\Http\Controllers\manage\binhongia;

use App\District;
use App\Jobs\SendMail;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBog;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBogCt;
use App\Model\system\company\Company;
use App\Model\system\company\CompanyLvCc;
use App\Model\system\dmdvt;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_binhongia;
use App\Model\view\view_dmnganhnghe;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KkMhBogController extends Controller
{
    public function ttdn(Request $request)
    {
        if (Session::has('admin')) {

            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $inputs['mh'] = DmNgheKd::where('manganh', 'BOG')
                    ->where('manghe', $inputs['manghe'])
                    ->first()->tennghe;
                $modeldmnghe = DmNgheKd::where('manganh', 'BOG')
                    ->where('manghe', $inputs['manghe'])
                    ->first();
                if (session('admin')->level == 'T') {
                    $modeldv = Town::where('mahuyen', $modeldmnghe->mahuyen)->get();
                    $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : $modeldv->first()->maxa;
                } elseif (session('admin')->level == 'H') {
                    if (session('admin')->mahuyen == $modeldmnghe->mahuyen) {
                        $modeldv = Town::where('mahuyen', $modeldmnghe->mahuyen)->get();
                        $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : $modeldv->first()->maxa;
                    } else
                        return view('errors.perm');
                } else {
                    if (session('admin')->mahuyen == $modeldmnghe->mahuyen) {
                        $modeldv = Town::where('mahuyen', $modeldmnghe->mahuyen)->get();
                        $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : session('admin')->maxa;
                    } else
                        return view('errors.perm');
                }
                $model = Company::join('companylvcc', 'companylvcc.maxa', '=', 'company.maxa')
                    ->join('town', 'town.maxa', '=', 'companylvcc.mahuyen')
                    ->where('companylvcc.manghe', $inputs['manghe'])
                    ->where('companylvcc.mahuyen', $inputs['maxa'])
                    ->where('company.trangthai', 'Kích hoạt')
                    ->select('company.*', 'town.tendv')
                    ->get();

                $ttql = District::where('mahuyen', $modeldmnghe->mahuyen)
                    ->first();

                return view('manage.kkgia.dkg.kekhaimhbog.kekhai.ttdn')
                    ->with('model', $model)
                    ->with('modeldv', $modeldv)
                    ->with('ttql', $ttql)
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Danh sách thông tin doanh nghiệp');
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    /*
     - Lấy danh mục địa bàn (X,H,T), gán mặc nếu rỗng
     - Lấy danh mục đơn vị, gán mặc định nếu rỗng
     - Load hồ sơ theo đơn vị
    - Load ngành nghề theo lĩnh vực đăng ký
    - Load đơn vị chủ quản để gửi hồ sơ
     */
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/binhongia';
            //$m_diaban = dsdiaban::wherein('madiaban', array_keys(getDiaBan_Level(session('admin')->level, session('admin')->madiaban)))->get();
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', a_unique(array_column($m_donvi->toArray(), 'madiaban')))->get();
            $m_donvi_th = getDonViTongHop_dn('bog', session('admin')->level, session('admin')->madiaban);
            
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_donvi->first()->madiaban;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $m_bog = view_dmnganhnghe::where('manganh', 'BOG')->get();
            $m_lvkd = CompanyLvCc::where('madv', $inputs['madv'])
                ->wherein('manghe', array_column($m_bog->toarray(), 'manghe'))->get();
            //dd($m_lvkd);
            //lấy danh mục nghề theo đơn vị đăng ký
            $m_bog = $m_bog->wherein('manghe', array_column($m_lvkd->toarray(), 'manghe'));

            $model = KkMhBog::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('ngayhieuluc', $inputs['nam']);
            //dd($model->get());
            return view('manage.bog.kekhai.index')
                ->with('model', $model->get()->sortby('ngayhieuluc'))
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_bog', $m_bog)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_phanloai',  array('DK' => 'Đăng ký giá', 'KK' => 'Kê khai giá'))
                ->with('a_nghe', array_column($m_bog->toarray(), 'tennghe', 'manghe'))
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ giá kê khai mặt hàng bình ổn giá');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new KkMhBog();
            $model->madv = $inputs['madv'];
            $model->mahs = $inputs['madv'] . '_' . getdate()[0];
            $model->manghe = $inputs['manghe'];
            $m_nghe = DmNgheKd::where('manghe', $inputs['manghe'])->first();
            $m_dn = Company::where('madv', $inputs['madv'])->first();

            //xóa các chi tiết ko có hồ sơ (dữ liệu thừa do khi tạo mới thì tự thêm vào trong chi tiết mà ko cần lưu hồ sơ)
            //DB::statement("DELETE FROM kkmhbogct WHERE mahs not in (SELECT mahs FROM kkmhbog where madv='" . $inputs['madv'] . "')");

            //lấy hồ sơ liền kề
            $hslk = KkMhBog::wherein('trangthai', ['HT', 'DD', 'CB', 'HCB'])
                ->where('madv', $inputs['madv'])
                ->where('manghe', $inputs['manghe'])
                ->orderby('ngayhieuluc', 'desc')->first();

            if ($hslk != null) {
                $model->socvlk = $hslk->socv;
                $model->ngaycvlk = $hslk->ngaynhap;
                $m_ct = KkMhBogCt::where('mahs', $hslk->mahs)->get();
                $a_ct = array();
                foreach ($m_ct as $ct) {
                    $a_ct[] = [
                        'tenhh' => $ct->tenhh,
                        'quycach' => $ct->quycach,
                        'dvt' => $ct->dvt,
                        'gialk' => $ct->giakk,
                        'giakk' => $ct->giakk,
                        'ghichu' => $ct->ghichu,
                        'madv' => $model->madv,
                        'mahs' => $model->mahs,
                        'trangthai' => 'CXD',
                    ];
                }
                foreach (array_chunk($a_ct , 100) as $dm){
                    KkMhBogCt::insert($dm);
                }
                // KkMhBogCt::insert($a_ct);
            }
            $a_pl = array_column(KkMhBogCt::all('plhh')->toArray(), 'plhh', 'plhh');
            $a_dvt = array_column(dmdvt::all()->toArray(), 'dvt', 'dvt');
            $model_ct = KkMhBogCt::where('mahs', $model->mahs)->get();
            $inputs['url'] = '/binhongia';
            return view('manage.bog.kekhai.create')
                ->with('model', $model)
                ->with('model_ct', $model_ct)
                ->with('m_nghe', $m_nghe)
                ->with('inputs', $inputs)
                ->with('m_dn', $m_dn)
                ->with('a_pl', $a_pl)
                ->with('a_dvt', $a_dvt)
                ->with('pageTitle', 'Giá kê khai mặt hàng BOG');
        }
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            //            $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
            //            $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
            //            $inputs['ngaycvlk']= getDateToDb($inputs['ngaycvlk']);
            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
            if ($model == null) {
                $m_nghe = DmNgheKd::where('manghe', $inputs['manghe'])->first();
                $inputs['phanloai'] = $m_nghe->phanloai;
                $inputs['trangthai'] = 'CC';
                KkMhBog::create($inputs);
            } else {
                $model->update($inputs);
            }


            //            if(isset($inputs['ipf1']) && $inputs['ipf1'] !='' ) {
            //                $ipf1 = $request->file('ipf1');
            //                $inputs['ipt1'] = $inputs['mahs'] .'1.'.$ipf1->getClientOriginalExtension();
            //                $ipf1->move(public_path() . '/data/kkdkg/', $inputs['ipt1']);
            //                $inputs['ipf1']= $inputs['ipt1'];
            //            }

            return redirect('binhongia/danhsach?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    //kiểm tra phân loại hồ so để DKG=>56; KKG=>233
    public function show(Request $request)
    {
        if (Session::has('admin')) {
            $input = $request->all();
            $mahs = $input['mahs'];
            $modelkk = KkMhBog::where('mahs', $mahs)->first();
            //dd($modelkk);
            //chưa gán lại số hồ sơ; thòi gian theo macqcq
            $modeldn = Company::where('madv', $modelkk->madv)->first();
            $modelkkct = KkMhBogCt::where('mahs', $modelkk->mahs)->get();
            $modelcqcq = view_dsdiaban_donvi::where('madv', $modelkk->macqcq)->first();
            $a_plhh = a_unique(array_column($modelkkct->toarray(), 'plhh'));
            foreach ($modelkkct as $ct) {
                $ct->chenhlech = $ct->gialk > 0 ? getDbl($ct->giakk) - getDbl($ct->gialk) : 0;
                if(getDbl($ct->gialk) == 0){
                    $ct->phantram = 0;
                }else{
                    $ct->phantram = $ct->giakk > 0 ? round(($ct->chenhlech / $ct->gialk) * 100, 2) : 0;
                }
                
            }
            if (strtotime($modelkk->ngayhieuluc) < strtotime('2024-01-01')) {
                return view('manage.bog.baocao.print56')
                    ->with('modelkk', $modelkk)
                    ->with('modeldn', $modeldn)
                    ->with('modelkkct', $modelkkct)
                    ->with('modelcqcq', $modelcqcq)
                    ->with('a_plhh', $a_plhh)
                    ->with('pageTitle', 'Giá kê khai mặt hàng bình ổn giá');
            }
            // dd(strtotime('2024-07-01'));
            return view('manage.bog.baocao.print')
                ->with('modelkk', $modelkk)
                ->with('modeldn', $modeldn)
                ->with('modelkkct', $modelkkct)
                ->with('modelcqcq', $modelcqcq)
                ->with('a_plhh', $a_plhh)
                ->with('pageTitle', 'Giá kê khai mặt hàng bình ổn giá');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {
        if (Session::has('admin')) {
            //Kiểm tra có thuộc sự quản lý hay k
            $inputs = $request->all();
            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
            // $modelct = KkMhBogCt::where('mahs', $model->mahs)->orderby('plhh')->get();
            $modelct = KkMhBogCt::where('mahs', $model->mahs)->get();
            $m_nghe = DmNgheKd::where('manghe', $model->manghe)->first();
            $m_dn = Company::where('madv', $model->madv)->first();
            $inputs['url'] = '/binhongia';
            $a_pl = array_column(KkMhBogCt::all('plhh')->toArray(), 'plhh', 'plhh');
            $a_dvt = array_column(dmdvt::all()->toArray(), 'dvt', 'dvt');
            return view('manage.bog.kekhai.create')
                ->with('model', $model)
                ->with('model_ct', $modelct)
                ->with('m_nghe', $m_nghe)
                ->with('inputs', $inputs)
                ->with('m_dn', $m_dn)
                ->with('a_pl', $a_pl)
                ->with('a_dvt', $a_dvt)
                ->with('pageTitle', 'Chỉnh sửa hồ sơ giá kê khai mặt hàng BOG');
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
            if ($model->delete()) {
                KkMhBogCt::where('mahs', $model->mahs)->delete();
            }
            return redirect('binhongia/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function timkiem()
    {
        if (Session::has('admin')) {
            //$inputs = $request->all();
            $inputs['url'] = '/binhongia';
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', a_unique(array_column($m_donvi->toArray(), 'madiaban')))->get();
            $m_dm = view_dmnganhnghe::where('manganh', 'BOG')->get();

            //dd($m_bog);
            return view('manage.bog.timkiem.index')
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_dm', array_column($m_dm->toarray(), 'tennghe', 'manghe'))
                ->with('m_donvi', $m_donvi)
                ->with('a_phanloai',  array('DK' => 'Đăng ký giá', 'KK' => 'Kê khai giá'))
                ->with('pageTitle', 'Tìm kiếm hồ sơ giá kê khai mặt hàng bình ổn giá');
        } else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request)
    {
        if (Session::has('admin')) {
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $inputs['url'] = '/binhongia';
            $m_donvi = getDoanhNghiep(session('admin')->level, session('admin')->madiaban);
            $model = view_binhongia::wherein('madv', array_column($m_donvi->toarray(), 'madv'));
            //dd($inputs);

            if ($inputs['madv'] != 'all') {
                $model = $model->where('madv', $inputs['madv']);
            }
            if ($inputs['manghe'] != 'all') {
                $model = $model->where('manghe', $inputs['manghe']);
            }

            if ($inputs['tenhh'] != '') {
                //$model = $model->where('tenhh', 'like', $inputs['tenhh'].'%');
                $model = $model->where('tenhh', 'like', getTimkiemLike($inputs['tenhh'], 1));
                //$model = $model->where('tenhh',$inputs['tenhh']);
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

            $a_dm = array_column(view_dmnganhnghe::where('manganh', 'BOG')->get()->toArray(), 'tennghe', 'manghe');
            return view('manage.bog.timkiem.result')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('a_diaban', array_column($m_donvi->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_donvi', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('a_dm', $a_dm)
                ->with('pageTitle', 'Tìm kiếm thông tin giá mặt hàng bình ổn giá');
        } else
            return view('errors.notlogin');
    }
}
