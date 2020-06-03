<?php

namespace App\Http\Controllers\manage\giadatdiaban;


use App\GiaDatDiaBanDm;
use App\Model\manage\dinhgia\giadatdiaban\GiaDatDiaBan;
use App\Model\manage\dinhgia\giadatdiaban\GiaDatDiaBanCt;
use App\Model\manage\dinhgia\giadatdiaban\TtGiaDatDiaBan;
use App\Model\system\dsdiaban;
use App\Model\system\dsxaphuong;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giadatdiaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class GiaDatDiaBanController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giacldat';
            //lấy địa bàn
            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giacldat',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';

            //lấy thông tin đơn vị
            $model = GiaDatDiaBan::where('madiaban', $inputs['madiaban']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            $a_dm = array_column(TtGiaDatDiaBan::all()->toarray(),'mota', 'soqd');

            //dd($inputs);
            return view('manage.dinhgia.giadatdiaban.kekhai.index')
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

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giacldat';
            $model = GiaDatDiaBan::where('soqd', $inputs['soqd'])->where('madiaban', $inputs['madiaban'])->first();
            if($model == null){
                $m_qd = TtGiaDatDiaBan::where('soqd', $inputs['soqd'])->first();
                $model = new GiaDatDiaBan();
                $model->mahs = getdate()[0];
                $model->soqd = $inputs['soqd'];
                $model->thoidiem = $m_qd->ngayqd_apdung;
                $model->madv = $inputs['madv'];
                $model->trangthai = 'CHT';
                $model->madiaban = $inputs['madiaban'];
                $model->save();
                $modelct = nullValue();
            }else{
                $modelct = GiaDatDiaBanCt::where('mahs',$model->mahs)->get();
            }

            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            $a_xp = array_column(dsxaphuong::where('madiaban',$model->madiaban)->get()->toarray(),'tenxp', 'maxp');
            $a_qd = array_column(TtGiaDatDiaBan::where('soqd', $model->soqd)->get()->toarray(),'mota', 'soqd');
            $a_khuvuc = array_column($modelct->toarray(),'khuvuc', 'khuvuc');
            return view('manage.dinhgia.giadatdiaban.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('a_diaban', $a_diaban)
                ->with('a_loaidat', $a_loaidat)
                ->with('a_khuvuc', $a_khuvuc)
                ->with('a_xp', $a_xp)
                ->with('a_qd', $a_qd)
                ->with('pageTitle', 'Thông tin hồ sơ giá đất');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giacldat';
            $model = GiaDatDiaBan::where('mahs',$inputs['mahs'])->first();
            $modelct = GiaDatDiaBanCt::where('mahs',$model->mahs)->get();

            //dd($model);
            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            $a_xp = array_column(dsxaphuong::where('madiaban',$model->madiaban)->get()->toarray(),'tenxp', 'maxp');
            $a_qd = array_column(TtGiaDatDiaBan::where('soqd', $model->soqd)->get()->toarray(),'mota', 'soqd');
            $a_khuvuc = array_column($modelct->toarray(),'khuvuc', 'khuvuc');
            return view('manage.dinhgia.giadatdiaban.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('inputs', $inputs)
                ->with('a_diaban', $a_diaban)
                ->with('a_loaidat', $a_loaidat)
                ->with('a_khuvuc', $a_khuvuc)
                ->with('a_xp', $a_xp)
                ->with('a_qd', $a_qd)
                ->with('pageTitle', 'Thông tin hồ sơ giá đất');
        } else
            return view('errors.notlogin');
    }

    public function store_ct(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['giavt1'] = getDoubleToDb($inputs['giavt1']);
            $inputs['giavt2'] = getDoubleToDb($inputs['giavt2']);
            $inputs['giavt3'] = getDoubleToDb($inputs['giavt3']);
            $inputs['giavt4'] = getDoubleToDb($inputs['giavt4']);
            $inputs['hesok'] = getDoubleToDb($inputs['hesok']);
            $model = GiaDatDiaBanCt::where('id', $inputs['id'])->first();
            if($model == null){
                unset($inputs['id']);
                GiaDatDiaBanCt::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('/giacldat/modify?mahs='.$inputs['mahs'].'&act=true');

        } else
            return view('errors.notlogin');
    }

    public function destroy_ct(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = GiaDatDiaBanCt::where('id',$inputs['id'])->first();
            $model->delete();
            return redirect('/giacldat/modify?mahs='.$model->mahs.'&act=true');
        }else
            return view('errors.notlogin');
    }

    public function destroy_mulct(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            GiaDatDiaBanCt::where('mahs',$inputs['mahs'])->delete();
            return redirect('/giacldat/modify?mahs='.$inputs['mahs'].'&act=true');
        }else
            return view('errors.notlogin');
    }

//    public function nhandulieutuexcel(){
//        if (Session::has('admin')) {
//            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
//            $m_donvi = getDonViNhapLieu(session('admin')->level);
//            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
//            $a_xp = array_column(dsxaphuong::where('madiaban',array_key_first($a_diaban))->get()->toarray(),'tenxp', 'maxp');
//            $a_qd = array_column(TtGiaDatDiaBan::all()->toarray(),'mota', 'soqd');
//
//            return view('manage.dinhgia.giadatdiaban.importexcel')
//                ->with('a_diaban', $a_diaban)
//                ->with('m_donvi', $m_donvi)
//                ->with('a_loaidat', $a_loaidat)
//                ->with('a_xp', $a_xp)
//                ->with('a_qd', $a_qd)
//                ->with('pageTitle','Nhận dữ liệu giá đất trên địa bàn file Excel');
//
//        } else
//            return view('errors.notlogin');
//    }

    public function importexcel(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $filename = $inputs['madiaban'] . '_' . getdate()[0];
            //dd($inputs);
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];

            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });
            $a_data = array();
            $inputs['dendong'] = $inputs['dendong'] > count($data) ? count($data) : $inputs['dendong'];
            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                if($data[$i][$inputs['khuvuc']] == ''){
                    continue;
                }
                $a_data[] = array(
                    'mahs' => $inputs['mahs'],
                    'madiaban' => $inputs['madiaban'],
                    'maxp' => $inputs['maxp'],
                    'maloaidat' => $inputs['maloaidat'],
                    'khuvuc' => $data[$i][$inputs['khuvuc']],
                    'diemdau' => $data[$i][$inputs['diemdau']],
                    'diemcuoi' => $data[$i][$inputs['diemcuoi']],
                    'giavt1' => (isset($data[$i][$inputs['giavt1']]) && $data[$i][$inputs['giavt1']] != '' ? chkDbl($data[$i][$inputs['giavt1']]) : 0),
                    'giavt2' => (isset($data[$i][$inputs['giavt2']]) && $data[$i][$inputs['giavt2']] != '' ? chkDbl($data[$i][$inputs['giavt2']]) : 0),
                    'giavt3' => (isset($data[$i][$inputs['giavt3']]) && $data[$i][$inputs['giavt3']] != '' ? chkDbl($data[$i][$inputs['giavt3']]) : 0),
                    'giavt4' => (isset($data[$i][$inputs['giavt4']]) && $data[$i][$inputs['giavt4']] != '' ? chkDbl($data[$i][$inputs['giavt4']]) : 0),
                    //'giavt5' => (isset($data[$i][$inputs['giavt5']]) && $data[$i][$inputs['giavt5']] != '' ? chkDbl($data[$i][$inputs['giavt5']]) : 0),
                    'hesok' => (isset($data[$i][$inputs['hesok']]) && $data[$i][$inputs['hesok']] != '' ? chkDbl($data[$i][$inputs['hesok']]) : 1),
                );
            }
            foreach (array_chunk($a_data, 100) as $data) {
                GiaDatDiaBanCt::insert($data);
            }

            File::Delete($path);
            return redirect('/giacldat/modify?mahs='.$inputs['mahs'].'&act=true');
        } else
            return view('errors.notlogin');
    }

    public function multidelete(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = GiaDatDiaBan::where('district',$inputs['districtdel'])
                ->where('nam',$inputs['namdel']);
            if($inputs['maloaidatdel'] != 'All')
                $model = $model->where('maloaidat',$inputs['maloaidatdel']);

            $model = $model->delete();

            return redirect('giadatdiaban?&nam='.$inputs['namdel'].'&district='.$inputs['districtdel'].'&maloaidat='.$inputs['maloaidatdel']);
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = GiaDatDiaBan::where('mahs',$inputs['mahs'])->first();
            GiaDatDiaBanCt::where('mahs',$inputs['mahs'])->delete();
            $model->delete();

            return redirect('giacldat/danhsach?madiaban='.$model->madiaban);
        }else
            return view('errors.notlogin');
    }

    public function get_hs(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = GiaDatDiaBanCt::where('id',$inputs['id'])->first();
        die($model);
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            //dd($inputs);
            $model = GiaDatDiaBan::where('mahs',$inputs['mahs'])->first();
            $model->update($inputs);
            return redirect('/giacldat/danhsach?madiaban='.$inputs['madiaban']);
        }else
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
            $model = GiaDatDiaBan::where('mahs', $inputs['mahs'])->first();
            //dd($model);
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
                $model->trangthai_t = 'CHT';
            } else if ($chk_dvcq->count() && $chk_dvcq->level == 'ADMIN') {
                $model->madv_ad = $inputs['macqcq'];
                $model->trangthai_ad = 'CHT';
            } else {
                $model->madv_h = $inputs['macqcq'];
                $model->trangthai_h = 'CHT';
            }
            $model->save();
            return redirect('/giacldat/danhsach?madiaban='.$model->madiaban);
        } else
            return view('errors.notlogin');
    }

    public function chuyenhs_mul(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model_hs = GiaDatDiaBan::where('madiaban', $inputs['madiaban'])
                ->where('trangthai','<>','HT')->where('nam', $inputs['nam']);

            if ($inputs['maxp'] != 'all')
                $model_hs = $model_hs->where('maxp', $inputs['maxp']);
            if ($inputs['maloaidat'] != 'all')
                $model_hs = $model_hs->where('maloaidat', $inputs['maloaidat']);
            foreach ($model_hs->get() as $model){
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
                    $model->trangthai_t = 'CHT';
                } else if ($chk_dvcq->count() && $chk_dvcq->level == 'ADMIN') {
                    $model->madv_ad = $inputs['macqcq'];
                    $model->trangthai_ad = 'CHT';
                } else {
                    $model->madv_h = $inputs['macqcq'];
                    $model->trangthai_h = 'CHT';
                }
                $model->save();
            }

            return redirect('/giacldat/danhsach?&nam='.$inputs['nam'].'&madiaban='.$inputs['madiaban']);
        } else
            return view('errors.notlogin');
    }
    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giacldat';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            //dd($m_diaban);
            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giacldat',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->where('level','H')->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
//            $inputs['maxp'] = $inputs['maxp'] ?? 'all';
//            $inputs['maloaidat'] = $inputs['maloaidat'] ?? 'all';
            $inputs['level'] = $m_donvi_th->where('madv', $inputs['madv'])->first()->level ?? 'H';

            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            $a_xp = array_column(dsxaphuong::where('madiaban',$inputs['madiaban'])->get()->toarray(),'tenxp', 'maxp');
            $a_qd = array_column(TtGiaDatDiaBan::all()->toarray(),'mota', 'soqd');

            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
                'tendv', 'madv');

            switch ($inputs['level']){
                case 'H':{
                    $model = GiaDatDiaBan::where('madv_h', $inputs['madv'])->where('madiaban',$inputs['madiaban']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_h;
                        $ct->macqcq = $ct->macqcq_h;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->trangthai = $ct->trangthai_h;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
                case 'T':{
                    $model = GiaDatDiaBan::where('madv_t', $inputs['madv'])->where('madiaban',$inputs['madiaban']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_t;
                        $ct->macqcq = $ct->macqcq_t;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->trangthai = $ct->trangthai_t;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
                case 'ADMIN':{
                    $model = GiaDatDiaBan::where('madv_ad', $inputs['madv'])->where('madiaban',$inputs['madiaban']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_ad;
                        $ct->macqcq = $ct->macqcq_ad;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->trangthai = $ct->trangthai_ad;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
            }
            //dd($model);

            return view('manage.dinhgia.giadatdiaban.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_loaidat', $a_loaidat)
                ->with('a_xp', $a_xp)
                ->with('a_qd', $a_qd)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ giá đất theo địa bàn');
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
            $model = GiaDatDiaBan::where('mahs', $inputs['mahs'])->first();
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
            setHoanThanhDV_Dat($inputs['madv'], $model, ['macqcq' => $inputs['macqcq'], 'trangthai' => 'HT']);
            //kiểm tra đơn vị tiếp nhận
            $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            setHoanThanhCQ_Dat($chk_dvcq->level, $model, ['madv' => $inputs['macqcq'], 'trangthai' => 'CHT']);

            //dd($model);
            $model->save();
            return redirect('giacldat/xetduyet?madv=' . $inputs['madv'] .'&madiaban='.$model->madiaban);
        } else
            return view('errors.notlogin');
    }

    public function chuyenxd_mul(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            $model_hs = GiaDatDiaBan::where('nam',$inputs['nam'])
                ->where('madiaban',$inputs['madiaban'])->where('trangthai','HT');
            if ($inputs['maxp'] != 'all')
                $model_hs = $model_hs->where('maxp', $inputs['maxp']);
            if ($inputs['maloaidat'] != 'all')
                $model_hs = $model_hs->where('maloaidat', $inputs['maloaidat']);
            foreach ($model_hs->get() as $model){
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
                setHoanThanhDV_Dat($inputs['madv'], $model, ['macqcq' => $inputs['macqcq'], 'trangthai' => 'HT']);
                //kiểm tra đơn vị tiếp nhận
                $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
                setHoanThanhCQ_Dat($chk_dvcq->level, $model, ['madv' => $inputs['macqcq'], 'trangthai' => 'CHT']);

                //dd($model);
                $model->save();
            }

            return redirect('giacldat/xetduyet?madv=' . $inputs['madv'] .'&madiaban='.$model->madiaban.'&nam='.$model->nam);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDatDiaBan::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'HHT',
                'username' => session('admin')->username,
                'mota' => 'Trả lại hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'madv' => $inputs['madv'],
            );
            $model->lichsu = json_encode($a_lichsu);
            setTraLai_Dat($inputs['madv'], $model, ['macqcq' => null, 'trangthai' => 'HHT']);
            //dd($model);
            $model->save();
            return redirect('giacldat/xetduyet?madv=' . $inputs['madv'] .'&madiaban='.$model->madiaban.'&nam='.$model->nam);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDatDiaBan::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giacldat/xetduyet?madv=' . $model->madv_ad .'&madiaban='.$model->madiaban);
        } else
            return view('errors.notlogin');
    }

    public function congbo_mul(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model_hs = GiaDatDiaBan::where('nam',$inputs['nam'])
                ->where('madiaban',$inputs['madiaban'])->where('trangthai','HT');
            if ($inputs['maxp'] != 'all')
                $model_hs = $model_hs->where('maxp', $inputs['maxp']);
            if ($inputs['maloaidat'] != 'all')
                $model_hs = $model_hs->where('maloaidat', $inputs['maloaidat']);
            foreach ($model_hs->get() as $model){
                $a_lichsu = json_decode($model->lichsu, true);
                $a_lichsu[getdate()[0]] = array(
                    'hanhdong' => $inputs['trangthai'],
                    'username' => session('admin')->username,
                    'mota' => $inputs['trangthai'] == 'CB' ? 'Công bố hồ sơ' : 'Hủy công bố hồ sơ',
                    'thoigian' => date('Y-m-d H:i:s'),
                );
                $model->lichsu = json_encode($a_lichsu);
                setCongBo($model, ['trangthai' => $inputs['trangthai'],
                    'congbo' => $inputs['trangthai'] == 'CB' ? 'DACONGBO' : 'CHUACONGBO']);
                $model->save();
            }

            return redirect('giacldat/xetduyet?madv=' . $inputs['madv'] .'&madiaban='.$model->madiaban.'&nam='.$model->nam);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>


    function bcgiadatdiaban(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = view_giadatdiaban::where('madiaban',$inputs['madiaban']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereyear('thoidiem', $inputs['nam']);

            if(isset($inputs['madv'])){
                $m_donvi = view_dsdiaban_donvi::where('madv',$inputs['madv'])->first();
                $inputs['level'] = $m_donvi->level;
                switch ($inputs['level']){
                    case 'H':{
                        $model = $model->where('madv_h', $inputs['madv']);
                        break;
                    }
                    case 'T':{
                        $model = $model->where('madv_t', $inputs['madv']);
                        break;
                    }
                    case 'ADMIN':{
                        $model = $model->where('madv_ad', $inputs['madv']);
                        break;
                    }
                    default:{
                        $model = GiaDatDiaBan::where('madv', $inputs['madv']);
                        break;
                    }
                }
            }else{
                $m_donvi = view_dsdiaban_donvi::where('madv',session('admin')->madv)->first();

            }
            $model = $model->get();
            $qd = a_unique(array_column($model->toarray(),'soqd'));
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            $a_xp = array_column(dsxaphuong::where('madiaban',$inputs['madiaban'])->get()->toarray(),'tenxp', 'maxp');
            $a_qd = array_column(TtGiaDatDiaBan::wherein('soqd',$qd)->get()->toarray(),'mota', 'soqd');
            $a_khuvuc = a_unique(array_column($model->toarray(),'khuvuc'));
            //dd($a_khuvuc);
            return view('manage.dinhgia.giadatdiaban.reports.BcGiaDatDiaBan')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('inputs',$inputs)
                ->with('a_loaidat',$a_loaidat)
                ->with('a_diaban', getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban))
                ->with('a_xp',$a_xp)
                ->with('a_qd',$a_qd)
                ->with('a_khuvuc',$a_khuvuc)
                ->with('pageTitle','Báo cáo giá đất theo địa bàn');

        } else
            return view('errors.notlogin');
    }
}
