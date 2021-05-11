<?php

namespace App\Http\Controllers;

use App\District;
use App\DmDvQl;
use App\DnDvGs;
use App\DnDvLt;
use App\DnDvLtReg;
use App\DnTaCn;
use App\DonViDvVt;
use App\DonViDvVtReg;
use App\GeneralConfigs;
use App\Model\system\company\Company;
use App\Model\system\danhmucchucnang;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Register;
use App\Users;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class thongkeController extends Controller
{
    public function hanhchinh(Request $request)
    {
        if (Session::has('admin')) {

            $inputs = $request->all();
            //dd($inputs);
            if (session('admin')->level == 'SSA' || session('admin')->level == 'ADMIN') {
                $m_diaban = dsdiaban::all();
            } else {
                $m_diaban = dsdiaban::where('madiaban', session('admin')->madiaban)->get();
            }
            $a_diaban = array_column($m_diaban->toArray(), 'madiaban');
            $m_donvi = dsdonvi::wherein('madiaban', $a_diaban)->take(500)->get();
            $a_donvi = array_column($m_donvi->toArray(), 'madv');
            $m_taikhoan = Users::wherein('madv', $a_donvi)->take(1000)->where('chucnang', 'NHAPLIEU')->get();
            $inputs['username'] = $inputs['username'] ?? $m_taikhoan->first()->username;
            $model = $m_taikhoan->where('username', $inputs['username'])->first();
            //dd($model);
            $per = getPhanQuyen();
            $per_user = json_decode($model->permission, true);
            $m_gui = GeneralConfigs::first();
            //loại phân quyền hệ thống nếu có
            $setting = json_decode($m_gui->setting, true);
            $a_giaodien = getGiaoDien();
            if (isset($setting['hethong'])) {
                unset($setting['hethong']);
            }
            //loại phân quyền thống kê nếu có
            if (isset($setting['thongke'])) {
                unset($setting['thongke']);
            }

            foreach ($per as $key => $val) {
                if (isset($per_user[$key])) {
                    $p_u = $per_user[$key];
                    foreach ($val as $k1 => $v1) {
                        if (!is_array($v1)) {
                            $per[$key][$k1] = $p_u[$k1] ?? $per[$key][$k1];
                        } else {
                            foreach ($v1 as $k2 => $v2) {
                                $per[$key][$k1][$k2] = $p_u[$k1][$k2] ?? $per[$key][$k1][$k2];
                            }
                        }
                    }
                }
            }
            //dd($a_giaodien);
            //chạy $setting nếu cái nào index = 0 => unset()
            foreach ($setting as $k1 => $v1) {
                if (!isset($v1['index']) || $v1['index'] == '0') {
                    unset($setting[$k1]);
                    continue;
                }

                //kiểm tra tài khoản không đc phân quyền thì bỏ chức năng đó
                if (!isset($per_user[$k1]['index']) || $per_user[$k1]['index'] == '0') {
                    unset($setting[$k1]);
                    continue;
                }

                $k1_hs = $k1_ht = 0;
                //xóa các giá trị đơn: index, congbo,... chỉ để mảng để duyệt
                foreach ($v1 as $k2 => $v2) {
                    if (!is_array($v2) || !isset($v2['index']) || $v2['index'] == '0') {
                        unset($setting[$k1][$k2]);
                        continue;
                    }
                    //kiểm tra tài khoản không đc phân quyền thì bỏ chức năng đó
                    if (!isset($per_user[$k2]['index']) || $per_user[$k2]['index'] == '0') {
                        unset($setting[$k1][$k2]);
                        continue;
                    }

                    $k2_hs = $k2_ht = 0;
                    foreach ($v2 as $k3 => $v3) {
                        //kiểm tra chức năng không đc phân quyền thì bỏ chức năng đó
                        if (!is_array($v3) || !isset($v3['index']) || $v3['index'] == '0') {
                            unset($setting[$k1][$k2][$k3]);
                            continue;
                        }
                        //kiểm tra tài khoản không đc phân quyền thì bỏ chức năng đó
                        if (!isset($per_user[$k3]['index']) || $per_user[$k3]['index'] == '0') {
                            unset($setting[$k1][$k2][$k3]);
                            continue;
                        }

                        $setting[$k1][$k2][$k3]['hoso'] = 0;
                        $setting[$k1][$k2][$k3]['hoanthanh'] = 0;
                        if(isset($a_giaodien[$k1][$k2][$k3]['table']) && $a_giaodien[$k1][$k2][$k3]['table'] !='') {
                            $setting[$k1][$k2][$k3]['hoso'] = DB::table($a_giaodien[$k1][$k2][$k3]['table'])->where('madv', $model->madv)->count();
                            $setting[$k1][$k2][$k3]['hoanthanh'] = DB::table($a_giaodien[$k1][$k2][$k3]['table'])
                                ->where('madv', $model->madv)
                                ->where('trangthai', 'HT')
                                ->count();
                            $k2_hs += $setting[$k1][$k2][$k3]['hoso'];
                            $k2_ht += $setting[$k1][$k2][$k3]['hoanthanh'];
                        }
                        //lấy thông tin các bảng
                    }
                    $setting[$k1][$k2]['hoso'] = $k2_hs;
                    $setting[$k1][$k2]['hoanthanh'] = $k2_ht;
                    $k1_hs += $k2_hs;
                    $k1_ht += $k2_ht;
                }
                $setting[$k1]['hoso'] = $k1_hs;
                $setting[$k1]['hoanthanh'] = $k1_ht;
            }

            $a_chucnang = array_column(danhmucchucnang::all()->toArray(), 'menu', 'maso');
            //dd($inputs);
            return view('thongke.hanhchinh')
                ->with('per', $per)
                ->with('setting', $setting)
                ->with('model', $model)
                ->with('a_chucnang', $a_chucnang)
                ->with('a_donvi', array_column($m_donvi->toarray(),'tendv','madv'))
                ->with('m_taikhoan', $m_taikhoan)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Thống kê hồ sơ của đơn vị hành chính');
        } else
            return view('errors.notlogin');
    }
}
