<?php

namespace App\Http\Controllers\manage\binhongia;

use App\Jobs\SendMail;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBog;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBogCt;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkMhBogXdController extends Controller
{
    //chuyển hô sơ cho Form nhập liệu: chỉ cần chuyển trạng thái và set trạng thái cho đơn vị tiếp nhận
    public function chuyenhs(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
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
            $model->macqcq = $inputs['macqcq'];
            $model->trangthai = 'CD';
            $model->ngaychuyen = date('Y-m-d H:i:s');
            //kiểm tra đơn vị tiếp nhận
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

            if($model->save()){
                $modeldn = Company::where('madv', $model->madv)->first();
                $modeldv = dsdiaban::where('madiaban',$model->madiaban)->first();
                $dmnghe = DmNgheKd::where('manghe',$model->manghe)->first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận được hồ sơ '.$dmnghe->tennghe.' của doanh nghiệp. Số công văn: '.$model->socv.
                    ' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Thông tin người nộp: '.$inputs['nguoinop'].'-Số điện thoại liên hệ: '.$inputs['dtll'].'!!!';
                $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận được hồ sơ '.$dmnghe->tennghe.' của doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->maxa.
                    ' Số công văn: '.$model->socv.' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Thông tin người nộp: '.$inputs['nguoinop'].'-Số điện thoại liên hệ: '.$inputs['dtll'].'!!!';
                $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
                $run->handle();
                //dispatch($run);
            }
            return redirect('binhongia/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function kiemtra(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => '"Ngày thực hiện mức giá kê khai không thể sử dụng được! Bạn cần chỉnh sửa lại thông tin trước khi chuyển", "Lỗi!!!"',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => '"Bạn cần đăng nhập tài khoản để chuyển hồ so", "Lỗi!!!"',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        $m_hs = KkMhBog::where('mahs',$inputs['mahs'])->first();
        $m_com = Company::where('madv',$m_hs->madv)->first();

        if($m_com->kiemtra && KiemTraNgayApDung($m_hs->ngayapdung,'bog')){
            $result = array(
                'status' => 'success',
                'message' => 'Ngày áp dụng hợp lệ.',
            );
            die(json_encode($result));
        }else{
            die(json_encode($result));
        }
    }

    //cũ 27.03.2020 => xem bỏ


    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //đơn vị xét duyệt xong hồ sơ thì chỉ chuyển cho đơn vị công bố (ko như các đơn vị sử dụng)
        //
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/binhongia';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViCongBo();
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            //lấy mã dv để set level
            $inputs['level'] = $m_donvi->where('madv', $inputs['madv'])->first()->level ?? 'H';
            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(Company::all()->toArray(),'tendn', 'madv');
            $a_donvi_th = array_column($m_donvi->toarray(),'tendv','madv');
            switch ($inputs['level']){
                case 'H':{
                    $model = KkMhBog::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_h', $inputs['nam']);
                    $model = $model->get();
                    $m_com = Company::wherein('madv', array_column($model->toarray(),'madv'))->get();
                    $a_com = array_column($m_com->toarray(),'madiaban','madv');
                    foreach ($model as $ct){
                        $ct->madiaban = $a_com[$ct->madv] ?? null;
                        //$ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv] ?? '';
                        $ct->madv = $ct->madv_h;
                        //$ct->macqcq = $ct->macqcq_h;
                        //$ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->ngaychuyen = $ct->ngaychuyen_h;
                        $ct->trangthai = $ct->trangthai_h;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
                case 'T':{
                    $model = KkMhBog::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_t', $inputs['nam']);
                    $model = $model->get();
                    $m_com = Company::wherein('madv', array_column($model->toarray(),'madv'))->get();
                    $a_com = array_column($m_com->toarray(),'madiaban','madv');
                    foreach ($model as $ct){
                        $ct->madiaban = $a_com[$ct->madv] ?? null;
                        //$ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
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
                    $model = KkMhBog::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_ad', $inputs['nam']);
                    $model = $model->get();
                    $m_com = Company::wherein('madv', array_column($model->toarray(),'madv'))->get();
                    $a_com = array_column($m_com->toarray(),'madiaban','madv');
                    //dd($a_donvi_th);
                    foreach ($model as $ct){
                        $ct->madiaban = $a_com[$ct->madv] ?? null;
                        //$ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv] ?? '';
                        $ct->madv = $ct->madv_ad;
                        //$ct->macqcq = $ct->macqcq_ad;
                        $ct->tencqcq = $a_donvi_th[$ct->macqcq] ?? '';
                        $ct->ngaychuyen = $ct->ngaychuyen_ad;
                        $ct->trangthai = $ct->trangthai_ad;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
            }
            //dd($model);
            return view('manage.bog.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H','T','X'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ kê khai bình ổn giá');
        } else
            return view('errors.notlogin');
    }

    public function duyeths(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();

            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
            $inputs['level'] = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first()->level ?? 'H';

            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'DD',
                'username' => session('admin')->username,
                'mota' => 'Chuyển hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'madv' => $inputs['madv'],
            );

            $model->lichsu = json_encode($a_lichsu);
            $model->ngaynhan = $inputs['ngaynhan'];
            //gán lại trạng thái cho doanh nghiệp
            $model->trangthai = 'DD';
            $model->ngaynhan = $inputs['ngaynhan'];
            //kiểm tra thông tin đơn vị
            setDuyetHS($inputs['madv'], $model, ['trangthai' => 'DD', 'ngaynhan' => $inputs['ngaynhan'], 'lydo' => null]);

            if ($model->save()) {
                $modeldn = Company::where('madv', $model->madv)->first();
                $modeldv = dsdiaban::where('madiaban', $model->madiaban)->first();
                $dmnghe = DmNgheKd::where('manghe', $model->manghe)->first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());

                $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã duyệt hồ sơ ' . $dmnghe->tennghe . ' của doanh nghiệp. Số công văn: ' . $model->socv .
                    ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Số hồ sơ nhận: ' . $inputs['sohsnhan'] . '- Ngày nhận: ' . getDayVn($inputs['ngaynhan']) . '!!!';
                $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã duyệt hồ sơ ' . $dmnghe->tennghe . ' của doanh nghiệp ' . $modeldn->tendn . ' - mã số thuế ' . $modeldn->madv .
                    '. Số công văn: ' . $model->socv . ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Số hồ sơ nhận: ' . $inputs['sohsnhan'] . '- Ngày nhận: ' . getDayVn($inputs['ngaynhan']) . '!!!';
                $run = new SendMail($modeldn, $contentdn, $modeldv, $contentht);
                $run->handle();
                //dispatch($run);
            }

            return redirect('binhongia/xetduyet?madv=' . $inputs['madv']);
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
            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'HT',
                'username' => session('admin')->username,
                'mota' => 'Chuyển hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'macqcq' => $inputs['macqcq'],
                'madv' => $inputs['madv'],
            );
            //dd($model);
            $model->lichsu = json_encode($a_lichsu);
            //kiểm tra thông tin đơn vị
            setHoanThanhDV($inputs['madv'], $model, ['macqcq' => $inputs['macqcq'], 'trangthai' => 'CCB']);
            //kiểm tra đơn vị tiếp nhận
            $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            setCongBoDN($model, ['madv' => $inputs['macqcq'], 'trangthai' => 'CCB', 'ngaynhan' => date('Y-m-d')]);

            //dd($model);
            $model->save();
            return redirect('binhongia/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'TL',
                'username' => session('admin')->username,
                'mota' => 'Trả lại hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'madv' => $inputs['madv'],
                'lydo' => $inputs['lydo'],
            );
            $model->lichsu = json_encode($a_lichsu);
            $model->lydo = $inputs['lydo'];
            $model->ngaynhan = null;
            setTraLaiDN($inputs['madv'], $model, ['macqcq' => null, 'trangthai' => 'TL', 'lydo' => $inputs['lydo']]);
            //dd($model);
            $model->save();
            return redirect('binhongia/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => $inputs['trangthai_ad'],
                'username' => session('admin')->username,
                'mota' => $inputs['trangthai_ad'] == 'CB' ? 'Công bố hồ sơ' : 'Hủy công bố hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
            );
            $model->lichsu = json_encode($a_lichsu);
            setCongBoDN($model, ['trangthai' => $inputs['trangthai_ad'],
                'congbo' => $inputs['trangthai_ad'] == 'CB' ? 'DACONGBO' : 'CHUACONGBO',
                'ngaynhan' => date('Y-m-d H:i:s'),]);
            $model->save();
            return redirect('binhongia/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>

    public function ttdnkkmhbog(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){

            $modelhs = KkMhBog::where('id',$inputs['id'])
                ->first();

            $modeldn = Company::where('maxa',$modelhs->maxa)
                ->first();

            $result['message'] = '<div class="form-group" id="ttdnkkdkg"> ';
            $result['message'] .= '<label style="color: blue"><b>'.$modeldn->tendn.'</b> Kê khai giá số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '<label style="color: blue">Mã hồ sơ kê khai: <b>'.$modelhs->mahs.'</b></label>';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function tralai_c(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $inputs['trangthai'] = 'BTL';
                $model = KkMhBog::where('id',$inputs['idtralai'])->first();

                if($model->update($inputs)){
                    $modeldn = Company::where('maxa', $model->maxa)
                        ->first();
                    $modeldv = Town::where('maxa',$model->mahuyen)
                        ->first();
                    $dmnghe = DmNgheKd::where('manghe',$model->phanloai)
                        ->where('manganh','BOG')
                        ->first();
                    $tg = getDateTime(Carbon::now()->toDateTimeString());
                    $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã trả lại hồ sơ '.$dmnghe->tennghe.' của doanh nghiệp. Số công văn: '.$model->socv.
                        ' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Lý do: '.$inputs['lydo'].'!!!';
                    $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã trả lại hồ sơ '.$dmnghe->tennghe.' của doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->maxa.
                        ' Số công văn: '.$model->socv.' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Lý do: '.$inputs['lydo'].'!!!';
                    $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
                    $run->handle();
                    //dispatch($run);
                }

                return redirect('xetduyetkkmhbog?manghe='.$model->phanloai.'&trangthai='.$inputs['trangthai'].'&mahuyen='.$model->mahuyen);
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function ttnhanhs(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){

            $modelhs = KkMhBog::where('id',$inputs['id'])
                ->first();
            $model = Town::where('maxa',$modelhs->mahuyen)
                ->first();
            $modeldn = Company::where('maxa',$modelhs->maxa)
                ->first();

            $ngay = Carbon::now()->toDateString();
            $stt = $this->getsohsnhan($modelhs->mahuyen,$modelhs->phanloai);

            $result['message'] = '<div class="modal-body" id="ttnhanhs">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label style="color: blue"><b>'.$modeldn->tendn.'</b> kê khai giá mặt hàng trong danh mục bình ổn giá công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
            $result['message'] .= '<input type="text" style="text-align: center" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" value="'.$stt.'" autofocus>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày duyệt hồ sơ</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhan" name="ngaynhan" class="form-control"  value="'.$ngay.'">';
            $result['message'] .= '</div>';
            /*$result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày hiệu lực</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngayhieuluc" name="ngayhieuluc" class="form-control"  value="'.$modelhs->ngayhieuluc.'">';
            $result['message'] .= '</div>';*/
            $result['message'] .= '<input type="hidden" id="idnhanhs" name="idnhanhs" value="'.$inputs['id'].'">';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function getsohsnhan($mahuyen,$phanloai){
        $idmax = KkMhBog::where('trangthai', 'DD')
            ->where('mahuyen', $mahuyen)
            ->where('phanloai',$phanloai)
            ->max('id');
        if (isset($idmax)) {
            $model = KkMhBog::where('id',$idmax)
                ->first();
            $stt = $model->sohsnhan + 1;
        } else
            $stt = 1;
        return $stt;
    }

    public function get_sohs(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = KkMhBog::where('mahs', $inputs['mahs'])->first();
        if ($model->madv_h == $inputs['madv']) {
            $model->lydo = $model->lydo_h;
        }
        if ($model->madv_t == $inputs['madv']) {
            $model->lydo = $model->lydo_t;
        }
        if ($model->madv_ad == $inputs['madv']) {
            $model->lydo = $model->lydo_ad;
        }
        die($model);
    }

    public function lydo(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkMhBog::where('id',$inputs['id'])
                ->first();

            $result['message'] = '<div class="form-group" id="lydo">';
            $result['message'] = '<label>'.$model->lydo.'</lable>';
            $result['message'] .= '</div>';
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }
}
