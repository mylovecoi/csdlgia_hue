<?php

namespace App\Http\Controllers\manage\giarung;

use App\DmGiaRung;
use App\Model\manage\dinhgia\GiaRung;
use App\Model\manage\dinhgia\GiaRungCt;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giarung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class GiaRungController extends Controller
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
            $inputs['url'] = '/giarung';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level,'giarung');
            $m_donvi_th = getDonViTongHop('giarung',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            //dd($inputs);
            //lấy thông tin đơn vị
            $model = GiaRung::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            //dd($inputs);
            return view('manage.dinhgia.giarung.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_loairung', $a_loairung)
                ->with('a_dvt', $a_dvt)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ giá rừng');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/giarung';
            $inputs['act'] = true;
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->where('level','H')->get();
            $model = new GiaRung();
            $model->mahs = getdate()[0];
            $model->madiaban = $m_diaban->first()->madiaban ?? null;
            $model->madv = $inputs['madv'];
            $model->trangthai = 'CHT';
            $model->thoidiem = date('Y-m-d');

//            $a_lichsu[$model->mahs] = [
//                'username' => session('admin')->username,
//                'hanhdong' => 'ADD',
//                'mota' => 'Thêm mới hồ sơ',
//                'thoigian' => $model->thoidiem,
//            ];
//
//            $model->lichsu = json_encode($a_lichsu);
//            $model->save();
            $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            //dd($a_diaban);

            $modelct = GiaRungCt::where('id', -1)->get();
            return view('manage.dinhgia.giarung.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('a_loairung', $a_loairung)
                ->with('a_dvt', $a_dvt)
                ->with('a_diaban', array_column($m_diaban->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ');

            //return redirect('/giaspdvci/modify?mahs='.$model->mahs.'&act=true&addnew=true');
        }else
            return view('errors.notlogin');
    }

    public function nhandulieutuexcel(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level,'giarung');
            $loairungs = DmGiaRung::all();
            return view('manage.dinhgia.giarung.importexcel')
                ->with('m_diaban',$m_diaban)
                ->with('loairungs',$loairungs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('inputs',$inputs)
                ->with('pageTitle','Nhận dữ liệu giá thuê môi trường rừng file Excel');

        } else
            return view('errors.notlogin');
    }

    public function importexcel(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();

            $filename = $inputs['madiaban'] . '_' . getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];

            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });
            //dd($data);
            $ma = getdate()[0];
            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                if(!isset($data[$i][$inputs['tenduan']]) || !isset($data[$i][$inputs['thoidiem']]) ||
                !isset($data[$i][$inputs['dongia']]) || !isset($data[$i][$inputs['ttqd']])){
                    continue;
                }
                $modelctnew = new Giarung();
                $modelctnew->mahs = $inputs['madv'].'_'.$ma++;
                $modelctnew->madiaban = $inputs['madiaban'];
                $modelctnew->madv = $inputs['madv'];
                $modelctnew->manhom = $inputs['manhom'] ?? '';
                $modelctnew->thoidiem = getDateToDb($data[$i][$inputs['thoidiem']]) ?? '';
                $modelctnew->tenduan = $data[$i][$inputs['tenduan']] ?? '';
                $modelctnew->dongia = (isset($data[$i][$inputs['dongia']]) && $data[$i][$inputs['dongia']] != '' ? chkDbl($data[$i][$inputs['dongia']]) : 0);
                $modelctnew->soqd = $data[$i][$inputs['ttqd']] ?? '';
                $modelctnew->ghichu = $data[$i][$inputs['ghichu']] ?? '';
                $modelctnew->trangthai = 'CHT';
                $modelctnew->save();
            }
            File::Delete($path);
            return redirect('/giarung/danhsach?madv='.$inputs['madv']);
        }else
            return view('errors.notlogin');
    }

    public function multidelete(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = GiaRung::whereYear('thoidiem',$inputs['namdel']);
            if($inputs['districtdel'] != 'all')
                $model = $model->where('district',$inputs['districtdel'])
                    ->where('trangthai','CHT');

            $model = $model->delete();

            return redirect('giarung?&nam='.$inputs['namdel'].'&district='.$inputs['districtdel']);
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = GiaRung::where('mahs',$inputs['mahs'])->first();
            $model->delete();
            return redirect('giarung/danhsach?madv='.$model->madv);
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        //kiểm tra đơn vị (madv) cấp H=> chỉ load danh mục H; T => load toàn Tỉnh
        if(Session::has('admin')){
            $inputs = $request->all();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            //$m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level,'giarung');
            $model = GiaRung::where('mahs',$inputs['mahs'])->first();
            $modelct = GiaRungCt::where('mahs',$model->mahs)->get();
            $inputs['url'] = '/giarung';
            $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->where('level','H')->get();
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            return view('manage.dinhgia.giarung.kekhai.edit')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_loairung', $a_loairung)
                ->with('a_dvt', $a_dvt)
                ->with('a_diaban', array_column($m_diaban->toarray(), 'tendiaban', 'madiaban'))
                ->with('inputs',$inputs)
                ->with('pageTitle','Chi tiết hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function show_dk(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();
        $model = GiaRung::where('mahs', $inputs['mahs'])->first();

        $result['message'] = '<div class="modal-body" id = "dinh_kem" >';

        $result['message'] .= '<div class="row">';
        if (isset($model->ipf1)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giarung/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf2)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giarung/' . $model->ipf2) . '">' . $model->ipf2 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf3)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giarung/' . $model->ipf3) . '">' . $model->ipf3 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf4)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giarung/' . $model->ipf4) . '">' . $model->ipf4 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        if (isset($model->ipf5)) {
            $result['message'] .= '<div class="col-md-6" ><div class="form-group">';
            $result['message'] .= '<label class="control-label" > File đính kèm</label>';
            $result['message'] .= '<p><a target = "_blank" href = "' . url('/data/giarung/' . $model->ipf5) . '">' . $model->ipf5 . '</a ></p>';
            $result['message'] .= '</div></div>';
        }
        $result['message'] .= '</div>';
        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] .'&1.'.$ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giarung/', $name);
                $inputs['ipf1']= $name;
            }
            if(isset($inputs['ipf2'])){
                $ipf2 = $request->file('ipf2');
                $name = $inputs['mahs'] .'&2.'.$ipf2->getClientOriginalName();
                $ipf2->move(public_path() . '/data/giarung/', $name);
                $inputs['ipf2']= $name;
            }
            if(isset($inputs['ipf3'])){
                $ipf3 = $request->file('ipf3');
                $name = $inputs['mahs'] .'&3.'.$ipf3->getClientOriginalName();
                $ipf3->move(public_path() . '/data/giarung/', $name);
                $inputs['ipf3']= $name;
            }
            if(isset($inputs['ipf4'])){
                $ipf4 = $request->file('ipf4');
                $name = $inputs['mahs'] .'&4.'.$ipf4->getClientOriginalName();
                $ipf4->move(public_path() . '/data/giarung/', $name);
                $inputs['ipf4']= $name;
            }
            if(isset($inputs['ipf5'])){
                $ipf5 = $request->file('ipf5');
                $name = $inputs['mahs'] .'&5.'.$ipf5->getClientOriginalName();
                $ipf5->move(public_path() . '/data/giarung/', $name);
                $inputs['ipf5']= $name;
            }
            $model = GiaRung::where('mahs',$inputs['mahs'])->first();
            if($model == null){
                $inputs['trangthai'] = 'CHT';
                GiaRung::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('giarung/danhsach?&madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    //chuyển hô sơ cho Form nhập liệu: chỉ cần chuyển trạng thái và set trạng thái cho đơn vị tiếp nhận
    public function chuyenhs(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaRung::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giarung/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giarung';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level,'giarung');
            $m_donvi_th = getDonViTongHop('giarung',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';
            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(view_dsdiaban_donvi::all()->toarray(),
                'tendv', 'madv');
            //dd($a_ttdv);
            switch ($inputs['level']){
                case 'H':{
                    $model = GiaRung::where('madv_h', $inputs['madv']);
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
                    $model = GiaRung::where('madv_t', $inputs['madv']);
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
                    $model = GiaRung::where('madv_ad', $inputs['madv']);
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
            $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');
            return view('manage.dinhgia.giarung.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_loairung', $a_loairung)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ giá rừng');
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
            $model = GiaRung::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giarung/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaRung::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giarung/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaRung::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giarung/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>

    public function BcGiaRung(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            //lấy thông tin đơn vị
            $model = $this->getHoSo($inputs);
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');
            $a_diaban = array_column(view_dsdiaban_donvi::wherein('madiaban',array_column($model->toArray(),'madiaban'))
                ->get()->toArray(),'tendiaban','madiaban');
            //dd($a_loairung);
            return view('manage.dinhgia.giarung.reports.BcGiaRung')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('a_loairung',$a_loairung)
                ->with('a_diaban',$a_diaban)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function timkiem(){
        if(Session::has('admin')){
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban,'giarung');
            //dd($m_diaban);
            $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');
            return view('manage.dinhgia.giarung.timkiem.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_loairung',$a_loairung)
                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request){
        if(Session::has('admin')){
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban,'giarung');
            $model = view_giarung::wherein('madv',array_column($m_donvi->toarray(),'madv'));
            //dd($inputs);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }
            if($inputs['manhom'] != 'all'){
                $model = $model->where('manhom',$inputs['manhom']);
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

            $a_loairung = array_column(DmGiaRung::all()->toArray(),'tennhom','manhom');
            return view('manage.dinhgia.giarung.timkiem.result')
                ->with('model',$model->get())
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('a_loairung',$a_loairung)
                ->with('pageTitle','Tìm kiếm thông tin giá rừng');
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
                $model = GiaRung::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                break;
            }
            case 'T':
            {
                $model = GiaRung::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                break;
            }
            case 'ADMIN':
            {
                $model = GiaRung::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                break;
            }
            default:
            {//mặc định lấy đơn vị nhâp liệu
                $model = GiaRung::where('madv', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem', $inputs['nam']);
                break;
            }
        }
        return $model->get();
    }

}
