<?php
//Excel
Route::group(['prefix'=>'thamdinhgia'],function () {
    //đơn vị thẩm định giá
    Route::get('donvi', 'dsdonvitdgController@index');
    Route::post('donvi', 'dsdonvitdgController@store');
    Route::get('show_dv', 'dsdonvitdgController@edit');
    Route::post('delete_dv', 'dsdonvitdgController@destroy');
    //danh mục hàng hóa
    Route::get('danhmuc','DmNhomHangHoaController@index');
    Route::post('danhmuc', 'DmNhomHangHoaController@store');
    Route::get('show_dm', 'DmNhomHangHoaController@show');
    Route::get('epExcel','DmNhomHangHoaController@epExcel');

    Route::get('danhmuc/detail','DmHangHoaController@index');
    Route::post('danhmuc/detail','DmHangHoaController@store');
    Route::get('show_dm_ct', 'DmHangHoaController@show');
    //Hồ sơ thẩm định
    Route::get('danhsach', 'ThamDinhGiaController@index');
    Route::get('new', 'ThamDinhGiaController@create');
    Route::get('modify', 'ThamDinhGiaController@edit');
    Route::post('modify','ThamDinhGiaController@update');
    Route::post('delete','ThamDinhGiaController@destroy');
    Route::post('chuyenhs','ThamDinhGiaController@chuyenhs');
    Route::get('xetduyet','ThamDinhGiaController@xetduyet');
    Route::post('chuyenxd','ThamDinhGiaController@chuyenxd');
    Route::post('tralai','ThamDinhGiaController@tralai');
    Route::post('congbo','ThamDinhGiaController@congbo');
    Route::get('timkiem','ThamDinhGiaController@timkiem');
    Route::post('timkiem','ThamDinhGiaController@ketquatk');
        //chi tiết hồ sơ
    Route::get('get_ct', 'ThamDinhGiaCtController@edit');
    Route::get('store_ct', 'ThamDinhGiaCtController@store');
    Route::get('delete_ct', 'ThamDinhGiaCtController@destroy');
    //Báo cáo
    Route::get('baocao', 'ReportsThamDinhGiaController@index');
    Route::post('baocao/BC1', 'ReportsThamDinhGiaController@Bc1');
    //

    Route::get('thamdinhgia/nhanexcel', 'ThamDinhGiaController@nhanexcel');
    Route::post('thamdinhgia/import_excel', 'ThamDinhGiaController@import_excel');

    Route::resource('thamdinhgia', 'ThamDinhGiaController');
    Route::post('thamdinhgia/delete', 'ThamDinhGiaController@destroy');
    Route::get('timkiemthamdinhgia', 'ThamDinhGiaController@search');
    Route::get('timkiemthamdinhgia/xemtttk', 'ThamDinhGiaController@xemtttk');
    Route::get('filethamdinhgia/dinhkem', 'ThamDinhGiaController@filedk');


    Route::post('thamdinhgia/hoanthanh', 'ThamDinhGiaController@hoanthanh');
    Route::post('thamdinhgia/huyhoanthanh', 'ThamDinhGiaController@huyhoanthanh');
    Route::post('thamdinhgia/congbo', 'ThamDinhGiaController@congbo');

    Route::get('thamdinhgiactdf/store', 'ThamDinhGiaCtDfController@store');
    Route::get('thamdinhgiactdf/edit', 'ThamDinhGiaCtDfController@edit');
    Route::get('thamdinhgiactdf/update', 'ThamDinhGiaCtDfController@update');
    Route::get('thamdinhgiactdf/del', 'ThamDinhGiaCtDfController@destroy');
    Route::get('thamdinhgiactdf/search', 'ThamDinhGiaCtDfController@search');

    Route::get('thamdinhgiact/store', 'ThamDinhGiaCtController@store');
    Route::get('thamdinhgiact/edit', 'ThamDinhGiaCtController@edit');
    Route::get('thamdinhgiact/update', 'ThamDinhGiaCtController@update');
    Route::get('thamdinhgiact/del', 'ThamDinhGiaCtController@destroy');

    Route::get('addtthanghoa', 'ThamDinhGiaController@gettthanghoa');
    Route::get('addtthanghoaedit', 'ThamDinhGiaController@gettthanghoa');

    Route::get('baocaoththamdinhgia', 'ReportsThamDinhGiaController@index');
    Route::post('baocaoththamdinhgia/BC1', 'ReportsThamDinhGiaController@Bc1');
});

?>
