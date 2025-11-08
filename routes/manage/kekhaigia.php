<?php

use App\Http\Controllers\manage\kekhaigia\TtDnTdCtController;
use App\Http\Controllers\system\company\CompanyController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'doanhnghiep'], function () {
    Route::get('danhsach', [CompanyController::class, 'ttdn']);
    Route::get('modify', 'system\company\CompanyController@ttdnedit');
    Route::post('store', 'system\company\CompanyController@ttdnupdate');
    Route::get('thaydoi', 'system\company\CompanyController@thaydoi');
    Route::get('chuyenhs', 'system\company\CompanyController@ttdnchuyen');

    Route::get('ThemNganhNghe', [TtDnTdCtController::class,'store']);
    Route::post('ThemNganhNghe', [TtDnTdCtController::class,'store']);
    Route::get('delete_ct', 'manage\kekhaigia\TtDnTdCtController@delete');

    Route::get('xetduyet', 'system\company\CompanyController@xetduyet');
    Route::get('chitiet', 'system\company\CompanyController@chitiet');
    Route::post('tralai', 'system\company\CompanyController@tralai');
    //
    Route::get('thongtindoanhnghiep', 'system\company\CompanyController@ttdn');
    Route::get('thongtindoanhnghiep/{id}/edit', 'system\company\CompanyController@ttdnedit');
    Route::get('thongtindoanhnghiep/{id}/chinhsua', 'system\company\CompanyController@ttdnchinhsua');
    Route::patch('thongtindoanhnghiep/df/{id}', 'system\company\CompanyController@ttdncapnhat');
    Route::post('thongtindoanhnghiep/upavatar', 'system\company\CompanyController@upavatar');

    Route::get('dangky', 'Auth\RegisterController@create');
    Route::post('themdn', 'Auth\RegisterController@store');

    // Route::get('get_dvql', 'system\company\CompanyLvCcController@getdvql');
    Route::get('getLVKD', 'system\company\CompanyLvCcController@edit');
    Route::post('addLVKD', 'system\company\CompanyLvCcController@store');
    Route::get('addLVKD', 'system\company\CompanyLvCcController@store');
    Route::get('delLVKD', 'system\company\CompanyLvCcController@delete');

    //Route::get('companylvcc/update','system\company\CompanyLvCcController@update');

    Route::post('dangkytaikhoantruycap', 'Auth\RegisterController@store');
    Route::patch('dangkytaikhoantruycap/{id}/update', 'Auth\RegisterController@update');
    Route::get('dangkytaikhoantruycap/checkmadangky', 'Auth\RegisterController@submitcheckmadk');
    //Route::post('dangkytaikhoantruycap/checkmadangky','Auth\RegisterController@submitcheckmadk');
    //Route::get('companylvcc/getmanghe','system\company\CompanyLvCcController@getmanghe');

    Route::get('dsdangky', 'system\company\CompanyController@dsdangky');
    Route::get('dstaikhoan', 'UsersCompanyController@index');
    Route::get('dstaikhoan/create', 'UsersCompanyController@create');
    Route::post('dstaikhoan/store', 'UsersCompanyController@store');
    Route::get('dstaikhoan/edit', 'UsersCompanyController@edit');
    Route::post('dstaikhoan/edit', 'UsersCompanyController@update');
    Route::post('dstaikhoan/delete', 'UsersCompanyController@destroy');
});

//Đăng ký tài khoản
Route::group(['prefix' => 'dangky'], function () {
    Route::get('danhsach', 'Auth\RegisterController@index');
    Route::get('modify', 'Auth\RegisterController@show');
    Route::post('tralai', 'Auth\RegisterController@tralai');
    Route::post('kichhoat', 'Auth\RegisterController@kichhoat');
});

Route::group(['prefix' => 'kkgiand85'], function () {
    Route::get('danhsach', 'manage\kekhaigia\KkGiaNd85Controller@index');
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
