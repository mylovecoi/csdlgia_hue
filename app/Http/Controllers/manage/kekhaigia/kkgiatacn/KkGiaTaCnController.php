<?php

namespace App\Http\Controllers\manage\kekhaigia\kkgiatacn;

use App\Jobs\SendMail;
use App\Model\manage\kekhaigia\kkgiatacn\KkGiaTaCn;
use App\Model\manage\kekhaigia\kkgiatacn\KkGiaTaCnCt;
use App\Model\system\company\Company;
use App\Model\system\dmnganhnghekd\DmNgheKd;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\NgayNghiLe;
use App\District;
use App\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use App\Imports\ColectionImport;

class KkGiaTaCnController extends Controller
{
    public function ttdn(Request $request)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $modeldmnghe = DmNgheKd::where('manghe', 'TACN')
                    ->first();
                if (session('admin')->level == 'T') {
                    $modeldv = Town::where('mahuyen', $modeldmnghe->mahuyen)->get();
                    $inputs['madv'] = isset($inputs['madv']) ? $inputs['madv'] : $modeldv->first()->madv;
                } elseif (session('admin')->level == 'H') {
                    if (session('admin')->mahuyen == $modeldmnghe->mahuyen) {
                        $modeldv = Town::where('mahuyen', $modeldmnghe->mahuyen)->get();
                        $inputs['madv'] = isset($inputs['madv']) ? $inputs['madv'] : $modeldv->first()->madv;
                    } else
                        return view('errors.perm');
                } else {
                    if (session('admin')->mahuyen == $modeldmnghe->mahuyen) {
                        $modeldv = Town::where('mahuyen', $modeldmnghe->mahuyen)->get();
                        $inputs['madv'] = isset($inputs['madv']) ? $inputs['madv'] : session('admin')->madv;
                    } else
                        return view('errors.perm');
                }
                $model = Company::join('companylvcc', 'companylvcc.madv', '=', 'company.madv')
                    ->where('companylvcc.manghe', 'TACN')
                    ->where('companylvcc.mahuyen', $inputs['madv'])
                    ->join('town', 'town.madv', '=', 'companylvcc.mahuyen')
                    ->select('company.*', 'town.tendv')
                    ->get();

                $ttql = District::where('mahuyen', $modeldmnghe->mahuyen)
                    ->first();

                return view('manage.kkgia.tacn.kkgia.kkgiadv.ttdn')
                    ->with('model', $model)
                    ->with('modeldv', $modeldv)
                    ->with('inputs', $inputs)
                    ->with('ttql', $ttql)
                    ->with('pageTitle', 'Danh sách doanh nghiệp kê khai giá thức ăn chăn nuôi');
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/kekhaigiatacn';
            $m_donvi = getDoanhNghiepNhapLieu(session('admin')->level, 'TACN');
            if (count($m_donvi) == 0) {
                return view('errors.noperm')
                    ->with('url', '')
                    ->with('message', 'Hệ thống chưa có doanh nghiệp kê khai giá thức ăn chăn nuôi.');
            }
            $m_diaban = dsdiaban::wherein('madiaban', array_column($m_donvi->toarray(), 'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $modeldn = $m_donvi->where('madv', $inputs['madv'])->first();

            //Lấy danh sách kkg theo madv hoặc lấy tất cả
            $model = KkGiaTaCn::query();

            if(!empty($inputs['madv']) && $inputs['madv'] != 'ALL'){
                $model = $model->where('madv', $inputs['madv']);
            }
            //kết thúc lấy danh sách kkg theo madv hoặc lấy tất cả

            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            if ($inputs['nam'] != 'all') {
                $model = $model->whereYear('ngaynhap', $inputs['nam']);
            }

            $inputs['trangthai'] = $inputs['trangthai'] ?? 'ALL';
            if ($inputs['trangthai'] != 'ALL') {
                $model = $model->where('trangthai', $inputs['trangthai']);
            }
            //Lấy hồ sơ
            $model = $model->orderby('ngaynhap')->get();
            $m_donvi_th = getDonViTongHop_dn('tacn', session('admin')->level, session('admin')->madiaban);

            return view('manage.kkgia.tacn.kkgia.kkgiadv.index')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('inputs', $inputs)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_diaban', array_column($m_diaban->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Danh sách hồ sơ kê khai giá thức ăn chăn nuôi');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['mahs'] = $inputs['madv'] . '_' . getdate()[0];
            $modeldn = Company::where('madv', $inputs['madv'])->first();
            $model = new KkGiaTaCn();
            $model->madv = $inputs['madv'];
            $model->mahs = $inputs['mahs'];
            $model->trangthai = 'CC';
            $model->ngaynhap = date('Y-m-d');

            /*DB::statement("DELETE FROM kkgiavtxbct WHERE mahs not in (SELECT mahs FROM kkgiavtxb where madv='" . $inputs['madv'] . "')");*/

            $modellk = KkGiaTaCn::where('madv', $inputs['madv'])
                ->wherein('trangthai', ['DD', 'CB', 'HCB'])
                ->orderby('ngayhieuluc', 'desc')->first();

            if ($modellk != null) {
                $modellkct = KkGiaTaCnCt::where('mahs', $modellk->mahs)->get();
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
                        'gialk' => $ctdf->giakk,
                        'giakk' => $ctdf->giakk,
                    );
                }
                KkGiaTaCnCt::insert($a_dm);
            }

            $modelct = KkGiaTaCnCt::where('mahs', $inputs['mahs'])->get();
            //            dd($modelct);

            return view('manage.kkgia.tacn.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi thêm mới');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
            $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
            $inputs['ngaycvlk'] = getDateToDb($inputs['ngaycvlk']);
            $model = KkGiaTaCn::where('mahs', $inputs['mahs'])->first();
            if ($model == null) {
                $inputs['trangthai'] = 'CC';
                $inputs['congbo'] = 'CHUACONGBO';
                KkGiaTaCn::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('kekhaigiatacn?&madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function show(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $mahs = $inputs['mahs'];
            $modelkk = KkGiaTaCn::where('mahs', $mahs)->first();
            $modeldn = Company::where('madv', $modelkk->madv)->first();
            $modelkkct = KkGiaTaCnCt::where('mahs', $modelkk->mahs)->get();
            //            dd($modelkkct);
            $modelcqcq = view_dsdiaban_donvi::where('madv', $modelkk->macqcq)->first();
            if (strtotime($modelkk->ngayhieuluc) < strtotime('2024-01-01')) {
                return view('manage.kkgia.tacn.reports.print56')
                ->with('modelkk', $modelkk)
                ->with('modeldn', $modeldn)
                ->with('modelkkct', $modelkkct)
                ->with('modelcqcq', $modelcqcq)
                ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi');
            }
            return view('manage.kkgia.tacn.reports.print')
                ->with('modelkk', $modelkk)
                ->with('modeldn', $modeldn)
                ->with('modelkkct', $modelkkct)
                ->with('modelcqcq', $modelcqcq)
                ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaTaCn::where('mahs', $inputs['mahs'])->first();
            $modeldn = Company::where('madv', $model->madv)->first();
            $modelct = KkGiaTaCnCt::where('mahs', $model->mahs)->get();
            /*dd($modelct);*/
            return view('manage.kkgia.tacn.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H'  || session('admin')->level == 'X') {
                $inputs = $request->all();
                $model = KkGiaTaCn::findOrFail($id);
                if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X' || $model->madv == session('admin')->madv) {
                    $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
                    $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                    if ($inputs['ngaycvlk'] != '')
                        $inputs['ngaycvlk'] = getDateToDb($inputs['ngaycvlk']);
                    else
                        unset($inputs['ngaycvlk']);
                    if ($model->update($inputs)) {
                        $modelct = KkGiaTaCnCt::where('mahs', $inputs['mahs'])
                            ->update(['trangthai' => 'XD']);
                    }
                    return redirect('kekhaigiatacn?&madv=' . $model->madv);
                } else
                    return view('errors.perm');
            } else
                return view('errors.perm');
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'DN' || session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $model = KkGiaTaCn::where('id', $inputs['iddelete'])
                    ->first();
                if ($model->delete()) {
                    $modelct = KkGiaTaCnCt::where('mahs', $model->mahs)
                        ->delete();
                }
                return redirect('kekhaigiatacn?&madv=' . $model->madv);
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function kiemtra(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => '"Ngày thực hiện mức giá kê khai không thể sử dụng được! Bạn cần chỉnh sửa lại thông tin trước khi chuyển", "Lỗi!!!"',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => '"Bạn cần đăng nhập tài khoản để chuyển hồ so", "Lỗi!!!"',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();
        $m_hs = KkGiaTaCn::where('mahs', $inputs['mahs'])->first();
        if (KiemTraNgayApDung($m_hs->ngayhieuluc, 'tacn')) {
            $result = array(
                'status' => 'success',
                'message' => 'Ngày áp dụng hợp lệ.',
            );
            die(json_encode($result));
        } else {
            die(json_encode($result));
        }
    }

    public function chuyen(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KkGiaTaCn::where('mahs', $inputs['mahs'])->first();
            if (KkGiaTaCn::where('madv', $model->madv)->where('trangthai', 'CD')->count() > 0) {
                return view('errors.403')
                    ->with('message', 'Doanh nghiệp đang có hồ sơ chờ nhận trên đơn vị chủ quản nên không thể chuyển hồ sơ.')
                    ->with('url', '/kekhaigiatacn?madv=' . $model->madv)
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
            $model->dtll = $inputs['dtll'];
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
            return redirect('kekhaigiatacn?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function showlydo(Request $request)
    {
        $inputs = $request->all();
        $model = KkGiaTaCn::where('mahs', $inputs['mahs'])->first();
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

    public function nhanexcel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/kekhaigiatacn';
            return view('manage.kkgia._include.importexcel')
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Nhận dữ liệu từ file Excel');
        } else
            return view('errors.notlogin');
    }

    public function create_excel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs["tenhhdv"] = ord(strtoupper($inputs["tenhhdv"])) - 65;
            $inputs["qccl"] = ord(strtoupper($inputs["qccl"])) - 65;
            $inputs["dvt"] = ord(strtoupper($inputs["dvt"])) - 65;
            $inputs["mucgialk"] = ord(strtoupper($inputs["mucgialk"])) - 65;
            $inputs["mucgiakk"] = ord(strtoupper($inputs["mucgiakk"])) - 65;
            $inputs["ghichu"] = ord(strtoupper($inputs["ghichu"])) - 65;

            $inputs['mahs'] = $inputs['madv'] . '_' . getdate()[0];
            $modeldn = Company::where('madv', $inputs['madv'])->first();

            $model = new KkGiaTaCn();
            $model->mahs = $inputs['mahs'];
            $model->trangthai = 'CC';
            $model->ngaynhap = date('Y-m-d');
            $model->madv = $modeldn->madv;

            $modellk = KkGiaTaCn::where('madv', $inputs['madv'])
                ->wherein('trangthai', ['DD', 'CB', 'HCB'])
                ->orderby('ngayhieuluc', 'desc')->first();

            if ($modellk != null) {
                $model->socvlk = $modellk->socv;
                $model->ngaycvlk = $modellk->ngaynhap;
            }

            $file = $request->file('fexcel');

            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0]; 

            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) : $inputs['dendong'];
            $a_dm = array();

            for ($i = $inputs['tudong'] - 1; $i <= ($inputs['dendong']); $i++) {

                $a_dm[] = array(
                    'mahs' => $inputs['mahs'],
                    'tendvcu' => trim($data[$i][$inputs['tenhhdv']] ?? ''),
                    'qccl' => trim($data[$i][$inputs['qccl']] ?? ''),
                    'dvt' => trim($data[$i][$inputs['dvt']] ?? ''),
                    'gialk' => trim($data[$i][$inputs['mucgialk']] ?? ''),
                    'giakk' => trim($data[$i][$inputs['mucgiakk']] ?? ''),
                    'ghichu' => trim($data[$i][$inputs['ghichu']] ?? ''),
                    'madv' => $inputs['madv'],
                );
            }
            //dd($a_dm);
            foreach (array_chunk($a_dm, 100) as $dm){
                KkGiaTaCnCt::insert($dm);
            }

            // KkGiaTaCnCt::insert($a_dm);
            // File::Delete($path);

            $modelct = KkGiaTaCnCt::where('mahs', $inputs['mahs'])->get();

            return view('manage.kkgia.tacn.kkgia.kkgiadv.edit')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi thêm mới');
        } else
            return view('errors.notlogin');
    }
}
