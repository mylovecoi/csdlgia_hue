<?php

namespace App\Http\Controllers\manage\kekhaigia\kkdatsanlap;

use App\District;
use App\Jobs\SendMail;
use App\Model\manage\kekhaigia\kkdatsanlap\KkGiaDatSanLap;
use App\Model\manage\kekhaigia\kkdatsanlap\KkGiaDatSanLapCt;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\NgayNghiLe;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KkGiaDatSanLapController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/kekhaigiadatsanlap';
            $m_donvi = getDoanhNghiepNhapLieu(session('admin')->level, 'DATSANLAP');
            if(count($m_donvi) == 0){
                return view('errors.noperm')
                    ->with('url','')
                    ->with('message','Hệ thống chưa có doanh nghiệp kê khai giá đất san lấp.');
            }
            $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(),'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modeldn = $m_donvi->where('madv', $inputs['madv'])->first();

            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            $model = KkGiaDatSanLap::where('madv', $inputs['madv'])
                ->whereYear('ngaynhap', $inputs['nam'])
                ->orderBy('id', 'desc')
                ->get();

                $inputs['trangthai'] = $inputs['trangthai'] ?? 'ALL';
                if ($inputs['trangthai'] != 'ALL') {
                        $model = $model->where('trangthai', $inputs['trangthai']);
                    }
            $m_donvi_th = getDonViTongHop_dn('datsanlap',session('admin')->level, session('admin')->madiaban);

            return view('manage.kkgia.datsanlap.kkgia.kkgiadv.index')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('inputs', $inputs)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_diaban', array_column($m_diaban->toarray(),'tendiaban', 'madiaban'))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ kê khai giá đất san lấp');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['mahs'] = $inputs['madv'] . '_' . getdate()[0];
            $modeldn = Company::where('madv', $inputs['madv'])->first();
            $model = new KkGiaDatSanLap();
            $model->madv = $inputs['madv'];
            $model->mahs = $inputs['mahs'];
            $model->trangthai = 'CC';
            $model->ngaynhap = date('Y-m-d');

            /*DB::statement("DELETE FROM kkgiavtxbct WHERE mahs not in (SELECT mahs FROM kkgiavtxb where madv='" . $inputs['madv'] . "')");*/

            $modellk = KkGiaDatSanLap::where('madv', $inputs['madv'])
                ->wherein('trangthai', ['DD', 'CB', 'HCB'])
                ->orderby('ngayhieuluc', 'desc')->first();

            if ($modellk != null) {
                $modellkct = KkGiaDatSanLapCt::where('mahs', $modellk->mahs)->get();
                $model->socvlk = $modellk->socv;
                $model->ngaycvlk = $modellk->ngaynhap;
                $a_dm = array();
                foreach ($modellkct as $ctdf) {
                    $a_dm[] = array(
                        'mahs' => $inputs['mahs'],
                        'madv' => $inputs['madv'],
                        'tendvcu' => $ctdf->tendvcu,
                        'qccl' => $ctdf->qccl,
                        'dvt' => $ctdf->dvt,
                        'giakk' => $ctdf->giakk,
                    );
                }
                KkGiaDatSanLapCt::insert($a_dm);
            }

            $modelct = KkGiaDatSanLapCt::where('mahs', $inputs['mahs'])->get();
//            dd($model);

            return view('manage.kkgia.datsanlap.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Kê khai giá đất san lấp thêm mới');

        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
            $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
            $inputs['ngaycvlk'] = getDateToDb($inputs['ngaycvlk']);
            $model = KkGiaDatSanLap::where('mahs', $inputs['mahs'])->first();
            if ($model == null) {
                $inputs['trangthai'] = 'CC';
                KkGiaDatSanLap::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('kekhaigiadatsanlap?&madv='.$inputs['madv']);

        }else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $mahs = $inputs['mahs'];
            $modelkk = KkGiaDatSanLap::where('mahs',$mahs)->first();
            $modeldn = Company::where('madv',$modelkk->madv)->first();
            $modelkkct = KkGiaDatSanLapCt::where('mahs',$modelkk->mahs)->get();
//            dd($modelkkct);
            $modelcqcq = view_dsdiaban_donvi::where('madv', $modelkk->macqcq)->first();
            if (strtotime($modelkk->ngayhieuluc) < strtotime('2024-01-01')) {
                return view('manage.kkgia.datsanlap.reports.print56')
                ->with('modelkk', $modelkk)
                ->with('modeldn', $modeldn)
                ->with('modelkkct', $modelkkct)
                ->with('modelcqcq', $modelcqcq)
                ->with('pageTitle','Kê khai giá đất san lấp');
            }
            return view('manage.kkgia.datsanlap.reports.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Kê khai giá đất san lấp');

        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaDatSanLap::where('mahs',$inputs['mahs'])->first();
            $modeldn = Company::where('madv', $model->madv)->first();
            $modelct = KkGiaDatSanLapCt::where('mahs', $model->mahs)->get();
            return view('manage.kkgia.datsanlap.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('pageTitle', 'Kê khai giá đất san lấp chỉnh sửa');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H'  || session('admin')->level == 'X') {
                $inputs = $request->all();
                $model = KkGiaDatSanLap::findOrFail($id);
                if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X' || $model->madv == session('admin')->madv) {
                    $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
                    $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                    if ($inputs['ngaycvlk'] != '')
                        $inputs['ngaycvlk'] = getDateToDb($inputs['ngaycvlk']);
                    else
                        unset($inputs['ngaycvlk']);
                    if($model->update($inputs)){
                        $modelct = KkGiaDatSanLapCt::where('mahs',$inputs['mahs'])
                            ->update(['trangthai' => 'XD']);
                    }
                    return redirect('kekhaigiadatsanlap?&madv=' . $model->madv);
                } else
                    return view('errors.perm');
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $model = KkGiaDatSanLap::where('id',$inputs['iddelete'])
                    ->first();
                if($model->delete()){
                    $modelct = KkGiaDatSanLapCt::where('mahs',$model->mahs)
                        ->delete();
                }
                return redirect('kekhaigiadatsanlap?&madv='.$model->madv);
            }else{
                return view('errors.perm');
            }

        }else
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
        //dd($request);
        $inputs = $request->all();
        $m_hs = KkGiaDatSanLap::where('mahs',$inputs['mahs'])->first();
        if(KiemTraNgayApDung($m_hs->ngayhieuluc,'datsanlap')){
            $result = array(
                'status' => 'success',
                'message' => 'Ngày áp dụng hợp lệ.',
            );
            die(json_encode($result));
        }else{
            die(json_encode($result));
        }
    }

    public function chuyen(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaDatSanLap::where('mahs', $inputs['mahs'])->first();
            if (KkGiaDatSanLap::where('madv', $model->madv)->where('trangthai', 'CD')->count() > 0) {
                return view('errors.403')
                    ->with('message', 'Doanh nghiệp đang có hồ sơ chờ nhận trên đơn vị chủ quản nên không thể chuyển hồ sơ.')
                    ->with('url', '/kekhaigiadatsanlap?madv=' . $model->madv)
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
                $contentdn = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận được hồ sơ của doanh nghiệp. Số công văn: '.$model->socv.
                    ' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Thông tin người nộp: '.$inputs['ttnguoinop'].'-Số điện thoại liên hệ: '.$inputs['dtll'].'!!!';

                $contentht = 'Vào lúc: '.$tg.', hệ thống CSDL giá đã nhận được hồ sơ của doanh nghiệp '.$modeldn->tendn.' - mã số thuế '.$modeldn->madv.
                    ' Số công văn: '.$model->socv.' - Ngày áp dung: '.getDayVn($model->ngayhieuluc).'- Thông tin người nộp: '.$inputs['ttnguoinop'].'-Số điện thoại liên hệ: '.$inputs['dtll'].'!!!';
                $run = new SendMail($modeldn,$contentdn,$modeldv,$contentht);
                $run->handle();
            }
            return redirect('kekhaigiadatsanlap?madv=' . $model->madv);


        } else
            return view('errors.notlogin');
    }

    public function showlydo(Request $request){
        $inputs = $request->all();
        $model = KkGiaDatSanLap::where('mahs', $inputs['mahs'])->first();
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
}
