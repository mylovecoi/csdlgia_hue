<?php
//Giá Nước sạch sinh hoạt
Route::group(['prefix'=>'phichuyengia'], function (){
    Route::get('danhmuc','manage\gianuocsachsh\DmGiaNuocSachShController@index');
    Route::post('danhmuc','manage\gianuocsachsh\DmGiaNuocSachShController@store');
    Route::get('show_dm','manage\gianuocsachsh\DmGiaNuocSachShController@edit');
    Route::post('delete_dm','manage\gianuocsachsh\DmGiaNuocSachShController@destroy');

    Route::get('danhsach','manage\gianuocsachsh\GiaNuocShController@index');
    Route::get('new','manage\gianuocsachsh\GiaNuocShController@create');
    Route::get('modify','manage\gianuocsachsh\GiaNuocShController@edit');
    Route::post('modify','manage\gianuocsachsh\GiaNuocShController@update');

    Route::post('delete','manage\gianuocsachsh\GiaNuocShController@destroy');
    Route::post('chuyenhs','manage\gianuocsachsh\GiaNuocShController@chuyenhs');

    Route::get('xetduyet','manage\gianuocsachsh\GiaNuocShController@xetduyet');
    Route::post('chuyenxd','manage\gianuocsachsh\GiaNuocShController@chuyenxd');
    Route::post('tralai','manage\gianuocsachsh\GiaNuocShController@tralai');
    Route::post('congbo','manage\gianuocsachsh\GiaNuocShController@congbo');

    Route::get('nhandulieutuexcel','manage\giarung\GiaNuocShController@nhandulieutuexcel');
    Route::post('importexcel','manage\giarung\GiaNuocShController@importexcel');

    Route::get('timkiem','manage\gianuocsachsh\GiaNuocShController@timkiem');
    Route::post('timkiem','manage\gianuocsachsh\GiaNuocShController@ketquatk');
    //Route::get('timkiem/printf','manage\gianuocsachsh\GiaNuocShTkController@printf');

    Route::get('edit_ct','manage\gianuocsachsh\GiaNuocShCtController@edit');
    Route::get('update_ct','manage\gianuocsachsh\GiaNuocShCtController@update');

    Route::get('baocao','manage\gianuocsachsh\GiaNuocShBcController@index');
    Route::post('baocao/baocaonuocsh1','manage\gianuocsachsh\GiaNuocShBcController@Bc1');
});
?>