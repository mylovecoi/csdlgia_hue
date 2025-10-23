<?php

namespace App\Http\Controllers\csdlquocgia;

use App\Jobs\SendMail;
use App\Model\manage\kekhaigia\kkdvch\KkGiaDvCh;
use App\Model\system\company\Company;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class qg_kkgiadvchController extends Controller
{
    public function nhanhoso(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/csdlquocgia/qg_kkgiadvch/nhanhoso';
            $m_donvi = getDoanhNghiepNhapLieu(session('admin')->level, 'CAHUE');
            if (count($m_donvi) == 0) {
                return view('errors.noperm')
                    ->with('url', '')
                    ->with('message', 'Hệ thống chưa có doanh nghiệp kê khai giá dịch vụ ca huế.');
            }
            $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(), 'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modeldn = $m_donvi->where('madv', $inputs['madv'])->first();

            $model = KkGiaDvCh::query();

            if (!empty($inputs['madv']) && $inputs['madv'] != 'ALL') {
                $model = $model->where('madv', $inputs['madv']);
            }

            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            $model = $model->whereYear('ngaynhap', $inputs['nam'])
                ->orderBy('id', 'desc')
                ->get();

            $m_donvi_th = getDonViTongHop_dn('cahue', session('admin')->level, session('admin')->madiaban);
            $inputs['trangthai'] = $inputs['trangthai'] ?? 'ALL';
            if ($inputs['trangthai'] != 'ALL') {
                $model = $model->where('trangthai', $inputs['trangthai']);
            }

            return view('csdlquocgia.qg_kkgiadvch.nhanhoso.index')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('inputs', $inputs)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_diaban', array_column($m_diaban->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ kê khai giá dịch vụ ca huế');
        } else
            return view('errors.notlogin');
    }

    public function chuyenhs(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaDvCh::where('mahs', $inputs['mahs'])->first();
            if (KkGiaDvCh::where('madv', $model->madv)->where('trangthai', 'CD')->count() > 0) {
                return view('errors.403')
                    ->with('message', 'Doanh nghiệp đang có hồ sơ chờ nhận trên đơn vị chủ quản nên không thể chuyển hồ sơ.')
                    ->with('url', '/kekhaigiadvcahue?madv=' . $model->madv)
                    ->with('pageTitle', 'Nhận dữ liệu từ file Excel');
            }
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'CD',
                'username' => session('admin')->username,
                'mota' => 'Chuyển hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'macqcq' => $inputs['macqcq'],
                'madv' => $model->madv
            );
            $model->lichsu = json_encode($a_lichsu);
            $model->ttnguoinop = $inputs['ttnguoinop'];
            $model->macqcq = $inputs['macqcq'];
            $model->trangthai = 'CD';
            $model->ngaychuyen = date('Y-m-d H:i:s');
            $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            if ($chk_dvcq->count() && $chk_dvcq->level == 'T') {
                $model->madv_t = $inputs['macqcq'];
                $model->ngaychuyen_t = date('Y-m-d');
                $model->trangthai_t = 'CD';
            } else if ($chk_dvcq->count() && $chk_dvcq->level == 'ADMIN') {
                $model->madv_ad = $inputs['macqcq'];
                $model->ngaychuyen_ad = date('Y-m-d');
                $model->trangthai_ad = 'CD';
            } else {
                $model->madv_h = $inputs['macqcq'];
                $model->ngaychuyen_h = date('Y-m-d');
                $model->trangthai_h = 'CD';
            }

            if ($model->save()) {
                $modeldn = Company::where('madv', $model->madv)->first();
                $modeldv = dsdiaban::where('madiaban', $model->madiaban)->first();

                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã nhận được hồ sơ của doanh nghiệp. Số công văn: ' . $model->socv .
                    ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Thông tin người nộp: ' . $inputs['ttnguoinop'] . '-Số điện thoại liên hệ: ' . $inputs['dtll'] . '!!!';

                $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã nhận được hồ sơ của doanh nghiệp ' . $modeldn->tendn . ' - mã số thuế ' . $modeldn->madv .
                    ' Số công văn: ' . $model->socv . ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Thông tin người nộp: ' . $inputs['ttnguoinop'] . '-Số điện thoại liên hệ: ' . $inputs['dtll'] . '!!!';
                $run = new SendMail($modeldn, $contentdn, $modeldv, $contentht);
                $run->handle();
            }
            return redirect('/csdlquocgia/qg_kkgiadvch/nhanhoso?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function truyenhoso(Request $request)
    {
        if (!Session::has('admin')) {
            return view('errors.notlogin');
        }
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_kkgiadvch/hoso';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

        $m_donvi = getDonViXetDuyet(session('admin')->level);
        $m_donvi_th = getDonViCongBo();
        $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['nam'] = $inputs['nam'] ?? date('Y');
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['level'] = $m_donvi->where('madv', $inputs['madv'])->first()->level ?? 'H';
        $a_ttdv = array_column(Company::all()->toArray(), 'tendn', 'madv');
        $a_donvi_th = array_column($m_donvi->toarray(), 'tendv', 'madv');
        switch ($inputs['level']) {
            case 'H': {
                    $model = KkGiaDvCh::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_h', $inputs['nam']);
                    if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                    $model = $model->get();
                    $m_com = Company::wherein('madv', array_column($model->toarray(), 'madv'))->get();
                    $a_com = array_column($m_com->toarray(), 'madiaban', 'madv');
                    foreach ($model as $ct) {
                        $ct->madiaban = $a_com[$ct->madv] ?? null;
                        $ct->tendv_ch = $a_ttdv[$ct->madv] ?? '';
                        $ct->madv = $ct->madv_h;
                        $ct->ngaychuyen = $ct->ngaychuyen_h;
                        $ct->trangthai = $ct->trangthai_h;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
            case 'T': {
                    $model = KkGiaDvCh::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_t', $inputs['nam']);
                    if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                    $model = $model->get();
                    $m_com = Company::wherein('madv', array_column($model->toarray(), 'madv'))->get();
                    $a_com = array_column($m_com->toarray(), 'madiaban', 'madv');
                    foreach ($model as $ct) {
                        $ct->madiaban = $a_com[$ct->madv] ?? null;
                        $ct->tendv_ch = $a_ttdv[$ct->madv] ?? '';
                        $ct->madv = $ct->madv_t;
                        $ct->macqcq = $ct->macqcq_t;
                        $ct->tencqcq = $a_donvi_th[$ct->macqcq] ?? '';
                        $ct->ngaychuyen = $ct->ngaychuyen_t;
                        $ct->trangthai = $ct->trangthai_t;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
            case 'ADMIN': {
                    $model = KkGiaDvCh::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_ad', $inputs['nam']);
                    if ($inputs['truyendulieu'] != 'all')
                        $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                    $model = $model->get();
                    $m_com = Company::wherein('madv', array_column($model->toarray(), 'madv'))->get();
                    $a_com = array_column($m_com->toarray(), 'madiaban', 'madv');
                    foreach ($model as $ct) {
                        $ct->madiaban = $a_com[$ct->madv] ?? null;
                        $ct->tendv_ch = $a_ttdv[$ct->madv] ?? '';
                        $ct->madv = $ct->madv_ad;
                        $ct->tencqcq = $a_donvi_th[$ct->macqcq] ?? '';
                        $ct->ngaychuyen = $ct->ngaychuyen_ad;
                        $ct->trangthai = $ct->trangthai_ad;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
        }

        $inputs['trangthai'] = $inputs['trangthai'] ?? 'ALL';
        if ($inputs['trangthai'] != 'ALL') {
            $model = $model->where('trangthai', $inputs['trangthai']);
        }

        return view('csdlquocgia.qg_kkgiadvch.truyenhoso.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('a_diaban', array_column($m_diaban->wherein('level', ['H', 'T', 'X'])->toarray(), 'tendiaban', 'madiaban'))
            ->with('m_donvi', $m_donvi)
            ->with('m_donvi_th', $m_donvi_th->where('madv', '<>', $inputs['madv']))
            ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
            ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
            ->with('pageTitle', 'Truyền hồ sơ kê khai giá dịch vụ ca huế');
    }

    public function capnhathoso(Request $request)
    {
        if (!Session::has('admin')) {
            return view('errors.notlogin');
        }
        $inputs = $request->all();
        $model = KkGiaDvCh::where('mahs', $inputs['mahs'])->first();
        $model->update($inputs);
        return redirect('/csdlquocgia/qg_kkgiadvch/hoso?truyendulieu=' . $inputs['truyendulieu']);
    }

    public function show_hoso(Request $request)
    {
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = KkGiaDvCh::where('mahs', $inputs['mahs'])->first();
        die($model);
    }

    public function congbo_hoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_kkgiadvch/congbo_hoso';
        $m_donvi = getDonViXetDuyet('SSA');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $model = KkGiaDvCh::where('macqcq', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);

        return view('csdlquocgia.qg_kkgiadvch.truyenhoso.congbo')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Công bố hồ sơ kê khai giá dịch vụ ca huế');
    }
}
