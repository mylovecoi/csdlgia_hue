<?php
    /*Route::resource('danhmucvatlieuxaydung', 'manage\kekhaigia\kkgiavlxd\DmVlXdController');
    Route::post('danhmucvatlieuxaydung/update', 'manage\kekhaigia\kkgiavlxd\DmVlXdController@update');*/

    Route::get('kekhaigiavlxd','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@index');
    Route::get('kekhaigiavlxd/create','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@create');
    Route::post('kekhaigiavlxd/store','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@store');
    Route::get('kekhaigiavlxd/edit','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@edit');
    Route::get('kekhaigiavlxd/prints','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@show');

    Route::get('kekhaigiavlxd/kiemtra','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@kiemtra');
    Route::post('kekhaigiavlxd/chuyen','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@chuyen');
    Route::get('kekhaigiavlxd/get_sohs','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@showlydo');
    Route::post('kekhaigiavlxd/delete','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@delete');

    Route::get('/kkvlxd/showlydo','manage\kekhaigia\kkgiavlxd\KkGiaVlXdController@showlydo');

    Route::get('/giavlxdct/storett','manage\kekhaigia\kkgiavlxd\KkGiaVlXdCtController@store');
    Route::get('/giavlxdct/edittt','manage\kekhaigia\kkgiavlxd\KkGiaVlXdCtController@edit');
    Route::get('/giavlxdct/updatett','manage\kekhaigia\kkgiavlxd\KkGiaVlXdCtController@update');
    Route::get('/giavlxdct/deletett','manage\kekhaigia\kkgiavlxd\KkGiaVlXdCtController@delete');

    Route::get('xetduyetkkgiavlxd','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@index');
    Route::post('xetduyetkkgiavlxd/tralai','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@tralai');
    Route::get('xetduyetkkgiavlxd/ttnhanhs','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@ttnhanhs');
    Route::post('xetduyetkkgiavlxd/nhanhs','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@nhanhs');
    Route::post('xetduyetkkgiavlxd/chuyenxd','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@chuyenxd');
    Route::post('xetduyetkkgiavlxd/congbo','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@congbo');
    //Ajax xd
    Route::get('/ttdnvlxd','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@ttdnvlxd');

    Route::get('timkiemkkgiavlxd','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@search');
    Route::get('timkiemkkgiavlxd/printf','manage\kekhaigia\kkgiavlxd\KkGiaVlXdXdController@printf');

    Route::get('baocaokkgiavlxd','manage\kekhaigia\kkgiavlxd\KkGiaVlXdBcController@index');
    Route::post('baocaokkgiavlxd/bc1','manage\kekhaigia\kkgiavlxd\KkGiaVlXdBcController@bc1');
    Route::post('baocaokkgiavlxd/bc2','manage\kekhaigia\kkgiavlxd\KkGiaVlXdBcController@bc2');

?>