<?php

namespace App\Http\Controllers\csdlquocgia;

use App\Jobs\SendMail;
use App\Model\system\company\Company;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLt;
use App\Model\manage\kekhaigia\kkdvlt\CsKdDvLt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class qg_kkgiadvltController extends Controller
{
    public function nhanhoso(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/csdlquocgia/qg_kkgiadvlt/nhanhoso';
            $m_donvi = getDoanhNghiepNhapLieu(session('admin')->level, 'DVLT');
            if (count($m_donvi) == 0) {
                return view('errors.noperm')
                    ->with('url', '')
                    ->with('message', 'Hệ thống chưa có doanh nghiệp kê khai giá dịch vụ lưu trú.');
            }
            $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(), 'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modeldn = $m_donvi->where('madv', $inputs['madv'])->first();
            $a_cskd = array_column(CsKdDvLt::where('madv', $inputs['madv'])->get()->toarray(), 'tencskd', 'macskd');
            if (count($a_cskd) == 0) {
                return view('errors.noperm')
                    ->with('url', '/thongtincskd?madv=' . $inputs['madv'])
                    ->with('message', 'Doanh nghiệp chưa có cơ sở kinh doanh. Bạn cần tạo cơ sơ kinh doanh trước khi kê khai giá');
            }
            $inputs['macskd'] = $inputs['macskd'] ?? array_key_first($a_cskd);

            //Lấy danh sách kkg theo madv hoặc lấy tất cả
            $model = KkGiaDvLt::query();
            
            if(!empty($inputs['macskd']) && $inputs['macskd'] != 'ALL'){
                $model = $model->where('macskd', $inputs['macskd']);
            }
            //kết thúc lấy danh sách kkg theo madv hoặc lấy tất cả
            
            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            $model = $model->whereYear('ngaynhap', $inputs['nam'])
                ->orderBy('id', 'desc')
                ->get();

            $m_donvi_th = getDonViTongHop_dn('dvlt', session('admin')->level, session('admin')->madiaban);
            $inputs['trangthai'] = $inputs['trangthai'] ?? 'ALL';
            if ($inputs['trangthai'] != 'ALL') {
                $model = $model->where('trangthai', $inputs['trangthai']);
            }
            return view('csdlquocgia.qg_kkgiadvlt.nhanhoso.index')
                ->with('model', $model)
                ->with('a_cskd', $a_cskd)
                ->with('modeldn', $modeldn)
                ->with('inputs', $inputs)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_diaban', array_column($m_diaban->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ kê khai giá dịch vụ lưu trú');
        } else
            return view('errors.notlogin');
    }

    public function chuyenhs(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaDvLt::where('mahs', $inputs['mahs'])->first();
            if (KkGiaDvLt::where('madv', $model->madv)->where('trangthai', 'CD')->count() > 0) {
                return view('errors.403')
                    ->with('message', 'Doanh nghiệp đang có hồ sơ chờ nhận trên đơn vị chủ quản nên không thể chuyển hồ sơ.')
                    ->with('url', '/kekhaigiadvlt?madv=' . $model->madv)
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
            $model->nguoichuyen = $inputs['ttnguoinop'];
            $model->dtll = $inputs['dtll'];
            $model->macqcq = $inputs['macqcq'];
            $model->macqcq1 = $inputs['macqcq1'];
            $model->macqcq2 = $inputs['macqcq2'];
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
                $modelcskd = CsKdDvLt::where('macskd', $model->macskd)->first();

                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã nhận được hồ sơ giá dịch vụ lưu trú của ' . $modelcskd->tencskd . '. Số công văn: ' . $model->socv .
                    ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Thông tin người nộp: ' . $inputs['ttnguoinop'] . '-Số điện thoại liên lạc: ' . $inputs['dtll'] . '!!!';
                $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã nhận được hồ sơ giá dịch vụ lưu trú của doanh nghiệp ' . $modeldn->tendn . ' - mã số thuế ' . $modeldn->madv .
                    ' -  ' . $modelcskd->tencskd . ' - Số công văn: ' . $model->socv . ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Thông tin người nộp: ' . $inputs['ttnguoinop'] . '-Số điện thoại liên lạc: ' . $inputs['dtll'] . '!!!';
                $run = new SendMail($modeldn, $contentdn, $modeldv, $contentht);
                $run->handle();
            }
            return redirect('/csdlquocgia/qg_kkgiadvlt/nhanhoso?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function truyenhoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_kkgiadvlt/hoso';
        $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
        $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

        $m_donvi = getDonViXetDuyet(session('admin')->level);
        $m_donvi_th = getDonViCongBo();
        $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['nam'] = $inputs['nam'] ?? date('Y');
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $inputs['level'] = $m_donvi->where('madv', $inputs['madv'])->first()->level ?? 'H';
        $a_ttdv = array_column(Company::all()->toArray(),'tendn', 'madv');
        $a_donvi_th = array_column($m_donvi->toarray(),'tendv','madv');
        switch ($inputs['level']){
            case 'H':{
                $model = KkGiaDvLt::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('ngaychuyen_h', $inputs['nam']);
                if ($inputs['truyendulieu'] != 'all')
                    $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                $model = $model->get();
                $m_com = Company::wherein('madv', array_column($model->toarray(),'madv'))->get();
                $a_com = array_column($m_com->toarray(),'madiaban','madv');
                foreach ($model as $ct){
                    $ct->madiaban = $a_com[$ct->madv] ?? null;
                    $ct->tendv_ch = $a_ttdv[$ct->madv] ?? '';
                    $ct->madv = $ct->madv_h;
                    $ct->ngaychuyen = $ct->ngaychuyen_h;
                    $ct->trangthai = $ct->trangthai_h;
                    $ct->level = $inputs['level'];
                }
                break;
            }
            case 'T':{
                $model = KkGiaDvLt::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('ngaychuyen_t', $inputs['nam']);
                if ($inputs['truyendulieu'] != 'all')
                    $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                $model = $model->get();
                $m_com = Company::wherein('madv', array_column($model->toarray(),'madv'))->get();
                $a_com = array_column($m_com->toarray(),'madiaban','madv');
                foreach ($model as $ct){
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
            case 'ADMIN':{
                $model = KkGiaDvLt::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('ngaychuyen_ad', $inputs['nam']);
                if ($inputs['truyendulieu'] != 'all')
                    $model = $model->where('truyendulieu', $inputs['truyendulieu']);
                $model = $model->get();
                $m_com = Company::wherein('madv', array_column($model->toarray(),'madv'))->get();
                $a_com = array_column($m_com->toarray(),'madiaban','madv');
                //dd($a_donvi_th);
                foreach ($model as $ct){
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

        if ($inputs['nam'] != 'all'){
            $model_dongthoi = KkGiaDvLt::whereYear('ngaychuyen', $inputs['nam'])
            ->where(function ($qr) use ($inputs){
                $qr->where('macqcq1', $inputs['madv'])
                    ->orwhere('macqcq2', $inputs['madv'])
                    ->get();
            })->get();
        }else{
            $model_dongthoi = KkGiaDvLt::where('macqcq1', $inputs['madv'])
                ->orwhere('macqcq2', $inputs['madv'])
            ->get();
        }

        foreach ($model_dongthoi as $key=>$val){
            $val->trangthai = 'DONGTHOI';
            $model->add($val);
        }

        $inputs['trangthai'] = $inputs['trangthai'] ?? 'ALL';
        if ($inputs['trangthai'] != 'ALL') {
            $model = $model->where('trangthai', $inputs['trangthai']);
        }

        return view('csdlquocgia.qg_kkgiadvlt.truyenhoso.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('m_diaban', $m_diaban)
            ->with('a_diaban', array_column($m_diaban->wherein('level', ['H','T','X'])->toarray(), 'tendiaban', 'madiaban'))
            ->with('m_donvi', $m_donvi)
            ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
            ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
            ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
            ->with('pageTitle', 'Truyền hồ sơ kê khai giá dịch vụ lưu trú');    
    }

    public function capnhathoso(Request $request)
    {
        $inputs = $request->all();
        $model = KkGiaDvLt::where('mahs',$inputs['mahs'])->first();
        $model->update($inputs);
        return redirect('/csdlquocgia/qg_kkgiadvlt/hoso?truyendulieu=' . $inputs['truyendulieu']);
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
        $model = KkGiaDvLt::where('mahs',$inputs['mahs'])->first();
        die($model);
    }

    public function congbo_hoso(Request $request)
    {
        $inputs = $request->all();
        $inputs['url'] = '/csdlquocgia/qg_kkgiadvlt/congbo_hoso';
        $m_donvi = getDonViXetDuyet('SSA');
        $inputs['nam'] = $inputs['nam'] ?? 'all';
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
        $inputs['truyendulieu'] = $inputs['truyendulieu'] ?? 'all';
        $model = KkGiaDvLt::where('macqcq', $inputs['madv']);
        if ($inputs['nam'] != 'all')
            $model = $model->whereYear('thoidiem', $inputs['nam']);
        if ($inputs['truyendulieu'] != 'all')
            $model = $model->where('truyendulieu', $inputs['truyendulieu']);

        return view('csdlquocgia.qg_kkgiadvlt.truyenhoso.congbo')
            ->with('model', $model->get())
            ->with('inputs', $inputs)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Công bố hồ sơ kê khai giá dịch vụ lưu trú');
    }
}
