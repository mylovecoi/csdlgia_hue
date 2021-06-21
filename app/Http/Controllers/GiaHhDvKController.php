<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\District;
use App\DmHhDvK;
use App\DmHhDvK_DonVi;
use App\DmNhomHangHoa;
use App\GiaHhDvK;
use App\GiaHhDvKCt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giahhdvk;
use App\NhomHhDvK;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class GiaHhDvKController extends Controller
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
            $inputs['url'] = '/giahhdvk';
            //lấy địa bàn
            //$a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $a_diaban = getDiaBan_NhapLieu(session('admin')->level, session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi_th = getDonViTongHop('giahhdvk',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            //$inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';

//            $m_donvi = view_dsdiaban_donvi::where('madiaban', $inputs['madiaban'])->where('chucnang', 'NHAPLIEU')->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level,'giahhdvk');
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $a_nhom = array_column(NhomHhDvK::where('theodoi', 'TD')->get()->toarray(), 'tentt','matt');
            //lấy thông tin đơn vị
            $model = GiaHhDvK::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            //dd($model->get());
            return view('manage.dinhgia.giahhdvk.kekhai.index')
                ->with('model', $model->orderby('nam')->orderby('thang')->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('a_nhom', $a_nhom)
                ->with('a_diaban', $a_diaban)
                ->with('a_dv', array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle','Thông tin hồ sơ giá hàng hóa, dịch vụ khác');
        } else
            return view('errors.notlogin');
    }

    public function index_c(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $modeldb = DiaBanHd::where('level','H')->get();
            if(session('admin')->level == 'X') {
                $inputs['district'] = session('admin')->district;
            }else {
                $inputs['district'] = isset($inputs['district']) ? $inputs['district'] : $modeldb->first()->district;
            }

            $model = GiaHhDvK::join('nhomhhdvk','nhomhhdvk.matt','=','giahhdvk.matt')
                ->select('giahhdvk.*', 'nhomhhdvk.tentt')
                ->where('giahhdvk.district', $inputs['district'])
                ->where('giahhdvk.nam',$inputs['nam']);
                //->where('giahhdvk.thang',$inputs['thang']);

            $model = $model->get();
            $m_nhom =array_column(NhomHhDvK::where('theodoi', 'TD')
                ->get()->toarray(), 'tentt','matt');
            $diaban = DiaBanHd::where('district',$inputs['district'])->first();
            return view('manage.dinhgia.giahhdvk.kekhai.index')
                ->with('model', $model)
                ->with('modeldb', $modeldb)
                ->with('inputs',$inputs)
                ->with('a_nhom', $m_nhom)
                ->with('diaban',$diaban)
                //->with('a_nhom',array_merge(array('ALL'=>'Tất cả hàng hóa'), $m_nhom))
                ->with('pageTitle', 'Thông tin báo cáo giá hàng hóa dịch vụ');

        } else
            return view('errors.notlogin');
    }

    public function create_c(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            //dd($inputs);
            if (isset($inputs['mattbc']) && isset($inputs['madiaban'])) {
                $model = GiaHhDvK::where('matt', $inputs['mattbc'])
                    ->where('thang', $inputs['thang'])
                    ->where('nam', $inputs['nam'])
                    ->where('madiaban', $inputs['madiaban'])
                    ->first();
                /*
                 nếu đã có báo cáo thì mở báo cáo đã tạo ra
                 * */
                if ($model != null) {
                    return redirect('/giahhdvk/modify?mahs='.$model->mahs.'&act=false');
                    //gọi đến hàm modify
                } else {
                    //xóa các chi tiết ko có hồ sơ (dữ liệu thừa do khi tạo mới thì tự thêm vào trong chi tiết mà ko cần lưu hồ sơ)
                    //DB::statement("DELETE FROM giahhdvkct WHERE mahs not in (SELECT mahs FROM giahhdvk where madv='" . $inputs['madv'] . "')");

                    $model = new GiaHhDvK();
                    //$tennhom = NhomHhDvK::where('matt', $inputs['mattbc'])->first()->tentt;
                    //$diaban = DiaBanHd::where('district', $inputs['districtbc'])->where('level', 'H')->first()->diaban;
                    //dd($inputs);
                    $m_lk = GiaHhDvK::where('trangthai', 'HT')
                        ->where('matt', $inputs['mattbc'])
                        ->where('madiaban', $inputs['madiaban'])
                        ->orderby('thoidiem', 'desc')->first();
                    if ($m_lk != null) {
                        $model->soqdlk = $m_lk->soqd;
                        $model->thoidiemlk = $m_lk->thoidiemlk;
                        $a_ctlk = array_column(GiaHhDvKCt::where('mahs', $m_lk->mahs)->get()->toarray(),'gia', 'mahhdv');
                    }
                    //dd($a_ctlk);
                    $model->mahs = $inputs['madiaban'] . '_' . getdate()[0];
                    $model->matt = $inputs['mattbc'];
                    $model->madiaban = $inputs['madiaban'];
                    $model->madv = $inputs['madv'];
                    $model->trangthai  = 'CHT';
                    $model->thang = $inputs['thang'];
                    $model->nam = $inputs['nam'];

                    //kiểm tra nếu đã tạo danh mục theo đơn vị thì lấy dm ko thì lấy theo hệ thống
                    $m_dm = DmHhDvK_DonVi::where('matt', $inputs['mattbc'])->where('madv', $inputs['madv'])->orderby('mahhdv')->get();
                    if(count($m_dm) == 0){
                        $m_dm = DmHhDvK::where('matt', $inputs['mattbc'])->orderby('mahhdv')->get();
                    }

                    $a_dm = array();
                    foreach ($m_dm as $dm) {
                        $a_dm[] = [
                            'mahs' => $model->mahs,
                            'mahhdv' => $dm->mahhdv,
                            'loaigia' => 'Giá bán lẻ',
                            'nguontt' => 'Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định',
                            'gia' => isset($a_ctlk[$dm->mahhdv]) && getDoubleToDb($a_ctlk[$dm->mahhdv]) > 0 ? round(getDoubleToDb($a_ctlk[$dm->mahhdv]),0) : 0,
                            'gialk' => isset($a_ctlk[$dm->mahhdv]) && getDoubleToDb($a_ctlk[$dm->mahhdv]) > 0 ? round(getDoubleToDb($a_ctlk[$dm->mahhdv]),0) : 0,
                        ];
                        //để hàm round() để chương trình tự hiểu đó là số
                    }
                    //dd($a_dm);
                    GiaHhDvKCt::insert($a_dm);
                    $modelct = GiaHhDvKCt::where('mahs', $model->mahs)->get();
                    $a_diaban = array_column(dsdiaban::where('madiaban', $inputs['madiaban'])->get()->toarray(), 'tendiaban', 'madiaban');
                    $a_tt = array_column(NhomHhDvK::where('matt', $inputs['mattbc'])->get()->toarray(), 'tentt', 'matt');
                    $a_dm = array_column(DmHhDvK::where('matt', $inputs['mattbc'])->get()->toarray(), 'tenhhdv', 'mahhdv');
                    return view('manage.dinhgia.giahhdvk.kekhai.edit')
                        ->with('model', $model)
                        ->with('modelct', $modelct)
                        ->with('a_diaban', $a_diaban)
                        ->with('a_tt', $a_tt)
                        ->with('a_dm', $a_dm)
                        ->with('inputs', $inputs)
                        ->with('pageTitle', 'Thông tin giá hàng hóa dịch vụ thêm mới');
                }
            } else
                dd('Lỗi!Bạn cần xem lại thao tác!');

        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            //dd($inputs);
            if (isset($inputs['mattbc']) && isset($inputs['madiaban'])) {
                //xóa các chi tiết ko có hồ sơ (dữ liệu thừa do khi tạo mới thì tự thêm vào trong chi tiết mà ko cần lưu hồ sơ)
                //DB::statement("DELETE FROM giahhdvkct WHERE mahs not in (SELECT mahs FROM giahhdvk where madv='" . $inputs['madv'] . "')");

                $model = new GiaHhDvK();
                //$tennhom = NhomHhDvK::where('matt', $inputs['mattbc'])->first()->tentt;
                //$diaban = DiaBanHd::where('district', $inputs['districtbc'])->where('level', 'H')->first()->diaban;
                //dd($inputs);
                $m_lk = GiaHhDvK::where('trangthai', 'HT')
                    ->where('matt', $inputs['mattbc'])
                    ->where('madiaban', $inputs['madiaban'])
                    ->orderby('thoidiem', 'desc')->first();
                if ($m_lk != null) {
                    $model->soqdlk = $m_lk->soqd;
                    $model->thoidiemlk = $m_lk->thoidiemlk;
                    $a_ctlk = array_column(GiaHhDvKCt::where('mahs', $m_lk->mahs)->get()->toarray(), 'gia', 'mahhdv');
                }
                //dd($a_ctlk);
                $model->mahs = $inputs['madiaban'] . '_' . getdate()[0];
                $model->matt = $inputs['mattbc'];
                $model->madiaban = $inputs['madiaban'];
                $model->madv = $inputs['madv'];
                $model->trangthai = 'CHT';
                $model->thang = $inputs['thang'];
                $model->nam = $inputs['nam'];

                //kiểm tra nếu đã tạo danh mục theo đơn vị thì lấy dm ko thì lấy theo hệ thống
                $m_dm = DmHhDvK_DonVi::where('matt', $inputs['mattbc'])->where('madv', $inputs['madv'])->orderby('mahhdv')->get();
                if (count($m_dm) == 0) {
                    $m_dm = DmHhDvK::where('matt', $inputs['mattbc'])->orderby('mahhdv')->get();
                }

                $a_dm = array();
                foreach ($m_dm as $dm) {
                    $a_dm[] = [
                        'mahs' => $model->mahs,
                        'mahhdv' => $dm->mahhdv,
                        'loaigia' => 'Giá bán lẻ',
                        'nguontt' => 'Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định',
                        'gia' => isset($a_ctlk[$dm->mahhdv]) && getDoubleToDb($a_ctlk[$dm->mahhdv]) > 0 ? round(getDoubleToDb($a_ctlk[$dm->mahhdv]), 0) : 0,
                        'gialk' => isset($a_ctlk[$dm->mahhdv]) && getDoubleToDb($a_ctlk[$dm->mahhdv]) > 0 ? round(getDoubleToDb($a_ctlk[$dm->mahhdv]), 0) : 0,
                    ];
                    //để hàm round() để chương trình tự hiểu đó là số
                }
                //dd($a_dm);
                GiaHhDvKCt::insert($a_dm);
                $modelct = GiaHhDvKCt::where('mahs', $model->mahs)->get();
                $a_diaban = array_column(dsdiaban::where('madiaban', $inputs['madiaban'])->get()->toarray(), 'tendiaban', 'madiaban');
                $a_tt = array_column(NhomHhDvK::where('matt', $inputs['mattbc'])->get()->toarray(), 'tentt', 'matt');
                $a_dm = array_column(DmHhDvK::where('matt', $inputs['mattbc'])->get()->toarray(), 'tenhhdv', 'mahhdv');
                return view('manage.dinhgia.giahhdvk.kekhai.edit')
                    ->with('model', $model)
                    ->with('modelct', $modelct)
                    ->with('a_diaban', $a_diaban)
                    ->with('a_tt', $a_tt)
                    ->with('a_dm', $a_dm)
                    ->with('inputs', $inputs)
                    ->with('pageTitle', 'Thông tin giá hàng hóa dịch vụ thêm mới');

            } else
                dd('Lỗi!Bạn cần xem lại thao tác!');

        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            if(isset($inputs['ipf1'])){
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] .'&1.'.$ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giahhdvk/', $name);
                $inputs['ipf1']= $name;
            }
            //dd($inputs);
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            $inputs['thoidiemlk'] = getDateToDb($inputs['thoidiemlk']);
            $model = GiaHhDvK::where('mahs',$inputs['mahs'])->first();
            if($model == null){
                $inputs['trangthai'] = 'CHT';
                GiaHhDvK::create($inputs);
            }else{
                $model->update($inputs);
            }
            return redirect('giahhdvk/danhsach?madiaban='.$inputs['madiaban']);
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
        $model = GiaHhDvK::where('mahs',$inputs['mahs'])->first();

        $result['message'] ='<div class="modal-body" id = "dinh_kem" >';
        if (isset($model->ipf1)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 1 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/giahhdvk/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }

        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function show(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = GiaHhDvK::where('mahs',$inputs['mahs'])->first();
            $modelct = view_giahhdvk::where('mahs',$model->mahs)->orderby('mahhdv')->get();
            $a_dmhhdv = array_column(DmHhDvK::where('matt', $model->matt)->get()->toarray(),'manhom','mahhdv');
            $a_diaban = array_column(dsdiaban::where('madiaban', $model->madiaban)->get()->toarray(), 'tendiaban', 'madiaban');
            $a_tt = array_column(NhomHhDvK::where('matt', $model->matt)->get()->toarray(), 'tentt', 'matt');
            $a_dm = array_column(DmHhDvK::where('matt', $model->matt)->get()->toarray(), 'tenhhdv', 'mahhdv');
            $m_dv = dsdonvi::where('madv',$model->madv)->first();
            $a_nhomhhdv = array_column(DmNhomHangHoa::where('phanloai','GIAHHDVK')->get()->toarray(),'tennhom','manhom');
            foreach ($modelct as $ct){
                $ct->manhom = $a_dmhhdv[$ct->mahhdv] ?? '';
            }
            return view('manage.dinhgia.giahhdvk.reports.prints')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('m_dv',$m_dv)
                ->with('a_diaban', $a_diaban)
                ->with('a_nhomhhdv', $a_nhomhhdv)
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
            $inputs['url'] = '/giahhdvk';
            $model = GiaHhDvK::where('mahs', $inputs['mahs'])->first();
            $modelct = GiaHhDvKCt::where('mahs', $model->mahs)->get();
            $a_diaban = array_column(dsdiaban::where('madiaban', $model->madiaban)->get()->toarray(), 'tendiaban', 'madiaban');
            $a_tt = array_column(NhomHhDvK::where('matt', $model->matt)->get()->toarray(), 'tentt', 'matt');
            $a_dm = array_column(DmHhDvK::where('matt', $model->matt)->get()->toarray(), 'tenhhdv', 'mahhdv');
            return view('manage.dinhgia.giahhdvk.kekhai.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('a_diaban', $a_diaban)
                ->with('a_tt', $a_tt)
                ->with('a_dm', $a_dm)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin giá hàng hóa dịch vụ thêm mới');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['ngayapdung'] = getDateToDb($inputs['ngayapdung']);
            if($inputs['ngayapdunglk'] != '')
                $inputs['ngayapdunglk'] = getDateToDb($inputs['ngayapdunglk']);
            else
                unset($inputs['ngayapdunglk']);
            $model = GiaHhDvK::findOrFail($id);
            $model->update($inputs);
            return redirect('giahhdvkhac?&district='.$model->district.'&thang='.$model->thang.'&nam='.$model->nam);

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = GiaHhDvK::where('mahs',$inputs['mahs'])->first();
            GiaHhDvKCt::where('mahs',$model->mahs)->delete();
            $model->delete();
            return redirect('giahhdvk/danhsach?&madiaban='.$model->madiaban);
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
            $model = GiaHhDvK::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giahhdvk/danhsach?madiaban=' . $model->madiaban);
        } else
            return view('errors.notlogin');
    }

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giahhdvk',\session('admin')->level, \session('admin')->madiaban);

            //dd(session('admin'));
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $inputs['level'] = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first()->level ?? 'H';
            //dd($inputs);
            //gán lại thông tin về trường madv, thoidiem để truyền sang form index
            //xét macqcq để tìm đơn vị chuyển đến
            $a_ttdv = array_column(view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->get()->toarray(),
                'tendv', 'madv');
//            dd($a_ttdv);
            switch ($inputs['level']){
                case 'H':{
                    $model = GiaHhDvK::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                    $model = $model->orderby('nam')->orderby('thang')->get();
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
                    $model = GiaHhDvK::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                    $model = $model->orderby('nam')->orderby('thang')->get();
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
                    $model = GiaHhDvK::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                    $model = $model->orderby('nam')->orderby('thang')->get();
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
            $a_tt = array_column(NhomHhDvK::all()->toArray(),'tentt', 'matt');
            return view('manage.dinhgia.giahhdvk.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_tt', $a_tt)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
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
            $model = GiaHhDvK::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giahhdvk/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaHhDvK::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giahhdvk/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaHhDvK::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giahhdvk/xetduyet?madv=' . $model->madv_ad);
        } else
            return view('errors.notlogin');
    }
    //</editor-fold>

    public function timkiem(){
        if(Session::has('admin')){
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban,'giahhdvk');
            //dd($m_diaban);
            $a_dm = array_column(NhomHhDvK::all()->toArray(),'tentt','matt');
            $inputs['url'] = '/giahhdvk';
            return view('manage.dinhgia.giahhdvk.timkiem.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_dm',$a_dm)
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
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban,'giahhdvk');
            $model = view_giahhdvk::wherein('madv',array_column($m_donvi->toarray(),'madv'));
            //dd($inputs);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }
            if($inputs['madoituong'] != 'all') {
                $model = $model->where('matt', 'like', getTimkiemLike($inputs['madoituong']));
            }

            if(getDayVn($inputs['thoidiem_tu']) != ''){
                $model = $model->where('thoidiem','>=',$inputs['thoidiem_tu']);
            }

            if(getDayVn($inputs['thoidiem_den']) != ''){
                $model = $model->where('thoidiem','<=',$inputs['thoidiem_den']);
            }

            $model = $model->where('gia','>=',chkDbl($inputs['giatri_tu']));
            if(chkDbl($inputs['giatri_den']) > 0){
                $model = $model->where('gia','<=',chkDbl($inputs['giatri_den']));
            }
            //dd($model->toSql());
            $a_dm = array_column(NhomHhDvK::all()->toArray(),'tentt','matt');
            $inputs['url'] = '/giahhdvk';
            return view('manage.dinhgia.giahhdvk.timkiem.result')
                ->with('model',$model->get())
                ->with('a_dm',$a_dm)
                ->with('inputs',$inputs)
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function search(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
            $inputs['tenhhdv'] = isset($inputs['tenhhdv']) ? $inputs['tenhhdv'] : '';
            $inputs['district'] =  isset($inputs['district']) ? $inputs['district'] : '';
            $inputs['matt'] =  isset($inputs['matt']) ? $inputs['matt'] : '';
            $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : 5;

            $modeldb = DiaBanHd::where('level','H')->get();
            $modelnhomtn = NhomHhDvK::where('theodoi','TD')->get();
            $model = GiaHhDvKCt::join('giahhdvk','giahhdvk.mahs','=','giahhdvkct.mahs')
                ->join('nhomhhdvk','nhomhhdvk.matt','=','giahhdvk.matt')
                ->join('diabanhd','diabanhd.district','=','giahhdvk.district')
                ->select('giahhdvkct.*','giahhdvk.soqd','giahhdvk.ngayapdung','diabanhd.diaban',
                    'nhomhhdvk.tentt', 'giahhdvk.thang','giahhdvk.nam')
                ->whereIn('giahhdvk.trangthai',['HT','CB']);
            if($inputs['thang'] != 'all')
                $model = $model->where('giahhdvk.thang',$inputs['thang']);
            if($inputs['nam'] != 'all')
                $model = $model->where('giahhdvk.nam',$inputs['nam']);
            if($inputs['district'] != '')
                $model = $model->where('giahhdvk.district','=',$inputs['district']);
            if($inputs['matt'] != '')
                $model = $model->where('giahhdvk.matt','=',$inputs['matt']);
            if($inputs['tenhhdv'] != '')
                $model = $model->where('giahhdvkct.tenhhdv','like','%'.$inputs['tenhhdv'].'%');

            $model = $model->paginate($inputs['paginate']);

            return view('manage.dinhgia.giahhdvk.timkiem.index')
                ->with('inputs',$inputs)
                ->with('model',$model)
                ->with('modeldb',$modeldb)
                ->with('modelnhomtn',$modelnhomtn)
                ->with('pageTitle','Tìm kiếm thông tin giá hàng hóa dịch vụ khác');
        }else
            return view('errors.notlogin');
    }

    public function hoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['idhoanthanh'];
            $model = GiaHhDvK::findOrFail($id);
            $model->trangthai = 'HT';
            $model->save();
            return redirect('giahhdvkhac?&district='.$model->district.'&thang='.$model->thang.'&nam='.$model->nam);
        }else
            return view('errors.notlogin');
    }

    public function huyhoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['idhuyhoanthanh'];
            $model = GiaHhDvK::findOrFail($id);
            $model->trangthai = 'CHT';
            $model->save();
            return redirect('giahhdvkhac?&district='.$model->district.'&thang='.$model->thang.'&nam='.$model->nam);
        }else
            return view('errors.notlogin');
    }

//    public function congbo(Request $request){
//        if(Session::has('admin')){
//            $inputs = $request->all();
//            $id = $inputs['idcongbo'];
//            $model = GiaHhDvK::findOrFail($id);
//            $model->congbo = 'CB';
//            $model->save();
//            return redirect('giahhdvkhac?&district='.$model->district.'&thang='.$model->thang.'&nam='.$model->nam);
//        }else
//            return view('errors.notlogin');
//    }

    function filemau(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            //dd($inputs);
            if ($inputs['phanloai'] == 'HS') {
                $model_nhom = NhomHhDvK::where('matt', $inputs['matt'])->first();

                $modellk = GiaHhDvK::where('trangthai', 'HT')
                    ->where('matt', $inputs['matt'])
                    ->where('madiaban', $inputs['madiaban'])
                    ->orderby('thoidiem','desc')->first();
                if ($modellk != null) {
                    $model = DmHhDvK::where('matt', $inputs['matt'])->get();
                    foreach ($model as $ct) {
                        $modelctlk = GiaHhDvKCt::where('mahs', $modellk->mahs)
                            ->where('mahhdv', $ct->mahhdv)->first();
                        $ct->gialk = $modelctlk->gia ?? 0;
                        $ct->loaigia = $modelctlk->loaigia ?? '';
                        $ct->nguontt = $modelctlk->nguontt ?? '';
                    }
                    Excel::create('DMHANGHOA', function ($excel) use ($model_nhom, $model) {
                        $excel->sheet('DMHANGHOA', function ($sheet) use ($model_nhom, $model) {
                            $sheet->loadView('manage.dinhgia.giahhdvk.excel.danhmuc')
                                ->with('model_nhom', $model_nhom)
                                ->with('model', $model)
                                ->with('pageTitle', 'Danh mục hàng hóa');
                            //$sheet->setPageMargin(0.25);
                            $sheet->setAutoSize(false);
                            $sheet->setFontFamily('Tahoma');
                            $sheet->setFontBold(false);

                            //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                        });
                    })->download('xlsx');
                } else
                    goto danhmuc;
            } else {
                danhmuc:
                $model_nhom = NhomHhDvK::where('matt', $inputs['matt'])->first();
                $model = DmHhDvK::where('matt', $inputs['matt'])->get();
//                    dd($inputs);
                foreach ($model as $ct) {
                    $ct->loaigia = 'Giá bán lẻ';
                    $ct->nguontt = 'Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định';
                    $ct->gia = 0;
                    $ct->gialk = 0;
                }
//                return view('manage.dinhgia.giahhdvk.excel.danhmuc')
//                    ->with('model_nhom', $model_nhom)
//                    ->with('model', $model)
//                    ->with('pageTitle', 'Danh mục hàng hóa');

                Excel::create('DMHANGHOA', function ($excel) use ($model_nhom, $model) {
                    $excel->sheet('DMHANGHOA', function ($sheet) use ($model_nhom, $model) {
                        $sheet->loadView('manage.dinhgia.giahhdvk.excel.danhmuc')
                            ->with('model_nhom', $model_nhom)
                            ->with('model', $model)
                            ->with('pageTitle', 'Danh mục hàng hóa');
                        //$sheet->setPageMargin(0.25);
                        $sheet->setAutoSize(false);
                        $sheet->setFontFamily('Tahoma');
                        $sheet->setFontBold(false);

                        //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                    });
                })->download('xlsx');
            }

        } else
            return view('errors.notlogin');
    }

    public function nhanexcel(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $m_nhom = array_column(NhomHhDvK::where('theodoi', 'TD')
                ->get()->toarray(), 'tentt','matt');
            $m_donvi = getDonViNhapLieu(session('admin')->level, 'giahhdvk');
            return view('manage.dinhgia.giahhdvk.excel.information')
                ->with('a_dv', array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('a_nhom', $m_nhom)
                ->with('inputs',$inputs)
                ->with('pageTitle', 'Nhận dữ liệu hàng hóa từ file Excel');
        }else
            return view('errors.notlogin');
    }

    function import_excel(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            //dd($inputs);

            if (isset($inputs['mattbc']) && isset($inputs['madiaban'])) {
                $model = GiaHhDvK::where('matt', $inputs['mattbc'])
                    ->where('thang', $inputs['thang'])
                    ->where('nam', $inputs['nam'])
                    ->where('madiaban', $inputs['madiaban'])
                    ->first();
                /*
                 nếu đã có báo cáo thì mở báo cáo đã tạo ra
                 * */
                if ($model != null) {
                    return redirect('/giahhdvk/modify?mahs='.$model->mahs.'&act=false');
                    //gọi đến hàm modify
                } else {
                    //xóa các chi tiết ko có hồ sơ (dữ liệu thừa do khi tạo mới thì tự thêm vào trong chi tiết mà ko cần lưu hồ sơ)
//                    DB::statement("DELETE FROM giahhdvkct WHERE mahs not in (SELECT mahs FROM giahhdvk where madv='" . $inputs['madv'] . "')");

                    $model = new GiaHhDvK();
                    //$tennhom = NhomHhDvK::where('matt', $inputs['mattbc'])->first()->tentt;
                    //$diaban = DiaBanHd::where('district', $inputs['districtbc'])->where('level', 'H')->first()->diaban;
                    $m_lk = GiaHhDvK::where('trangthai', 'HT')
                        ->where('matt', $inputs['mattbc'])
                        ->where('madiaban', $inputs['madiaban'])
                        ->orderby('thoidiem', 'desc')->first();
                    if ($m_lk != null) {
                        $model->soqdlk = $m_lk->soqd;
                        $model->thoidiemlk = $m_lk->thoidiemlk;
                        $a_ctlk = array_column(GiaHhDvKCt::where('mahs', $m_lk->mahs)->get()->toarray(), 'mahhdv', 'gia');
                    }
                    $model->mahs = $inputs['madiaban'] . '_' . getdate()[0];
                    $model->matt = $inputs['mattbc'];
                    $model->madiaban = $inputs['madiaban'];
                    $model->madv = $inputs['madv'];
                    $model->trangthai  = 'CHT';
                    $model->thang = $inputs['thang'];
                    $model->nam = $inputs['nam'];
                    $m_dm = DmHhDvK::where('matt', $inputs['mattbc'])->get();
                    $a_dm = array();
                    foreach ($m_dm as $dm) {
                        $a_dm[] = [
                            'mahs' => $model->mahs,
                            'mahhdv' => $dm->mahhdv,
                            'loaigia' => 'Giá bán lẻ',
                            'nguontt' => 'Do cơ quan/đơn vị quản lý nhà nước có liên quan cung cấp/báo cáo theo quy định',
                            'gia' => (float)$a_ctlk[$dm->mahhdv] ?? 0,
                            'gialk' => (float)$a_ctlk[$dm->mahhdv] ?? 0,
                        ];
                    }
                    //dd($a_dm);
                    GiaHhDvKCt::insert($a_dm);
                    $modelct = GiaHhDvKCt::where('mahs', $model->mahs)->get();
                    $a_diaban = array_column(dsdiaban::where('madiaban', $inputs['madiaban'])->get()->toarray(), 'tendiaban', 'madiaban');
                    $a_tt = array_column(NhomHhDvK::where('matt', $inputs['mattbc'])->get()->toarray(), 'tentt', 'matt');
                    $a_dm = array_column(DmHhDvK::where('matt', $inputs['mattbc'])->get()->toarray(), 'tenhhdv', 'mahhdv');
                    return view('manage.dinhgia.giahhdvk.kekhai.edit')
                        ->with('model', $model)
                        ->with('modelct', $modelct)
                        ->with('a_diaban', $a_diaban)
                        ->with('a_tt', $a_tt)
                        ->with('a_dm', $a_dm)
                        ->with('inputs', $inputs)
                        ->with('pageTitle', 'Thông tin giá hàng hóa dịch vụ thêm mới');
                }
            } else
                dd('Lỗi!Bạn cần xem lại thao tác!');

            //$inputs['phanloaibc'] = $inputs['phanloai'];
            $inputs['thangbc'] = $inputs['thang'];
            $inputs['nambc'] = $inputs['nam'];
            $inputs['districtbc'] = $inputs['district'];
            $inputs['mattbc'] = $inputs['matt'];
            //dd($inputs);

            $modelkt = GiaHhDvK::where('matt',$inputs['matt'])
                ->where('thang',$inputs['thang'])
                ->where('nam',$inputs['nam'])
                ->where('district',$inputs['district'])
                //->where('phanloai',$inputs['phanloai'])
                ->count();

            if($modelkt > 0)
                dd('Báo cáo đã tồn tại, bạn cần kiểm tra lại! Nếu thay đổi thông tin bạn cần xóa báo cáo và nhận lại file');
            else {
                $filename = $inputs['district'] . '_' . getdate()[0];
                $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
                $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
                $data = [];

                Excel::load($path, function ($reader) use (&$data, $inputs) {
                    $obj = $reader->getExcel();
                    $sheet = $obj->getSheet(0);
                    $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
                });
                //dd($data);
                $modeldel = GiaHhDvKCt::where('district', $inputs['district'])->where('trangthai', 'CXD')->delete();
                $inputs['mahs'] = $inputs['districtbc'].getdate()[0];
                for ($i = $inputs['tudong']; $i < ($inputs['tudong'] + $inputs['sodong']); $i++) {
                    //dd($data[$i]);
                    if (!isset($data[$i][$inputs['mahhdv']]) || $data[$i][$inputs['tenhhdv']] == '') {
                        continue;//Tên cán bộ rỗng => thoát
                    }
                    $modelctnew = new GiaHhDvKCt();
                    $modelctnew->mahs = $inputs['mahs'];
                    $modelctnew->district = $inputs['district'];
//                    $modelctnew->matt = $inputs['matt'];
                    $modelctnew->trangthai = 'CXD';
                    $modelctnew->manhom = $data[$i][$inputs['manhom']];
                    $modelctnew->nhom = $data[$i][$inputs['nhom']];
                    $modelctnew->mahhdv = $data[$i][$inputs['mahhdv']];
                    $modelctnew->tenhhdv = $data[$i][$inputs['tenhhdv']];
                    $modelctnew->dacdiemkt = $data[$i][$inputs['dacdiemkt']];
                    $modelctnew->dvt = $data[$i][$inputs['dvt']];
                    $modelctnew->loaigia = $data[$i][$inputs['loaigia']];
                    $modelctnew->gia = $data[$i][$inputs['gia']];
                    $modelctnew->gialk = $data[$i][$inputs['gialk']];
                    $modelctnew->nguontt = $data[$i][$inputs['nguontt']];
                    $modelctnew->ghichu = $data[$i][$inputs['ghichu']];
                    $modelctnew->save();
                }
                File::Delete($path);
                $tennhom = NhomHhDvK::where('matt', $inputs['matt'])->first()->tentt;
                $diaban = DiaBanHd::where('district', $inputs['district'])->where('level', 'H')->first()->diaban;
                $modelidlk = GiaHhDvK::where('trangthai', 'HT')
                    ->where('matt', $inputs['matt'])
                    ->where('district', $inputs['district'])
                    ->max('id');
                if ($modelidlk != null) {
                    $modellk = GiaHhDvK::where('id',$modelidlk)
                        ->first();
                    $inputs['soqdlk'] = $modellk->soqd;
                    $inputs['ngayapdunglk'] = $modellk->ngayapdung;
                }
                $modelct = GiaHhDvKCt::where('mahs', $inputs['mahs'])
                   ->get();
                return view('manage.dinhgia.giahhdvk.kekhai.create')
                    ->with('diaban', $diaban)
                    ->with('tennhom', $tennhom)
                    ->with('modelct', $modelct)
                    ->with('inputs',$inputs)
                    ->with('pageTitle', 'Kê khai giá hàng hóa dịch vụ thêm mới');
            }
        }else
            return view('errors.notlogin');
    }
}
