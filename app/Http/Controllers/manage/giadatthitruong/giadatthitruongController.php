<?php

namespace App\Http\Controllers\manage\giadatthitruong;


use App\Model\manage\dinhgia\giadatthitruong\giadatthitruong;
use App\Model\manage\dinhgia\giadatthitruong\giadatthitruongct;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\dsxaphuong;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giadatdaugia;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class giadatthitruongController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadatthitruong';
            //lấy địa bàn
            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giadatthitruong',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            $inputs['madv'] = $m_donvi->first()->madv;

            $inputs['nam'] = $inputs['nam'] ?? 'all';

            //lấy thông tin đơn vị
            $model = giadatthitruong::where('madiaban', $inputs['madiaban']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereyear('thoidiem', $inputs['nam']);


            //dd($inputs);
            return view('manage.dinhgia.giadatthitruong.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                //->with('m_diaban', $m_diaban)
                ->with('a_diaban', $a_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle','Thông tin hồ sơ đấu giá đất');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadatthitruong';
            $model = new giadatthitruong();
            $model->madiaban = $inputs['madiaban'];
            $model->madv = $inputs['madv'];
            $model->mahs = getdate()[0];
            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
            $a_xp = array_column(dsxaphuong::where('madiaban',$inputs['madiaban'])->get()->toarray(),'tenxp', 'maxp');
            return view('manage.dinhgia.giadatthitruong.kekhai.edit')
                ->with('model', $model)
                ->with('model_ct', nullValue())
                ->with('a_xp', $a_xp)
                ->with('a_diaban', $a_diaban)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin hồ sơ đấu giá đất thêm mới');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = giadatthitruong::where('mahs',$inputs['mahs'])->first();
            if($model == null){
                $inputs['trangthai'] = 'CHT';
                giadatthitruong::create($inputs);
            }else{
                $model->update($inputs);
            }

            return redirect('giadatthitruong/danhsach');
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['url'] = '/giadatthitruong';
            $model = giadatthitruong::where('mahs',$inputs['mahs'])->first();
            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
            $a_xp = array_column(dsxaphuong::where('madiaban',$model->madiaban)->get()->toarray(),'tenxp', 'maxp');
            $model_ct = giadatthitruongct::where('mahs',$inputs['mahs'])->get();
            return view('manage.dinhgia.giadatthitruong.kekhai.edit')
                ->with('model',$model)
                ->with('model_ct', $model_ct)
                ->with('a_xp', $a_xp)
                ->with('a_diaban', $a_diaban)
                ->with('inputs', $inputs)
                ->with('pageTitle','Thông tin hồ sơ đấu giá đất thêm mới');
        }else
            return view('errors.notlogin');
    }

    public function show($id){
        if(Session::has('admin')){
            $model = giadatthitruong::findOrFail($id);
            $modelct = giadatthitruongct::where('mahs',$model->mahs)
                ->get();
            $modeldb = DiaBanHd::where('level','H')
                ->where('district',$model->mahuyen)
                ->first();
            $modelxa = DiaBanHd::where('level','X')
                ->where('town',$model->maxa)
                ->first();

            if(session('admin')->level == 'T'){
                $inputs['dvcaptren'] = getGeneralConfigs()['tendvcqhienthi'];
                $inputs['dv'] = getGeneralConfigs()['tendvhienthi'];
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            }elseif(session('admin')->level == 'H'){
                $modeldv = District::where('mahuyen',session('admin')->mahuyen)->first();
                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                $inputs['dv'] = $modeldv->tendvhienthi;
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            }else{
                $modeldv = Town::where('maxa',session('admin')->maxa)
                    ->where('mahuyen',session('admin')->mahuyen)->first();
                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                $inputs['dv'] = $modeldv->tendvhienthi;
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            }
            return view('manage.dinhgia.giadatthitruong.kekhai.show')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('modeldb',$modeldb)
                ->with('modelxa',$modelxa)
                ->with('inputs',$inputs)
                ->with('pageTitle','Hồ sơ đấu giá đất');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = giadatthitruong::where('mahs',$inputs['mahs'])->first();
            giadatthitruongct::where('mahs',$inputs['mahs'])->delete();
            $model->delete();
            return redirect('giadatthitruong/danhsach');
        }else
            return view('errors.notlogin');
    }

    public function search(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['vitridiadiem'] = isset($inputs['vitridiadiem']) ? $inputs['vitridiadiem'] : '';
            $model = DauGiaDatCt::join('daugiadat','daugiadat.mahs','=','daugiadatct.mahs')
                ->select('daugiadatct.*','daugiadat.soqd','daugiadat.donvi','daugiadat.trangthai','daugiadat.thdaugia','daugiadat.created_at','daugiadat.diadiem')
                ->whereIn('daugiadat.trangthai',['HT','CB']);

            if($inputs['nam'] != '')
                $model = $model->whereYear('daugiadat.created_at',$inputs['nam']);
            if($inputs['vitridiadiem'] != '')
                $model = $model->where('daugiadatct.vitridiadiem','like','%'.$inputs['vitridiadiem'].'%');
            $model = $model->get();



            return view('manage.dinhgia.giadatthitruong.timkiem.index')
                ->with('inputs',$inputs)
                ->with('model',$model)
                ->with('pageTitle','Tìm kiếm thông tin đấu giá đất');
        }else
            return view('errors.notlogin');
    }

    public function ketxuat_cu(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['tenduan'] = isset($inputs['tenduan']) ? $inputs['tenduan'] : '';
            $inputs['mahuyen'] = isset($inputs['mahuyen']) ? $inputs['mahuyen'] : 'all';
            $inputs['maxa'] = isset($inputs['maxa']) ? $inputs['maxa'] : 'all';
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $huyens = DiaBanHd::where('level','H')
                ->get();
            $model = new DauGiaDat();
            if($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem',$inputs['nam']);
            if($inputs['mahuyen'] != 'all') {
                $model = $model->where('mahuyen', $inputs['mahuyen']);
            }
            if($inputs['maxa'] != 'all')
                $model = $model->where('maxa', $inputs['maxa']);
            if($inputs['tenduan'] != '')
                $model = $model->where('tenduan','like', '%'.$inputs['tenduan'].'%');
            $model = $model->get();
            $array = '';
            foreach($model as $tt){
                $tenxa = DiaBanHd::where('level','X')
                    ->where('town',$tt->maxa)
                    ->first();
                $tt->tenxa = $tenxa->diaban;
                $array = $array.$tt->mahs.',';
            }
            $modelct = giadatthitruongCt::whereIn('mahs',explode(',',$array))
                ->get();

            if(session('admin')->level == 'T'){
                $inputs['dvcaptren'] = getGeneralConfigs()['tendvcqhienthi'];
                $inputs['dv'] = getGeneralConfigs()['tendvhienthi'];
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            }elseif(session('admin')->level == 'H'){
                $modeldv = District::where('mahuyen',session('admin')->mahuyen)->first();
                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                $inputs['dv'] = $modeldv->tendvhienthi;
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            }else{
                $modeldv = Town::where('maxa',session('admin')->maxa)
                    ->where('mahuyen',session('admin')->mahuyen)->first();
                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                $inputs['dv'] = $modeldv->tendvhienthi;
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            }
            return view('manage.dinhgia.giadatthitruong.reports.print')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('inputs',$inputs)
                ->with('huyens',$huyens)
                ->with('pageTitle','Thông tin hồ sơ đấu giá đất');
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
            $model = giadatthitruong::where('mahs', $inputs['mahs'])->first();
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
            return redirect('/giadatthitruong/danhsach?madiaban=' . $model->madiaban);
        } else
            return view('errors.notlogin');
    }

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadatthitruong';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giadatthitruong',\session('admin')->level, \session('admin')->madiaban);
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
                    $model = giadatthitruong::where('madv_h', $inputs['madv']);
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
                    $model = giadatthitruong::where('madv_t', $inputs['madv']);
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
                    $model = giadatthitruong::where('madv_ad', $inputs['madv']);
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
            return view('manage.dinhgia.giadatthitruong.xetduyet.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
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
            $model = giadatthitruong::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadatthitruong/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giadatthitruong::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadatthitruong/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = giadatthitruong::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadatthitruong/xetduyet?madv=' . $model->madv_ad);
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
            $m_diaban = dsdiaban::wherein('madiaban',array_column($model->toarray(),'madiaban'))->get();
            //$a_dm = array_column(DmPhiLePhi::all()->toArray(),'tennhom','manhom');
            return view('manage.dinhgia.giadatthitruong.reports.baocao')
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('m_diaban',$m_diaban)
                //->with('a_dm',$a_dm)
                //->with('a_pl',getPhanLoaiSPDVCI())
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ');
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
                $model = view_giadatdaugia::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_h', $inputs['nam']);
                break;
            }
            case 'T':
            {
                $model = view_giadatdaugia::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_t', $inputs['nam']);
                break;
            }
            case 'ADMIN':
            {
                $model = view_giadatdaugia::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem_ad', $inputs['nam']);
                break;
            }
            default:
            {//mặc định lấy đơn vị nhâp liệu
                $model = view_giadatdaugia::where('madv', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->whereYear('thoidiem', $inputs['nam']);
                break;
            }
        }
        return $model->get();
    }

    public function timkiem(){
        if(Session::has('admin')){
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            //dd($m_diaban);
            //$a_dm = array_column(DmPhiLePhi::all()->toArray(),'tennhom','manhom');
            return view('manage.dinhgia.giadatthitruong.timkiem.index')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                //->with('a_dm',$a_dm)
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
            $model = view_giadatdaugia::wherein('madv',array_column($m_donvi->toarray(),'madv'));
            //dd($inputs);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }
            if($inputs['tenduan'] != '') {
                $model = $model->where('tenduan', 'like' , getTimkiemLike($inputs['tenduan']));
            }

            if(getDayVn($inputs['thoidiem_tu']) != ''){
                $model = $model->where('thoidiem','>=',$inputs['thoidiem_tu']);
            }

            if(getDayVn($inputs['thoidiem_den']) != ''){
                $model = $model->where('thoidiem','<=',$inputs['thoidiem_den']);
            }

            $model = $model->where('giakhoidiem','>=',chkDbl($inputs['giakhoidiem_tu']));
            if(chkDbl($inputs['giakhoidiem_den']) > 0){
                $model = $model->where('giakhoidiem','<=',chkDbl($inputs['giakhoidiem_den']));
            }

            $model = $model->where('giadaugia','>=',chkDbl($inputs['giadaugia_tu']));
            if(chkDbl($inputs['giadaugia_den']) > 0){
                $model = $model->where('giakhoidiem','<=',chkDbl($inputs['giadaugia_den']));
            }
            //dd($model);

            return view('manage.dinhgia.giadatthitruong.timkiem.result')
                ->with('model',$model->get())
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))

                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }
}
