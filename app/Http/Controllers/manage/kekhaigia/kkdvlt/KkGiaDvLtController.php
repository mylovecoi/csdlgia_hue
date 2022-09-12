<?php

namespace App\Http\Controllers\manage\kekhaigia\kkdvlt;

use App\Jobs\SendMail;
use App\Model\manage\dinhgia\GiaRung;
use App\Model\manage\kekhaigia\kkdvlt\CsKdDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLtCt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLtCtDf;
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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class KkGiaDvLtController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/kekhaigiadvlt';
            $m_donvi = getDoanhNghiepNhapLieu(session('admin')->level, 'DVLT');
            if(count($m_donvi) == 0){
                return view('errors.noperm')
                    ->with('url','')
                    ->with('message','Hệ thống chưa có doanh nghiệp kê khai giá dịch vụ lưu trú.');
            }
            $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(),'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modeldn = $m_donvi->where('madv', $inputs['madv'])->first();
            $a_cskd = array_column( CsKdDvLt::where('madv', $inputs['madv'])->get()->toarray(),'tencskd','macskd');
            if(count($a_cskd) == 0){
                return view('errors.noperm')
                    ->with('url','/thongtincskd?madv='.$inputs['madv'])
                    ->with('message','Doanh nghiệp chưa có cơ sở kinh doanh. Bạn cần tạo cơ sơ kinh doanh trước khi kê khai giá');
            }
            $inputs['macskd'] = $inputs['macskd'] ?? array_key_first($a_cskd);

            //dd($modelcskd);

            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            $model = KkGiaDvLt::where('macskd', $inputs['macskd'])
                ->whereYear('ngaynhap', $inputs['nam'])
                ->orderBy('id', 'desc')
                ->get();

            $m_donvi_th = getDonViTongHop_dn('dvlt',session('admin')->level, session('admin')->madiaban);
            $inputs['trangthai'] = $inputs['trangthai'] ?? 'ALL';
            if ($inputs['trangthai'] != 'ALL') {
                    $model = $model->where('trangthai', $inputs['trangthai']);
                }
            return view('manage.kkgia.dvlt.kkgia.kkgiadv.index')
                ->with('model', $model)
                ->with('a_cskd', $a_cskd)
                ->with('modeldn', $modeldn)
                ->with('inputs', $inputs)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_diaban', array_column($m_diaban->toarray(),'tendiaban', 'madiaban'))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ kê khai dịch vụ lưu trú');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['mahs'] = $inputs['macskd'].'_'.getdate()[0];
            $modelcskd = CsKdDvLt::where('macskd', $inputs['macskd'])->first();
            $modeldn = Company::where('madv', $modelcskd->madv)->first();
            //DB::statement("DELETE FROM kkgiadvltct WHERE macskd='" . $modelcskd->macskd . "' and mahs not in (SELECT mahs FROM kkgiadvlt where madv='" . $modelcskd->madv . "')");

            $model = new KkGiaDvLt();
            $model->mahs = $inputs['mahs'];
            $model->macskd = $inputs['macskd'];
            $model->trangthai = 'CC';
            $model->ngaynhap = date('Y-m-d');
            $model->madv = $modelcskd->madv;

            $modellk = KkGiaDvLt::where('macskd', $inputs['macskd'])
                ->wherein('trangthai', ['DD', 'CB', 'HCB'])
                ->orderby('ngayhieuluc', 'desc')->first();
            //dd($inputs);
            if ($modellk != null) {
                $modellkct = KkGiaDvLtCt::where('mahs', $modellk->mahs)->get();
                //dd($modellkct);
                $model->socvlk = $modellk->socv;
                $model->ngaycvlk = $modellk->ngaynhap;
                $a_dm = array();
                foreach ($modellkct as $ctdf) {
                    $a_dm[] = array(
                        'mahs' => $inputs['mahs'],
                        'tenhhdv' => $ctdf->tenhhdv,
                        'qccl' => $ctdf->qccl,
                        'dvt' => $ctdf->dvt,
                        'mucgialk' => $ctdf->mucgiakk,
                        'mucgiakk' => $ctdf->mucgiakk,
                        'macskd' => $inputs['macskd'],
                    );
                }
                KkGiaDvLtCt::insert($a_dm);
            }

            $modelct = KkGiaDvLtCt::where('mahs', $inputs['mahs'])->get();

            return view('manage.kkgia.dvlt.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modelcskd', $modelcskd)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú');

        } else
            return view('errors.notlogin');
    }

    public function nhanexcel(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_cskd = CsKdDvLt::where('macskd', $inputs['macskd'])->first();
            $inputs['madv'] = $m_cskd->madv;
            $inputs['url'] = '/kekhaigiadvlt';
            return view('manage.kkgia._include.importexcel_cskd')
                ->with('inputs',$inputs)
                ->with('pageTitle','Nhận dữ liệu từ file Excel');

        } else
            return view('errors.notlogin');
    }

    public function create_excel(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $inputs['mahs'] = $inputs['macskd'].'_'.getdate()[0];
            $modelcskd = CsKdDvLt::where('macskd', $inputs['macskd'])->first();
            $modeldn = Company::where('madv', $modelcskd->madv)->first();
            //DB::statement("DELETE FROM kkgiadvltct WHERE macskd='" . $modelcskd->macskd . "' and mahs not in (SELECT mahs FROM kkgiadvlt where madv='" . $modelcskd->madv . "')");

            $model = new KkGiaDvLt();
            $model->mahs = $inputs['mahs'];
            $model->macskd = $inputs['macskd'];
            $model->trangthai = 'CC';
            $model->ngaynhap = date('Y-m-d');
            $model->madv = $modelcskd->madv;

            $modellk = KkGiaDvLt::where('macskd', $inputs['macskd'])
                ->wherein('trangthai', ['DD', 'CB', 'HCB'])
                ->orderby('ngayhieuluc', 'desc')->first();
            //dd($inputs);
            if ($modellk != null) {
                $model->socvlk = $modellk->socv;
                $model->ngaycvlk = $modellk->ngaynhap;
            }

            $filename = $inputs['macskd'] . '_' . getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];

            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });
            //dd($data);

            $a_dm = array();

            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                if(!isset($data[$i][$inputs['tenhhdv']]) || !isset($data[$i][$inputs['qccl']]) ||
                    !isset($data[$i][$inputs['dvt']]) || !isset($data[$i][$inputs['mucgialk']]) ||
                    !isset($data[$i][$inputs['mucgiakk']])){
                    continue;
                }
                $a_dm[] = array(
                    'mahs' => $inputs['mahs'],
                    'tenhhdv' => $data[$i][$inputs['tenhhdv']] ?? '',
                    'qccl' => $data[$i][$inputs['qccl']] ?? '',
                    'dvt' => $data[$i][$inputs['dvt']] ?? '',
                    'mucgialk' => $data[$i][$inputs['mucgialk']] ?? '',
                    'mucgiakk' => $data[$i][$inputs['mucgiakk']] ?? '',
                    'macskd' => $inputs['macskd'],
                );
            }
            KkGiaDvLtCt::insert($a_dm);
            File::Delete($path);

            $modelct = KkGiaDvLtCt::where('mahs', $inputs['mahs'])->get();

            return view('manage.kkgia.dvlt.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modelcskd', $modelcskd)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú');

        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_cskd = CsKdDvLt::where('macskd', $inputs['macskd'])->first();
            $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
            $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
            $inputs['ngaycvlk'] = getDateToDb($inputs['ngaycvlk']);
            //dd($inputs);
            $model = KkGiaDvLt::where('mahs', $inputs['mahs'])->first();
            if ($model == null) {
                $inputs['trangthai'] = 'CC';
                KkGiaDvLt::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('kekhaigiadvlt?&madv=' . $m_cskd->madv . '&macskd=' . $inputs['macskd']);
        } else
            return view('errors.notlogin');
    }

    public function show(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $mahs = $input['mahs'];
            $modelkk = KkGiaDvLt::where('mahs',$mahs)->first();
            $modelcskd = CsKdDvLt::where('macskd',$modelkk->macskd)->first();
            $modeldn = Company::where('madv',$modelcskd->madv)->first();
            $modelkkct = KkGiaDvLtCt::where('mahs',$modelkk->mahs)->get();
            $modelcqcq = view_dsdiaban_donvi::where('madv', $modelkk->macqcq)->first();

            return view('manage.kkgia.dvlt.reports.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelcskd',$modelcskd)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Kê khai giá dịch vụ lưu trú');

        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaDvLt::where('mahs',$inputs['mahs'])->first();

            $modelcskd = CsKdDvLt::where('macskd', $model->macskd)->first();
            $modeldn = Company::where('madv', $modelcskd->madv)->first();
            $modelct = KkGiaDvLtCt::where('mahs', $model->mahs)->get();

            return view('manage.kkgia.dvlt.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modelcskd', $modelcskd)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('pageTitle', 'Chỉnh sửa hồ sơ kê khai giá dịch vụ lưu trú');

        } else
            return view('errors.notlogin');
    }

    public function ktchuyendvlt(Request $request){
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
        $m_hs = KkGiaDvLt::where('mahs',$inputs['mahs'])->first();
        if(KiemTraNgayApDung($m_hs->ngayhieuluc,'dvlt')){
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
            //dd($inputs);
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
           //dd($inputs);
            //$inputs['trangthai'] = 'CD';
            //$inputs['ngaychuyen'] = Carbon::now()->toDateTimeString();
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
                //$modeldv = Town::where('madv',$model->mahuyen)->first();
                $modelcskd = CsKdDvLt::where('macskd', $model->macskd)->first();

                $tg = getDateTime(Carbon::now()->toDateTimeString());
                $contentdn = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã nhận được hồ sơ giá dịch vụ lưu trú của ' . $modelcskd->tencskd . '. Số công văn: ' . $model->socv .
                    ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Thông tin người nộp: ' . $inputs['ttnguoinop'] . '-Số điện thoại liên lạc: ' . $inputs['dtll'] . '!!!';
                $contentht = 'Vào lúc: ' . $tg . ', hệ thống CSDL giá đã nhận được hồ sơ giá dịch vụ lưu trú của doanh nghiệp ' . $modeldn->tendn . ' - mã số thuế ' . $modeldn->madv .
                    ' -  ' . $modelcskd->tencskd . ' - Số công văn: ' . $model->socv . ' - Ngày áp dung: ' . getDayVn($model->ngayhieuluc) . '- Thông tin người nộp: ' . $inputs['ttnguoinop'] . '-Số điện thoại liên lạc: ' . $inputs['dtll'] . '!!!';
                $run = new SendMail($modeldn, $contentdn, $modeldv, $contentht);
                $run->handle();
            }
            return redirect('kekhaigiadvlt?&macskd=' . $model->macskd . '&madv=' . $model->madv);


        } else
            return view('errors.notlogin');
    }

    public function showlydo(Request $request){
        $inputs = $request->all();
        $model = KkGiaDvLt::where('mahs', $inputs['mahs'])->first();
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

    public function delete(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaDvLt::where('id', $inputs['iddelete'])->first();
            if ($model->delete()) {
                KkGiaDvLtCt::where('mahs', $model->mahs)->delete();
            }
            return redirect('kekhaigiadvlt?&macskd=' . $model->macskd . '&madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }
}
