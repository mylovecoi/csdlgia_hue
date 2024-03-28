<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\District;
use App\DmHangHoa;
use App\DmThamDinhGiaHh;
use App\dsdonvitdg;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_thamdinhgia;
use App\ThamDinhGia;
use App\ThamDinhGiaCt;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\manage\dinhgia\phichuyengia\dmphichuyengia;
use App\ThamDinhGiaCtDf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class ThamDinhGiaController extends Controller
{
    //<editor-fold des="Chức năng nhập liệu">
    public function index(Request $request)
    {
        //1. Chức năng chỉ danh cho tài khoản chức năng "NHAPLIEU", tài khoản lv = 'SSA'
        //tài khoản SSA list tất cả đơn vị nhập liệu (chức năng sau này cho tài khoản SSA nhập liệu)
        //2. Lấy danh sách đơn vị tiếp nhận:
        //  - level == 'H' => lấy các đơn vị tổng hợp trong địa bàn và các đơn vị tổng hơp level == 'T' (các sở ban ngành)
        // - level == 'T' => lấy các đơn vị tổng hơp level == 'T' (các sở ban ngành)
        // - SSA => lấy tất cả
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/thamdinhgia';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_donvi_th = getDonViTongHop('thamdinhgia',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';

            //lấy thông tin đơn vị
            $model = ThamDinhGia::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);

            return view('manage.thamdinhgia.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle','Thông tin hồ sơ hàng hóa chuyển từ phí sang giá');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //$a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            //$m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->where('level', 'H')->first();
            //DB::statement("DELETE FROM thamdinhgiact WHERE mahs not in (SELECT mahs FROM thamdinhgia where madv='" . $inputs['madv'] . "')");
            $model = new ThamDinhGia();
            $model->mahs = getdate()[0];
            $model->madv = $inputs['madv'];
            $model->trangthai = 'CHT';
            $model->thoidiem = date('Y-m-d');

            $inputs['url'] = '/thamdinhgia';
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $modelct = nullValue();
            $m_dvtdg = dsdonvitdg::all();
            $m_dmhh = DmHangHoa::all();
            //dd($a_dmhh);
            //dd(json_encode($a_dmhh));
            return view('manage.thamdinhgia.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                //->with('a_dm', array_column($m_danhmuc->toArray(),'tengia','maso'))
                //->with('a_diaban', getDiaBan_HoSo($m_diaban->where('level', 'H'), true))
                ->with('m_dvtdg', $m_dvtdg)
                ->with('a_dvt', $a_dvt)
                ->with('m_dmhh', $m_dmhh)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Hồ sơ thẩm định giá');

        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //$a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            //$m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            //$m_donvi = getDonViNhapLieu(session('admin')->level);
            $inputs['url'] = '/thamdinhgia';
            $model = ThamDinhGia::where('mahs', $inputs['mahs'])->first();
            $modelct = ThamDinhGiaCt::where('mahs', $model->mahs)->get();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $m_dvtdg = dsdonvitdg::all();
            $m_dmhh = DmHangHoa::all();

            return view('manage.thamdinhgia.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('a_dvt', $a_dvt)
                ->with('m_dmhh', $m_dmhh)
                ->with('m_dvtdg', $m_dvtdg)
                //->with('a_dm', array_column($m_danhmuc->toArray(),'tengia','maso'))
                //->with('a_diaban', getDiaBan_HoSo($m_diaban->where('level', 'H'), true))
                //->with('m_donvi', $m_donvi)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Chỉnh sửa hồ sơ thẩm định giá');

        } else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if(Session::has('admin')) {
            $inputs = $request->all();
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            $inputs['thoihan'] = getDateToDb($inputs['thoidiem']);
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] .'&1.'.$ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/thamdinhgia/', $name);
                $inputs['ipf1']= $name;
            }

            if(isset($inputs['ipf2'])){
                $ipf2 = $request->file('ipf2');
                $name = $inputs['mahs'] .'&2.'.$ipf2->getClientOriginalName();
                $ipf2->move(public_path() . '/data/thamdinhgia/', $name);
                $inputs['ipf2']= $name;
            }

            if(isset($inputs['ipf3'])){
                $ipf3 = $request->file('ipf3');
                $name = $inputs['mahs'] .'&3.'.$ipf3->getClientOriginalName();
                $ipf3->move(public_path() . '/data/thamdinhgia/', $name);
                $inputs['ipf3']= $name;
            }
            if(isset($inputs['ipf4'])){
                $ipf4 = $request->file('ipf4');
                $name = $inputs['mahs'] .'&4.'.$ipf4->getClientOriginalName();
                $ipf4->move(public_path() . '/data/thamdinhgia/', $name);
                $inputs['ipf4']= $name;
            }

            $model = ThamDinhGia::where('mahs', $inputs['mahs'])->first();
            if($model == null){
                $inputs['trangthai'] = 'CHT';
                $m_dv = dsdonvi::where('madv',$inputs['madv'])->first();
                $inputs['madiaban'] = $m_dv->madiaban;
                ThamDinhGia::create($inputs);
            }else{
                $model->update($inputs);
            }

            return redirect('thamdinhgia/danhsach?madv='.$inputs['madv']);
        }else
            return view('errors.notlogin');
    }

    public function chuyenhs(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThamDinhGia::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'HT',
                'username' => session('admin')->username,
                'mota' => 'Chuyển hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'macqcq' => $inputs['macqcq'],
                'madv' => $model->madv
            );

            $model->lichsu = json_encode($a_lichsu);
            $model->macqcq = $inputs['macqcq'];
            $model->trangthai = 'HT';
            //kiểm tra đơn vị tiếp nhận
            $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            if ($chk_dvcq->count() && $chk_dvcq->level == 'T') {
                $model->madv_t = $inputs['macqcq'];
                $model->thoidiem_t = date('Y-m-d');
                $model->trangthai_t = 'CHT';
            } else if ($chk_dvcq->count() && $chk_dvcq->level == 'ADMIN') {
                $model->madv_ad = $inputs['macqcq'];
                $model->thoidiem_ad = date('Y-m-d');
                $model->trangthai_ad = 'CHT';
            } else {
                $model->madv_h = $inputs['macqcq'];
                $model->thoidiem_h = date('Y-m-d');
                $model->trangthai_h = 'CHT';
            }
            $model->save();
            return redirect('thamdinhgia/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = ThamDinhGia::where('mahs', $inputs['mahs'])->first();
            ThamDinhGiaCt::where('mahs',$model->mahs)->delete();
            $model->delete();
            return redirect('thamdinhgia/danhsach?madv='.$model->madv);

        }else
            return view('errors.notlogin');
    }
    //</editor-fold>

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/thamdinhgia';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('thamdinhgia',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';
            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
                'tendv', 'madv');

            switch ($inputs['level']){
                case 'H':{
                    $model = ThamDinhGia::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_h;
                        $ct->macqcq = $ct->macqcq_h;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->thoidiem = $ct->thoidiem_h;
                        $ct->trangthai = $ct->trangthai_h;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
                case 'T':{
                    $model = ThamDinhGia::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_t;
                        $ct->macqcq = $ct->macqcq_t;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->thoidiem = $ct->thoidiem_t;
                        $ct->trangthai = $ct->trangthai_t;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
                case 'ADMIN':{
                    $model = ThamDinhGia::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_ad;
                        $ct->macqcq = $ct->macqcq_ad;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->thoidiem = $ct->thoidiem_ad;
                        $ct->trangthai = $ct->trangthai_ad;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
            }
            //dd($model);
            return view('manage.thamdinhgia.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H', 'T'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    public function chuyenxd(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $model = thamdinhgia::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'HT',
                'username' => session('admin')->username,
                'mota' => 'Chuyển hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'macqcq' => $inputs['macqcq'],
                'madv' => $inputs['madv'],
            );

            $model->lichsu = json_encode($a_lichsu);
            //kiểm tra thông tin đơn vị
            setHoanThanhDV($inputs['madv'], $model, ['macqcq' => $inputs['macqcq'], 'trangthai' => 'HT']);
            //kiểm tra đơn vị tiếp nhận
            $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            setHoanThanhCQ($chk_dvcq->level, $model, ['madv' => $inputs['macqcq'], 'trangthai' => 'CHT', 'thoidiem' => date('Y-m-d')]);

            //dd($model);
            $model->save();
            return redirect('thamdinhgia/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThamDinhGia::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'HHT',
                'username' => session('admin')->username,
                'mota' => 'Trả lại hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'madv' => $inputs['madv'],
            );
            $model->lichsu = json_encode($a_lichsu);
            setTraLai($inputs['madv'], $model, ['macqcq' => null, 'trangthai' => 'HHT', 'lydo' => null]);
            //dd($model);
            $model->save();
            return redirect('thamdinhgia/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThamDinhGia::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => $inputs['trangthai_ad'],
                'username' => session('admin')->username,
                'mota' => $inputs['trangthai_ad'] == 'CB' ? 'Công bố hồ sơ' : 'Hủy công bố hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
            );
            $model->lichsu = json_encode($a_lichsu);
            setCongBo($model, ['trangthai' => $inputs['trangthai_ad'],
                'congbo' => $inputs['trangthai_ad'] == 'CB' ? 'DACONGBO' : 'CHUACONGBO']);
            $model->save();
            return redirect('thamdinhgia/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>

    public function ketxuat(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            //lấy thông tin đơn vị
            $model = $this->getHoSo($inputs);
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            $m_diaban = dsdiaban::wherein('madiaban',array_column($model->toarray(),'madiaban'))->get();
            $a_dm = array_column(dmphichuyengia::all()->toarray(),
                'tengia', 'maso');
            return view('manage.thamdinhgia.reports.baocao')
                ->with('model',$model)
                ->with('a_dm',$a_dm)
                ->with('m_donvi',$m_donvi)
                ->with('m_diaban',$m_diaban)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    function getHoSo($inputs)
    {
        $m_donvi = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first();
        $inputs['level'] = $m_donvi->chucnang != 'NHAPLIEU' ? $m_donvi->level : 'NHAPLIEU';
        switch ($inputs['level']) {
            case 'H':
            {
                $model = view_thamdinhgia::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                break;
            }
            case 'T':
            {
                $model = view_thamdinhgia::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                break;
            }
            case 'ADMIN':
            {
                $model = view_thamdinhgia::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                break;
            }
            default:
            {//mặc định lấy đơn vị nhâp liệu
                $model = view_thamdinhgia::where('madv', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem', $inputs['nam']);
                break;
            }
        }
        return $model->get();
    }

    public function timkiem(){
        if(Session::has('admin')){
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            //dd($m_diaban);
            //$a_dm = array_column(dmphichuyengia::all()->toArray(),'tengia','maso');
            return view('manage.thamdinhgia.timkiem.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                //->with('a_dm',$a_dm)
                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request){
        if(Session::has('admin')){
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            $model = view_thamdinhgia::wherein('madv',array_column($m_donvi->toarray(),'madv'));
            //dd($model);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }
            if($inputs['tents'] != '') {
                $model = $model->where('tents', 'like', getTimkiemLike($inputs['tents']));
            }

            if(getDayVn($inputs['thoidiem_tu']) != ''){
                $model = $model->where('thoidiem','>=',$inputs['thoidiem_tu']);
            }

            if(getDayVn($inputs['thoidiem_den']) != ''){
                $model = $model->where('thoidiem','<=',$inputs['thoidiem_den']);
            }

            $model = $model->where('nguyengiadenghi','>=',chkDbl($inputs['nguyengiadenghi_tu']));
            if(chkDbl($inputs['nguyengiadenghi_den']) > 0){
                $model = $model->where('nguyengiadenghi','<=',chkDbl($inputs['nguyengiadenghi_den']));
            }

            $model = $model->where('nguyengiathamdinh','>=',chkDbl($inputs['nguyengiathamdinh_tu']));
            if(chkDbl($inputs['nguyengiathamdinh_den']) > 0){
                $model = $model->where('nguyengiathamdinh','<=',chkDbl($inputs['nguyengiathamdinh_den']));
            }
            //dd($model);
            return view('manage.thamdinhgia.timkiem.result')
                ->with('model',$model->get())
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))

                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            $inputs['thoihan'] = getDateToDb($inputs['thoihan']);
            $inputs['quy'] = Thang2Quy(getMonth($inputs['thoidiem']));
            $inputs['mahs'] = $inputs['maxa'].getdate()[0];
            $inputs['trangthai'] = 'CHT';
            $inputs['congbo'] = 'chuacongbo';
            $inputs['thaotac'] = session('admin')->username.' thêm mới - ' . getDateTime(Carbon::now()->toDateTimeString());
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $inputs['ipt1'] = $inputs['mahs'] .'&1.'.$ipf1->getClientOriginalExtension();
                $ipf1->move(public_path() . '/data/thamdinhgia/', $inputs['ipt1']);
                $inputs['ipf1']= $inputs['ipt1'];
            }
            if(isset($inputs['ipf2'])){
                $ipf2 = $request->file('ipf2');
                $inputs['ipt2'] = $inputs['mahs'] .'&2.'.$ipf2->getClientOriginalExtension();
                $ipf2->move(public_path() . '/data/thamdinhgia/', $inputs['ipt2']);
                $inputs['ipf2']= $inputs['ipt2'];
            }
            if(isset($inputs['ipf3'])){
                $ipf3 = $request->file('ipf3');
                $inputs['ipt3'] = $inputs['mahs'] .'&3.'.$ipf3->getClientOriginalExtension();
                $ipf3->move(public_path() . '/data/thamdinhgia/', $inputs['ipt3']);
                $inputs['ipf3']= $inputs['ipt3'];
            }
            if(isset($inputs['ipf4'])){
                $ipf4 = $request->file('ipf4');
                $inputs['ipt4'] = $inputs['mahs'].'&4.'.$ipf4->getClientOriginalExtension();
                $ipf4->move(public_path() . '/data/thamdinhgia/', $inputs['ipt4']);
                $inputs['ipf4']= $inputs['ipt4'];
            }
            if(isset($inputs['ipf5'])){
                $ipf5 = $request->file('ipf5');
                $inputs['ipt5'] = $inputs['mahs'] .'&5.'.$ipf5->getClientOriginalExtension();
                $ipf5->move(public_path() . '/data/thamdinhgia/', $inputs['ipt5']);
                $inputs['ipf5']= $inputs['ipt5'];
            }
            $model = new ThamDinhGia();
            if($model->create($inputs)){
                $modelctdf = ThamDinhGiaCtDf::where('maxa',$inputs['maxa']);
                foreach($modelctdf->get() as $ctdf){
                    $modelct = new ThamDinhGiaCt();
                    $modelct->mats = $ctdf->mats;
                    $modelct->tents = $ctdf->tents;
                    $modelct->dacdiempl= $ctdf->dacdiempl;
                    $modelct->thongsokt = $ctdf->thongsokt;
                    $modelct->nguongoc = $ctdf->nguongoc;
                    $modelct->dvt = $ctdf->dvt;
                    $modelct->sl = $ctdf->sl;
                    $modelct->nguyengiadenghi = $ctdf->nguyengiadenghi;
                    $modelct->giadenghi = $ctdf->giadenghi;
                    $modelct->nguyengiathamdinh = $ctdf->nguyengiathamdinh;
                    $modelct->giaththamdinh = $ctdf->giaththamdinh;
                    $modelct->giakththamdinh = $ctdf->giakththamdinh;
                    $modelct->giatritstd = $ctdf->giatritstd;
                    $modelct->gc = $ctdf->gc;
                    $modelct->mahs = $inputs['mahs'];
                    $modelct->save();
                }
                $modelctdf->delete();
            }
            return redirect('thamdinhgia?&maxa='.$inputs['maxa']);

        }else
            return view('errors.notlogin');
    }

    public function filedk(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();

        $model = ThamDinhGia::find($inputs['id']);

        $result['message'] ='<div class="modal-body" id = "dinh_kem" >';
        if (isset($model->ipt1)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 1 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/thamdinhgia/' . $model->ipf1) . '">' . $model->ipt1 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }
        if (isset($model->ipt2)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 2 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/thamdinhgia/' . $model->ipf2) . '">' . $model->ipt2 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }
        if (isset($model->ipt3)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 3 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/thamdinhgia/' . $model->ipf3) . '">' . $model->ipt3 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }
        if (isset($model->ipt4)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 4 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/thamdinhgia/' . $model->ipf4) . '">' . $model->ipt4 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }
        if (isset($model->ipt5)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 5 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/thamdinhgia/' . $model->ipf5) . '">' . $model->ipt5 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }

        $result['status'] = 'success';

        die(json_encode($result));
    }

    function gettthanghoa(Request $request){
        if(Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        $model = DmHangHoa::where('mahanghoa',$inputs['mahanghoa'])->first();
        if(count($model) == 0){
            $result['status'] = 'fail';
        }else{
            $result['status'] = 'success';
            $result['tenhanghoa'] = $model->tenhanghoa;
            $result['thongsokt'] = $model->thongsokt;
            $result['xuatxu'] = $model->xuatxu;
            $result['dvt'] = $model->dvt;

        }
        die(json_encode($result));
    }

    public function nhanexcel(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            if(session('admin')->level == 'X')
                $inputs['maxa'] = session('admin')->maxa;
            $modeldv = Town::where('maxa',$inputs['maxa'])
                ->first();

            return view('manage.thamdinhgia.excel.information')
                ->with('inputs',$inputs)
                ->with('modeldv',$modeldv)
                ->with('pageTitle', 'Nhận dữ liệu thẩm định giá từ file Excel');
        }else
            return view('errors.notlogin');
    }

    function import_excel(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $filename = $inputs['maxa'] . '_' . getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];

            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });
            //dd($data);
            $modeldel = ThamDinhGiaCtDf::where('maxa', $inputs['maxa'])->delete();

            for ($i = $inputs['tudong']; $i < ($inputs['tudong'] + $inputs['sodong']); $i++) {
                //dd($data[$i]);
                if (!isset($data[$i][$inputs['mats']]) || $data[$i][$inputs['tents']] == '') {
                    continue;//Tên cán bộ rỗng => thoát
                }
                $modelctnew = new ThamDinhGiaCtDf();
                $modelctnew->maxa = $inputs['maxa'];
                $modelctnew->mats = $data[$i][$inputs['mats']];
                $modelctnew->tents = $data[$i][$inputs['tents']];
                $modelctnew->dacdiempl = $data[$i][$inputs['dacdiempl']];
                $modelctnew->thongsokt = $data[$i][$inputs['thongsokt']];
                $modelctnew->nguongoc = $data[$i][$inputs['nguongoc']];
                $modelctnew->dvt = $data[$i][$inputs['dvt']];
                $modelctnew->sl = $data[$i][$inputs['sl']];
                $modelctnew->nguyengiadenghi = $data[$i][$inputs['nguyengiadenghi']];
                $modelctnew->giadenghi = $data[$i][$inputs['giadenghi']];
                $modelctnew->nguyengiathamdinh = $data[$i][$inputs['nguyengiathamdinh']];
                $modelctnew->giatritstd = $data[$i][$inputs['giatritstd']];
                $modelctnew->save();
            }
            File::Delete($path);
            $modelct = ThamDinhGiaCtDf::where('maxa',$inputs['maxa'])
                ->get();
            $modeldv = Town::where('maxa',$inputs['maxa'])
                ->first();
            return view('manage.thamdinhgia.create')
                ->with('modeldv',$modeldv)
                ->with('maxa',$inputs['maxa'])
                ->with('modelct',$modelct)
                ->with('pageTitle','Thêm mới hồ sơ thẩm định giá');

        }else
            return view('errors.notlogin');
    }
}
