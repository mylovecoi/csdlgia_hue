<?php


Route::group(['prefix'=>'doanhnghiep'],function (){
    Route::get('danhsach','system\company\CompanyController@ttdn');
    Route::get('modify','system\company\CompanyController@ttdnedit');
    Route::post('store','system\company\CompanyController@ttdnupdate');
    Route::get('thaydoi','system\company\CompanyController@thaydoi');
    Route::get('chuyenhs','system\company\CompanyController@ttdnchuyen');

    Route::get('store_ct','manage\kekhaigia\TtDnTdCtController@store');
    Route::get('delete_ct','manage\kekhaigia\TtDnTdCtController@delete');

    Route::get('xetduyet','system\company\CompanyController@xetduyet');
    Route::get('chitiet','system\company\CompanyController@chitiet');
    //
    Route::get('thongtindoanhnghiep','system\company\CompanyController@ttdn');
    Route::get('thongtindoanhnghiep/{id}/edit','system\company\CompanyController@ttdnedit');

    Route::get('thongtindoanhnghiep/{id}/chinhsua','system\company\CompanyController@ttdnchinhsua');
    Route::patch('thongtindoanhnghiep/df/{id}','system\company\CompanyController@ttdncapnhat');

    Route::post('thongtindoanhnghiep/upavatar','system\company\CompanyController@upavatar');

});
//DVLT
include('kkgia/dvlt.php');

//DVGS
include('kkgia/tpcnte6t.php');

//TACN
include('kkgia/tacn.php');

//VTXK
include('kkgia/vtxk.php');

//VTXTX
include('kkgia/vtxtx.php');

//VTXB
include('kkgia/vtxb.php');

//VLXD
include('kkgia/vlxd.php');

//Cước vận chuyển hành khách
include('kkgia/cuocvchk.php');

//Đăng ký giá
include('kkgia/dkg.php');

//XMTXD
include('kkgia/xmtxd.php');

//dvhdtm
include('kkgia/dvhdtm.php');

//Than
include('kkgia/than.php');

//Giấy in, viết
include('kkgia/giay.php');

//Sách giáo khoa
include('kkgia/sach.php');

//Etanol
include('kkgia/etanol.php');

//Khám chữa bệnh tư nhân
include('kkgia/kcbtn.php');

//Dịch vụ cảng biển
include('kkgia/dvcb.php');

//Oto nhập khẩu, sx trong nước
include('kkgia/otonksxtn.php');

//Xe gắn máy nhập khẩu, sx trong nước
include('kkgia/xemaynksxtn.php');

//Dịch vụ du lịch bãi biển
include('kkgia/dvdlbb.php');

//Vé tham quan tại khu du lịch
include('kkgia/vetqkdl.php');

//Dịch vụ ca huế trên sông hương
include('kkgia/dvch.php');

//Học phí lái xe
include('kkgia/hplx.php');

//Vật liệu xây dựng: cát,sạn
include('kkgia/catsan.php');

//Vật liệu xây dựng: đất san lấp
include('kkgia/datsanlap.php');

//Vật liệu xây dựng: đá xây dựng
include('kkgia/daxaydung.php');
?>