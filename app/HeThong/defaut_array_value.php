<?php



function NhomQuanLy()
{
    $a_kq = array(
        'TC' => 'Tài Chính',
        'VT' => 'Vận Tải',
        'CT' => 'Công Thương',
        'KHAC' => 'Khác'
    );
    //dd($a_kq);
    return $a_kq;
}


function getLoaiXe(){
    $a_loaixe = array(
        'Xe 4 chỗ' => 'Xe 4 chỗ',
        'Xe 5 chỗ' => 'Xe 5 chỗ',
        'Xe 7 chỗ' => 'Xe 7 chỗ',
        'Xe 16 chỗ' => 'Xe 16 chỗ',
        'Xe 29 chỗ' => 'Xe 29 chỗ',
        'Xe 35 chỗ' => 'Xe 35 chỗ',
        'Xe 45 chỗ' => 'Xe 45 chỗ',
        'Xe 47 chỗ' => 'Xe 47 chỗ',
        'Loại xe khác' => 'Loại xe khác'
    );
    return $a_loaixe ;
}

function getDiaDanhH(){
    $diadanhhs = \App\DiaBanHd::where('level','H')
        ->get();

    $options = array();
    $options[''] = '--Chọn địa bàn quản lý--';
    foreach ($diadanhhs as $diadanhh) {


        $options[$diadanhh->district] = $diadanhh->diaban;
    }
    return $options;
}

function getDtapdungdvlt(){
    $dtads = \App\DtAdDvLt::all();

    $options = array();
    $options['00'] = '--Chọn loại đối tượng áp dụng--';
    foreach ($dtads as $dtad) {
        $options[$dtad->madtad] = $dtad->tendtad;
    }
    return $options;
}

function getDvtDvLt(){
    $dvt = array(
        ''=>'--Chọn đơn vị tính--',
        'Đồng/giường/ngày đêm'=>'Đồng/giường/ngày đêm',
        'Đồng/phòng/ngày đêm'=>'Đồng/phòng/ngày đêm',
        'Đồng/phòng/tuần'=> 'Đồng/phòng/tuần',
        'Đồng/phòng/tháng'=> 'Đồng/phòng/tháng',
        'Đồng/căn hộ/ngày đêm'=>'Đồng/căn hộ/ngày đêm',
        'Đồng/căn hộ/tuần'=> 'Đồng/căn hộ/tuần' ,
        'Đồng/căn hộ/tháng'=>'Đồng/căn hộ/tháng',
    );
    return $dvt;
}

function getLoaiVbQlNn(){
    $vbqlnn = array(
        '' => '--Loại văn bản--',
        'luat' => 'Luật',
        'nghidinh'=>'Nghị định',
        'nghiquyet'=> 'Nghị quyết',
        'thongtu' => 'Thông tư',
        'quyetdinh' => 'Quyết định',
        'vbhd' => 'Văn bản hướng dẫn',
        'baocao' => 'Báo cáo tình hình giá trị trường',
        'tailieu' => 'Báo cáo, tài liệu học tập kinh nghiệm',
        'khoahoc' => 'Kết quả, đề tài nghiên cứu khoa học',
        'vbkhac' => 'Báo cáo, văn bản có liên quan khác',
    );
    return $vbqlnn;
}

function getThang(){
    return array('01' => '01','02' => '02','03' => '03',
        '04' => '04','05' => '05','06' => '06',
        '07' => '07','08' => '08','09' => '09',
        '10' => '10','11' => '11','12' => '12');
}

function getPhanLoaiDonVi_DiaBan(){
    return array(
        'ADMIN'=>'Đơn vị tổng hợp toàn Tỉnh',
        'T'=>'Đơn vị hành chính cấp Tỉnh',
        'H'=>'Đơn vị hành chính cấp Huyện',
    );
}

function getPhanLoaiDonVi(){
    return array(
        'TONGHOP'=>'Đơn vị tổng hợp dữ liệu',
        'NHAPLIEU'=>'Đơn vị nhập liệu',
        'QUANTRI'=>'Đơn vị quản trị hệ thống',
    );
}

function getHienTrang_NhaXH(){
    return array(
        'CHOTHUE'=>'Đang cho thuê',
        'DANGSD' => 'Đang sử dụng',
        'DABAN' => 'Đã bán',
        'CHUASD' => 'Chưa sử dụng',
    );
}

function getPhanLoai_NhaXH(){
    return array(
        'NHAOXH'=>'Nhà ở xã hội',
        'NHACV' => 'Nhà ở công vụ',
        'NHANN' => 'Nhà ở thuộc sở hữu nhà nước',
        'NHAK' => 'Nhà ở khác',
    );
}

function getPhanLoaiSPDVCI(){
    return array(
        'SANPHAM'=>'Sản phẩm',
        'DVCI' => 'Dịch vụ công ích',
        'DVSNC' => 'Dịch vụ sự nghiệp công',
        'HHDV' => 'Hàng hóa, dịch vụ',
        'KHAC' => 'Sản phẩm, dịch vụ khác',
    );
}

function getPhanLoaiTroGia(){
    return array(
        'NGANSACH'=>'Chi từ ngân sách địa phương và trung ương',
        'BANLE' => 'Mức giá hoặc khung giá bán lẻ',
        'KHOKHAN' => 'Cung ứng hàng hóa, dịch vụ thiết yếu phục vụ đồng bào miền núi, vùng sâu, xa và hải đảo',
        'KHAC' => 'Trợ giá, trợ cước khác',
    );
}

function getDiaBan_Level($level, $madiaban = null)
{
    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H', 'ADMIN'])->get()->toarray(),
            'tendiaban', 'madiaban');
    }

    return array_column(App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban', 'madiaban');
}

//Lấy danh sách địa bàn thực tế tại đơn vị
function getDiaBan_ApDung($level, $madiaban = null)
{
//    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
//        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
//            'tendiaban', 'madiaban');
//    }
    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
        return array_column(App\Model\system\dsdiaban::wherein('level', ['ADMIN', 'H'])->get()->toarray(),
            'tendiaban', 'madiaban');
    }

    return array_column(App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban', 'madiaban');
}

//Lấy danh sách địa bàn có chức năng nhập liệu (X; H; T)
function getDiaBan_NhapLieu($level, $madiaban = null, $all = true)
{
//    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
//        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
//            'tendiaban', 'madiaban');
//    }
    if (in_array($level, ['SSA'])) {
        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
            'tendiaban', 'madiaban');
    }

    if (in_array($level, ['T', 'ADMIN']) && $all == true) {
        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H'])->get()->toarray(),
            'tendiaban', 'madiaban');
    }

    return array_column(App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban', 'madiaban');
}

//Lấy danh sách địa bàn các đơn vị xã huyện
function getDiaBan_XaHuyen($level, $madiaban = null)
{
    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
        return array_column(App\Model\system\dsdiaban::wherein('level', ['X', 'H'])->get()->toarray(),
            'tendiaban', 'madiaban');
    }

    return array_column(App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban', 'madiaban');
}

//Lấy danh sách địa bàn theo level hệ thống
function getDiaBan_HeThong($level, $madiaban = null)
{
    if (in_array($level, ['SSA', 'ADMIN'])) {
        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H', 'X'])->get()->toarray(),
            'tendiaban', 'madiaban');
    }

    return array_column(App\Model\system\dsdiaban::where('madiaban', $madiaban)->get()->toarray(),
        'tendiaban', 'madiaban');
}
function getDonViNhapLieu($level){
    if ($level == 'SSA') {
        return App\Model\system\dsdonvi::where('chucnang', 'NHAPLIEU')->get();
    }else{
        return App\Model\system\dsdonvi::where('madv', session('admin')->madv)->get();
    }
}

function getDoanhNghiepNhapLieu($level, $lvcc){
    if ($level == 'SSA') {
        return App\Model\system\company\Company::wherein('madv', function ($qr) use ($lvcc) {
            $qr->select('madv')->from('companylvcc')->where('manghe', $lvcc);
        })->get();
    } else {
        return App\Model\system\company\Company::where('madv', session('admin')->madv)->get();
    }
}

function getDoanhNghiep($level, $madiaban = null){
    if ($level == 'SSA') {
        return App\Model\system\company\Company::all();
    } elseif (in_array($level, ['X', 'H', 'T'])) {
        return App\Model\system\company\Company::where('madiaban', $madiaban)->get();
    } else {
        return App\Model\system\company\Company::where('madv', session('admin')->madv)->get();
    }
}

function getDonViTimKiem($level, $madiaban = null){
    //Lấy danh sách đơn vị nhập liệu trên địa bàn
    if ($level == 'SSA') {
        return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'NHAPLIEU')->get();
    }else{
        return App\Model\system\view_dsdiaban_donvi::where('madiaban', $madiaban)
            ->where('chucnang', 'NHAPLIEU')->get();
    }
}

function getDonViXetDuyet($level){
    if ($level == 'SSA') {
        return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->get();
    }else{
        return App\Model\system\view_dsdiaban_donvi::where('madv', session('admin')->madv)->get();
    }
}

/*
 * Căn cứ vào lĩnh vực để duyệt user trong nhóm đơn vị tổng hợp
 * nếu User nào có quyền trong lĩnh vực thì thêm đơn vị đó vào danh sách tổng hợp
 * riêng quyền SSA thì ko kiểm tra User (cho trường hợp gửi mà đơn vị đó ko phân quyền)
 * */
function getDonViTongHop($linhvuc, $level, $madiaban = null){
    if ($level == 'SSA') {
        //lấy tất cả đơn vị
        //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->where('level', '<>', 'ADMIN')->get();
        return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->get();
    }
    //mặc định luôn thêm đơn vị tổng hợp toàn tỉnh
    //$ketqua = new Illuminate\Support\Collection();
    $ketqua = App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
        ->where('level', 'ADMIN')->get();

    if ($level == 'T') {
        //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->wherein('level', ['T'])->get();
        $m_donvi = App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
            ->where('level', 'T')->get();
    }else{
        $m_donvi = App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
            ->where(function ($qr) use ($madiaban) {
                $qr->where('level', 'T')
                    ->orwhere('madiaban', $madiaban);
            })->get();
    }

    $m_user = App\Users::wherein('madv',array_column($m_donvi->toarray(),'madv'))->get();
    foreach ($m_user as $user){
        $per = json_decode($user->permission,true);
        if(isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'){
            $ketqua->add($m_donvi->where('madv',$user->madv)->first());
        }
    }
    //dd($ketqua);
    return $ketqua;
    //App\Users
    //})->toSql();
}

function getDonViTongHop_dn($linhvuc, $level, $madiaban = null){
    //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->wherein('level', ['T', 'H'])->get();
    $m_donvi = App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
        ->wherein('level', ['T', 'H'])->get();
    $m_user = App\Users::wherein('madv',array_column($m_donvi->toarray(),'madv'))->get();
    //dd($m_user);
    $ketqua = new Illuminate\Support\Collection();
//    if($linhvuc == 'binhongia'){
//        foreach ($m_user as $user){
//            $per = json_decode($user->permission,true);
//            if(isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'){
//                $ketqua->add($m_donvi->where('madv',$user->madv)->first());
//            }
//        }
//    }else{
        foreach ($m_user as $user){
            $per = json_decode($user->permission,true);
            if(isset($per[$linhvuc]['hoso']['approve']) && $per[$linhvuc]['hoso']['approve'] == '1'){
                $ketqua->add($m_donvi->where('madv',$user->madv)->first());
            }
        }
//    }

    //dd($ketqua);
    return $ketqua;
}

function getDonViCongBo(){
    return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
        ->wherein('level', ['ADMIN'])->get();
}

function getDiaBan_HoSo($m_diaban, $all = false){
    $a_diaban = array_column($m_diaban->toarray(), 'tendiaban', 'madiaban');
    if ($all) {
        $a_kq = ['null' => '-- Chọn địa bàn --'];
        foreach ($a_diaban as $k => $v) {
            $a_kq[$k] = $v;
        }
        return $a_kq;
    }
    return $a_diaban;
}

function getNam($all = false){
    $a_tl = $all == true ? array('all'=>'--Tất cả--') : array();
    for ($i = date('Y') - 3; $i <= date('Y') + 1; $i++) {
        $a_tl[$i] = $i;
    }
    return $a_tl;
}

function getDonViChuyen($macqcq, $hoso){
    $madv = '';
    //dd($hoso);
    if($macqcq == $hoso->macqcq){
        $madv = $hoso->madv;
    }
    if($macqcq == $hoso->macqcq_h){
        $madv = $hoso->madv_h;
    }
    if($macqcq == $hoso->macqcq_t){
        $madv = $hoso->madv_t;
    }
    if($macqcq == $hoso->macqcq_ad){
        $madv = $hoso->madv_ad;
    }
    return $madv;
}

function setDuyetHS($madv, $hoso, $a_hoanthanh)
{
    if ($madv == $hoso->madv) {
        $hoso->trangthai = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan = $a_hoanthanh['ngaynhan'] ?? null;
    }

    if ($madv == $hoso->madv_h) {
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo_h = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan_h = $a_hoanthanh['ngaynhan'] ?? null;
    }

    if ($madv == $hoso->madv_t) {
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo_t = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan_t = $a_hoanthanh['ngaynhan'] ?? null;
    }

    if ($madv == $hoso->madv_ad) {
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CD';
        $hoso->lydo_ad = $a_hoanthanh['lydo'] ?? null;
        $hoso->ngaynhan_ad = $a_hoanthanh['ngaynhan'] ?? null;
    }
}

function setTraLaiDN($macqcq, $hoso, $a_tralai)
{
    //Gán trạng thái của đơn vị chuyển hồ sơ
    if ($macqcq == $hoso->macqcq) {
        $hoso->macqcq = null;
        $hoso->trangthai = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo_h = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo_t = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = $a_tralai['trangthai'] ?? 'CC';
        $hoso->lydo_ad = $a_tralai['lydo'] ?? null;
    }

    //Gán trạng thái của đơn vị tiếp nhận hồ sơ
    if ($macqcq == $hoso->madv_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = null;
        $hoso->lydo_h = null;
        $hoso->ngaynhan_h = null;
        $hoso->ngaychuyen_h = null;
        $hoso->madv_h = null;
    }

    if ($macqcq == $hoso->madv_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = null;
        $hoso->lydo_t = null;
        $hoso->ngaynhan_t = null;
        $hoso->ngaychuyen_t = null;
        $hoso->madv_t = null;
    }

    if ($macqcq == $hoso->madv_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = null;
        $hoso->lydo_ad = null;
        $hoso->ngaynhan_ad = null;
        $hoso->ngaychuyen_ad = null;
        $hoso->madv_ad = null;
    }
}

function setCongBoDN($hoso, $a_hoanthanh)
{
    //chưa set lại trạng thái cho đơn vị cấp dưới ( đơn vị tổng hợp chuyển nên)
    $hoso->ngaynhan_ad = $a_hoanthanh['ngaynhan'] ?? null;
    $hoso->ngaychuyen_ad = $a_hoanthanh['ngaynhan'] ?? null;
    $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    $hoso->madv_ad = $a_hoanthanh['madv'] ?? null;
    if($hoso->macqcq_h == $hoso->madv_ad){
        $hoso->ngaynhan_h = $a_hoanthanh['ngaynhan'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CCB';
    }
    if($hoso->macqcq_t == $hoso->madv_ad){
        $hoso->ngaynhan_t = $a_hoanthanh['ngaynhan'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CCB';
    }
}

function setHoanThanhDV($madv, $hoso, $a_hoanthanh)
{
    if ($madv == $hoso->madv) {
        $hoso->macqcq = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo = $a_hoanthanh['lydo'] ?? null;
    }

    if ($madv == $hoso->madv_h) {
        $hoso->macqcq_h = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo_h = $a_hoanthanh['lydo'] ?? null;
    }

    if ($madv == $hoso->madv_t) {
        $hoso->macqcq_t = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo_t = $a_hoanthanh['lydo'] ?? null;
    }

    if ($madv == $hoso->madv_ad) {
        $hoso->macqcq_ad = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
        $hoso->lydo_ad = $a_hoanthanh['lydo'] ?? null;
    }
}

function setHoanThanhCQ($level, $hoso, $a_hoanthanh)
{
    if ($level == 'T') {
        $hoso->madv_t = $a_hoanthanh['madv'] ?? null;
        $hoso->thoidiem_t = $a_hoanthanh['thoidiem'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'ADMIN') {
        $hoso->madv_ad = $a_hoanthanh['madv'] ?? null;
        $hoso->thoidiem_ad = $a_hoanthanh['thoidiem'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'H') {
        $hoso->madv_h = $a_hoanthanh['madv'] ?? null;
        $hoso->thoidiem_h = $a_hoanthanh['thoidiem'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
    }
}

function setHoanThanhDV_Dat($madv, $hoso, $a_hoanthanh)
{
    if ($madv == $hoso->madv) {
        $hoso->macqcq = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($madv == $hoso->madv_h) {
        $hoso->macqcq_h = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($madv == $hoso->madv_t) {
        $hoso->macqcq_t = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($madv == $hoso->madv_ad) {
        $hoso->macqcq_ad = $a_hoanthanh['macqcq'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    }
}

function setHoanThanhCQ_Dat($level, $hoso, $a_hoanthanh)
{
    if ($level == 'T') {
        $hoso->madv_t = $a_hoanthanh['madv'] ?? null;
        $hoso->trangthai_t = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'ADMIN') {
        $hoso->madv_ad = $a_hoanthanh['madv'] ?? null;
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'] ?? 'CHT';
    }

    if ($level == 'H') {
        $hoso->madv_h = $a_hoanthanh['madv'] ?? null;
        $hoso->trangthai_h = $a_hoanthanh['trangthai'] ?? 'CHT';
    }
}

function setTraLai_Dat($macqcq, $hoso, $a_tralai)
{
    //Gán trạng thái của đơn vị chuyển hồ sơ
    if ($macqcq == $hoso->macqcq) {
        $hoso->macqcq = null;
        $hoso->trangthai = $a_tralai['trangthai'] ?? 'CHT';
    }
    if ($macqcq == $hoso->macqcq_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = $a_tralai['trangthai'] ?? 'CHT';
    }
    if ($macqcq == $hoso->macqcq_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = $a_tralai['trangthai'] ?? 'CHT';
    }
    if ($macqcq == $hoso->macqcq_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = $a_tralai['trangthai'] ?? 'CHT';
    }
    //Gán trạng thái của đơn vị tiếp nhận hồ sơ
    if ($macqcq == $hoso->madv_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = null;
        $hoso->madv_h = null;
    }

    if ($macqcq == $hoso->madv_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = null;
        $hoso->madv_t = null;
    }

    if ($macqcq == $hoso->madv_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = null;
        $hoso->madv_ad = null;
    }
}

function setTraLai($macqcq, $hoso, $a_tralai)
{
    //Gán trạng thái của đơn vị chuyển hồ sơ
    if ($macqcq == $hoso->macqcq) {
        $hoso->macqcq = null;
        $hoso->trangthai = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo_h = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo_t = $a_tralai['lydo'] ?? null;
    }
    if ($macqcq == $hoso->macqcq_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = $a_tralai['trangthai'] ?? 'CHT';
        $hoso->lydo_ad = $a_tralai['lydo'] ?? null;
    }
    //Gán trạng thái của đơn vị tiếp nhận hồ sơ
    if ($macqcq == $hoso->madv_h) {
        $hoso->macqcq_h = null;
        $hoso->trangthai_h = null;
        $hoso->lydo_h = null;
        $hoso->thoidiem_h = null;
        $hoso->madv_h = null;
    }

    if ($macqcq == $hoso->madv_t) {
        $hoso->macqcq_t = null;
        $hoso->trangthai_t = null;
        $hoso->lydo_t = null;
        $hoso->thoidiem_t = null;
        $hoso->madv_t = null;
    }

    if ($macqcq == $hoso->madv_ad) {
        $hoso->macqcq_ad = null;
        $hoso->trangthai_ad = null;
        $hoso->lydo_ad = null;
        $hoso->thoidiem_ad = null;
        $hoso->madv_ad = null;
    }
}

function setCongBo($hoso, $a_congbo){
    $hoso->trangthai_ad = $a_congbo['trangthai'];
    $hoso->congbo = $a_congbo['congbo'];
}

?>