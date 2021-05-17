<?php

namespace App\Http\Controllers\manage\giadatphanloai;

use App\GiaDatDiaBanDm;
use App\Model\manage\dinhgia\giadatphanloai\GiaDatPhanLoai;
use App\Model\manage\dinhgia\giadatphanloai\GiaDatPhanLoaiCt;
use App\Model\manage\kekhaigia\kkdvlt\CsKdDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLt;
use App\Model\manage\kekhaigia\kkdvlt\KkGiaDvLtCt;
use App\Model\system\company\Company;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giadatphanloai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class GiaDatPhanLoaiController extends Controller
{
    //<editor-fold des="Chức năng nhập liệu">
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
            $inputs['url'] = '/giadatphanloai';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giadatpl',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';

            //lấy thông tin đơn vị
            $model = GiaDatPhanLoai::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);

            return view('manage.dinhgia.giadatphanloai.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ giá đất');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        //Tài khoản nhập liệu ko lấy mặc định mã địa bàn theo đơn vị do Tài khoản nhập liệu Sở ban ngành nhâp cho cac Huyện
        //Load danh sách địa bàn theo đơn vị sau đó để chọn
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['act'] = 'true';
            $inputs['url'] = '/giadatphanloai';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $model = new GiaDatPhanLoai();
            $model->madv = $inputs['madv'];
            $model->mahs = getdate()[0];
            $model->trangthai = 'CHT';

            //dd($m_diaban);
            $m_loaidat = GiaDatDiaBanDm::all();
            $a_loaidat = array_column($m_loaidat->toArray(),'loaidat','maloaidat');
            $a_khuvuc = array_column(view_giadatphanloai::where('madv',$inputs['madv'])->get('khuvuc')->toArray(),'khuvuc','khuvuc');
            //dd($a_dvt);
            return view('manage.dinhgia.giadatphanloai.kekhai.edit')
                ->with('model',$model)
                ->with('modelct',nullValue())
                ->with('m_loaidat',$m_loaidat)
                ->with('a_loaidat',$a_loaidat)
                ->with('a_khuvuc',$a_khuvuc)
                ->with('a_diaban', $a_diaban)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ giá đất');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
//        if (Session::has('admin')) {
//            $inputs = $request->all();
//            $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
//            if (count($chk_dvt) == 0) {
//                dmdvt::insert(['dvt' => $inputs['dvt']]);
//            }
//            $inputs['mahs'] = getdate()[0];
//
//            //lichsu
//            $a_lichsu[$inputs['mahs']] = [
//                'username' => session('admin')->username,
//                'hanhdong' => 'ADD',
//                'mota' => 'Thêm mới hồ sơ',
//                'thoigian' => date('Y-m-d H:i:s'),
//            ];
//
//            $inputs['lichsu'] = json_encode($a_lichsu);
//            $inputs['tinhtrang'] = 'Hồ sơ thêm mới';
//            $inputs['mahs'] = getdate()[0];
//            $inputs['trangthai'] = 'CHT';
//            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
//            $inputs['giatri'] = getDoubleToDb($inputs['giatri']);
//            $inputs['dientich'] = getDoubleToDb($inputs['dientich']);
//
//            GiaDatPhanLoai::create($inputs);
//            return redirect('giadatphanloai/danhsach?madv=' . $inputs['madv']);
//        } else
//            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/giadatphanloai';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_loaidat = GiaDatDiaBanDm::all();
            $a_loaidat = array_column($m_loaidat->toArray(),'loaidat','maloaidat');
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $model = GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first();
            $modelct = GiaDatPhanLoaiCt::where('mahs',$inputs['mahs'])->get();
            $a_khuvuc = array_column(view_giadatphanloai::where('madv',$model->madv)->get('khuvuc')->toArray(),'khuvuc','khuvuc');
            //dd($inputs);
            return view('manage.dinhgia.giadatphanloai.kekhai.edit')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('m_loaidat',$m_loaidat)
                ->with('a_diaban',$a_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_loaidat',$a_loaidat)
                ->with('a_khuvuc',$a_khuvuc)
                ->with('a_dvt', $a_dvt)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ giá đất');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] .'&1.'.$ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giadatphanloai/', $name);
                $inputs['ipf1']= $name;
            }
            $m_chk = GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first();
            if($m_chk == null){
                GiaDatPhanLoai::create($inputs);
            }else{
                $m_chk->update($inputs);
            }
            return redirect('giadatphanloai/danhsach?madv='.$inputs['madv']);
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $model = GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first();
            GiaDatPhanLoaiCt::where('mahs',$inputs['mahs'])->delete();
            $model->delete();
            return redirect('giadatphanloai/danhsach?&madv='.$model->madv);
        }else
            return view('errors.notlogin');
    }

    public function show(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();
        $model = GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first();

        $result['message'] ='<div class="modal-body" id = "dinh_kem" >';
        if (isset($model->ipf1)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 1 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/giadatphanloai/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }

        $result['status'] = 'success';

        die(json_encode($result));
    }

    //chuyển hô sơ cho Form nhập liệu: chỉ cần chuyển trạng thái và set trạng thái cho đơn vị tiếp nhận
    public function chuyenhs(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDatPhanLoai::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadatphanloai/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function nhanexcel(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $m_dv = dsdonvi::where('madv', $inputs['madv'])->first();
            $inputs['madv'] = $m_dv->madv;
            $inputs['url'] = '/giadatphanloai';

            return view('manage.dinhgia.giadatphanloai.kekhai.imp_excel')
                ->with('inputs',$inputs)
                ->with('pageTitle','Nhận dữ liệu từ file Excel');

        } else
            return view('errors.notlogin');
    }

    public function create_excel(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
//            $m_dv = dsdonvi::where('madv', $inputs['madv'])->first();
            $inputs['mahs'] = $inputs['madv'].'_'.getdate()[0];
            //DB::statement("DELETE FROM kkgiadvltct WHERE macskd='" . $modelcskd->macskd . "' and mahs not in (SELECT mahs FROM kkgiadvlt where madv='" . $modelcskd->madv . "')");


            $filename = $inputs['madv'] . '_' . getdate()[0].'.'.$request->file('fexcel')->getClientOriginalExtension();
            $path = public_path() . '/data/uploads/excels/';
            $request->file('fexcel')->move($path, $filename);
            $data = [];

            Excel::load($path . $filename, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });
//            dd($data);
            //dd($inputs);

            $a_dm = array();
            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                if(!isset($data[$i][$inputs['khuvuc']]) || !isset($data[$i][$inputs['maloaidat']]) ||
                    !isset($data[$i][$inputs['vitri']]) || !isset($data[$i][$inputs['banggiadat']]) ||
                    !isset($data[$i][$inputs['giacuthe']]) || !isset($data[$i][$inputs['hesodc']])){
                    continue;
                }
                $a_dm[] = array(
                    'mahs' => $inputs['mahs'],
                    'khuvuc' => $data[$i][$inputs['khuvuc']] ?? '',
                    'vitri' => $data[$i][$inputs['vitri']] ?? '',
                    'maloaidat' => $data[$i][$inputs['maloaidat']] ?? '',
                    'banggiadat' => $data[$i][$inputs['banggiadat']] ? (float)getDoubleToDb($data[$i][$inputs['banggiadat']]) : 0,
                    'giacuthe' => $data[$i][$inputs['giacuthe']] ? (float)getDoubleToDb($data[$i][$inputs['giacuthe']]) : 0,
                    'hesodc' => $data[$i][$inputs['hesodc']] ? (float)round(getDoubleToDb($data[$i][$inputs['hesodc']]),4) : 0,
                );
            }
            //dd($a_dm);
            GiaDatPhanLoaiCt::insert($a_dm);
            File::Delete($path. $filename);

            $inputs['act'] = 'true';
            $inputs['url'] = '/giadatphanloai';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $model = new GiaDatPhanLoai();
            $model->madv = $inputs['madv'];
            $model->mahs = $inputs['mahs'];
            $model->trangthai = 'CHT';

            $m_loaidat = GiaDatDiaBanDm::all();
            $a_loaidat = array_column($m_loaidat->toArray(),'loaidat','maloaidat');
            $a_khuvuc = array_column(view_giadatphanloai::where('madv',$inputs['madv'])->get('khuvuc')->toArray(),'khuvuc','khuvuc');
            $modelct = GiaDatPhanLoaiCt::where('mahs', $inputs['mahs'])->get();
            //dd($a_dvt);

            return view('manage.dinhgia.giadatphanloai.kekhai.edit')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('m_loaidat',$m_loaidat)
                ->with('a_loaidat',$a_loaidat)
                ->with('a_khuvuc',$a_khuvuc)
                ->with('a_diaban', $a_diaban)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ giá đất');

        } else
            return view('errors.notlogin');
    }

    //</editor-fold>

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadatphanloai';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giadatpl',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';
            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
                    'tendv', 'madv');

            switch ($inputs['level']){
                case 'H':{
                    $model = GiaDatPhanLoai::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
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
                case 'T':{
                    $model = GiaDatPhanLoai::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
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
                case 'ADMIN':{
                    $model = GiaDatPhanLoai::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
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
            //dd($model);
            return view('manage.dinhgia.giadatphanloai.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column(view_dsdiaban_donvi::all()->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ giá đất');
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
            $model = GiaDatPhanLoai::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadatphanloai/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDatPhanLoai::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadatphanloai/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDatPhanLoai::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => $inputs['trangthai_ad'],
                'username' => session('admin')->username,
                'mota' => $inputs['trangthai_ad'] == 'CB' ? 'Công bố hồ sơ' : 'Hủy công bố hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
            );
            $model->lichsu = json_encode($a_lichsu);
            setCongBo($model, ['trangthai' => $inputs['trangthai_ad'],
                'congbo' => $inputs['trangthai_ad'] == 'CB' ? 'DACONGBO' : 'CHUACONGBO']);
            $model->save();
            return redirect('giadatphanloai/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>


    public function ketxuat(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            //lấy thông tin đơn vị
            $model = $this->getHoSo($inputs);
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            //dd($model->get());
            return view('manage.dinhgia.giadatphanloai.reports.print')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('a_loaidat',$a_loaidat)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ đấu giá đất');
        }else
            return view('errors.notlogin');
    }

    public function print_hs(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //lấy thông tin đơn vị
            $model = view_giadatphanloai::where('mahs', $inputs['mahs'])->get();
//            $model = view_giadatphanloai::where('mahs', $inputs['mahs'])->orderby('khuvuc')->orderby('maloaidat')->orderby('vitri')->get();
            $m_hs = GiaDatPhanLoai::where('mahs', $inputs['mahs'])->first();
            //tạo gr theo khuvuc;maloaidat sx theo vị trí
            $a_khuvuc = a_unique(array_column($model->toarray(),'khuvuc'));
//            foreach ($a_khuvuc as $kv){
//                dd($kv);
//            }


            $a_group = a_unique(a_split($model->toarray(),['khuvuc','maloaidat']));
            //dd($a_group);
            $m_donvi = dsdonvi::where('madv', $m_hs->madv)->first();
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            //dd($model->get());
            return view('manage.dinhgia.giadatphanloai.reports.inhoso')
                ->with('m_hoso',$m_hs)
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('a_loaidat',$a_loaidat)
                ->with('a_khuvuc',$a_khuvuc)
                ->with('a_group',$a_group)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ giá đất');
        }else
            return view('errors.notlogin');
    }

    public function timkiem(){
        if(Session::has('admin')){
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            //dd($m_diaban);
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            return view('manage.dinhgia.giadatphanloai.timkiem.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_loaidat',$a_loaidat)
                ->with('pageTitle','Tìm kiếm thông tin đấu giá đất');
        }else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request){
        if(Session::has('admin')){
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            $model = GiaDatPhanLoai::wherein('madv',array_column($m_donvi->toarray(),'madv'))->get();
            //dd($inputs);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }
            if($inputs['maloaidat'] != 'all'){
                $model = $model->where('maloaidat',$inputs['maloaidat']);
            }

            if(getDayVn($inputs['thoidiem_tu']) != ''){
                $model = $model->where('thoidiem','>=',$inputs['thoidiem_tu']);
            }

            if(getDayVn($inputs['thoidiem_den']) != ''){
                $model = $model->where('thoidiem','<=',$inputs['thoidiem_den']);
            }

            $model = $model->where('giatri','>=',chkDbl($inputs['giatri_tu']));
            if(chkDbl($inputs['giatri_den']) > 0){
                $model = $model->where('giatri','<=',chkDbl($inputs['giatri_den']));
            }

            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            return view('manage.dinhgia.giadatphanloai.timkiem.result')
                ->with('model',$model)
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('a_loaidat',$a_loaidat)
                ->with('pageTitle','Tìm kiếm thông tin đấu giá đất');
        }else
            return view('errors.notlogin');
    }

    function getHoSo($inputs)
    {
        $m_donvi = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first();
        $inputs['level'] = $m_donvi->chucnang != 'NHAPLIEU' ? $m_donvi->level : 'NHAPLIEU';
        switch ($inputs['level']) {
            case 'H':
            {
                $model = GiaDatPhanLoai::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                break;
            }
            case 'T':
            {
                $model = GiaDatPhanLoai::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                break;
            }
            case 'ADMIN':
            {
                $model = GiaDatPhanLoai::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                break;
            }
            default:
            {//mặc định lấy đơn vị nhâp liệu
                $model = GiaDatPhanLoai::where('madv', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem', $inputs['nam']);
                break;
            }
        }
        return $model->get();
    }
}
