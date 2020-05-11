<?php

namespace App\Http\Controllers\system;

use App\GeneralConfigs;
use App\Model\system\danhmucchucnang;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Model\system\dsnhomtaikhoan;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dsnhomtaikhoanController extends Controller
{
    public function index()
    {
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'nhomtaikhoan','danhmuc', 'index')) {
                return view('errors.noperm');
            }
            $model = dsnhomtaikhoan::all();
            //dd($model);
            return view('system.nhomtaikhoan.index')
                ->with('model', $model)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('pageTitle', 'Danh sách nhóm tài khoản');
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'nhomtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsnhomtaikhoan::where('maso',$inputs['maso'])->first();
            if($model == null){
                $inputs['maso'] = getdate()[0];
                dsnhomtaikhoan::create($inputs);
            }else{
                $model->update($inputs);
            }

            return redirect('/nhomtaikhoan/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsnhomtaikhoan::findorfail($inputs['iddelete']);
            $model->delete();
            return redirect('/nhomtaikhoan/danhsach');
        } else
            return view('errors.notlogin');
    }

    public function edit(Request $request)
    {

        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = dsnhomtaikhoan::where('maso',$inputs['maso'])->first();
        die($model);
    }

    /*
 Load setting
load quyền mặc định
Load quyền user
Cập nhật quyền user vào quyền mặc định (để luôn chạy theo quyền hệ thống, nếu có thay đổi quyền, thêm quyền thì luôn có)
 * */
    public function permission(Request $request)
    {
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'nhomtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $inputs['url'] = '/nhomtaikhoan';
            //dd($inputs);

            $per = getPhanQuyen();
            $model = dsnhomtaikhoan::where('maso',$inputs['maso'])->first();
            $per_user = json_decode($model->permission,true);


            $m_gui = GeneralConfigs::first();
            //$gui = getGiaoDien();

            if($model->chucnang == 'QUANTRI'){
                $setting['hethong'] = json_decode($m_gui->setting, true)['hethong']?? array();
            }else{
                //loại phân quyền hệ thống nếu có
                $setting = json_decode($m_gui->setting, true);
                if(isset($setting['hethong'])){unset($setting['hethong']);}
            }

            foreach($per as $key => $val){
                if(isset($per_user[$key])){
                    $p_u = $per_user[$key];
                    foreach ($val as $k1=>$v1){
                        if(!is_array($v1)){
                            $per[$key][$k1] = $p_u[$k1] ?? $per[$key][$k1];
                        }else{
                            foreach ($v1 as $k2=>$v2){
                                $per[$key][$k1][$k2] = $p_u[$k1][$k2] ?? $per[$key][$k1][$k2];
                            }
                        }
                    }
                }
            }
            //chạy $setting nếu cái nào index = 0 => unset()
            foreach($setting as $k1 => $v1){
                if(!isset($v1['index']) || $v1['index'] == '0'){
                    unset($setting[$k1]);
                    continue;
                }
                //xóa các giá trị đơn: index, congbo,... chỉ để mảng để duyệt
                foreach ($v1 as $k2 => $v2){
                    if(!is_array($v2) || !isset($v2['index']) || $v2['index'] == '0'){
                        unset($setting[$k1][$k2]);
                        continue;
                    }
                    foreach ($v2 as $k3 => $v3){
                        if(!is_array($v3) || !isset($v3['index']) || $v3['index'] == '0'){
                            unset($setting[$k1][$k2][$k3]);
                            continue;
                        }
                    }
                }
            }
            $a_chucnang = array_column(danhmucchucnang::all()->toArray(),'menu','maso');
            //dd($per);
            return view('system.nhomtaikhoan.perms')
                ->with('per', $per)
                ->with('setting', $setting)
                ->with('model', $model)
                ->with('a_chucnang', $a_chucnang)
                ->with('inputs', $inputs)
                ->with('pageTitle', 'Phân quyền cho tài khoản');

        } else
            return view('errors.notlogin');
    }

    function store_perm(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'nhomtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = dsnhomtaikhoan::where('maso',$inputs['maso_pq'])->first();
            $per_user = json_decode($model->permission,true);
            $per = getPhanQuyen()[$inputs['maso']];
            $a_per = $inputs[$inputs['maso']] ?? array();

            foreach ($per as $k1=>$v1){
                if(!is_array($v1)){
                    $per[$k1] = isset($a_per[$k1]) ? '1' : '0';
                }else{
                    foreach ($v1 as $k2=>$v2){
                        $per[$k1][$k2] = isset($a_per[$k1][$k2]) ? '1' : '0';
                    }
                }
            }

            $per_user[$inputs['maso']] = $per;
            //dd($inputs);
            $model->permission = json_encode($per_user);
            $model->save();
            return redirect('/nhomtaikhoan/perm?maso='.$inputs['maso_pq']);
        } else
            return view('errors.notlogin');
    }

    function get_perm(Request $request)
    {

        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        $model = dsnhomtaikhoan::where('maso', $inputs['maso_pq'])->first();
        $per_user = json_decode($model->permission, true)[$inputs['maso']]?? array();
        $per = getPhanQuyen()[$inputs['maso']];

        foreach ($per as $k1 => $v1) {
            if (!is_array($v1)) {
                $per[$k1] = $per_user[$k1] ?? $per[$k1];
            } else {
                foreach ($v1 as $k2 => $v2) {
                    $per[$k1][$k2] = $per_user[$k1][$k2] ?? $per[$k1][$k2];
                }
            }
        }
        $result = array(
            'status' => 'success',
            'message' => '',
        );
        //dd($per_user);
        $result['message'] = '<div class="modal-body" id="chitiet">';
        $result['message'] .= '<div class="row" >';
        $result['message'] .= '<div class="col-md-offset-4 col-md-8">';
        $result['message'] .= '<div class="md-checkbox">';
        $result['message'] .= '<input type="checkbox" id="index" name="'.$inputs['maso'].'[index]" class="md-check" '.(isset($per['index']) && $per['index'] == 1 ? 'checked':'').' >';
        $result['message'] .= '<label for="index">';
        $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Phân quyền chức năng</label>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';
        $result['message'] .= '<hr>';
        if (isset($per['danhmuc'])) {
            $result['message'] .= '<div id="dm">';
            $result['message'] .= '<h4>Danh mục</h4>';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-offset-1 col-md-3">';
            $result['message'] .= '<div class="md-checkbox">';
            $result['message'] .= '<input type="checkbox" id="dm_index" name="'.$inputs['maso'].'[danhmuc][index]" class="md-check" '.(isset($per['danhmuc']['index']) && $per['danhmuc']['index'] == 1 ? 'checked':'').' >';
            $result['message'] .= '<label for="dm_index">';
            $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Danh sách</label>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-3">';
            $result['message'] .= '<div class="md-checkbox">';
            $result['message'] .= '<input type="checkbox" id="dm_modify" name="'.$inputs['maso'].'[danhmuc][modify]" class="md-check" '.(isset($per['danhmuc']['modify']) && $per['danhmuc']['modify'] == 1 ? 'checked':'').' >';
            $result['message'] .= '<label for="dm_modify">';
            $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Thay đổi</label>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
        }

        if (isset($per['hoso'])) {
            $result['message'] .= '<div id="hs">';
            $result['message'] .= '<h4>Hồ sơ</h4>';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-offset-1 col-md-3">';
            $result['message'] .= '<div class="md-checkbox">';
            $result['message'] .= '<input type="checkbox" id="hs_index" name="'.$inputs['maso'].'[hoso][index]" class="md-check" '.(isset($per['hoso']['index']) && $per['hoso']['index'] == 1 ? 'checked':'').' >';
            $result['message'] .= '<label for="hs_index">';
            $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Danh sách</label>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="col-md-3">';
            $result['message'] .= '<div class="md-checkbox">';
            $result['message'] .= '<input type="checkbox" id="hs_modify" name="'.$inputs['maso'].'[hoso][modify]" class="md-check" '.(isset($per['hoso']['modify']) && $per['hoso']['modify'] == 1 ? 'checked':'').' >';
            $result['message'] .= '<label for="hs_modify">';
            $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Thay đổi</label>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="col-md-3">';
            $result['message'] .= '<div class="md-checkbox">';
            $result['message'] .= '<input type="checkbox" id="hs_approve" name="'.$inputs['maso'].'[hoso][approve]" class="md-check" '.(isset($per['hoso']['approve']) && $per['hoso']['approve'] == 1 ? 'checked':'').' >';
            $result['message'] .= '<label for="hs_approve">';
            $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Hoàn thành</label>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
        }
        //riêng chức năng khác thì load từng check do nhóm này có thể có 1 số chức năng
        if (isset($per['khac'])) {
            $result['message'] .= '<div id="khac">';
            $result['message'] .= '<h4>Chức năng khác</h4>';
            $result['message'] .= '<div class="row" >';
            if(isset($per['khac']['baocao'])){
                $result['message'] .= '<div class="col-md-offset-1 col-md-3">';
                $result['message'] .= '<div class="md-checkbox">';
                $result['message'] .= '<input type="checkbox" id="khac_baocao" name="'.$inputs['maso'].'[khac][baocao]" class="md-check" '.(isset($per['khac']['baocao']) && $per['khac']['baocao'] == 1 ? 'checked':'').' >';
                $result['message'] .= '<label for="khac_baocao">';
                $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Tổng hợp</label>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
            }

            if(isset($per['khac']['company'])){
                $result['message'] .= '<div class="col-md-3">';
                $result['message'] .= '<div class="md-checkbox">';
                $result['message'] .= '<input type="checkbox" id="khac_company" name="'.$inputs['maso'].'[khac][company]" class="md-check" '.(isset($per['khac']['company']) && $per['khac']['company'] == 1 ? 'checked':'').' >';
                $result['message'] .= '<label for="khac_company">';
                $result['message'] .= '<span></span><span class="check"></span><span class="box"></span>Thông tin doanh nghiệp</label>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
            }
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
        }
        $result['message'] .= '</div>';

        die(json_encode($result));
    }
}
