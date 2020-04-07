<?php
Route::group(['prefix'=>'binhongia'],function (){
    Route::get('mathang','manage\binhongia\MatHangBogController@index');
    Route::post('mathang/update','manage\binhongia\MatHangBogController@update');

    Route::get('store_ct','manage\binhongia\KkMhBogCtController@store');
    Route::get('show_ct','manage\binhongia\KkMhBogCtController@show');
    Route::get('del_ct','manage\binhongia\KkMhBogCtController@destroy');

    Route::get('danhsach','manage\binhongia\KkMhBogController@index');
    Route::get('create','manage\binhongia\KkMhBogController@create');
    Route::post('create','manage\binhongia\KkMhBogController@store');
    Route::get('modify','manage\binhongia\KkMhBogController@edit');
    Route::get('xemhoso','manage\binhongia\KkMhBogController@show');
    Route::post('delete','manage\binhongia\KkMhBogController@destroy');

    Route::get('kiemtra','manage\binhongia\KkMhBogXdController@kiemtra');
    Route::post('chuyenhs','manage\binhongia\KkMhBogXdController@chuyenhs');
    Route::get('get_sohs','manage\binhongia\KkMhBogXdController@get_sohs');
    Route::post('duyeths','manage\binhongia\KkMhBogXdController@duyeths');
    Route::get('xetduyet','manage\binhongia\KkMhBogXdController@xetduyet');
    Route::post('chuyenxd','manage\binhongia\KkMhBogXdController@chuyenxd');
    Route::post('tralai','manage\binhongia\KkMhBogXdController@tralai');
    Route::post('congbo','manage\binhongia\KkMhBogXdController@congbo');

    Route::get('timkiem','manage\binhongia\KkMhBogController@timkiem');
    Route::post('timkiem','manage\binhongia\KkMhBogController@ketquatk');

    Route::get('baocao','manage\binhongia\KkMhBogBcController@index');
    Route::post('bc1','manage\binhongia\KkMhBogBcController@bc1');
    Route::post('bc2','manage\binhongia\KkMhBogBcController@bc2');
});
/* 20.03.2020
Route::resource('dmmhbinhongia','DmMhBinhOnGiaController');
Route::get('dmmhbinhongia/edittt','DmMhBinhOnGiaController@show');
Route::post('dmmhbinhongia/update','DmMhBinhOnGiaController@update');
Route::post('dmmhbinhongia/delete','DmMhBinhOnGiaController@destroy');

Route::resource('binhongia','BinhOnGiaController');
Route::post('binhongia/delete','BinhOnGiaController@destroy');
Route::post('binhongia/hoanthanh','BinhOnGiaController@hoanthanh');
Route::post('binhongia/huyhoanthanh','BinhOnGiaController@huyhoanthanh');
Route::post('binhongia/congbo','BinhOnGiaController@congbo');

Route::get('timkiemthongtinbog','BinhOnGiaController@search');

Route::get('binhongiactdf/add','BinhOnGiaCtDfController@add');
Route::get('binhongiactdf/show','BinhOnGiaCtDfController@show');
Route::get('binhongiactdf/update','BinhOnGiaCtDfController@update');
Route::get('binhongiactdf/del','BinhOnGiaCtDfController@destroy');

Route::get('/binhongiact/store','BinhOnGiaCtController@store');
Route::get('/binhongiact/show','BinhOnGiaCtController@show');
Route::get('/binhongiact/update','BinhOnGiaCtController@update');
Route::get('/binhongiact/del','BinhOnGiaCtController@destroy');

//Doanh nghiệp
//Route::resource('dsthongtindn','DangKyGiaBOGController@indexdnbog');
//Route::get('createdn/create','DangKyGiaBOGController@create');
//Route::post('storednbog','DangKyGiaBOGController@storednbog');
//Route::get('editdnbog/{id}/edit','DangKyGiaBOGController@showdnbog');
//Route::post('updatednbog','DangKyGiaBOGController@updatednbog');
//Route::post('deletednbog','DangKyGiaBOGController@destroydnbog');
//Route::get('adduser','DangKyGiaBOGController@createuser');
//Route::post('storeuser','DangKyGiaBOGController@storeuser');

//Đăng ký giá
Route::resource('hosodkgbog','DangKyGiaBOGController');
Route::get('thongtindndkgbog','DangKyGiaBOGController@ttdn');
Route::post('hosodkgbog/delete','DangKyGiaBOGController@destroy');
Route::post('chuyen','DangKyGiaBOGController@chuyen');


//Nhập mặt hàng nháp
Route::get('createdkg/add','DangKyGiaBOGDfController@add');
Route::get('createdkg/show','DangKyGiaBOGDfController@show');
Route::get('createdkg/update','DangKyGiaBOGDfController@update');
Route::get('createdkg/del','DangKyGiaBOGDfController@destroy');
//Nhập mặt hàng chi tiết
Route::get('/createdkgct/add','DangKyGiaBOGCtController@store');
Route::get('/createdkgct/show','DangKyGiaBOGCtController@show');
Route::get('/createdkgct/update','DangKyGiaBOGCtController@update');
Route::get('/createdkgct/del','DangKyGiaBOGCtController@destroy');
//Tìm kiếm
Route::get('timkiem','DangKyGiaBOGController@indexdkgtk');
//Báo cáo
Route::get('baocaodkg','BaoCaoDkgController@index');
Route::get('baocaodkg/BcMhBog','BaoCaoDkgController@BcMhBog');
Route::get('baocao/{id}/Bc1','BaoCaoDkgController@BC1');
*/
?>
