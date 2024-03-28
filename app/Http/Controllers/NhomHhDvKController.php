<?php

namespace App\Http\Controllers;

use App\DmHhDvK;
use App\DmHhDvK_DonVi;
use App\Model\system\dsdiaban;
use App\Model\system\view_dsdiaban_donvi;
use App\NhomHhDvK;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NhomHhDvKController extends Controller
{
    public function index()
    {
        if (Session::has('admin')) {
            $inputs['url'] = '/giahhdvk';
            $model = NhomHhDvK::all();
            return view('manage.dinhgia.giahhdvk.danhmuc.nhom.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thông tin nhóm hàng hóa dịch vụ');
        } else
            return view('errors.notlogin');
    }

    public function index_donvi(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['url'] = '/giahhdvk';
            //dd($inputs);
            $a_thongtu = array_column(NhomHhDvK::all()->toArray(), 'tentt', 'matt');
            $inputs['matt'] = $inputs['matt'] ?? array_key_first($a_thongtu);
            $a_diaban = getDiaBan_NhapLieu(session('admin')->level, session('admin')->madiaban);
            $m_diaban = dsdiaban::wherein('madiaban', array_keys($a_diaban))->get();
            $m_donvi = getDonViNhapLieu(session('admin')->level, 'giahhdvk');
            if (count($m_donvi) == null) {
                $message = 'Chưa có đơn vị nào được phân quyền nhập liệu cho chức năng: ' . session('admin')['a_chucnang']['giahhdvk']
                    . '. Bạn cần liên hệ người quản trị để phần quyền nhập liệu cho đơn vị.';
                return  view('errors.403')
                    ->with('message', $message);
            }
            //            $m_donvi = view_dsdiaban_donvi::wherein('madiaban', array_keys($a_diaban))->where('chucnang', 'NHAPLIEU')->get();

            $inputs['madiaban'] = $inputs['madiaban'] ?? array_key_first($a_diaban);
            $m_donvi = $m_donvi->wherein('madiaban', array_column($m_diaban->toarray(), 'madiaban'));           
            $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;            
            $model = DmHhDvK_DonVi::where('madv', $inputs['madv'])
                ->where('matt', $inputs['matt'])->orderby('mahhdv')->get();
            $m_hanghoa = DmHhDvK::where('matt', $inputs['matt'])->wherenotin('mahhdv', array_column($model->toarray(), 'mahhdv'))->get();
            // dd($inputs);
            //dd($m_donvi->toArray());
            return view('manage.dinhgia.giahhdvk.danhmuc.donvi.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('m_hanghoa', $m_hanghoa)
                ->with('a_thongtu', $a_thongtu)
                ->with('pageTitle', 'Thông tin hàng hóa, dịch vụ theo đơn vị');
        } else
            return view('errors.notlogin');
    }

    public function store_dmdonvi(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            //chỉ cần kiểm tra tồn tại do trên form đã bắt trường hợp ko chọn
            if (isset($inputs['a_hh'])) {
                $model = DmHhDvK::where('matt', $inputs['matt'])->wherein('mahhdv', $inputs['a_hh'])->orderby('mahhdv')->get();
            } else {
                $model = DmHhDvK::where('matt', $inputs['matt'])->orderby('mahhdv')->get();
            }
            $a_dm = [];
            $a_check = array_column(DmHhDvK_DonVi::where('madv', $inputs['madv'])
                ->where('matt', $inputs['matt'])->get('mahhdv')->toarray(), 'mahhdv');
            //dd($a_check);
            foreach ($model as $key => $val) {
                if (in_array($val->mahhdv, $a_check)) {
                    continue;
                }
                //dd($val);
                $a_dm[] = [
                    'manhom' => $val->manhom,
                    'matt' => $val->matt,
                    'mahhdv' => $val->mahhdv,
                    'tenhhdv' => $val->tenhhdv,
                    'dacdiemkt' => $val->dacdiemkt,
                    'dvt' => $val->dvt,
                    'xuatxu' => $val->xuatxu,
                    'theodoi' => $val->theodoi,
                    'madv' => $inputs['madv'],
                ];
            }
            //dd($a_dm);
            foreach (array_chunk($a_dm, 100) as $data) {
                DmHhDvK_DonVi::insert($data);
            }
            $result = array(
                'status' => 'success',
                'message' => 'Thêm mới danh mục thành công.',
            );
            die(json_encode($result));
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = NhomHhDvK::where('matt', $inputs['matt'])->first();
            if ($model == null) {
                $inputs['matt'] = getdate()[0];
                NhomHhDvK::create($inputs);
            } else {
                $model->update($inputs);
            }
            return redirect('/giahhdvk/danhmuc');
        } else
            return view('errors.notlogin');
    }

    public function show_nhomdm(Request $request)
    {
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = NhomHhDvK::where('matt', $inputs['matt'])->first();
        die($model);
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            NhomHhDvK::where('matt', $inputs['matt'])->first()->delete();
            DmHhDvK::where('matt', $inputs['matt'])->delete();
            return redirect('giahhdvk/danhmuc');
        } else
            return view('errors.notlogin');
    }

    public function destroy_dmdonvi(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            DmHhDvK_DonVi::where('id', $inputs['id'])->delete();
            return redirect('giahhdvk/dmdonvi');
        } else
            return view('errors.notlogin');
    }
}
