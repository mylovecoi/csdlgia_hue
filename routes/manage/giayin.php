<?php
Route::group(['prefix'=>'giayin'],function (){
    Route::get('mathang','manage\giayin\GiayInController@index');
    Route::post('mathang/update','manage\giayin\GiayInController@update');

    Route::get('danhsach','manage\giayin\KkGiayInController@index');
    Route::get('create','manage\giayin\KkGiayInController@create');
    Route::post('create','manage\giayin\KkGiayInController@store');
    Route::get('modify','manage\giayin\KkGiayInController@edit');
    Route::get('xemhoso','manage\giayin\KkGiayInController@show');
    Route::post('delete','manage\giayin\KkGiayInController@destroy');
    Route::get('timkiem','manage\giayin\KkGiayInController@timkiem');
    Route::post('timkiem','manage\giayin\KkGiayInController@ketquatk');

    Route::get('xetduyet','manage\giayin\KkGiayInXdController@xetduyet');
    Route::get('kiemtra','manage\giayin\KkGiayInXdController@kiemtra');
    Route::post('chuyenhs','manage\giayin\KkGiayInXdController@chuyenhs');
    Route::get('get_sohs','manage\giayin\KkGiayInXdController@get_sohs');
    Route::post('duyeths','manage\giayin\KkGiayInXdController@duyeths');
    Route::post('chuyenxd','manage\giayin\KkGiayInXdController@chuyenxd');
    Route::post('tralai','manage\giayin\KkGiayInXdController@tralai');
    Route::post('congbo','manage\giayin\KkGiayInXdController@congbo');

    Route::get('baocao','manage\giayin\KkGiayInBcController@index');
    Route::post('bc1','manage\giayin\KkGiayInBcController@bc1');
    Route::post('bc2','manage\giayin\KkGiayInBcController@bc2');

    Route::get('store_ct','manage\giayin\KkGiayInCtController@store');
    Route::get('show_ct','manage\giayin\KkGiayInCtController@show');
    Route::get('del_ct','manage\giayin\KkGiayInCtController@destroy');


});