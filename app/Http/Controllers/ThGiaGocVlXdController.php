<?php

namespace App\Http\Controllers;

use App\DiaBanHd;
use App\GiaGocVlXdCt;
use App\Model\manage\dinhgia\giagdbatdongsan\GiaGdBatDongSan;
use App\Model\system\dsdiaban;
use App\ThGiaGocVlXd;
use App\ThGiaGocVlXdCt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ThGiaGocVlXdController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giagocvlxd';
            //lấy địa bàn
            $a_diaban = getDiaBan_Level(\session('admin')->level, \session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level);
            $m_donvi_th = getDonViTongHop('giagocvlxd', \session('admin')->level, \session('admin')->madiaban);
            //$inputs['madiaban'] = $inputs['madiaban'] ?? $m_diaban->first()->madiaban;
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;
            $inputs['nam'] = $inputs['nam'] ?? 'all';
            $inputs['thang'] = $inputs['thang'] ?? 'all';
            //$inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
            //dd($inputs);
            //lấy thông tin đơn vị
            //$model = ThGiaGocVlXd::where('madv', $inputs['madv']);
            $model = ThGiaGocVlXd::all();
            if ($inputs['nam'] != 'all')
                $model = $model->where('nam', strval($inputs['nam']));
            if ($inputs['thang'] != 'all')
                $model = $model->where('thang', strval($inputs['thang']));

            //dd($model);
            return view('manage.dinhgia.giagocvlxd.tonghop.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('a_diaban', array_column($m_diaban->wherein('level', ['H', 'X'])->toarray(), 'tendiaban', 'madiaban'))
                ->with('m_donvi', $m_donvi)
                ->with('m_donvi_th', $m_donvi_th)
                ->with('a_donvi_th', array_column($m_donvi_th->toarray(), 'tendv', 'madv'))
                ->with('a_diaban_th', array_column($m_donvi_th->toarray(), 'tendiaban', 'madiaban'))
                ->with('pageTitle', 'Thông tin hồ sơ');
        } else
            return view('errors.notlogin');
    }

    public function create(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = new ThGiaGocVlXd();
            $model->mahs = getdate()[0];
            //$model->thoidiem = date("Y-m-d");
            $model->diadanh = getGeneralConfigs()['diadanh'];
            $model->dvcq = getGeneralConfigs()['tendonvi'];
            $model->dvbc = 'LIÊN SỞ TÀI CHÍNH - XÂY DỰNG';
            //$inputs['ttthaotac'] = session('admin')->name.'('.session('admin')->username.') thêm mới';
            $model->quy = date('Y');
            $model->nam = Thang2Quy(date('m'));
            $model->thang = date('m');
            //$inputs['diabanbc'] = implode(',',$inputs['diabanbc']);
            $model->trangthai = 'CHT';
            $modelct = ThGiaGocVlXdCt::where('id', -1)->get();
            return view('manage.dinhgia.giagocvlxd.tonghop.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('pageTitle', 'Tổng hợp giá gốc vật liệu xây dựng');
            //            if($model->create($inputs)){
            //                $modelct = GiaGocVlXdCt::join('giagocvlxd','giagocvlxd.mahs','=','giagocvlxdct.mahs')
            //                    ->where('giagocvlxd.quy',$inputs['quybc'])
            //                    ->where('giagocvlxd.nam',$inputs['nambc'])
            //                    ->where('giagocvlxd.trangthai','HT')
            //                    ->whereIn('giagocvlxd.district',explode(',',$inputs['diabanbc']))
            //                    ->select('giagocvlxdct.tenhhdv','giagocvlxdct.qccl','giagocvlxdct.dvt','giagocvlxdct.giagoc','giagocvlxdct.qcad','giagocvlxd.district')
            //                    ->get();
            //                foreach($modelct as $ct){
            //                    $modelthct = new ThGiaGocVlXdCt();
            //                    $modelthct->tenhhdv = $ct->tenhhdv;
            //                    $modelthct->qccl = $ct->qccl;
            //                    $modelthct->dvt = $ct->dvt;
            //                    $modelthct->giagoc = $ct->giagoc;
            //                    $modelthct->qcad = $ct->qcad;
            //                    $modelthct->district = $ct->district;
            //                    $modelthct->mahs = $inputs['mahs'];
            //                    $modelthct->save();
            //                }
            //            }
            //return redirect('tonghopgiagocvlxd?&quy='.$inputs['quybc'].'&nam='.$inputs['nambc']);

        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //$inputs['ngayapdung'] = getDateToDb($inputs['ngayapdung']);
            //$inputs['thoidiem'] = getDateToDb($inputs['thoidiem']);
            if (isset($inputs['ipf1'])) {
                $ipf1 = $request->file('ipf1');
                $name = $inputs['mahs'] . '&1.' . $ipf1->getClientOriginalName();
                $ipf1->move(public_path() . '/data/giagdbatdongsan/', $name);
                $inputs['ipf1'] = $name;
            }

            $model = ThGiaGocVlXd::where('mahs', $inputs['mahs'])->first();
            if ($model == null) {
                $inputs['trangthai'] = 'CHT';
                ThGiaGocVlXd::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('/giagocvlxd/tonghop');
        } else
            return view('errors.notlogin');
    }

    public function show_c($id)
    {
        if (Session::has('admin')) {
            $model = ThGiaGocVlXd::findOrFail($id);
            $diabans = DiaBanHd::whereIn('district', explode(',', $model->diabanbc))
                ->get();
            $tendiaban  = '';
            foreach ($diabans as $diaban) {
                $tendiaban .= $diaban->diaban . ', ';
            }
            $model->tendiaban = $tendiaban;
            $modelct = ThGiaGocVlXdCt::where('mahs', $model->mahs)
                ->get();
            if (session('admin')->level == 'T') {
                $inputs['dvcaptren'] = getGeneralConfigs()['tendvcqhienthi'];
                $inputs['dv'] = getGeneralConfigs()['tendvhienthi'];
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            } elseif (session('admin')->level == 'H') {
                $modeldv = District::where('mahuyen', session('admin')->mahuyen)->first();
                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                $inputs['dv'] = $modeldv->tendvhienthi;
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            } else {
                $modeldv = Town::where('maxa', session('admin')->maxa)
                    ->where('mahuyen', session('admin')->mahuyen)->first();
                $inputs['dvcaptren'] = $modeldv->tendvcqhienthi;
                $inputs['dv'] = $modeldv->tendvhienthi;
                $inputs['diadanh'] = getGeneralConfigs()['diadanh'];
            }
            return view('manage.dinhgia.giagocvlxd.report.printth')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('diabans', $diabans)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Tổng hợp giá gốc vật liệu xây dựng');
        } else
            return view('errors.notlogin');
    }

    public function show(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $inputs = $request->all();
        $model = ThGiaGocVlXd::where('mahs', $inputs['mahs'])->first();

        $result['message'] = '<div class="modal-body" id = "dinh_kem" >';
        if (isset($model->ipf1)) {
            $result['message'] .= '<div class="row" ><div class="col-md-6" ><div class="form-group" >';
            $result['message'] .= '<label class="control-label" > File đính kèm 1 </label >';
            $result['message'] .= '<p ><a target = "_blank" href = "' . url('/data/giagdbatdongsan/' . $model->ipf1) . '">' . $model->ipf1 . '</a ></p >';
            $result['message'] .= '</div ></div ></div >';
        }

        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function edit(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThGiaGocVlXd::where('mahs', $inputs['mahs'])->first();
            //dd($model);
            //            $modelct = ThGiaGocVlXdCt::join('diabanhd','diabanhd.district','=','thgiagocvlxdct.district')
            //                ->where('thgiagocvlxdct.mahs',$model->mahs)
            //                ->select('thgiagocvlxdct.*','diabanhd.diaban')
            //                ->get();
            $modelct = ThGiaGocVlXdCt::where('mahs', $model->mahs)->get();
            return view('manage.dinhgia.giagocvlxd.tonghop.edit')
                ->with('model', $model)
                ->with('modelct', $modelct)
                ->with('pageTitle', 'Tổng hợp giá gốc vật liệu xây dựng chỉnh sửa');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['ngaybc'] = getDateToDb($inputs['ngaybc']);
            $model = ThGiaGocVlXd::findOrFail($id);
            $model->update();
            return redirect('tonghopgiagocvlxd?&quy=' . $inputs['quy'] . '&nam=' . $inputs['nam']);
        } else
            return view('errors.notlogin');
    }

    public function hoanthanh(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThGiaGocVlXd::where('id', $inputs['idhoanthanh'])->first();
            $model->trangthai = 'HT';
            $model->save();
            return redirect('tonghopgiagocvlxd?&quy=' . $model->quy . '&nam=' . $model->nam);
        } else
            return view('errors.notlogin');
    }

    public function huyhoanthanh(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThGiaGocVlXd::where('id', $inputs['idhuyhoanthanh'])->first();
            $model->trangthai = 'HHT';
            $model->congbo = 'CCB';
            $model->save();
            return redirect('tonghopgiagocvlxd?&quy=' . $model->quy . '&nam=' . $model->nam);
        } else
            return view('errors.notlogin');
    }


    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = ThGiaGocVlXd::where('id', $inputs['iddelete'])->first();
            if ($model->delete()) {
                $modelct = ThGiaGocVlXdCt::where('mahs', $model->mahs)
                    ->delete();
            }
            return redirect('tonghopgiagocvlxd');
        } else
            return view('errors.notlogin');
    }

    public function tralai(Request $request)
    {
        //Truyền vào mahs và macqcq
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = GiaGdBatDongSan::where('mahs', $inputs['mahs'])->first();
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
            return redirect('giabatdongsan/xetduyet?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function congbo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();

            $model = ThGiaGocVlXd::where('mahs', $inputs['mahs'])->first();
            $a_lichsu = json_decode($model->lichsu, true);
            $a_lichsu[getdate()[0]] = array(
                'hanhdong' => $inputs['trangthai_ad'],
                'username' => session('admin')->username,
                'mota' => $inputs['trangthai_ad'] == 'CB' ? 'Công bố hồ sơ' : 'Hủy công bố hồ sơ',
                'thoigian' => date('Y-m-d H:i:s'),
            );
            $model->lichsu = json_encode($a_lichsu);

            $model->trangthai = $inputs['trangthai_ad'];
            $model->congbo = $inputs['trangthai_ad'] == 'CB' ? 'DACONGBO' : 'CHUACONGBO';

            $model->save();
            return redirect('giagocvlxd/tonghop');
        } else
            return view('errors.notlogin');
    }
}
