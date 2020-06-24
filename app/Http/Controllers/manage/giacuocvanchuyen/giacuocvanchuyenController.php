<?php

namespace App\Http\Controllers\manage\giacuocvanchuyen;

use App\Model\manage\dinhgia\giacuocvanchuyen\giacuocvanchuyen;
use App\Model\manage\dinhgia\giacuocvanchuyen\giacuocvanchuyenct;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giacuocvanchuyen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giacuocvanchuyenController extends Controller
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
            $inputs['url'] = '/giacuocvanchuyen';
            //$a_diabanapdung = getDiaBan_ApDung(\session('admin')->level, \session('admin')->madiaban);
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            //$m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giacuocvanchuyen',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? date('Y');
            $inputs['thang'] = $inputs['thang'] ?? date('m');

            //$m_donvi = view_dsdiaban_donvi::where('madiaban', $inputs['madiaban'])->where('chucnang', 'NHAPLIEU')->get();
            //lấy thông tin đơn vị
            $model = giacuocvanchuyen::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);

            //dd($model);
            return view('manage.dinhgia.giacuocvanchuyen.kekhai.index')
                ->with('model', $model->orderby('thoidiem')->get())
                ->with('inputs', $inputs)
                //->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('a_diaban', $a_diaban)
                //->with('a_diabanapdung', $a_diabanapdung)
                ->with('a_dv', array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle','Thông tin hồ sơ giá hàng hóa, dịch vụ khác');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giacuocvanchuyen';
            $inputs['act'] = $inputs['act'] ?? 'true';
            //dd($inputs);
            $model = new giacuocvanchuyen();
            $model->mahs = $inputs['madv'] . '_' . getdate()[0];
            $model->madv = $inputs['madv'];
            $model->trangthai = 'CHT';
            //$model->thoidiem = $inputs['thoidiem'];
            $a_diabanapdung = getDiaBan_ApDung(\session('admin')->level, \session('admin')->madiaban);
            return view('manage.dinhgia.giacuocvanchuyen.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', nullValue())
                ->with('a_diabanapdung', $a_diabanapdung)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin hồ sơ');

        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            $model = giacuocvanchuyen::where('mahs',$inputs['mahs'])->first();
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] .'&1.'.$ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giacuocvanchuyen/', $name);
                $inputs['ipf1']= $name;
            }
            if($model == null){
                $inputs['trangthai'] = 'CHT';
                giacuocvanchuyen::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('giacuocvanchuyen/danhsach');
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
        $model = giacuocvanchuyen::where('mahs',$inputs['mahs'])->first();

        $result['message'] ='<div class="modal-body" id = "dinh_kem" >';
        if (isset($model->ipf1)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 1 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/giacuocvanchuyen/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }

        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function ketxuat(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = giacuocvanchuyen::where('mahs',$inputs['mahs'])->first();
            $modelct = view_giacuocvanchuyen::where('mahs',$model->mahs)->get();

            $a_diaban = array_column(dsdiaban::where('madiaban', $model->madiaban)->get()->toarray(), 'tendiaban', 'madiaban');
            $a_tt = array_column(NhomHhDvK::where('matt', $model->matt)->get()->toarray(), 'tentt', 'matt');
            $a_dm = array_column(DmHhDvK::where('matt', $model->matt)->get()->toarray(), 'tenhhdv', 'mahhdv');
            $m_dv = dsdonvi::where('madv',$model->madv)->first();
            return view('manage.dinhgia.giacuocvanchuyen.reports.prints')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('m_dv',$m_dv)
                ->with('a_diaban', $a_diaban)
                ->with('a_tt', $a_tt)
                ->with('a_dm', $a_dm)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Kê khai giá hàng hóa dịch vụ chi tiết');
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $inputs['url'] = '/giacuocvanchuyen';
            $model = giacuocvanchuyen::where('mahs', $inputs['mahs'])->first();
            $inputs['act'] = in_array($model->trangthai, ['CHT', 'HHT']) ? 'true' : $inputs['act']; //do có trường hợp đc gọi từ thêm mới
            $modelct = giacuocvanchuyenct::where('mahs', $model->mahs)->get();
            $a_diabanapdung = getDiaBan_ApDung(\session('admin')->level, \session('admin')->madiaban);
           return view('manage.dinhgia.giacuocvanchuyen.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('a_diabanapdung', $a_diabanapdung)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = giacuocvanchuyen::where('mahs',$inputs['mahs'])->first();
            giacuocvanchuyenct::where('mahs',$model->mahs)->delete();
            $model->delete();
            return redirect('giacuocvanchuyen/danhsach');
        }else
            return view('errors.notlogin');
    }

    public function chuyenhs(Request $request)
    {
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giacuocvanchuyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giacuocvanchuyen/danhsach');
        } else
            return view('errors.notlogin');
    }

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giacuocvanchuyen';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giacuocvanchuyen',\session('admin')->level, \session('admin')->madiaban);
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
                    $model = giacuocvanchuyen::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_h;
                        $ct->macqcq = $ct->macqcq_h;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->thoidiem_ch = $ct->thoidiem_h;
                        $ct->trangthai = $ct->trangthai_h;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
                case 'T':{
                    $model = giacuocvanchuyen::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_t;
                        $ct->macqcq = $ct->macqcq_t;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->thoidiem_ch = $ct->thoidiem_t;
                        $ct->trangthai = $ct->trangthai_t;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
                case 'ADMIN':{
                    $model = giacuocvanchuyen::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                    $model = $model->get();
                    foreach ($model as $ct){
                        $ct->madv_ch = getDonViChuyen($inputs['madv'], $ct );
                        $ct->tendv_ch = $a_ttdv[$ct->madv_ch] ?? '';
                        $ct->madv = $ct->madv_ad;
                        $ct->macqcq = $ct->macqcq_ad;
                        $ct->tencqcq = $a_ttdv[$ct->macqcq] ?? '';
                        $ct->thoidiem_ch = $ct->thoidiem_ad;
                        $ct->trangthai = $ct->trangthai_ad;
                        $ct->level = $inputs['level'];
                    }
                    break;
                }
            }
            //dd($model);
            return view('manage.dinhgia.giacuocvanchuyen.xetduyet.index')
                ->with('model', $model->sortby('thoidiem'))
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column(dsdiaban::all()->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th->where('madv','<>',$inputs['madv']))
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
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
            $model = giacuocvanchuyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giacuocvanchuyen/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giacuocvanchuyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giacuocvanchuyen/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giacuocvanchuyen::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giacuocvanchuyen/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>

    public function timkiem(){
        if(Session::has('admin')){
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            //dd($m_diaban);
            //$a_dm = array_column(NhomHhDvK::all()->toArray(),'tentt','matt');
            $inputs['url'] = '/giacuocvanchuyen';
            return view('manage.dinhgia.giacuocvanchuyen.timkiem.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                //->with('a_dm',$a_dm)
                ->with('inputs',$inputs)
                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function ketquatk(Request $request){
        if(Session::has('admin')){
            //Chỉ tìm kiếm hồ sơ do đơn vị nhập (các hồ sơ chuyển đơn vị cấp trên ko tính)
            //Lấy hết hồ sơ trên địa bàn rồi bắt đầu tìm kiểm
            $inputs = $request->all();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            $model = view_giacuocvanchuyen::wherein('madv',array_column($m_donvi->toarray(),'madv'));
            //dd($model);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }

            if($inputs['phanloai'] != 'all'){
                $model = $model->where('phanloai',$inputs['phanloai']);
            }

            if($inputs['bachh'] != 'all'){
                $model = $model->where('bachh',$inputs['bachh']);
            }

            if($inputs['tencuoc'] != '') {
                $model = $model->where('tencuoc','like', getTimkiemLike($inputs['tencuoc']));
            }

            if(getDayVn($inputs['thoidiem_tu']) != ''){
                $model = $model->where('thoidiem','>=',$inputs['thoidiem_tu']);
            }

            if(getDayVn($inputs['thoidiem_den']) != ''){
                $model = $model->where('thoidiem','<=',$inputs['thoidiem_den']);
            }

            $model = $model->where('tukm','>=',chkDbl($inputs['tukm_tu']));
            if(chkDbl($inputs['tukm_den']) > 0){
                $model = $model->where('tukm','<=',chkDbl($inputs['tukm_den']));
            }
            //dd($model);
            //$a_dm = array_column(NhomHhDvK::all()->toArray(),'tentt','matt');
            $inputs['url'] = '/giacuocvanchuyen';
            return view('manage.dinhgia.giacuocvanchuyen.timkiem.result')
                ->with('model',$model->get())
                //->with('a_dm',$a_dm)
                ->with('inputs',$inputs)
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

}
