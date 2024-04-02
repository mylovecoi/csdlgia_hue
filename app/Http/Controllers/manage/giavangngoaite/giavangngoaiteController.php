<?php

namespace App\Http\Controllers\manage\giavangngoaite;

use App\DmHhDvK;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaite;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaitect;
use App\Model\manage\dinhgia\giavangngoaite\giavangngoaitedm;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\view\view_giavangngoaite;
use App\NhomHhDvK;
use Illuminate\Support\Facades\Session;

class giavangngoaiteController extends Controller
{
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
            $inputs['url'] = '/giavangngoaite';
            $m_donvi = getDonViNhapLieu(session('admin')->level, 'giavangngoaite');
            if (count($m_donvi) == null) {
                $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . (session('admin')['a_chucnang']['giavangngoaite'] ?? 'giavangngoaite')
                    . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
                return  view('errors.403')
                    ->with('message', $message);
            }
            $m_donvi_th = getDonViTongHop('giavangngoaite', \session('admin')->level, \session('admin')->madiaban);
            //$inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            $inputs['thang'] = $inputs['thang'] ?? date('m');

            //$m_donvi = view_dsdiaban_donvi::where('madiaban', $inputs['madiaban'])->where('chucnang', 'NHAPLIEU')->get();
            //lấy thông tin đơn vị
            $model = giavangngoaite::wheremonth('thoidiem', $inputs['thang'])
                ->whereYear('thoidiem', $inputs['nam'])->get();
            //dd($model);
            return view('manage.dinhgia.giavangngoaite.kekhai.index')
                ->with('model', $model->sortby('thoidiem'))
                ->with('inputs', $inputs)
                //->with('m_diaban', $m_diaban)
                //->with('a_diaban', $a_diaban)
                ->with('a_dv', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ giá hàng hóa, dịch vụ khác');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giavangngoaite';

            $model = giavangngoaite::where('thoidiem', $inputs['thoidiem'])->first();
            /*
             nếu đã có báo cáo thì mở báo cáo đã tạo ra
             * */
            if ($model != null) {
                return redirect('/giavangngoaite/modify?mahs=' . $model->mahs . '&act=false');
                //gọi đến hàm modify
            }

            $model = new giavangngoaite();
            //$tennhom = NhomHhDvK::where('matt', $inputs['mattbc'])->first()->tentt;
            //$diaban = DiaBanHd::where('district', $inputs['districtbc'])->where('level', 'H')->first()->diaban;

            $model->mahs = $inputs['madv'] . '_' . getdate()[0];
            $model->madv = $inputs['madv'];
            $model->trangthai = 'CHT';
            $model->thoidiem = $inputs['thoidiem'];

            $m_dm = giavangngoaitedm::all();
            $a_dm = array();
            foreach ($m_dm as $dm) {
                $a_dm[] = [
                    'mahs' => $model->mahs,
                    'mahhdv' => $dm->mahhdv,
                    'tenhhdv' => $dm->tenhhdv,
                    'dacdiemkt' => $dm->dacdiemkt,
                    'dvt' => $dm->dvt,
                    'gia' => $dm->gia,
                    'giaban' => $dm->gia,
                    'loaigia' => $dm->loaigia,
                ];
            }

            giavangngoaitect::insert($a_dm);
            $modelct = giavangngoaitect::where('mahs', $model->mahs)->get();
            return view('manage.dinhgia.giavangngoaite.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
            if ($model == null) {
                $inputs['trangthai'] = 'CHT';
                giavangngoaite::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('giavangngoaite/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function show(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
            $modelct = view_giavangngoaite::where('mahs', $model->mahs)->get();

            $a_diaban = array_column(dsdiaban::where('madiaban', $model->madiaban)->get()->toarray(), 'tendiaban', 'madiaban');
            $a_tt = array_column(NhomHhDvK::where('matt', $model->matt)->get()->toarray(), 'tentt', 'matt');
            $a_dm = array_column(DmHhDvK::where('matt', $model->matt)->get()->toarray(), 'tenhhdv', 'mahhdv');
            $m_dv = dsdonvi::where('madv', $model->madv)->first();
            return view('manage.dinhgia.giavangngoaite.reports.prints')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('m_dv', $m_dv)
                ->with('a_diaban', $a_diaban)
                ->with('a_tt', $a_tt)
                ->with('a_dm', $a_dm)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Kê khai giá hàng hóa dịch vụ chi tiết');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $inputs['url'] = '/giavangngoaite';
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
            $inputs['act'] = in_array($model->trangthai, ['CHT', 'HHT']) ? 'true' : $inputs['act']; //do có trường hợp đc gọi từ thêm mới
            $modelct = giavangngoaiteCt::where('mahs', $model->mahs)->get();
            return view('manage.dinhgia.giavangngoaite.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
            giavangngoaiteCt::where('mahs', $model->mahs)->delete();
            $model->delete();
            return redirect('giavangngoaite/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function chuyenhs(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giavangngoaite/danhsach');
        } else
            return view('errors.notlogin');
    }

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giavangngoaite';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giavangngoaite', \session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';
            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(
                view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
                'tendv',
                'madv'
            );

            switch ($inputs['level']) {
                case 'H': {
                        $model = giavangngoaite::where('madv_h', $inputs['madv']);
                        if ($inputs['nam'] != 'all')
                            $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                        $model = $model->get();
                        foreach ($model as $ct) {
                            $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
                            $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                            $ct->madv = $ct->madv_h;
                            $ct->macqcq = $ct->macqcq_h;
                            $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                            $ct->thoidiem_ch = $ct->thoidiem_h;
                            $ct->trangthai = $ct->trangthai_h;
                            $ct->level = $inputs['level'];
                        }
                        break;
                    }
                case 'T': {
                        $model = giavangngoaite::where('madv_t', $inputs['madv']);
                        if ($inputs['nam'] != 'all')
                            $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                        $model = $model->get();
                        foreach ($model as $ct) {
                            $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
                            $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                            $ct->madv = $ct->madv_t;
                            $ct->macqcq = $ct->macqcq_t;
                            $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                            $ct->thoidiem_ch = $ct->thoidiem_t;
                            $ct->trangthai = $ct->trangthai_t;
                            $ct->level = $inputs['level'];
                        }
                        break;
                    }
                case 'ADMIN': {
                        $model = giavangngoaite::where('madv_ad', $inputs['madv']);
                        if ($inputs['nam'] != 'all')
                            $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                        $model = $model->get();
                        foreach ($model as $ct) {
                            $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
                            $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                            $ct->madv = $ct->madv_ad;
                            $ct->macqcq = $ct->macqcq_ad;
                            $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                            $ct->thoidiem_ch = $ct->thoidiem_ad;
                            $ct->trangthai = $ct->trangthai_ad;
                            $ct->level = $inputs['level'];
                        }
                        break;
                    }
            }
            // dd(array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'));
            return view('manage.dinhgia.giavangngoaite.xetduyet.index')
                ->with('model', $model->sortby('thoidiem'))
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv', '<>', $inputs['madv']))
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
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
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giavangngoaite/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request)
    {
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giavangngoaite/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giavangngoaite::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => $inputs['trangthai_ad'],
                'username' => session('admin')->username,
                'mota' => $inputs['trangthai_ad'] == 'CB' ? 'Công bố hồ sơ' : 'Hủy công bố hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
            );
            $model->lichsu = json_encode($a_lichsu);
            setCongBo($model, [
                'trangthai' => $inputs['trangthai_ad'],
                'congbo' => $inputs['trangthai_ad'] == 'CB' ? 'DACONGBO' : 'CHUACONGBO'
            ]);
            $model->save();
            return redirect('giavangngoaite/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>

    public function timkiem()
    {
        if (Session::has('admin')) {
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            //dd($m_diaban);
            $a_dm = array_column(NhomHhDvK::all()->toArray(), 'tentt', 'matt');
            $inputs['url'] = '/giavangngoaite';
            return view('manage.dinhgia.giavangngoaite.timkiem.index')
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('a_dm', $a_dm)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Tìm kiếm thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request)
    {
        if (Session::has('admin')) {
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            $model = view_giavangngoaite::wherein('madv', array_column($m_donvi->toarray(), 'madv'));
            //dd($model);

            if ($inputs['madv'] != 'all') {
                $model = $model->where('madv', $inputs['madv']);
            }
            if ($inputs['madoituong'] != 'all') {
                $model = $model->where('madoituong', getTimkiemLike($inputs['madoituong']));
            }

            if (getDayVn($inputs['thoidiem_tu']) != '') {
                $model = $model->where('thoidiem', '>=', $inputs['thoidiem_tu']);
            }

            if (getDayVn($inputs['thoidiem_den']) != '') {
                $model = $model->where('thoidiem', '<=', $inputs['thoidiem_den']);
            }

            $model = $model->where('gia', '>=', chkDbl($inputs['giatri_tu']));
            if (chkDbl($inputs['giatri_den']) > 0) {
                $model = $model->where('gia', '<=', chkDbl($inputs['giatri_den']));
            }
            //dd($model);
            $a_dm = array_column(NhomHhDvK::all()->toArray(), 'tentt', 'matt');
            $inputs['url'] = '/giavangngoaite';
            return view('manage.dinhgia.giavangngoaite.timkiem.result')
                ->with('model', $model->get())
                ->with('a_dm', $a_dm)
                ->with('inputs', $inputs)
                ->with('a_diaban', array_column($m_donvi->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_donvi', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('pageTitle', 'Tìm kiếm thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }
}
