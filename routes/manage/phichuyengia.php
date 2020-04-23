<?php
//Giá Nước sạch sinh hoạt
Route::group(['prefix'=>'phichuyengia'], function (){
    Route::get('danhmuc','manage\phichuyengia\dmphichuyengiaController@index');
    Route::post('danhmuc','manage\phichuyengia\dmphichuyengiaController@store');
    Route::get('show_dm','manage\phichuyengia\dmphichuyengiaController@edit');
    Route::post('delete_dm','manage\phichuyengia\dmphichuyengiaController@destroy');

    Route::get('get_ct','manage\phichuyengia\phichuyengiactController@show');
    Route::get('store_ct','manage\phichuyengia\phichuyengiactController@store');
    Route::get('delete_ct','manage\phichuyengia\phichuyengiactController@destroy');

    Route::get('danhsach','manage\phichuyengia\phichuyengiaController@index');
    Route::get('new','manage\phichuyengia\phichuyengiaController@create');
    Route::get('modify','manage\phichuyengia\phichuyengiaController@edit');
    Route::post('modify','manage\phichuyengia\phichuyengiaController@update');

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