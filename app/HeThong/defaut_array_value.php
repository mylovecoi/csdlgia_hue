<?php

use App\Model\system\view_dsdiaban_donvi;

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

function getDiaBan_Level($level, $madiaban = null)
{
    if (in_array($level, ['SSA', 'T', 'ADMIN'])) {
        return array_column(App\Model\system\dsdiaban::wherein('level', ['T', 'H', 'ADMIN'])->get()->toarray(),
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

function getDonViXetDuyet($level){
    if ($level == 'SSA') {
        return App\Model\system\dsdonvi::where('chucnang', 'TONGHOP')->get();
    }else{
        return App\Model\system\dsdonvi::where('madv', session('admin')->madv)->get();
    }
}

function getDonViTongHop($linhvuc, $level, $madiaban = null)
{
    //chưa làm biến lĩnh vực
    if ($level == 'SSA') {
        //lấy tất cả đơn vị
        //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->where('level', '<>', 'ADMIN')->get();
        return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->get();
    }
    if ($level == 'T') {
        //return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->wherein('level', ['T'])->get();
        return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')
            ->wherein('level', ['T', 'ADMIN'])->get();
    }

    return App\Model\system\view_dsdiaban_donvi::where('chucnang', 'TONGHOP')->where(function ($qr) use ($madiaban) {
        $qr->wherein('level', ['T', 'ADMIN'])->orwhere('madiaban', $madiaban);
    })->get();
    //})->toSql();
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
function setHoanThanhDV($madv, $hoso, $a_hoanthanh)
{
    if ($madv == $hoso->madv) {
        $hoso->macqcq = $a_hoanthanh['macqcq'];
        $hoso->trangthai = $a_hoanthanh['trangthai'];
    }

    if ($madv == $hoso->madv_h) {
        $hoso->macqcq_h = $a_hoanthanh['macqcq'];
        $hoso->trangthai_h = $a_hoanthanh['trangthai'];
    }

    if ($madv == $hoso->madv_t) {
        $hoso->macqcq_t = $a_hoanthanh['macqcq'];
        $hoso->trangthai_t = $a_hoanthanh['trangthai'];
    }

    if ($madv == $hoso->madv_ad) {
        $hoso->macqcq_ad = $a_hoanthanh['macqcq'];
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'];
    }
}

function setHoanThanhCQ($level, $hoso, $a_hoanthanh)
{
    if ($level == 'T') {
        $hoso->madv_t = $a_hoanthanh['madv'];
        $hoso->thoidiem_t = $a_hoanthanh['thoidiem'];
        $hoso->trangthai_t = $a_hoanthanh['trangthai'];;
    }

    if ($level == 'ADMIN') {
        $hoso->madv_ad = $a_hoanthanh['madv'];
        $hoso->thoidiem_ad = $a_hoanthanh['thoidiem'];
        $hoso->trangthai_ad = $a_hoanthanh['trangthai'];
    }

    if ($level == 'H') {
        $hoso->madv_h = $a_hoanthanh['madv'];
        $hoso->thoidiem_h = $a_hoanthanh['thoidiem'];
        $hoso->trangthai_h = $a_hoanthanh['trangthai'];
    }
}
?>