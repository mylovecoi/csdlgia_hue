<?php

namespace App\Http\Controllers\manage\giadvkcb;

use App\DiaBanHd;

use App\DvKcbCt;
use App\Model\manage\dinhgia\giadvkcb\DvKcb;
use App\Model\manage\dinhgia\giadvkcb\dvkcbdm;
use App\Model\manage\dinhgia\giaspdvci\trogiatrocuocdm;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giadvkcb;
use App\NhomDvKcb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;


class DvKcbController extends Controller
{
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
            $inputs['url'] = '/giadvkcb';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level, 'giadvkcb');
            if (count($m_donvi) == null) {
                $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giadvkcb']
                    . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
                return  view('errors.403')
                    ->with('message', $message);
            }
            $m_donvi_th = getDonViTongHop('giadvkcb',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';

            //lấy thông tin đơn vị
            $model = DvKcb::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            $a_dm = array_column(NhomDvKcb::all()->toArray(),'tennhom','manhom');

            //dd($inputs);
            return view('manage.dinhgia.giadvkcb.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H','T','X'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_dm', $a_dm)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadvkcb';
            $m_dv = dsdonvi::where('madv', $inputs['madv'])->first();
            $modelnhom = NhomDvKcb::where('manhom', $inputs['manhom'])->first();
            $inputs['mahs'] = getdate()[0];
            $modeldm = dvkcbdm::where('manhom', $inputs['manhom'])->where('hientrang', 'TD')->get();
            $model = new DvKcb();
            $model->mahs = $inputs['mahs'];
            $model->madv = $inputs['madv'];
            $model->madiaban = $m_dv->madiaban;
            $model->manhom = $inputs['manhom'];
            $model->trangthai  = 'CHT';

            $m_lk = DvKcb::where('trangthai', 'HT')
                ->where('manhom', $inputs['manhom'])
                ->where('madv', $inputs['madv'])
                ->orderby('thoidiem', 'desc')->first();
            if ($m_lk != null) {
                $model->soqdlk = $m_lk->soqd;
                $model->thoidiemlk = $m_lk->thoidiemlk;
                $a_ctlk = array_column(DvKcbCt::where('mahs', $m_lk->mahs)->get()->toarray(),'giadv', 'madichvu');
            }
            //dd($a_ctlk);
            $a_dm = [];
            foreach ($modeldm as $dm) {
                //$giadv = isset($a_ctlk[$dm->madichvu]) ? getDoubleToDb($a_ctlk[$dm->madichvu]) : 0;
                $a_dm[] = [
                    'mahs' => $inputs['mahs'],
                    'phanloai' => $dm->phanloai,
                    'madichvu' => $dm->madichvu,
                    'tenspdv' => $dm->tenspdv,
                    'dvt' => $dm->dvt,
                    'giadv' => isset($a_ctlk[$dm->madichvu]) && getDoubleToDb($a_ctlk[$dm->madichvu]) > 0 ? getDoubleToDb($a_ctlk[$dm->madichvu]) : 0,
                ];
            }
            //dd($a_dm);
            foreach (array_chunk($a_dm , 100) as $dm){
                DvKcbCt::insert($dm);
            }
            $modelct = DvKcbCt::where('mahs', $inputs['mahs'])->get();
            $a_tt = array_column(NhomDvKcb::where('manhom', $inputs['manhom'])->get()->toarray(), 'tennhom', 'manhom');
            $a_diaban = array_column(dsdiaban::where('madiaban', $m_dv->madiaban)->get()->toarray(), 'tendiaban', 'madiaban');
            return view('manage.dinhgia.giadvkcb.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('modelnhom', $modelnhom)
                ->with('a_diaban', $a_diaban)
                ->with('a_tt', $a_tt)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Hồ sơ giá dịch vụ khám chữa bệnh');
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = DvKcb::where('mahs',$inputs['mahs'])->first();
            $model->delete();
            return redirect('giadvkcb/danhsach?madv='.$model->madv);
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/giadvkcb';
            $model = DvKcb::where('mahs', $inputs['mahs'])->first();
            $modelct = DvKcbCt::where('mahs', $inputs['mahs'])->get();
            $a_tt = array_column(NhomDvKcb::where('manhom', $model->manhom)->get()->toarray(), 'tennhom', 'manhom');
            $a_diaban = array_column(dsdiaban::where('madiaban', $model->madiaban)->get()->toarray(), 'tendiaban', 'madiaban');
            return view('manage.dinhgia.giadvkcb.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                //->with('modelnhom', $modelnhom)
                ->with('a_diaban', $a_diaban)
                ->with('a_tt', $a_tt)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Hồ sơ giá dịch vụ khám chữa bệnh');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            //$inputs['dongia'] = getDoubleToDb($inputs['dongia']);
            $chk = DvKcb::where('mahs', $inputs['mahs'])->first();
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] .'&1.'.$ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giadvkcb/', $name);
                $inputs['ipf1']= $name;
            }
            if(isset($inputs['ipf2'])){
                $ipf2 = $request->file('ipf2');
                $name = $inputs['mahs'] .'&2.'.$ipf2->getClientOriginalName();
                $ipf2->move(public_path() . '/data/giadvkcb/', $name);
                $inputs['ipf2']= $name;
            }
            if(isset($inputs['ipf3'])){
                $ipf3 = $request->file('ipf3');
                $name = $inputs['mahs'] .'&3.'.$ipf3->getClientOriginalName();
                $ipf3->move(public_path() . '/data/giadvkcb/', $name);
                $inputs['ipf3']= $name;
            }
            if(isset($inputs['ipf4'])){
                $ipf4 = $request->file('ipf4');
                $name = $inputs['mahs'] .'&4.'.$ipf4->getClientOriginalName();
                $ipf4->move(public_path() . '/data/giadvkcb/', $name);
                $inputs['ipf4']= $name;
            }
            if(isset($inputs['ipf5'])){
                $ipf5 = $request->file('ipf5');
                $name = $inputs['mahs'] .'&5.'.$ipf5->getClientOriginalName();
                $ipf5->move(public_path() . '/data/giadvkcb/', $name);
                $inputs['ipf5']= $name;
            }
            //dd($inputs);
            if ($chk == null) {
                //$inputs['mahs'] = getdate()[0];
                $inputs['trangthai'] = 'CHT';
                DvKcb::create($inputs);
            } else {
                $chk->update($inputs);
            }

            return redirect('giadvkcb/danhsach?&madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function show_dk(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();
        $model = DvKcb::where('mahs',$inputs['mahs'])->first();

        $result['message'] ='<div class="modal-body" id = "dinh_kem" >';
        $result['message'] .= '<div class="row">';
        if (isset($model->ipf1)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giadvkcb/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf2)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giadvkcb/' . $model->ipf2) . '">' . $model->ipf2 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf3)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giadvkcb/' . $model->ipf3) . '">' . $model->ipf3 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf4)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giadvkcb/' . $model->ipf4) . '">' . $model->ipf4 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf5)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giadvkcb/' . $model->ipf5) . '">' . $model->ipf5 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        $result['message'] .= '</div>';
        $result['status'] = 'success';
//        if (isset($model->ipf1)) {
//            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
//            $result['message'] .= '<label class="control-label" > File đính kèm 1 </label >';
//            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/giadvkcb/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p >';
//            $result['message'] .= '</div ></div ></div >';
//        }
//        $result['status'] = 'success';

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
            $model = DvKcb::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadvkcb/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function nhandulieutuexcel(){
        if (Session::has('admin')) {
            $districts = DiaBanHd::where('level','H')
                ->get();
            return view('manage.dinhgia.dvkcb.importexcel')
                ->with('districts',$districts)
                ->with('pageTitle','Nhận dữ liệu giá dịch vụ khám chữa bệnh từ file Excel');

        } else
            return view('errors.notlogin');
    }

    public function importexcel(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $inputs['tudong'] = getMoneyToDb($inputs['tudong']);
            $inputs['dendong'] = getMoneyToDb($inputs['dendong']);
            $filename = $inputs['district'] . '_' . getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];

            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });

            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {

                $modelctnew = new DvKcb();
                $modelctnew->district = $inputs['district'];
                $modelctnew->thoidiem = getDateToDb($data[$i][$inputs['thoidiem']]);
                $modelctnew->tenbv = $data[$i][$inputs['tenbv']];
                $modelctnew->mota = $data[$i][$inputs['mota']];
                $modelctnew->dongia = (isset($data[$i][$inputs['dongia']]) && $data[$i][$inputs['dongia']] != '' ? chkDbl($data[$i][$inputs['dongia']]) : 0);
                $modelctnew->dvt = $data[$i][$inputs['dvt']];
                $modelctnew->ttqd = $data[$i][$inputs['ttqd']];
                $modelctnew->ghichu = $data[$i][$inputs['ghichu']];
                $modelctnew->trangthai = 'CHT';
                $modelctnew->save();
            }
            File::Delete($path);
            return redirect('dichvukcb?&district='.$inputs['district']);
        }else
            return view('errors.notlogin');
    }


    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadvkcb';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level,'giadvkcb');
            $m_donvi_th = getDonViTongHop('giadvkcb',\session('admin')->level, \session('admin')->madiaban);
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
                    $model = DvKcb::where('madv_h', $inputs['madv']);
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
                    $model = DvKcb::where('madv_t', $inputs['madv']);
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
                    $model = DvKcb::where('madv_ad', $inputs['madv']);
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
            $a_dm = array_column(NhomDvKcb::all()->toArray(),'tennhom','manhom');
            return view('manage.dinhgia.giadvkcb.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_dm', $a_dm)
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H','T','X'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ dịch vụ khám chữa bệnh');
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
            $model = DvKcb::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadvkcb/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DvKcb::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadvkcb/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DvKcb::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadvkcb/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>

    public function timkiem(){
        if(Session::has('admin')){
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban,'giadvkcb');
            //dd($m_diaban);
            $a_dm = array_column(dvkcbdm::all()->toArray(),'tenspdv','maspdv');
            return view('manage.dinhgia.giadvkcb.timkiem.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_dm',$a_dm)
                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request){
        if(Session::has('admin')){
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban,'giadvkcb');
            $model = view_giadvkcb::wherein('madv',array_column($m_donvi->toarray(),'madv'))->get();
            //dd($inputs);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }
            if($inputs['maspdv'] != 'all'){
                $model = $model->where('maspdv',$inputs['maspdv']);
            }


            if(getDayVn($inputs['thoidiem_tu']) != ''){
                $model = $model->where('thoidiem','>=',$inputs['thoidiem_tu']);
            }

            if(getDayVn($inputs['thoidiem_den']) != ''){
                $model = $model->where('thoidiem','<=',$inputs['thoidiem_den']);
            }

            $model = $model->where('giadv','>=',chkDbl($inputs['giatri_tu']));
            if(chkDbl($inputs['giatri_den']) > 0){
                $model = $model->where('giadv','<=',chkDbl($inputs['giatri_den']));
            }

            $a_dm = array_column(dvkcbdm::all()->toArray(),'tenspdv','maspdv');
            return view('manage.dinhgia.giadvkcb.timkiem.result')
                ->with('model',$model)
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('a_dm',$a_dm)
                ->with('pageTitle','Tìm kiếm thông tin giá dịch vụ khám chữa bệnh');
        }else
            return view('errors.notlogin');
    }

    function ketxuat(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            //lấy thông tin đơn vị
            $model = $this->getHoSo($inputs);
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            $a_diaban = array_column(view_dsdiaban_donvi::wherein('madiaban',array_column($model->toArray(),'madiaban'))
                ->get()->toArray(),'tendiaban','madiaban');
            $a_dm = array_column(NhomDvKcb::all()->toArray(),'tennhom','manhom');
            return view('manage.dinhgia.giadvkcb.reports.BcGiaDvKcb')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('a_dm',$a_dm)
                ->with('a_diaban',$a_diaban)
                ->with('pageTitle','Báo cáo giá dịch vụ khám chữa bệnh');

        } else
            return view('errors.notlogin');
    }

    function getHoSo($inputs)
    {
        $m_donvi = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first();
        $inputs['level'] = $m_donvi->chucnang != 'NHAPLIEU' ? $m_donvi->level : 'NHAPLIEU';
        switch ($inputs['level']) {
            case 'H':
            {
                $model = DvKcb::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                break;
            }
            case 'T':
            {
                $model = DvKcb::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                break;
            }
            case 'ADMIN':
            {
                $model = DvKcb::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                break;
            }
            default:
            {//mặc định lấy đơn vị nhâp liệu
                $model = DvKcb::where('madv', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem', $inputs['nam']);
                break;
            }
        }
        return $model->get();
    }
}
