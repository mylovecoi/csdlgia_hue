<?php

namespace App\Http\Controllers\system;

use App\GeneralConfigs;
use App\Model\system\danhmucchucnang;
use App\Model\system\dsdiaban;
use App\Model\system\dsdonvi;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class dstaikhoanController extends Controller
{
    public function index(Request $request)
    {
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'index')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            if(session('admin')->level == 'SSA' || session('admin')->level == 'ADMIN'){
                $m_diaban = dsdiaban::all();
            }else{
                $m_diaban = dsdiaban::where('madiaban',session('admin')->madiaban)->get();
            }
            $m_donvi = dsdonvi::wherein('madiaban',array_column($m_diaban->toarray(),'madiaban'))->get();
            $inputs['madv'] = $inputs['madv'] ??  $m_donvi->first()->madv;
            $model = Users::where('madv', $inputs['madv'])->get();
            //lấy phân loại tài khoản từ bảng dsdonvi để hiển thị
            foreach($model as $ct){
                $dv = $m_donvi->where('madv',$ct->madv)->first();
                $ct->chucnang = $dv->chucnang;
            }
            //dd($model);
            return view('system.taikhoan.index')
                ->with('model', $model)
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('m_diaban', $m_diaban)
                ->with('m_donvi', $m_donvi)
                ->with('pageTitle', 'Danh sách tài khoản đơn vị');

        } else
            return view('errors.notlogin');
    }

    public function create(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $m_donvi = dsdonvi::where('madv',$inputs['madv'])->get();
            //dd(array_column($m_donvi->toArray(),'tendv','madv'));
            return view('system.taikhoan.create')
                ->with('inputs', $inputs)
                ->with('a_phanloai', getPhanLoaiDonVi())
                ->with('a_donvi',array_column($m_donvi->toArray(),'tendv','madv'))
                ->with('pageTitle','Thêm mới thông tin tài khoản');

        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            //$user->username = chuanhoachuoi($inputs['username']);
            //$user->password = md5($inputs['password']);
            $user = new Users();
            $user->madv = $inputs['madv'];
            $user->name = $inputs['name'];
            $user->username = chuanhoachuoi($inputs['username']);
            $user->password = md5($inputs['password']);
            $user->status = 'Kích hoạt';
            $user->save();

            return redirect('/taikhoan/danhsach?madv=' . $inputs['madv']);
        } else
            return view('errors.notlogin');
    }

    public function copy(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username',$inputs['username'])->first();
            return view('system.taikhoan.copy')
                ->with('model',$model)
                ->with('pageTitle','Sao chép thông tin tài khoản');
        } else
            return view('errors.notlogin');
    }

    public function store_copy(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username',$inputs['username_goc'])->first();
            $user = new Users();
            $user->madv = $model->madv;
            $user->name = $inputs['name'];
            $user->username = chuanhoachuoi($inputs['username']);
            $user->password = md5($inputs['password']);
            $user->status = 'Kích hoạt';
            $user->permission = $model->permission;
            $user->save();

            return redirect('/taikhoan/danhsach?madv=' . $model->madv);
        } else
            return view('errors.notlogin');
    }

    public function modify(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username', $inputs['username'])->first();
            $m_donvi = dsdonvi::where('madv',$model->madv)->get();

            return view('system.taikhoan.edit')
                ->with('model', $model)
                ->with('a_donvi',array_column($m_donvi->toArray(),'tendv','madv'))
                ->with('pageTitle','Thông tin tài khoản');

        }else
            return view('errors.notlogin');
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username', $inputs['username'])->first();
            $model->name = $inputs['name'];
            $model->status = $inputs['status'];
            if($inputs['password'] != ''){
                $model->password = md5($inputs['password']);
            }
            $model->update($inputs);

            return redirect('/taikhoan/danhsach?madv='. $inputs['madv']);
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
            $model = Users::findorfail($inputs['iddelete']);
            $model->delete();
            return redirect('/taikhoan/danhsach?madv='. $model->madv);
        } else
            return view('errors.notlogin');
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
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            //dd($inputs);

            $per = getPhanQuyen();
            $model = Users::where('username',$inputs['username'])->first();
            $per_user = json_decode($model->permission,true);
            $m_donvi = dsdonvi::where('madv',$model->madv)->first();

            $m_gui = GeneralConfigs::first();
            //$gui = getGiaoDien();

            if($m_donvi->chucnang == 'QUANTRI'){
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
            //chạy thêm lần nữa để xóa các phân hệ ko phân quyền trong hệ thống
            // chỉ có ssa, admin mới hiện lên để phân quyền
            if( $m_donvi->chucnang == 'QUANTRI' && !in_array(session('admin')->level, ['SSA', 'ADMIN'])){
                foreach($setting as $k1 => $v1){
                    foreach ($v1 as $k2 => $v2){
                        foreach ($v2 as $k3 => $v3){
                            if(!isset($per[$k3]['index']) || $per[$k3]['index'] == '0'){
                                unset($setting[$k1][$k2][$k3]);
                            }
                        }
                    }
                }
                //dd($setting);
            }

            $a_chucnang = array_column(danhmucchucnang::all()->toArray(),'menu','maso');
            //dd($per);
            return view('system.taikhoan.perms')
                ->with('per', $per)
                ->with('setting', $setting)
                ->with('model', $model)
                ->with('a_chucnang', $a_chucnang)
                ->with('pageTitle', 'Phân quyền cho tài khoản');

        } else
            return view('errors.notlogin');
    }

    function store_perm(Request $request){
        if (Session::has('admin')) {
            //tài khoản SSA; tài khoản quản trị + có phân quyền
            if (!chkPer('hethong', 'hethong_pq', 'danhsachtaikhoan','danhmuc', 'modify')) {
                return view('errors.noperm');
            }
            $inputs = $request->all();
            $model = Users::where('username',$inputs['username'])->first();
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
            return redirect('/taikhoan/perm?username='.$inputs['username']);
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
        $model = Users::where('username', $inputs['username'])->first();
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
