<?php

namespace App\Http\Controllers\manage\kekhaigia\kkdvvt\vtxb;

use App\Jobs\SendMail;
use App\Model\manage\kekhaigia\kkdvlt\CsKdDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLt;
use App\Model\manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXb;
use App\Model\manage\kekhaigia\kkdvvt\vtxb\KkGiaVtXbCt;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class KkGiaVtXbXdController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/xetduyetkekhaigiavtxb';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViCongBo();
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            $inputs['trangthai'] = $inputs['trangthai'] ?? 'CD';
            //lấy mã dv để set level
            $inputs['level'] = $m_donvi->where('madv', $inputs['madv'])->first()->level ?? 'H';
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(Company::all()->toArray(),'tendn', 'madv');
            $a_donvi_th = array_column($m_donvi->toarray(),'tendv','madv');
            switch ($inputs['level']){
                case 'H':{
                    $model = KkGiaVtXb::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_h', $inputs['nam']);
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
                    $model = KkGiaVtXb::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_t', $inputs['nam']);
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
                    $model = KkGiaVtXb::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_ad', $inputs['nam']);
                    $model = $model->get();
                    $m_com = Company::wherein('madv', array_column($model->toarray(),'madv'))->get();
                    $a_com = array_column($m_com->toarray(),'madiaban','madv');
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

            /*dd($model);*/
            return view('manage.kkgia.vtxb.kkgia.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H','T','X'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Xét duyệt hồ sơ kê khai giá vận tải xe buýt');
        } else
            return view('errors.notlogin');
    }

    public function ttdnkkvtxb(Request $request){
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
        $inputs = $request->all();

        if(isset($inputs['id'])){

            $modelhs = KkGiaVtXb::where('id',$inputs['id'])->first();
            $modeldn = Company::where('madv',$modelhs->madv)->first();

            $result['message'] = '<div class="form-group" id="ttdnkkdvgs"> ';
            $result['message'] .= '<label style="color: blue"><b>'.$modeldn->tendn.'</b> Kê khai giá số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '<label style="color: blue">Mã hồ sơ kê khai: <b>'.$modelhs->mahs.'</b></label>';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function tralai(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            /*dd($inputs);*/
            $inputs['macqcq'] = 'BTL';
            $model = KkGiaVtXb::where('id', $inputs['idtralai'])->first();
            $a_lichsu = json_decode($model->lichsu, true);;
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'BTL',
                'username' => session('admin')->username,
                'mota' => 'Trả lại hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'madv' => $model->madv,
                'lydo' => $inputs['lydo'],
            );
            $model->lichsu = json_encode($a_lichsu);
            setTraLaiDN($inputs['madvtralai'], $model, ['macqcq' => null, 'trangthai' => 'BTL', 'lydo' => $inputs['lydo']]);
            if ($model->save()) {
                $modeldn = Company::where('madv', $model->madv)->first();
                $modeldv = dsdiaban::where('madiaban', $model->madiaban)->first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã trả lại hồ sơ của doanh nghiệp. Số công văn: '.$model->socv.
                    ' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Lý do: '.$inputs['lydo'].'!!!';
                $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã trả lại hồ sơ của doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->maxa.
                    ' Số công văn: '.$model->socv.' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Lý do: '.$inputs['lydo'].'!!!';
                $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
                $run->handle();
            }
            return redirect('xetduyetkekhaigiavtxb?madv=' . $inputs['madvtralai']);

        } else
            return view('errors.notlogin');
    }

    public function ttnhanhs(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        $modelhs = KkGiaVtXb::where('mahs', $inputs['mahs'])->first();
        $modeldn = Company::where('madv', $modelhs->madv)->first();

        $ngay = Carbon::now()->toDateString();
        $stt = $this->getsohsnhan($modelhs->macqcq);

        $result['message'] = '<div class="modal-body" id="ttnhanhs">';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label style="color: blue"><b>' . $modeldn->tendn . '</b> kê khai giá dịch vụ lưu trú số công văn <b>' . $modelhs->socv . '</b> ngày áp dụng <b>' . getDayVn($modelhs->ngayhieuluc) . '</b></b></label>';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
        $result['message'] .= '<input type="text" style="text-align: center" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" value="' . $stt . '" autofocus>';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label><b>Ngày duyệt hồ sơ</b></label>';
        $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhan" name="ngaynhan" class="form-control"  value="' . $ngay . '">';
        $result['message'] .= '</div>';
        $result['message'] .= '<input type="hidden" id="idnhanhs" name="idnhanhs" value="' . $modelhs->id . '">';
        $result['message'] .= '</div>';

        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function getsohsnhan($macqcq){
        $idmax = KkGiaVtXb::wherein('trangthai', ['DD', 'CB', 'HCB'])
            ->max('id');
        if (isset($idmax)) {
            $model = KkGiaVtXb::where('id',$idmax)->first();
            $stt = getDbl($model->sohsnhan) + 1;
        } else
            $stt = 1;
        return $stt;
    }

    public function nhanhs(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['idnhanhs'];
            $model = KkGiaVtXb::findOrFail($id);
            $inputs['madv'] = $model->macqcq;

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
            $model->sohsnhan = $inputs['sohsnhan'];
            $model->ngaynhan = $inputs['ngaynhan'];
            $model->thoihan = getThXdHsDvLt($model->ngaychuyen,$inputs['ngaynhan']);
            setDuyetHS($inputs['madv'], $model, ['trangthai' => 'DD', 'ngaynhan' => $inputs['ngaynhan'], 'lydo' => null]);

            if($model->save()){
                $modeldn = Company::where('madv', $model->madv)->first();
                $modeldv = dsdiaban::where('madiaban', $model->madiaban)->first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã trả lại hồ sơ dịch vụ lưu trú của ' . $modeldn->tendn . ' . Số công văn: ' . $model->socv .
                    ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) ;
                $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã trả lại hồ sơ của doanh nghiệp ' . $modeldn->tendn . ' - mã số thuế ' . $modeldn->madv .
                    ' - Số công văn: ' . $model->socv . ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc);
                $run = new SendMail($modeldn, $contentdn, $modeldv, $contentht);
                $run->handle();
                //dispatch($run);
            }
            return redirect('xetduyetkekhaigiavtxb?madv='.$model->macqcq);
        }else
            return view('errors.notlogin');
    }

    public function chuyenxd(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaVtXb::where('mahs', $inputs['mahs'])->first();
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
            setHoanThanhDV($inputs['madv'], $model, ['macqcq' => $inputs['macqcq'], 'trangthai' => 'CCB']);
            //kiểm tra đơn vị tiếp nhận
            //$chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            //mặc định chuyển là nhận luôn do đơn vị chỉ có chức năng công bố
            setCongBoDN($model, ['madv' => $inputs['macqcq'], 'trangthai' => 'CCB', 'ngaynhan' => date('Y-m-d')]);

            //dd($model);
            $model->save();
            return redirect('xetduyetkekhaigiavtxb?&madv='.$model->macqcq);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaVtXb::where('mahs', $inputs['mahs'])->first();
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
                'ngaynhan' => date('Y-m-d H:i:s'),'madv'=>$model->madv_ad]);
            $model->save();
            return redirect('xetduyetkekhaigiavtxb?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }

    public function search(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['mota'] = isset($inputs['mota']) ? $inputs['mota'] : '';
            $model = KkGiaVtXbCt::join('kkgiavtxb','kkgiavtxb.mahs','=','kkgiavtxbct.mahs')
                ->join('company','company.madv','=','kkgiavtxb.madv')
                ->select('kkgiavtxbct.*','company.tendn','kkgiavtxb.ngayhieuluc')
                ->where('kkgiavtxb.trangthai','DD');
            if($inputs['mota'] != '')
                $model = $model->where('kkgiavtxbct.tendvcu','like','%'.$inputs['mota'].'%');
            if($inputs['nam'] != 'all')
                $model = $model->whereYear('kkgiavtxb.ngayhieuluc',$inputs['nam']);
            $model = $model->get();
            /*dd($model);*/
            return view('manage.kkgia.vtxb.kkgia.timkiem.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá vận tải xe buýt');
        }else
            return view('errors.notlogin');
    }

    public function printf(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['mota'] = isset($inputs['mota']) ? $inputs['mota'] : '';
            $model = KkGiaVtXbCt::join('kkgiavtxb','kkgiavtxb.mahs','=','kkgiavtxbct.mahs')
                ->join('company','company.madv','=','kkgiavtxb.madv')
                ->select('kkgiavtxbct.*','company.tendn','kkgiavtxb.ngayhieuluc')
                ->where('kkgiavtxb.trangthai','DD');
            if($inputs['mota'] != '')
                $model = $model->where('kkgiavtxbct.tendvcu','like','%'.$inputs['mota'].'%');
            if($inputs['nam'] != 'all')
                $model = $model->whereYear('kkgiavtxb.ngayhieuluc',$inputs['nam']);
            $model = $model->get();
            /*dd($model);*/
            return view('manage.kkgia.vtxb.kkgia.timkiem.printf')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá vận tải xe buýt');
        }else
            return view('errors.notlogin');
    }
}
