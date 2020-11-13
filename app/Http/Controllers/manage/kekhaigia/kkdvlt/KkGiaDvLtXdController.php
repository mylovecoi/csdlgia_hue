<?php

namespace App\Http\Controllers\manage\kekhaigia\kkdvlt;

use App\Jobs\SendMail;
use App\Model\manage\kekhaidkg\kehaimhbog\KkMhBog;
use App\Model\manage\kekhaigia\kkdvlt\CsKdDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLtCt;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class KkGiaDvLtXdController extends Controller
{
    public function index(Request $request)
    {
        //đơn vị xét duyệt xong hồ sơ thì chỉ chuyển cho đơn vị công bố (ko như các đơn vị sử dụng)
        //
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/xetduyetkkgiadvlt';
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
            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(Company::all()->toArray(),'tendn', 'madv');
            $a_donvi_th = array_column($m_donvi->toarray(),'tendv','madv');
            //dd($inputs['level']);
            switch ($inputs['level']){
                case 'H':{
                    $model = KkGiaDvLt::where('madv_h', $inputs['madv']);
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
                    $model = KkGiaDvLt::where('madv_t', $inputs['madv']);
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
                    $model = KkGiaDvLt::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('ngaychuyen_ad', $inputs['nam']);
                        //$model = $model->whereYear('ngaychuyen_ad', $inputs['nam']);
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
            //lấy danh sách hồ sơ đc gửi đồng thời

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
            //$model = $model->merge($model_dongthoi);
            foreach ($model_dongthoi as $key=>$val){
                $val->trangthai = 'DONGTHOI';
                $model->add($val);
            }
            //dd($model);
            return view('manage.kkgia.dvlt.kkgia.xetduyet.index')
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

    public function ttdnkkdvlt(Request $request){
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

            $modelhs = KkGiaDvLt::where('id',$inputs['id'])
                ->first();
            $modeldn = Company::where('madv',$modelhs->madv)->first();
            $modelcskd = CsKdDvLt::where('macskd',$modelhs->macskd)->first();

            $result['message'] = '<div class="form-group" id="ttkkgs"> ';
            $result['message'] .= '<label style="color: blue"><b>'.$modeldn->tendn.'</b> Kê khai giá dịch vụ lưu trú <b>'.$modelcskd->tencskd.'</b> số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '<label style="color: blue">Mã hồ sơ kê khai: <b>'.$modelhs->mahs.'</b></label>';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function tralai(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['macqcq'] = 'BTL';
            $model = KkGiaDvLt::where('id', $inputs['idtralai'])->first();
            //$inputs['macqcq'] = $model->macqcq;
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'BTL',
                'username' => session('admin')->username,
                'mota' => 'Trả lại hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'madv' => $model->madv,
                'lydo' => $inputs['lydo'],
            );
            $model->lichsu = json_encode($a_lichsu);
//            $model->lydo = $inputs['lydo'];
//            $model->trangthai = 'BTL';
//            $model->ngaynhan = null;
//            $model->macqcq = null;
            setTraLaiDN($inputs['madvtralai'], $model, ['macqcq' => null, 'trangthai' => 'BTL', 'lydo' => $inputs['lydo']]);//dd($model);

            //dd($model);
            if ($model->save()) {
                $modeldn = Company::where('madv', $model->madv)->first();
                $modeldv = dsdiaban::where('madiaban', $model->madiaban)->first();
                //$modeldv = Town::where('madv',$model->mahuyen)->first();
                $modelcskd = CsKdDvLt::where('macskd', $model->macskd)->first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã trả lại hồ sơ dịch vụ lưu trú của ' . $modelcskd->tencskd . ' . Số công văn: ' . $model->socv .
                    ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Lý do: ' . $inputs['lydo'] . '!!!';
                $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã trả lại hồ sơ của doanh nghiệp ' . $modeldn->tendn . ' - mã số thuế ' . $modeldn->madv .
                    ' -  ' . $modelcskd->tencskd . ' - Số công văn: ' . $model->socv . ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Lý do: ' . $inputs['lydo'] . '!!!';
                $run = new SendMail($modeldn, $contentdn, $modeldv, $contentht);
                $run->handle();
                //dispatch($run);
            }
            return redirect('xetduyetkkgiadvlt?madv=' . $inputs['madvtralai']);

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
        //dd($request);
        $inputs = $request->all();


        $modelhs = KkGiaDvLt::where('mahs', $inputs['mahs'])
            ->first();


        $modelcskd = CsKdDvLt::where('macskd', $modelhs->macskd)->first();

        $ngay = Carbon::now()->toDateString();
        $stt = $this->getsohsnhan($modelhs->madv);

        $result['message'] = '<div class="modal-body" id="ttnhanhs">';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label style="color: blue"><b>' . $modelcskd->tencskd . '</b> kê khai giá dịch vụ lưu trú số công văn <b>' . $modelhs->socv . '</b> ngày áp dụng <b>' . getDayVn($modelhs->ngayhieuluc) . '</b></b></label>';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
        $result['message'] .= '<input type="text" style="text-align: center" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" value="' . $stt . '" autofocus>';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label><b>Ngày duyệt hồ sơ</b></label>';
        $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhan" name="ngaynhan" class="form-control"  value="' . $ngay . '">';
        $result['message'] .= '</div>';
        /*$result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label><b>Ngày hiệu lực</b></label>';
        $result['message'] .= '<input type="date" style="text-align: center" id="ngayhieuluc" name="ngayhieuluc" class="form-control"  value="'.$modelhs->ngayhieuluc.'">';
        $result['message'] .= '</div>';*/
        $result['message'] .= '<input type="hidden" id="idnhanhs" name="idnhanhs" value="' . $modelhs->id . '">';
        $result['message'] .= '</div>';

        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function getsohsnhan($mahuyen){
        $idmax = KkGiaDvLt::where('trangthai', 'DD')
            //->where('mahuyen', $mahuyen)
            ->max('id');
        if (isset($idmax)) {
            $model = KkGiaDvLt::where('id',$idmax)
                ->first();
            $stt = $model->sohsnhan + 1;
        } else
            $stt = 1;
        return $stt;
    }

    public function nhanhs(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['idnhanhs'];
            $model = KkGiaDvLt::findOrFail($id);
            $inputs['madv'] = $model->macqcq;
            //$inputs['level'] = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first()->level ?? 'H';

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
            $model->thoihan = getThXdHsDvLt($model->ngaychuyen,$inputs['ngaynhan']);
            setDuyetHS($inputs['madv'], $model, ['trangthai' => 'DD', 'ngaynhan' => $inputs['ngaynhan'], 'lydo' => null]);

            if($model->save()){
                $modeldn = Company::where('madv', $model->madv)->first();
                $modeldv = dsdiaban::where('madiaban', $model->madiaban)->first();
                //$modeldv = Town::where('madv',$model->mahuyen)->first();
                $modelcskd = CsKdDvLt::where('macskd', $model->macskd)->first();
                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã trả lại hồ sơ dịch vụ lưu trú của ' . $modelcskd->tencskd . ' . Số công văn: ' . $model->socv .
                    ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) ;
                $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã trả lại hồ sơ của doanh nghiệp ' . $modeldn->tendn . ' - mã số thuế ' . $modeldn->madv .
                    ' -  ' . $modelcskd->tencskd . ' - Số công văn: ' . $model->socv . ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc);
                $run = new SendMail($modeldn, $contentdn, $modeldv, $contentht);
                $run->handle();
                //dispatch($run);
            }
            return redirect('xetduyetkkgiadvlt?madv='.$model->macqcq);
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
            //dd($inputs);
            $model = KkGiaDvLt::where('mahs', $inputs['mahs'])->first();
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
            //$chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            //mặc định chuyển là nhận luôn do đơn vị chỉ có chức năng công bố
            setCongBoDN($model, ['madv' => $inputs['macqcq'], 'trangthai' => 'CCB', 'ngaynhan' => date('Y-m-d')]);

            //dd($model);
            $model->save();
            return redirect('xetduyetkkgiadvlt?&madv='.$model->macqcq);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaDvLt::where('mahs', $inputs['mahs'])->first();
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
            return redirect('xetduyetkkgiadvlt?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }

    public function search(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam'])  ? $inputs['nam'] : date('Y');
            //$inputs['nam'] = $inputs['nam'] != 'all') ? $inputs['nam'] : date('Y');
            $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 20;
            $inputs['tencskd'] = isset($inputs['tencskd']) ? $inputs['tencskd'] : '';
            $inputs['tenhhdv'] = isset($inputs['tenhhdv']) ? $inputs['tenhhdv'] : '';

            $model = KkGiaDvLtCt::leftjoin('kkgiadvlt','kkgiadvlt.mahs','=','kkgiadvltct.mahs')
                ->leftJoin('cskddvlt','cskddvlt.macskd','=','kkgiadvlt.macskd')
                ->leftJoin('company','company.madv','=','kkgiadvlt.madv')
                ->select('kkgiadvltct.*','cskddvlt.tencskd','company.tendn','kkgiadvlt.ngayhieuluc','kkgiadvlt.socv')
                ->where('kkgiadvlt.trangthai','DD');
//            dd($model->get());
            if($inputs['tencskd'] != '')
                $model = $model->where('tencskd','like','%'.$inputs['tencskd'].'%');
            if($inputs['tenhhdv'] != '')
                $model = $model->where('tenhhdv','like','%'.$inputs['tenhhdv'].'%');
            if($inputs['nam'] != 'all')
                $model = $model->whereYear('kkgiadvlt.ngayhieuluc',$inputs['nam']);

            $model= $model->paginate($inputs['paginate']);


            return view('manage.kkgia.dvlt.kkgia.timkiem.index')
                ->with('model', $model)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Tìm kiếm thông tin hồ sơ kê khai giá dịch vụ lưu trú.');
        }else
            return view('errors.notlogin');
    }

    public function printf(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam'])  ? $inputs['nam'] : date('Y');
            //$inputs['nam'] = $inputs['nam'] != 'all') ? $inputs['nam'] : date('Y');
            $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 20;
            $inputs['tencskd'] = isset($inputs['tencskd']) ? $inputs['tencskd'] : '';
            $inputs['tenhhdv'] = isset($inputs['tenhhdv']) ? $inputs['tenhhdv'] : '';

            $model = KkGiaDvLtCt::leftjoin('kkgiadvlt','kkgiadvlt.mahs','=','kkgiadvltct.mahs')
                ->leftJoin('cskddvlt','cskddvlt.macskd','=','kkgiadvlt.macskd')
                ->leftJoin('company','company.madv','=','kkgiadvlt.madv')
                ->select('kkgiadvltct.*','cskddvlt.tencskd','company.tendn','kkgiadvlt.ngayhieuluc','kkgiadvlt.socv')
                ->where('kkgiadvlt.trangthai','DD');
//            dd($model->get());
            if($inputs['tencskd'] != '')
                $model = $model->where('tencskd','like','%'.$inputs['tencskd'].'%');
            if($inputs['tenhhdv'] != '')
                $model = $model->where('tenhhdv','like','%'.$inputs['tenhhdv'].'%');
            if($inputs['nam'] != 'all')
                $model = $model->whereYear('kkgiadvlt.ngayhieuluc',$inputs['nam']);

            $model= $model->paginate($inputs['paginate']);


            return view('manage.kkgia.dvlt.kkgia.timkiem.printf')
                ->with('model', $model)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Tìm kiếm thông tin hồ sơ kê khai giá dịch vụ lưu trú.');
        }else
            return view('errors.notlogin');
    }
}
