<?php

namespace App\Http\Controllers\manage\giadatphanloai;

use App\DiaBanHd;
use App\District;
use App\GiaDatDiaBanDm;
use App\Model\manage\dinhgia\giadatphanloai\GiaDatPhanLoai;
use App\Model\manage\dinhgia\giadatphanloai\GiaDatPhanLoaiDm;
use App\Model\system\dmdvt;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\view_dsdiaban_donvi;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GiaDatPhanLoaiController extends Controller
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
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            //dd($m_diaban);
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            //dd($a_dvt);
            return view('manage.dinhgia.giadatphanloai.kekhai.create')
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_loaidat',$a_loaidat)
                ->with('a_dvt', $a_dvt)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ giá đất');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $chk_dvt = dmdvt::where('dvt', $inputs['dvt'])->get();
            if (count($chk_dvt) == 0) {
                dmdvt::insert(['dvt' => $inputs['dvt']]);
            }
            $inputs['mahs'] = getdate()[0];

            //lichsu
            $a_lichsu[$inputs['mahs']] = [
                'username' => session('admin')->username,
                'hanhdong' => 'ADD',
                'mota' => 'Thêm mới hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
            ];

            $inputs['lichsu'] = json_encode($a_lichsu);
            $inputs['tinhtrang'] = 'Hồ sơ thêm mới';
            $inputs['mahs'] = getdate()[0];
            $inputs['trangthai'] = 'CHT';
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            $inputs['giatri'] = getDoubleToDb($inputs['giatri']);
            $inputs['dientich'] = getDoubleToDb($inputs['dientich']);

            GiaDatPhanLoai::create($inputs);
            return redirect('giadatphanloai/danhsach?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            $a_dvt = array_column(dmdvt::all()->toArray(),'dvt','dvt');
            $model = GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first();
            //dd($inputs);
            return view('manage.dinhgia.giadatphanloai.kekhai.edit')
                ->with('model',$model)
                ->with('m_diaban',$m_diaban)
                ->with('m_donvi',$m_donvi)
                ->with('a_loaidat',$a_loaidat)
                ->with('a_dvt', $a_dvt)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ giá đất');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['giatri'] = getDoubleToDb($inputs['giatri']);
            $inputs['dientich'] = getDoubleToDb($inputs['dientich']);
            $inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first()->update($inputs);
            return redirect('giadatphanloai/danhsach?madv='.$inputs['madv']);
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            //dd($inputs);
            $model = GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first();
            $model->delete();
            return redirect('giadatphanloai/danhsach?&madv='.$model->madv);
        }else
            return view('errors.notlogin');
    }

    //chuyển hô sơ cho Form nhập liệu: chỉ cần chuyển trạng thái và set trạng thái cho đơn vị tiếp nhận
    public function chuyenhs(Request $request){
        //Lấy thông tin đơn vị tiếp nhận để kiểm tra level
        // level == 'H' => set madv_h = $inputs['macqcq']; trangthai_h = 'CHT' (tương đương tạo mới hoso)
        // level == 'T' => set madv_t = $inputs['macqcq']; trangthai_t = 'CHT' (tương đương tạo mới hoso)
        if(Session::has('admin')){
            $inputs = $request->all();
            $model = GiaDatPhanLoai::where('mahs',$inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu,true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => 'HT',
                'username' => session('admin')->username,
                'mota' => 'Chuyển hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
                'macqcq' => $inputs['macqcq']
            );

            $model->lichsu = json_encode($a_lichsu);
            $model->macqcq = $inputs['macqcq'];
            $model->thoidiem = date('Y-m-d H:i:s');
            $model->trangthai = 'HT';
            //kiểm tra đơn vị tiếp nhận
            $chk_dvcq = view_dsdiaban_donvi::where('madv', $inputs['macqcq'])->first();
            if($chk_dvcq->count() && $chk_dvcq->level == 'T'){
                $model->madv_t = $inputs['macqcq'];
                $model->trangthai_t = 'CHT';
            }else{
                $model->madv_h = $inputs['macqcq'];
                $model->trangthai_h = 'CHT';
            }
            $model->save();
            return redirect('giadatphanloai/danhsach?madv='.$model->madv);
        }else
            return view('errors.notlogin');
    }



    public function hoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            dd($inputs);
            $id = $inputs['idhoanthanh'];
            $model = GiaDatPhanLoai::findOrFail($id);
            $model->trangthai = 'HT';
            $model->save();
            return redirect('giadatphanloai');
        }else
            return view('errors.notlogin');
    }

    public function huyhoanthanh(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['idhuyhoanthanh'];
            $model = GiaDatPhanLoai::findOrFail($id);
            $model->trangthai = 'HHT';
            $model->save();
            return redirect('giadatphanloai');
        }else
            return view('errors.notlogin');
    }

    public function congbo(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $id = $inputs['idcongbo'];
            $model = GiaDatPhanLoai::findOrFail($id);
            $model->trangthai = 'CB';
            $model->save();
            return redirect('giadatphanloai');
        }else
            return view('errors.notlogin');
    }

    public function ketxuat(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            //lấy thông tin đơn vị
            $model = GiaDatPhanLoai::where('madv', $inputs['madv']);
            if ($inputs['nam'] != 'all')
                $model = $model->whereYear('thoidiem', $inputs['nam']);
            $m_donvi = dsdonvi::where('madv', $inputs['madv'])->first();
            $a_loaidat = array_column(GiaDatDiaBanDm::all()->toArray(),'loaidat','maloaidat');
            //dd($model->get());
            return view('manage.dinhgia.giadatphanloai.reports.print')
                ->with('model',$model->get())
                ->with('m_donvi',$m_donvi)
                ->with('a_loaidat',$a_loaidat)
                ->with('inputs',$inputs)
                ->with('pageTitle','Thông tin hồ sơ đấu giá đất');
        }else
            return view('errors.notlogin');
    }
}
