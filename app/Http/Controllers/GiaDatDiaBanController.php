<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\DmGiaRung;
use App\GiaDatDiaBan;
use App\GiaDatDiaBanDm;
use App\Model\manage\dinhgia\giadatdiaban\TtGiaDatDiaBan;
use App\Model\manage\dinhgia\GiaRung;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use App\Model\system\dsxaphuong;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class GiaDatDiaBanController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giacldat';
            //lấy địa bàn
            //$a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $a_diaban = getDiaBan_XaHuyen(session('admin')->level,session('admin')->madiaban);
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            //$m_donvi_th = getDonViTongHop('giacldat',\session('admin')->level, \session('admin')->madiaban);
            $m_donvi_th = getDonViTongHop('giacldat',\session('admin')->level, \session('admin')->madiaban);
            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            $inputs['madv'] = $m_donvi->first()->madv;

            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $inputs['maxp'] = $inputs['maxp'] ?? 'all';
            $inputs['maloaidat'] = $inputs['maloaidat'] ?? 'all';
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            $a_xp = array_column(dsxaphuong::where('madiaban',$inputs['madiaban'])->get()->toarray(),'tenxp', 'maxp');
            $a_qd = array_column(TtGiaDatDiaBan::all()->toarray(),'mota', 'soqd');
            //lấy thông tin đơn vị
            $model = GiaDatDiaBan::where('madiaban', $inputs['madiaban']);
            if ($inputs['nam'] != 'all')
                $model = $model->where('nam', $inputs['nam']);
            if ($inputs['maxp'] != 'all')
                $model = $model->where('maxp', $inputs['maxp']);
            if ($inputs['maloaidat'] != 'all')
                $model = $model->where('maloaidat', $inputs['maloaidat']);
            //dd($inputs);
            return view('manage.dinhgia.giadatdiaban.kekhai.index')
                ->with('model', $model->get())
                ->with('inputs', $inputs)
                //->with('m_diaban', $m_diaban)
                ->with('a_diaban', $a_diaban)
                ->with('a_loaidat', $a_loaidat)
                ->with('a_xp', $a_xp)
                ->with('a_qd', $a_qd)
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th',array_column($m_donvi_th->toarray(),'tendv','madv'))
                ->with('a_diaban_th',array_column($m_donvi_th->toarray(),'tendiaban','madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ giá đất');
        } else
            return view('errors.notlogin');
    }

    public function nhandulieutuexcel(){
        if (Session::has('admin')) {
            $districts =DiaBanHd::where('level','H')
                ->get();
            $loaidats = GiaDatDiaBanDm::all();
            return view('manage.dinhgia.giadatdiaban.importexcel')
                ->with('districts',$districts)
                ->with('loaidats',$loaidats)
                ->with('pageTitle','Nhận dữ liệu giá đất trên địa bàn file Excel');

        } else
            return view('errors.notlogin');
    }

    public function importexcel(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
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

                $modelctnew = new GiaDatDiaBan();
                $modelctnew->nam = $inputs['nam'];
                $modelctnew->district = $inputs['district'];
                $modelctnew->maloaidat = $inputs['maloaidat'];
                $modelctnew->khuvuc = $data[$i][$inputs['khuvuc']];
                $modelctnew->mota = $data[$i][$inputs['mota']];
                $modelctnew->mdsd = $data[$i][$inputs['mdsd']];
                $modelctnew->giavt1 = (isset($data[$i][$inputs['giavt1']]) && $data[$i][$inputs['giavt1']] != '' ? chkDbl($data[$i][$inputs['giavt1']]) : 0);
                $modelctnew->giavt2 = (isset($data[$i][$inputs['giavt2']]) && $data[$i][$inputs['giavt2']] != '' ? chkDbl($data[$i][$inputs['giavt2']]) : 0);
                $modelctnew->giavt3 = (isset($data[$i][$inputs['giavt3']]) && $data[$i][$inputs['giavt3']] != '' ? chkDbl($data[$i][$inputs['giavt3']]) : 0);
                $modelctnew->giavt4 = (isset($data[$i][$inputs['giavt4']]) && $data[$i][$inputs['giavt4']] != '' ? chkDbl($data[$i][$inputs['giavt4']]) : 0);
                $modelctnew->giavt5 = (isset($data[$i][$inputs['giavt5']]) && $data[$i][$inputs['giavt5']] != '' ? chkDbl($data[$i][$inputs['giavt5']]) : 0);
                $modelctnew->hesok = (isset($data[$i][$inputs['hesok']]) && $data[$i][$inputs['hesok']] != '' ? chkDbl($data[$i][$inputs['hesok']]) : 1);
                $modelctnew->soqd = $inputs['soqd'];
                //$modelctnew->username = session('admin')->name.'('.session('admin')->username.')' ;
                $modelctnew->thaotac = 'Import';
                $modelctnew->trangthai = 'CHT';
                $modelctnew->save();
            }
            File::Delete($path);
            return redirect('giadatdiaban?&nam='.$inputs['nam'].'&district='.$inputs['district'].'&maloaidat='.$inputs['maloaidat']);
        }else
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
            $model = GiaDatDiaBan::where('maso',$inputs['mahs'])->first();
            $model->delete();

            return redirect('giacldat/danhsach?&nam='.$model->nam.'&madiaban='.$model->madiaban);
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = GiaDatDiaBan::where('maso',$inputs['maso'])->first();
        die($model);
    }

    public function store(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $inputs['giavt1'] = chkDbl($inputs['giavt1']);
            $inputs['giavt2'] = chkDbl($inputs['giavt2']);
            $inputs['giavt3'] = chkDbl($inputs['giavt3']);
            $inputs['giavt4'] = chkDbl($inputs['giavt4']);
            $inputs['hesok'] = chkDbl($inputs['hesok']);

            $model = GiaDatDiaBan::where('maso',$inputs['maso'])->first();
            if($model == null){
                $inputs['trangthai'] = 'CHT';
                $inputs['maso'] = getdate()[0];
                GiaDatDiaBan::create($inputs);
            }else{
                $model->update($inputs);
            }

            return redirect('/giacldat/danhsach?&nam='.$inputs['nam'].'&madiaban='.$inputs['madiaban']);
        }else
            return view('errors.notlogin');
    }

    public function congbo(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $id = $inputs['congbo_id'];
            $model = GiaDatDiaBan::findOrFail($id);
            $model->trangthai = 'CB';
            $model->save();

            return redirect('giadatdiaban?&nam='.$model->nam.'&district='.$model->district.'&maloaidat='.$model->maloaidat);
        }else
            return view('errors.notlogin');
    }

    public function huycongbo(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $id = $inputs['huycongbo_id'];
            $model = GiaDatDiaBan::findOrFail($id);
            $model->trangthai = 'HT';
            $model->save();

            return redirect('giadatdiaban?&nam='.$model->nam.'&district='.$model->district.'&maloaidat='.$model->maloaidat);
        }else
            return view('errors.notlogin');
    }
    public function hoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $id = $inputs['hoanthanh_id'];
            $model = GiaDatDiaBan::findOrFail($id);
            $model->trangthai = 'HT';
            $model->save();

            return redirect('giadatdiaban?&nam='.$model->nam.'&district='.$model->district.'&maloaidat='.$model->maloaidat);
        }else
            return view('errors.notlogin');
    }

    public function huyhoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $id = $inputs['huyhoanthanh_id'];
            $model = GiaDatDiaBan::findOrFail($id);
            $model->trangthai = 'CHT';
            $model->save();

            return redirect('giadatdiaban?&nam='.$model->nam.'&district='.$model->district.'&maloaidat='.$model->maloaidat);
        }else
            return view('errors.notlogin');
    }

    function checkmulti(Request $request){
        if(Session::has('admin')){
            $inputs=$request->all();
            $model = GiaDatDiaBan::where('district',$inputs['districtcheck'])
                ->where('nam',$inputs['namcheck']);
            if($inputs['maloaidatcheck'] != 'All')
                $model = $model->where('maloaidat',$inputs['maloaidatcheck']);

            $model = $model->update(['trangthai' => $inputs['trangthaicheck']]);

            return redirect('giadatdiaban?&nam='.$inputs['namcheck'].'&district='.$inputs['districtcheck'].'&maloaidat='.$inputs['maloaidatcheck']);
        }else
            return view('errors.notlogin');
    }

    function bcgiadatdiaban(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['district'] = isset($inputs['district']) ? $inputs['district'] : 'All';
            $inputs['maloaidat'] = isset($inputs['maloaidat']) ? $inputs['maloaidat'] : 'All';
            $inputs['khuvuc'] = isset($inputs['khuvuc']) ? $inputs['khuvuc'] : '';
            $inputs['mota'] = isset($inputs['mota']) ? $inputs['mota'] : '';
            $loaidats = GiaDatDiaBanDm::all();
            $diaban = DiaBanHd::all();

            $model  = GiaDatDiaBan::join('diabanhd','diabanhd.district','=','giadatdiaban.district')
                ->join('giadatdiabandm','giadatdiaban.maloaidat','=','giadatdiabandm.maloaidat')
                ->select('giadatdiaban.*','diabanhd.diaban','giadatdiabandm.loaidat');
            if($inputs['nam'] != 'all')
                $model = $model->where('giadatdiaban.nam',$inputs['nam']);
            if($inputs['district'] !='All') {
                $model = $model->where('giadatdiaban.district', $inputs['district']);
                $diaban = DiaBanHd::where('district',$inputs['district'])
                    ->where('level','H')
                    ->first();
            }
            if($inputs['maloaidat'] != 'All') {
                $model = $model->where('giadatdiaban.maloaidat', $inputs['maloaidat']);
                $loaidats = GiaDatDiaBanDm::where('maloaidat',$inputs['maloaidat'])
                    ->first();
            }
            if($inputs['khuvuc'] != '')
                $model = $model->where('giadatdiaban.khuvuc','like', '%'.$inputs['khuvuc'].'%');
            if($inputs['mota'] != '')
                $model = $model->where('giadatdiaban.mota','like', '%'.$inputs['mota'].'%');
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
            return view('manage.dinhgia.giadatdiaban.reports.BcGiaDatDiaBan')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('loaidats',$loaidats)
                ->with('diaban',$diaban)
                ->with('pageTitle','Báo cáo giá đất theo địa bàn');

        } else
            return view('errors.notlogin');
    }
}
