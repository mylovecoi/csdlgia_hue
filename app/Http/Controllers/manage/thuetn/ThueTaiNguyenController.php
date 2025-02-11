<?php

namespace App\Http\Controllers\manage\thuetn;

use App\District;
use App\Http\Controllers\_dungchung\KetNoiCSDLQuocGiaController;
use App\Model\manage\dinhgia\thuetn\DmThueTn;
use App\Model\manage\dinhgia\thuetn\NhomThueTn;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyen;
use App\Model\manage\dinhgia\thuetn\ThueTaiNguyenCt;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giathuetn;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ColectionImport;
use App\Model\system\dmdvt;
use App\Model\system\dsdonvi;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class ThueTaiNguyenController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giathuetn';
            //lấy địa bàn
            //$a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            //$a_diaban = getDiaBan_NhapLieu(session('admin')->level, session('admin')->madiaban);
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi_th = getDonViTongHop('giathuetn', \session('admin')->level, \session('admin')->madiaban);
            //            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            //$inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';

            //            $m_donvi = view_dsdiaban_donvi::where('madiaban', $inputs['madiaban'])->where('chucnang', 'NHAPLIEU')->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level, 'giathuetn');
            if (count($m_donvi) == null) {
                $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giathuetn']
                    . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
                return  view('errors.403')
                    ->with('message', $message);
            }
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            //dd($m_donvi);
            $a_nhom = array_column(NhomThueTn::where('theodoi', 'TD')->get()->toarray(), 'tennhom', 'manhom');
            //lấy thông tin đơn vị
            $model = ThueTaiNguyen::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            //dd($model->get());
            return view('manage.dinhgia.thuetn.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('a_nhom', $a_nhom)
                ->with('a_diaban', $a_diaban)
                ->with('a_dv', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Thông tin giá thuế tài nguyên');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giathuetn';
            $inputs['act'] = 'true';
            if ($inputs['manhom'] == 'ALL') {
                $a_nhom = NhomThueTn::where('theodoi', 'TD')->get('manhom')->toarray();
            } else {
                $a_nhom[] = $inputs['manhom'];
            }

            $modeldm = DmThueTn::wherein('manhom', $a_nhom)
                ->where('theodoi', 'TD')
                ->get();

            $inputs['mahs'] = $inputs['madv'] . '_' . getdate()[0];
            $model = new ThueTaiNguyen();
            $model->mahs = $inputs['mahs'];
            $model->madv = $inputs['madv'];
            $model->manhom = $inputs['manhom'];
            //            $model->madiaban = $inputs['madiaban'];
            $model->trangthai  = 'CHT';
            $a_dm = [];
            foreach ($modeldm as $dm) {
                $a_dm[] = [
                    'cap1' => $dm->cap1,
                    'cap2' => $dm->cap2,
                    'cap3' => $dm->cap3,
                    'cap4' => $dm->cap4,
                    'cap5' => $dm->cap5,
                    'ten' => $dm->ten,
                    'dvt' => $dm->dvt,
                    'level' => $dm->level,
                    'mahs' => $inputs['mahs'],
                    'sapxep' => $dm->sapxep,
                    'maso' => $dm->maso,
                    'maso_goc' => $dm->maso_goc,
                ];
            }
            foreach (array_chunk($a_dm, 100) as $data) {
                ThueTaiNguyenCt::insert($data);
            }
            $modelct = ThueTaiNguyenCt::where('mahs', $inputs['mahs'])->get();
            //duyệt để xác định mã tài nguyên có là mã gốc ko để mở trường nhập số tiền
            //            foreach($modelct as $ct){
            //                $ct->nhaplieu = true;
            //                if($modelct->where()->where()->count()>0){
            //                    $ct->nhaplieu = false;
            //                }
            //            }
            //            $a_diaban = array_column(dsdiaban::where('madiaban', $inputs['madiaban'])->get()->toarray(), 'tendiaban', 'madiaban');
            return view('manage.dinhgia.thuetn.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Bảng giá tính thuế tài nguyên');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();

            if (isset($inputs['ipf1'])) {
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] . '&1.' . $ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giathuetn/', $name);
                $inputs['ipf1'] = $name;
            }
            //dd($inputs);
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            $inputs['thoidiemlk'] = getDateToDb($inputs['thoidiemlk']);
            $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();
            if ($model == null) {
                $inputs['trangthai'] = 'CHT';
                ThueTaiNguyen::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('giathuetn/danhsach?nam=' . date('Y'));
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giathuetn';
            $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();
            ///dd($model);
            $modelct = ThueTaiNguyenCt::where('mahs', $model->mahs)->get();
            $modelnhom = NhomThueTn::where('manhom', $model->manhom)->first();
            $a_diaban = array_column(dsdiaban::where('madiaban', $model->madiaban)->get()->toarray(), 'tendiaban', 'madiaban');
            return view('manage.dinhgia.thuetn.kekhai.edit')
                ->with('modelct', $modelct)
                ->with('modelnhom', $modelnhom)
                ->with('model', $model)
                ->with('a_diaban', $a_diaban)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Bảng giá tính thuế tài nguyên');
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            ThueTaiNguyen::where('mahs', $inputs['mahs'])->delete();
            ThueTaiNguyenCt::where('mahs', $inputs['mahs'])->delete();
            return redirect('giathuetn/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function dinhkem(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();
        $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();

        $result['message'] = '<div class="modal-body" id = "dinh_kem" >';
        if (isset($model->ipf1)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 1 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/giathuetn/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }

        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function show(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();
            $modelct = ThueTaiNguyenCt::where('mahs', $model->mahs)->get();
            $modelnhom = NhomThueTn::where('manhom', $model->manhom)
                ->first();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','madvt');
            return view('manage.dinhgia.thuetn.reports.prints')
                ->with('modelct', $modelct)
                ->with('modelnhom', $modelnhom)
                ->with('a_dvt', $a_dvt)
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Bảng giá tính thuế tài nguyên ');
        } else
            return view('errors.notlogin');
    }

    public function nhandulieutuexcel()
    {
        if (Session::has('admin')) {
            $nhoms = NhomThueTn::where('theodoi', 'TD')
                ->get();
            return view('manage.dinhgia.thuetn.importexcel')
                ->with('nhoms', $nhoms)
                ->with('pageTitle', 'Nhận dữ liệu giá thuế tài nguyên từ file Excel');
        } else
            return view('errors.notlogin');
    }

    public function importexcel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();

            //Do mã char('A') = 65
            //Chuyển mã A,B,C về 0,1,2,3,...
            $inputs["maso"] = ord(strtoupper($inputs["maso"])) - 65;
            $inputs["gia"] = ord(strtoupper($inputs["gia"])) - 65;
            //dd($inputs);
            $file = $request->file('fexcel');
            $dataObj = new ColectionImport();
            $theArray = Excel::toArray($dataObj, $file);
            $data = $theArray[0]; //Mặc định lấy Sheet 1            
            $a_dm = [];
            $inputs['dendong'] = $inputs['dendong'] < count($data) ? count($data) - 1 : $inputs['dendong'];
            $inputs['tudong'] = $inputs['tudong'] - 1; //Do mảng bắt đầu từ 0
            // dd($data);
            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                if (isset($data[$i][$inputs['maso']]))
                    $a_dm[$data[$i][$inputs['maso']]] = chkDbl($data[$i][$inputs['gia']]);
            }
            //dd($a_dm);
            foreach (ThueTaiNguyenCt::where('mahs', $inputs['mahs'])->get() as $tainguyen) {
                $tainguyen->gia = $a_dm[$tainguyen->maso] ?? 0;
                $tainguyen->save();
            }
            return redirect('/giathuetn/modify?mahs=' . $inputs['mahs']);
        } else
            return view('errors.notlogin');
    }

    public function importexcel_26102024(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $modelnhom = NhomThueTn::where('manhom', $inputs['manhom'])
                ->first();
            $check = ThueTaiNguyen::where('manhom', $inputs['manhom'])
                ->where('nam', $inputs['nam'])
                ->count();
            if ($check > 0) {
                return view('manage.dinhgia.thuetn.errors.nodata')
                    ->with('nam', $inputs['nam'])
                    ->with('nhomtn', $modelnhom->tennhom);
            } else {
                $del = ThueTaiNguyenCt::where('trangthai', 'CXD')->delete();
                $inputs['add_nam'] = $inputs['nam'];
                $inputs['add_manhom'] = $inputs['manhom'];
                $inputs['mahs'] = getdate()[0];
                $filename = $inputs['nam'] . '_' . getdate()[0];
                $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
                $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
                $data = [];

                Excel::load($path, function ($reader) use (&$data, $inputs) {
                    $obj = $reader->getExcel();
                    $sheet = $obj->getSheet(0);
                    $data = $sheet->toArray(null, true, true, true); // giữ lại tiêu đề A=>'val';
                });
                for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                    if (isset($data[$i][$inputs['level']]) &&  $data[$i][$inputs['level']] != '') {
                        $modelctnew = new ThueTaiNguyenCt();
                        $modelctnew->level = $data[$i][$inputs['level']];
                        $modelctnew->cap1 = $data[$i][$inputs['cap1']];
                        $modelctnew->cap2 = $data[$i][$inputs['cap2']];
                        $modelctnew->cap3 = $data[$i][$inputs['cap3']];
                        $modelctnew->cap4 = $data[$i][$inputs['cap4']];
                        $modelctnew->cap5 = $data[$i][$inputs['cap5']];
                        $modelctnew->ten = $data[$i][$inputs['ten']];
                        $modelctnew->dvt = $data[$i][$inputs['dvt']];
                        $modelctnew->gia = (isset($data[$i][$inputs['gia']]) && $data[$i][$inputs['gia']] != '' ? chkDbl($data[$i][$inputs['gia']]) : 0);
                        $modelctnew->trangthai = 'CXD';
                        $modelctnew->mahs = $inputs['mahs'];
                        $modelctnew->save();
                    } else
                        continue;
                }
                File::Delete($path);
                $modelct = ThueTaiNguyenCt::where('mahs', $inputs['mahs'])
                    ->get();
                return view('manage.dinhgia.thuetn.create')
                    ->with('modelct', $modelct)
                    ->with('modelnhom', $modelnhom)
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Bảng giá tính thuế tài nguyên thêm mới');
            }
        } else
            return view('errors.notlogin');
    }

    public function export(Request $request)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X') {
                $inputs = $request->all();
                $model_nhom = NhomThueTn::where('manhom', $inputs['manhomex'])->first();
                $model = DmThueTn::where('manhom', $inputs['manhomex'])->get();
                Excel::create('DMTHUETN', function ($excel) use ($model, $model_nhom) {
                    $excel->sheet('DMTHUETN', function ($sheet) use ($model, $model_nhom) {
                        $sheet->loadView('manage.dinhgia.thuetn.excel.danhmuc')
                            ->with('model', $model)
                            ->with('model_nhom', $model_nhom)
                            ->with('pageTitle', 'DMTHUETN');
                        //$sheet->setPageMargin(0.25);
                        $sheet->setAutoSize(false);
                        $sheet->setFontFamily('Tahoma');
                        $sheet->setFontBold(false);

                        //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                    });
                })->download('xls');
            } else
                return view('errors.perm');
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
            $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giathuetn/danhsach?madiaban=' . $model->madiaban);
        } else
            return view('errors.notlogin');
    }

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giathuetn';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giathuetn', \session('admin')->level, \session('admin')->madiaban);
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
                        $model = ThueTaiNguyen::where('madv_h', $inputs['madv']);
                        if ($inputs['nam'] != 'all')
                            $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                        $model = $model->get();
                        foreach ($model as $ct) {
                            $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
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
                case 'T': {
                        $model = ThueTaiNguyen::where('madv_t', $inputs['madv']);
                        if ($inputs['nam'] != 'all')
                            $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                        $model = $model->get();
                        foreach ($model as $ct) {
                            $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
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
                case 'ADMIN': {
                        $model = ThueTaiNguyen::where('madv_ad', $inputs['madv']);
                        if ($inputs['nam'] != 'all')
                            $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                        $model = $model->get();
                        foreach ($model as $ct) {
                            $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct);
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
            //dd(session('admin'));
            // dd(array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'));
            $a_tt = array_column(NhomThueTn::all()->toArray(), 'tennhom', 'manhom');
            return view('manage.dinhgia.thuetn.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_tt', $a_tt)
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
            $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giathuetn/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request)
    {
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giathuetn/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThueTaiNguyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giathuetn/xetduyet?madv=' . $model->madv_ad);
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
            $a_dm = array_column(NhomThueTn::all()->toArray(), 'tennhom', 'manhom');
            $inputs['url'] = '/giathuetn';
            return view('manage.dinhgia.thuetn.timkiem.index')
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
            $model = view_giathuetn::wherein('madv', array_column($m_donvi->toarray(), 'madv'));
            //dd($model);

            if ($inputs['madv'] != 'all') {
                $model = $model->where('madv', $inputs['madv']);
            }
            if ($inputs['manhom'] != 'all') {
                $model = $model->where('manhom', getTimkiemLike($inputs['manhom']));
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
            $a_dm = array_column(NhomThueTn::all()->toArray(), 'tennhom', 'manhom');
            $inputs['url'] = '/giathuetn';
            return view('manage.dinhgia.thuetn.timkiem.result')
                ->with('model', $model->get())
                ->with('a_dm', $a_dm)
                ->with('inputs', $inputs)
                ->with('a_diaban', array_column($m_donvi->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_donvi', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('pageTitle', 'Tìm kiếm thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    //Xây dựng các chức năng nhận hồ sơ từ pm csdl quốc gia
    public function nhanhoso(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giathuetn';
            //lấy địa bàn
            //$a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            //$a_diaban = getDiaBan_NhapLieu(session('admin')->level, session('admin')->madiaban);
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi_th = getDonViTongHop('giathuetn', \session('admin')->level, \session('admin')->madiaban);
            //            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            //$inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';

            //            $m_donvi = view_dsdiaban_donvi::where('madiaban', $inputs['madiaban'])->where('chucnang', 'NHAPLIEU')->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level, 'giathuetn');
            if (count($m_donvi) == null) {
                $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giathuetn']
                    . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
                return  view('errors.403')
                    ->with('message', $message);
            }
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            //dd($m_donvi);
            $a_nhom = array_column(NhomThueTn::where('theodoi', 'TD')->get()->toarray(), 'tennhom', 'manhom');
            //lấy thông tin đơn vị
            $model = ThueTaiNguyen::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            //dd($model->get());
            return view('manage.dinhgia.thuetn.nhanhoso.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('a_nhom', $a_nhom)
                ->with('a_diaban', $a_diaban)
                ->with('a_dv', array_column($m_donvi->toarray(), 'tendv', 'madv'))
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Thông tin giá thuế tài nguyên');
        } else
            return view('errors.notlogin');
    }

    public function innhanhosocsdlqg(Request $request)
    {
        $inputs = $request->all();
        $m_donvi = dsdonvi::where('madv', '1605321545')->first();;
        $model = ThueTaiNguyen::where('madv', '1605321545')->get();
        return view('manage.dinhgia.thuetn.nhanhoso.BC1')
            ->with('model', $model)
            ->with('m_donvi', $m_donvi)
            ->with('pageTitle', 'Thông tin giá thuế tài nguyên');
    }
}
