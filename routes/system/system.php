<?php
use Illuminate\Support\Facades\Route;

Route::resource('general','GeneralConfigsController');
Route::get('setting','GeneralConfigsController@setting');
Route::post('setting','GeneralConfigsController@updatesetting');
Route::post('setting_gr','GeneralConfigsController@updatesetting_gr');

Route::group(['prefix'=>'diaban'], function(){
    Route::get('danhsach','system\dsdiabanController@index');
    Route::post('modify','system\dsdiabanController@modify');
    Route::post('delete','system\dsdiabanController@delete');
});

Route::group(['prefix'=>'xaphuong'], function(){
    Route::get('danhsach','system\dsxaphuongController@index');
    Route::post('modify','system\dsxaphuongController@modify');
    Route::post('delete','system\dsxaphuongController@delete');
});

Route::group(['prefix'=>'donvi'], function(){
    Route::get('danhsach', 'system\dsdonviController@index');
    Route::get('create', 'system\dsdonviController@create');
    Route::post('store', 'system\dsdonviController@store');
    Route::get('modify', 'system\dsdonviController@modify');
    Route::post('update', 'system\dsdonviController@update');
    Route::post('delete','system\dsdonviController@delete');
});

Route::group(['prefix'=>'dmdvt'], function(){
    Route::get('danhsach', 'system\dmdvtController@index');
    Route::get('create', 'system\dmdvtController@create');
    Route::post('store', 'system\dmdvtController@store');
    Route::get('modify', 'system\dmdvtController@modify');
    Route::post('update', 'system\dmdvtController@update');
    Route::post('delete','system\dmdvtController@delete');
    Route::post('delete_all','system\dmdvtController@delete_all');
    Route::post('nhanexcel','system\dmdvtController@create_excel');
});

Route::group(['prefix'=>'nhomtaikhoan'],function(){
    Route::get('danhsach', 'system\dsnhomtaikhoanController@index');
    Route::post('store', 'system\dsnhomtaikhoanController@store');
    Route::get('get_tk', 'system\dsnhomtaikhoanController@edit');
    Route::post('delete','system\dsnhomtaikhoanController@delete');

    Route::get('perm', 'system\dsnhomtaikhoanController@permission');
    Route::post('perm', 'system\dsnhomtaikhoanController@store_perm');
    Route::get('get_perm', 'system\dsnhomtaikhoanController@get_perm');
    Route::post('set_perm_user', 'system\dsnhomtaikhoanController@set_perm_user');
});

Route::group(['prefix'=>'taikhoan'],function(){
    Route::get('danhsach', 'system\dstaikhoanController@index');
    Route::get('create', 'system\dstaikhoanController@create');
    Route::post('store', 'system\dstaikhoanController@store');
    Route::get('copy', 'system\dstaikhoanController@copy');
    Route::post('copy', 'system\dstaikhoanController@store_copy');
    Route::get('modify', 'system\dstaikhoanController@modify');
    Route::post('modify', 'system\dstaikhoanController@update');
    Route::post('delete','system\dstaikhoanController@delete');

    Route::get('perm', 'system\dstaikhoanController@permission');
    Route::post('perm', 'system\dstaikhoanController@store_perm');
    Route::get('get_perm', 'system\dstaikhoanController@get_perm');

    Route::post('perm_group', 'system\dstaikhoanController@store_perm_group');
});

Route::group(['prefix'=>'dmloaidat'], function(){
    Route::get('', 'system\GiaDatDiaBanDmController@index');
    Route::post('modify', 'system\GiaDatDiaBanDmController@store');
    Route::post('delete','system\GiaDatDiaBanDmController@destroy');
});

//Route::resource('district','DistrictController');
//Route::resource('town','TownController');

Route::get('company','system\company\CompanyController@index');
Route::get('company/create','system\company\CompanyController@create');
Route::post('company','system\company\CompanyController@store');
Route::get('company/{id}/edit','system\company\CompanyController@edit');
Route::patch('company/{id}','system\company\CompanyController@update');

//Route::resource('xetduyet_thaydoi_ttdoanhnghiep','XdTdTtDnController');
//Route::post('xetduyet_thaydoi_ttdoanhnghiep/tralai','XdTdTtDnController@tralai');
//Route::get('xetduyet_thaydoi_ttdoanhnghiep/{id}/duyet','XdTdTtDnController@duyet');

Route::resource('danhmucdiadanh','DiaBanHdController');
Route::post('danhmucdiadanh/delete','DiaBanHdController@destroy');

//Users
Route::get('login','UsersController@login');
Route::post('signin','UsersController@signin');
Route::get('/change-password','UsersController@cp');
Route::post('/change-password','UsersController@cpw');
Route::get('/user_setting','UsersController@settinguser');
Route::post('/user_setting','UsersController@settinguserw');
Route::get('/checkpass','UsersController@checkpass');
Route::get('/checkuser','UsersController@checkuser');
Route::get('/checkmasothue','UsersController@checkmasothue');
Route::get('logout','UsersController@logout');
Route::get('users','UsersController@index');
Route::get('users/{id}/edit','UsersController@edit');
Route::patch('users/{id}','UsersController@update');
Route::get('users/{id}/phan-quyen','UsersController@permission');
Route::post('users/phan-quyen','UsersController@uppermission');
Route::post('users/delete','UsersController@destroy');
Route::get('users/lock/{id}/{pl}','UsersController@lockuser');
Route::get('users/unlock/{id}/{pl}','UsersController@unlockuser');
Route::get('users/create','UsersController@create');
Route::post('users','UsersController@store');
Route::get('users/{id}/copy','UsersController@copy');

Route::get('users/print','UsersController@prints');

Route::resource('xetduyettdttdn','TdTtDnController');
Route::post('xetduyettdttdn/tralai','TdTtDnController@tralai');
Route::get('xetduyettdttdn/{id}/duyet','TdTtDnController@duyet');

Route::resource('thongtinngaynghile','NgayNghiLeController');
Route::post('thongtinngaynghile/delete','NgayNghiLeController@destroy');

//Route::resource('userscompany','UsersCompanyController');
//Route::get('userscompany/{id}/permission','UsersCompanyController@permission');
Route::post('userscompany/phan-quyen','UsersCompanyController@uppermission');
//EndUsers
Route::get('thongtindonvi','ThongTinDonViController@index');
Route::get('thongtindonvi/edit','ThongTinDonViController@edit');
Route::post('thongtindonvi','ThongTinDonViController@update');

//Danh mục nhóm hàng hóa cho Giá HHDV khác
Route::group(['prefix'=>'dmnhomhh'],function (){
    Route::get('danhsach','system\DmNhomHangHoaController@index');
    Route::post('danhsach', 'system\DmNhomHangHoaController@store');
    Route::get('show_dm', 'system\DmNhomHangHoaController@show');
});

//Danh mục ngành nghề
Route::group(['prefix'=>'dmnganhnghe'],function (){
    Route::get('danhsach','system\dmnganhnghekd\DmNganhKdController@index');
    Route::get('get_hs','system\dmnganhnghekd\DmNganhKdController@edit');
    Route::post('store','system\dmnganhnghekd\DmNganhKdController@store');

    Route::get('chitiet','system\dmnganhnghekd\DmNgheKdController@index');
    Route::get('chitiet/edit','system\dmnganhnghekd\DmNgheKdController@edit');
    Route::post('chitiet/store','system\dmnganhnghekd\DmNgheKdController@store');
});

Route::get('ajax/checkuser','AjaxController@checkusername');
Route::get('ajax/checkmasothue','AjaxController@checkmasothue');
Route::get('searchtkdangky','Auth\RegisterController@searchindex');
Route::post('searchtkdangky','Auth\RegisterController@search');
Route::get('ajax/get_dvtonghop_diaban','AjaxController@get_dvtonghop_diaban');

//Danh sách chức năng
Route::group(['prefix'=>'chucnang'],function (){
    Route::get('danhsach','system\danhmucchucnangController@index');
    Route::get('get_chucnang','system\danhmucchucnangController@edit');
    Route::post('store','system\danhmucchucnangController@store');
    Route::post('delete','system\danhmucchucnangController@destroy');
});

//Văn phòng hỗ trợ
Route::group(['prefix'=>'vanphonghotro'],function (){
    Route::get('danhsach','system\dsvanphongController@index');
    Route::get('get_chucnang','system\dsvanphongController@edit');
    Route::post('store','system\dsvanphongController@store');
    Route::post('delete','system\dsvanphongController@destroy');
});

//Thiết lập kết nôi API

Route::group(['prefix'=>'KetNoiAPI'],function (){
    Route::get('ThietLapChung','Api\APIController@ThietLapChung');
    Route::post('LuuChung','Api\APIController@LuuChung');
    Route::get('LayTLChung','Api\APIController@LayTLChung');
    Route::post('XoaTLChung','Api\APIController@XoaTLChung');
    Route::post('LinkKetNoi','Api\APIController@LinkKetNoi');
    Route::get('getLink','Api\APIController@getLink');
    
    //Chi tiết
    Route::get('ThietLapChiTiet','Api\APIController@ThietLapChiTiet');
    Route::get('HoSo','Api\APIController@ThietLapHoSo');
    Route::post('LuuHoSo','Api\APIController@LuuHoSo');
    Route::post('LuuHoSoChiTiet','Api\APIController@LuuHoSoChiTiet');
    Route::get('LayHoSo','Api\APIController@LayHoSo');
    Route::get('LayHoSoChiTiet','Api\APIController@LayHoSoChiTiet');
    Route::post('XoaHoSo','Api\APIController@XoaHoSo');
    Route::post('XoaHoSoChiTiet','Api\APIController@XoaHoSoChiTiet');

    Route::post('MacDinh','Api\APIController@MacDinh');
    Route::get('DanhSachKetNoi','Api\APIController@DanhSachKetNoi');
    
    //Truyền hồ sơ
    Route::post('TruyenHoSo','_dungchung\KetNoiCSDLQuocGiaController@send_post');
    Route::get('XemHoSo','_dungchung\KetNoiCSDLQuocGiaController@XemHoSo');
});

Route::group(['prefix'=>'tinhuyenxa'], function(){
    Route::get('danhsach', 'system\dmtinhhuyenxaController@index');
    Route::get('create', 'system\dmtinhhuyenxaController@create');
    Route::post('store', 'system\dmtinhhuyenxaController@store');
    Route::get('modify', 'system\dmtinhhuyenxaController@modify');
    Route::post('update', 'system\dmtinhhuyenxaController@update');
    Route::post('delete','system\dmtinhhuyenxaController@delete');
    Route::post('delete_all','system\dmtinhhuyenxaController@delete_all');
    Route::post('nhanexcel','system\dmtinhhuyenxaController@create_excel');
});