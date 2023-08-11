<?php

namespace App\Http\Controllers\Api;


use App\Model\API\KetNoiAPI;
use App\Model\API\KetNoiAPI_HoSo;
use App\Model\API\KetNoiAPI_HoSo_ChiTiet;
use App\Model\system\danhmucchucnang;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\API\KetNoiAPI_DanhSach;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class APIController extends Controller
{
    public function ThietLapChung(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/KetNoiAPI';
            $inputs['phanloai'] = $inputs['phanloai'] ?? 'Header';
            $model = KetNoiAPI::where('phanloai', $inputs['phanloai'])->orderby('stt')->get();
            $inputs['stt'] = count($model) + 1;
            return view('system.KetNoiAPI.ThietLapChung')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thiết lập chung kết nối API');
        } else
            return view('errors.notlogin');
    }

    public function LuuChung(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KetNoiAPI::find($inputs['id']);
            if ($model == null) {
                unset($inputs['id']);
                KetNoiAPI::create($inputs);
            } else {
                $model->update($inputs);
            }
            return  redirect('/KetNoiAPI/ThietLapChung?phanloai=' . $inputs['phanloai']);
        } else
            return view('errors.notlogin');
    }

    public function LayTLChung(Request $request)
    {
        //dd($request);
        $inputs = $request->all();
        $model = KetNoiAPI::findorfail($inputs['id']);
        die(json_encode($model));
    }

    public function XoaTLChung(Request $request)
    {
        $inputs = $request->all();
        $model = KetNoiAPI::findorfail($inputs['id']);
        $model->delete();
        return  redirect('/KetNoiAPI/ThietLapChung?phanloai=' . $model->phanloai);
    }

    public function ThietLapChiTiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/KetNoiAPI';
            //dd(\session('admin'));
            $per = getPhanQuyen();
            $setting = \session('admin')['setting'];
            if (isset($setting['hethong'])) {
                unset($setting['hethong']);
            }

            //chạy $setting nếu cái nào index = 0 => unset()
            foreach ($setting as $k1 => $v1) {
                if (!isset($v1['index']) || $v1['index'] == '0') {
                    unset($setting[$k1]);
                    continue;
                }
                //xóa các giá trị đơn: index, congbo,... chỉ để mảng để duyệt
                foreach ($v1 as $k2 => $v2) {
                    if (!is_array($v2) || !isset($v2['index']) || $v2['index'] == '0') {
                        unset($setting[$k1][$k2]);
                        continue;
                    }
                    foreach ($v2 as $k3 => $v3) {
                        if (!is_array($v3) || !isset($v3['index']) || $v3['index'] == '0') {
                            unset($setting[$k1][$k2][$k3]);
                            continue;
                        }
                    }
                }
            }
            //dd($setting);
            $a_chucnang = session('admin')['a_chucnang'];
            //dd($per);
            //lấy danh sách tài khoản
            $model_danhsach = KetNoiAPI_DanhSach::all();
            //dd( $model_danhsach);
            return view('system.KetNoiAPI.ThietLapChucNang')
                ->with('per', $per)
                ->with('setting', $setting)
                ->with('inputs', $inputs)
                ->with('a_chucnang', $a_chucnang)
                ->with('model_danhsach', $model_danhsach)
                ->with('pageTitle', 'Thiết lập hồ sơ chức năng');
        } else
            return view('errors.notlogin');
    }

    public function ThietLapHoSo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/KetNoiAPI';
            //dd(session('admin'));
            $model = KetNoiAPI_HoSo::where('maso', $inputs['maso'])->orderby('stt')->get();
            $model_ct = KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['maso'])->orderby('stt')->get();
            $inputs['stt'] = count($model) + 1;
            //dd($model_ct);
            return view('system.KetNoiAPI.ThietLapHoSo')
                ->with('model', $model)
                ->with('model_ct', $model_ct)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thiết lập chung kết nối API');
        } else
            return view('errors.notlogin');
    }

    public function LayHoSo(Request $request)
    {
        //dd($request);
        $inputs = $request->all();
        $model = KetNoiAPI_HoSo::findorfail($inputs['id']);
        die(json_encode($model));
    }

    public function LayHoSoChiTiet(Request $request)
    {
        //dd($request);
        $inputs = $request->all();
        $model = KetNoiAPI_HoSo_ChiTiet::findorfail($inputs['id']);
        die(json_encode($model));
    }

    public function LuuHoSo(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KetNoiAPI_HoSo::find($inputs['id']);
            if ($model == null) {
                unset($inputs['id']);
                KetNoiAPI_HoSo::create($inputs);
            } else {
                $model->update($inputs);
            }
            return  redirect('/KetNoiAPI/HoSo?maso=' . $inputs['maso']);
        } else
            return view('errors.notlogin');
    }

    public function LuuHoSoChiTiet(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KetNoiAPI_HoSo_ChiTiet::find($inputs['id']);
            if ($model == null) {
                unset($inputs['id']);
                KetNoiAPI_HoSo_ChiTiet::create($inputs);
            } else {
                $model->update($inputs);
            }
            return  redirect('/KetNoiAPI/HoSo?maso=' . $inputs['maso']);
        } else
            return view('errors.notlogin');
    }

    public function XoaHoSo(Request $request)
    {
        $inputs = $request->all();
        $model = KetNoiAPI_HoSo::findorfail($inputs['id']);
        $model->delete();
        return  redirect('/KetNoiAPI/HoSo?maso=' . $model->maso);
    }

    public function XoaHoSoChiTiet(Request $request)
    {
        $inputs = $request->all();
        $model = KetNoiAPI_HoSo_ChiTiet::findorfail($inputs['id']);
        $model->delete();
        return  redirect('/KetNoiAPI/HoSo?maso=' . $model->maso);
    }

    public function MacDinh(Request $request)
    {
        $inputs = $request->all();
        if ($inputs['machucnang'] == 'Header') {
            KetNoiAPI::where('phanloai', $inputs['maso'])->delete();
            $a_chucnang = getAPIThietLapMacDinh($inputs['machucnang']);
            foreach ($a_chucnang as $chucnang) {
                KetNoiAPI::create($chucnang);
            }
            return  redirect('/KetNoiAPI/ThietLapChung');
        } else {
            KetNoiAPI_HoSo::where('maso', $inputs['maso'])->delete();
            KetNoiAPI_HoSo_ChiTiet::where('maso', $inputs['maso'])->delete();
            $a_chucnang = getAPIThietLapMacDinh($inputs['machucnang']);
            //dd($a_chucnang);
            foreach ($a_chucnang['HOSO'] as $chucnang) {
                KetNoiAPI_HoSo::create(a_merge(['maso' => $inputs['maso']], $chucnang));
            }
            if (isset($a_chucnang['CHITIET']))
                foreach ($a_chucnang['CHITIET'] as $chucnang) {
                    KetNoiAPI_HoSo_ChiTiet::create(a_merge(['maso' => $inputs['maso']], $chucnang));
                }
            return  redirect('/KetNoiAPI/HoSo?maso=' . $inputs['maso']);
        }
    }

    public function DanhSachKetNoi(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/KetNoiAPI';
            //$m_donvi_th = getDonViTongHop('giahhdvk', 'SSA');
            $m_donvi = getDonViNhapLieu('SSA', 'giahhdvk');
            $model = Users::wherein('madv', array_column($m_donvi->toarray(), 'madv'))->get();
            //dd($request->server());
            foreach ($model as $TK) {
                $TK->linkAPI = $request->server()['SERVER_NAME'] . '/api/getAPI?name=' . $TK->username . '&token=' . md5($TK->username . $TK->madv) . '&maso=' . $inputs['maso'];
            }
            //dd($m_user);
            return view('system.KetNoiAPI.DanhSachKetNoi')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Danh sách kết nối API');
        } else
            return view('errors.notlogin');
    }

    function getLink(Request $request)
    {
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = KetNoiAPI_DanhSach::where('maso', $inputs['maso'])->first();
        if ($model == null) {
            $model = new KetNoiAPI_DanhSach();
            $model->maso = $inputs['maso'];
            $model->save();
        }
        die($model);
    }

    public function LinkKetNoi(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = KetNoiAPI_DanhSach::where('maso', $inputs['maso'])->first();
            $model->update($inputs);
            return  redirect('/KetNoiAPI/ThietLapChiTiet');
        } else
            return view('errors.notlogin');
    }
}
