<?php
Route::group(['prefix'=>'giaetanol'],function (){
    Route::get('mathang','manage\giaetanol\GiaEtanolController@index');
    Route::post('mathang/update','manage\giaetanol\GiaEtanolController@update');

    Route::get('danhsach','manage\giaetanol\KkGiaEtanolController@index');
    Route::get('create','manage\giaetanol\KkGiaEtanolController@create');
    Route::post('create','manage\giaetanol\KkGiaEtanolController@store');
    Route::get('modify','manage\giaetanol\KkGiaEtanolController@edit');
    Route::get('xemhoso','manage\giaetanol\KkGiaEtanolController@show');
    Route::post('delete','manage\giaetanol\KkGiaEtanolController@destroy');
    Route::get('timkiem','manage\giaetanol\KkGiaEtanolController@timkiem');
    Route::post('timkiem','manage\giaetanol\KkGiaEtanolController@ketquatk');

    Route::get('xetduyet','manage\giaetanol\KkGiaEtanolXdController@xetduyet');
    Route::get('kiemtra','manage\giaetanol\KkGiaEtanolXdController@kiemtra');
    Route::post('chuyenhs','manage\giaetanol\KkGiaEtanolXdController@chuyenhs');
    Route::get('get_sohs','manage\giaetanol\KkGiaEtanolXdController@get_sohs');
    Route::post('duyeths','manage\giaetanol\KkGiaEtanolXdController@duyeths');
    Route::post('chuyenxd','manage\giaetanol\KkGiaEtanolXdController@chuyenxd');
    Route::post('tralai','manage\giaetanol\KkGiaEtanolXdController@tralai');
    Route::post('congbo','manage\giaetanol\KkGiaEtanolXdController@congbo');

    Route::get('baocao','manage\giaetanol\KkGiaEtanolBcController@index');
    Route::post('bc1','manage\giaetanol\KkGiaEtanolBcController@bc1');
    Route::post('bc2','manage\giaetanol\KkGiaEtanolBcController@bc2');

    Route::get('store_ct','manage\giaetanol\KkGiaEtanolCtController@store');
    Route::get('show_ct','manage\giaetanol\KkGiaEtanolCtController@show');
    Route::get('del_ct','manage\giaetanol\KkGiaEtanolCtController@destroy');


});