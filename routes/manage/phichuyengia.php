<?php
//Giá Nước sạch sinh hoạt
Route::group(['prefix'=>'phichuyengia'], function (){
    Route::get('danhmuc','manage\phichuyengia\nhomphichuyengiaController@index');
    Route::post('nhomdm','manage\phichuyengia\nhomphichuyengiaController@store');
    Route::get('show_nhomdm','manage\phichuyengia\nhomphichuyengiaController@show_nhomdm');
    Route::post('delete_nhomdm','manage\phichuyengia\nhomphichuyengiaController@destroy');

    Route::get('danhmuc/detail','manage\phichuyengia\dmphichuyengiaController@index');
    Route::post('dm','manage\phichuyengia\dmphichuyengiaController@store');
    Route::get('show_dm','manage\phichuyengia\dmphichuyengiaController@edit');
    Route::post('delete_dm','manage\phichuyengia\dmphichuyengiaController@destroy');

    Route::get('get_ct','manage\phichuyengia\phichuyengiactController@show');
    Route::get('store_ct','manage\phichuyengia\phichuyengiactController@store');
    Route::get('delete_ct','manage\phichuyengia\phichuyengiactController@destroy');

    Route::get('danhsach','manage\phichuyengia\phichuyengiaController@index');
    Route::get('new','manage\phichuyengia\phichuyengiaController@create');
    Route::get('modify','manage\phichuyengia\phichuyengiaController@edit');
    Route::post('modify','manage\phichuyengia\phichuyengiaController@update');
    Route::get('dinhkem','manage\phichuyengia\phichuyengiaController@show');

    Route::post('delete','manage\phichuyengia\phichuyengiaController@destroy');
    Route::post('chuyenhs','manage\phichuyengia\phichuyengiaController@chuyenhs');
    //
    Route::get('xetduyet','manage\phichuyengia\phichuyengiaController@xetduyet');
    Route::post('chuyenxd','manage\phichuyengia\phichuyengiaController@chuyenxd');
    Route::post('tralai','manage\phichuyengia\phichuyengiaController@tralai');
    Route::post('congbo','manage\phichuyengia\phichuyengiaController@congbo');

    //Route::get('nhandulieutuexcel','manage\giarung\GiaNuocShController@nhandulieutuexcel');
    //Route::post('importexcel','manage\giarung\GiaNuocShController@importexcel');

    Route::get('timkiem','manage\phichuyengia\phichuyengiaController@timkiem');
    Route::post('timkiem','manage\phichuyengia\phichuyengiaController@ketquatk');
    Route::get('prints','manage\phichuyengia\phichuyengiaController@ketxuat');
});
?>