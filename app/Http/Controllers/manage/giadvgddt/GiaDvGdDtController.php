<?php

namespace App\Http\Controllers\manage\giadvgddt;

use App\DiaBanHd;
use App\District;
use App\Model\manage\dinhgia\GiaDvGdDt;
use App\Model\manage\dinhgia\GiaDvGdDtCt;
use App\Model\manage\dinhgia\giadvgddtdm;
use App\Model\manage\dinhgia\giaspdvci\trogiatrocuoc;
use App\Model\manage\dinhgia\giaspdvci\trogiatrocuocdm;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Model\view\view_giadvgddt;
use App\Model\view\view_giaspdvci;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class GiaDvGdDtController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadvgddt';
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giadvgddt',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $model = GiaDvGdDt::where('madv', $inputs['madv']);
            if($inputs['nam'] != 'all')
                $model = $model->where('nam',$inputs['nam']);
            $a_dm = array_column(giadvgddtdm::all()->toArray(), 'maspdv', 'tenspdv');
            return view('manage.dinhgia.giadvgddt.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->where('level', 'H')->toarray(), 'tendiaban', 'madiaban'))
                ->with('a_dm', $a_dm)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }

    //Tự động thêm mới hồ sơ với các thông tin mặc định sau đó chuyển đến form 'Chỉnh sửa'
    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();

            $model = new GiaDvGdDt();
            $model->mahs = getdate()[0];
            $model->madiaban = view_dsdiaban_donvi::where('madv',$inputs['madv'])->first()->madiaban ?? null;
            $model->madv = $inputs['madv'];
            $model->trangthai = 'CHT';
            $model->thoidiem = date('Y-m-d');

            $a_lichsu[$model->mahs] = [
                'username' => session('admin')->username,
                'hanhdong' => 'ADD',
                'mota' => 'Thêm mới hồ sơ',
                'thoigian' => $model->thoidiem,
            ];

            $model->lichsu = json_encode($a_lichsu);

            $m_danhmuc = giadvgddtdm::all();
            $a_dm = array();
            foreach ($m_danhmuc as $dm) {
                $a_dm[] = array(
                    'maspdv' => $dm->maspdv,
                    'giadv' => '0',
                    'mahs' => $model->mahs,
                );
            }

            if(GiaDvGdDtCt::insert($a_dm)){
                $model->save();
            }
            return redirect('/giadvgddt/modify?mahs='.$model->mahs.'&act=true&addnew=true');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        //kiểm tra đơn vị (madv) cấp H=> chỉ load danh mục H; T => load toàn Tỉnh
        if(Session::has('admin')){
            $inputs = $request->all();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $model = GiaDvGdDt::where('mahs',$inputs['mahs'])->first();
            $modelct = GiaDvGdDtCt::where('mahs',$model->mahs)->get();
            $inputs['url'] = '/giadvgddt';
            $a_dm = array_column(giadvgddtdm::all()->toArray(),'tenspdv','maspdv');
            return view('manage.dinhgia.giadvgddt.kekhai.edit')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('m_diaban',$m_diaban)
                ->with('a_diaban',array_column($m_diaban->wherein('level',['H','T','X'])->toarray(),'tendiaban', 'madiaban'))
                ->with('m_donvi',$m_donvi)
                ->with('a_dm',$a_dm)
                ->with('inputs',$inputs)
                ->with('pageTitle','Chi tiết hồ sơ');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDvGdDt::where('mahs', $inputs['mahs'])->first();
            $model->update($inputs);
            return redirect('giadvgddt/danhsach?&nam=' . $model->nam . '&madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = GiaDvGdDt::where('mahs',$inputs['mahs'])->first();
            $model->delete();
            return redirect('giadvgddt/danhsach?madv=' . $model->madv);
        }else
            return view('errors.notlogin');
    }

    public function nhandulieutuexcel(){
        if (Session::has('admin')) {
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->wherein('level',['H','T','X'])->get();
            return view('manage.dinhgia.giadvgddt.importexcel')
                ->with('m_diaban',$m_diaban)
                ->with('pageTitle','Nhận dữ liệu giá dịch vụ giáo dục đào tạo từ file Excel');

        } else
            return view('errors.notlogin');
    }

    //chức năng chưa hoàn thiện do chia thành: hồ sơ - chi tiết hồ sơ
    public function importexcel(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $filename = $inputs['nam'] . '_' . getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];


            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });

            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {

                $modelctnew = new GiaDvGdDt();
                $modelctnew->nam = $inputs['nam'];
                $modelctnew->district = $inputs['district'];
                $modelctnew->khuvuc = $data[$i][$inputs['khuvuc']];
                $modelctnew->mota = $data[$i][$inputs['mota']];
                $modelctnew->dongia = (isset($data[$i][$inputs['dongia']]) && $data[$i][$inputs['dongia']] != '' ? chkDbl($data[$i][$inputs['dongia']]) : 0);
                $modelctnew->ttqd = $data[$i][$inputs['ttqd']];
                $modelctnew->ghichu = $data[$i][$inputs['ghichu']];
                //$modelctnew->username = session('admin')->name.'('.session('admin')->username.')' ;
                $modelctnew->thaotac = 'Import';
                $modelctnew->trangthai = 'CHT';
                $modelctnew->save();
            }
            File::Delete($path);
            return redirect('giadvgddt?&nam='.$inputs['nam']);
        }else
            return view('errors.notlogin');
    }

    public function BcGiaDvGdDt(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : (date('Y').'-'.(date('Y')+1));
            $inputs['district'] = isset($inputs['district']) ? $inputs['district'] : 'All';
            $inputs['khuvuc'] = isset($inputs['khuvuc']) ? $inputs['khuvuc'] : '';
            $inputs['mota'] = isset($inputs['mota']) ? $inputs['mota'] : '';
            $diabans = DiaBanHd::where('level','H')
                ->get();
            $model = GiaDvGdDt::join('diabanhd','diabanhd.district','=','giadvgddt.district')
                ->where('diabanhd.level','H')
                ->select('giadvgddt.*','diabanhd.diaban');
            if($inputs['nam'] != 'all')
                $model = $model->where('giadvgddt.nam',$inputs['nam']);
            if($inputs['district'] != 'All') {
                $model = $model->where('giadvgddt.district', $inputs['district']);
                $diabans = DiaBanHd::where('level','H')
                    ->where('district',$inputs['district'])
                    ->first();
            }
            if($inputs['khuvuc'] != '')
                $model = $model->where('giadvgddt.khuvuc','like', '%'.$inputs['khuvuc'].'%');
            if($inputs['mota'] != '')
                $model = $model->where('giadvgddt.mota','like', '%'.$inputs['mota'].'%');

            $model = $model->get();

            if(session('admin')->level == 'T'){
                $inputs['dvcaptren'] = '';
                $inputs['dv'] = getGeneralConfigs()['tendonvi'];
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
            return view('manage.dinhgia.giadvgddt.reports.BcGiaDvGdDt')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('diabans',$diabans)
                ->with('pageTitle', 'Giá dịch vụ giáo dục đào tạo');
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
            $model = GiaDvGdDt::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadvgddt/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    //<editor-fold des="Chức năng xét duyệt">
    public function xetduyet(Request $request)
    {
        //lấy thông tin đơn vị đễ lấy level
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giadvgddt';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();

            $m_donvi = getDonViXetDuyet(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giadvgddt',\session('admin')->level, \session('admin')->madiaban);
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
                    $model = GiaDvGdDt::where('madv_h', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->where('nam', $inputs['nam']);
                    $model = $model->get();
                    //dd($model);
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
                    $model = GiaDvGdDt::where('madv_t', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->where('nam', $inputs['nam']);
                    $model = $model->get();
                    //dd($model);
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
                    $model = GiaDvGdDt::where('madv_ad', $inputs['madv']);
                    if ($inputs['nam'] != 'all')
                        $model = $model->where('nam', $inputs['nam']);
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
            return view('manage.dinhgia.giadvgddt.xetduyet.index')
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
            $model = GiaDvGdDt::where('mahs', $inputs['mahs'])->first();
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
            //dd($model);
            $model->save();
            return redirect('giadvgddt/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request){
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDvGdDt::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadvgddt/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaDvGdDt::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giadvgddt/xetduyet?madv=' . $model->madv_ad);
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
            $model_ct = view_giadvgddt::wherein('mahs',array_column($model->toarray(),'mahs'))->get();
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            $m_diaban = dsdiaban::wherein('madiaban',array_column($model->toarray(),'madiaban'))->get();
            $a_ts = array_column(giadvgddtdm::all()->toArray(),'tenspdv','maspdv');

            return view('manage.dinhgia.giadvgddt.reports.baocao')
                ->with('model',$model)
                ->with('model_ct',$model_ct)
                ->with('m_donvi',$m_donvi)
                ->with('m_diaban',$m_diaban)
                ->with('a_dm',$a_ts)
                ->with('a_diaban',getDiaBan_HeThong('ADMIN'))
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
                $model = GiaDvGdDt::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                break;
            }
            case 'T':
            {
                $model = GiaDvGdDt::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                break;
            }
            case 'ADMIN':
            {
                $model = GiaDvGdDt::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                break;
            }
            default:
            {//mặc định lấy đơn vị nhâp liệu
                $model = GiaDvGdDt::where('madv', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                break;
            }
        }
        return $model->get();
    }

    function getHoSo_ct($inputs)
    {
        $m_donvi = view_dsdiaban_donvi::where('madv', $inputs['madv'])->first();
        $inputs['level'] = $m_donvi->chucnang != 'NHAPLIEU' ? $m_donvi->level : 'NHAPLIEU';
        switch ($inputs['level']) {
            case 'H':
            {
                $model = view_giadvgddt::where('madv_h', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                break;
            }
            case 'T':
            {
                $model = view_giadvgddt::where('madv_t', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                break;
            }
            case 'ADMIN':
            {
                $model = view_giadvgddt::where('madv_ad', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
                break;
            }
            default:
            {//mặc định lấy đơn vị nhâp liệu
                $model = view_giadvgddt::where('madv', $inputs['madv']);
                if ($inputs['nam'] != 'all')
                    $model = $model->where('nam', $inputs['nam']);
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
            $a_dm = array_column(giadvgddtdm::all()->toArray(),'tenspdv','maspdv');
            return view('manage.dinhgia.giadvgddt.timkiem.index')
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
            $m_donvi = getDonViTimKiem(session('admin')->level, \session('admin')->madiaban);
            $model = view_giadvgddt::wherein('madv',array_column($m_donvi->toarray(),'madv'))->get();
            //dd($inputs);

            if($inputs['madv'] != 'all'){
                $model = $model->where('madv',$inputs['madv']);
            }
            if($inputs['maspdv'] != 'all') {
                $model = $model->where('maspdv', $inputs['maspdv']);
            }

            if($inputs['nam'] != 'all'){
                $model = $model->where('nam',$inputs['nam']);
            }

            $model = $model->where('giadv','>=',chkDbl($inputs['giatri_tu']));
            if(chkDbl($inputs['giatri_den']) > 0){
                $model = $model->where('giadv','<=',chkDbl($inputs['giatri_den']));
            }
            //dd($model);
            $a_dm = array_column(giadvgddtdm::all()->toArray(),'tenspdv','maspdv');
            return view('manage.dinhgia.giadvgddt.timkiem.result')
                ->with('model',$model)
                ->with('a_diaban',array_column($m_donvi->toarray(),'tendiaban','madiaban'))
                ->with('a_donvi',array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('a_dm',$a_dm)
                ->with('pageTitle','Tìm kiếm thông tin hồ sơ');
        }else
            return view('errors.notlogin');
    }
}
