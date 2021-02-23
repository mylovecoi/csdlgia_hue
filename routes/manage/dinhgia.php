<?php
//Giá các loại đất
Route::resource('dmqdgiadat','DmQdGiaDatController');
Route::post('dmqdgiadat/delete','DmQdGiaDatController@destroy');

Route::get('thongtingiacacloaidat','GiaCacLoaiDatController@index');
Route::get('thongtingiacacloaidat/addlv1','GiaCacLoaiDatController@addlv1');
Route::get('thongtingiacacloaidat/editvitri','GiaCacLoaiDatController@editvitri');
Route::get('thongtingiacacloaidat/updatevitri','GiaCacLoaiDatController@updatevitri');
Route::get('thongtingiacacloaidat/storechirld','GiaCacLoaiDatController@storechirld');
Route::get('thongtingiacacloaidat/edithesok','GiaCacLoaiDatController@edithesok');
Route::get('thongtingiacacloaidat/updatehesok','GiaCacLoaiDatController@updatehesok');
Route::post('thongtingiacacloaidat/delete','GiaCacLoaiDatController@destroy');
Route::post('thongtingiacacloaidat/upgrade','GiaCacLoaiDatController@upgrade');
ROute::get('thongtingiacacloaidat/history','GiaCacLoaiDatController@showhis');

Route::get('reportsgiacldat','GiaCacLoaiDatController@show');

Route::get('timkiemthongtingiacacloaidat','GiaCacLoaiDatController@search');

//
//Khung giá đất
Route::group(['prefix'=>'khunggiadat'],function (){
    Route::get('danhsach','manage\khunggiadat\khunggiadatController@index');
    Route::get('new','manage\khunggiadat\khunggiadatController@create');

    Route::get('modify','manage\khunggiadat\khunggiadatController@edit');
    Route::post('modify','manage\khunggiadat\khunggiadatController@store');
    Route::post('delete','manage\khunggiadat\khunggiadatController@destroy');
    Route::get('dinhkem','manage\khunggiadat\khunggiadatController@show');

    Route::post('chuyenhs','manage\khunggiadat\khunggiadatController@chuyenhs');

    Route::get('xetduyet','manage\khunggiadat\khunggiadatController@xetduyet');
    Route::post('chuyenxd','manage\khunggiadat\khunggiadatController@chuyenxd');
    Route::post('tralai','manage\khunggiadat\khunggiadatController@tralai');
    Route::post('congbo','manage\khunggiadat\khunggiadatController@congbo');

    Route::get('timkiem','manage\khunggiadat\khunggiadatController@timkiem');
    Route::post('timkiem','manage\khunggiadat\khunggiadatController@ketquatk');
});

//Giá đất địa bàn (bảng giá đất)
Route::group(['prefix'=>'giacldat'],function (){
    Route::get('danhmuc','manage\giadatdiaban\TtGiaDatDiaBanController@index');
    Route::post('danhmuc','manage\giadatdiaban\TtGiaDatDiaBanController@store');
    Route::post('update_dm','manage\giadatdiaban\TtGiaDatDiaBanController@update');
    Route::post('delete_dm','manage\giadatdiaban\TtGiaDatDiaBanController@destroy');
    Route::get('show_dm','manage\giadatdiaban\TtGiaDatDiaBanController@show');

    Route::get('danhsach','manage\giadatdiaban\GiaDatDiaBanController@index');
    Route::post('new','manage\giadatdiaban\GiaDatDiaBanController@create');
    Route::get('modify','manage\giadatdiaban\GiaDatDiaBanController@edit');
    Route::post('modify','manage\giadatdiaban\GiaDatDiaBanController@store');

    Route::post('delete','manage\giadatdiaban\GiaDatDiaBanController@destroy');

    Route::post('store_ct','manage\giadatdiaban\GiaDatDiaBanController@store_ct');
    Route::get('edit_ct','manage\giadatdiaban\GiaDatDiaBanController@get_hs');
    Route::post('del_ct','manage\giadatdiaban\GiaDatDiaBanController@destroy_ct');
    Route::post('del_mulct','manage\giadatdiaban\GiaDatDiaBanController@destroy_mulct');
    Route::post('importexcel','manage\giadatdiaban\GiaDatDiaBanController@importexcel');

    Route::post('chuyenhs','manage\giadatdiaban\GiaDatDiaBanController@chuyenhs');
    Route::post('chuyenhs_mul','manage\giadatdiaban\GiaDatDiaBanController@chuyenhs_mul');
    Route::get('print','manage\giadatphanloai\GiaDatPhanLoaiController@ketxuat');

    Route::get('xetduyet','manage\giadatdiaban\GiaDatDiaBanController@xetduyet');
    Route::post('chuyenxd','manage\giadatdiaban\GiaDatDiaBanController@chuyenxd');
    Route::post('chuyenxd_mul','manage\giadatdiaban\GiaDatDiaBanController@chuyenxd_mul');
    Route::post('tralai','manage\giadatdiaban\GiaDatDiaBanController@tralai');
    Route::post('tralai_mul','manage\giadatdiaban\GiaDatDiaBanController@tralai_mul');
    Route::post('congbo','manage\giadatdiaban\GiaDatDiaBanController@congbo');
    Route::post('congbo_mul','manage\giadatdiaban\GiaDatDiaBanController@congbo_mul');
    Route::get('prints','manage\giadatdiaban\GiaDatDiaBanController@bcgiadatdiaban');

    Route::get('nhandulieutuexcel','manage\giadatdiaban\GiaDatDiaBanController@nhandulieutuexcel');

});

//Giá cước vận chuyển
Route::group(['prefix'=>'giacuocvanchuyen'],function (){
    Route::get('danhsach','manage\giacuocvanchuyen\giacuocvanchuyenController@index');
    Route::get('new','manage\giacuocvanchuyen\giacuocvanchuyenController@create');
    Route::get('modify','manage\giacuocvanchuyen\giacuocvanchuyenController@edit');
    Route::post('modify','manage\giacuocvanchuyen\giacuocvanchuyenController@store');
    Route::post('delete','manage\giacuocvanchuyen\giacuocvanchuyenController@destroy');
    Route::get('dinhkem','manage\giacuocvanchuyen\giacuocvanchuyenController@show');

    Route::get('store_ct','manage\giacuocvanchuyen\giacuocvanchuyenctController@store');
    Route::get('edit_ct','manage\giacuocvanchuyen\giacuocvanchuyenctController@show');
    Route::get('del_ct','manage\giacuocvanchuyen\giacuocvanchuyenctController@destroy');
    Route::post('importexcel','manage\giacuocvanchuyen\giacuocvanchuyenctController@importexcel');

    Route::post('chuyenhs','manage\giacuocvanchuyen\giacuocvanchuyenController@chuyenhs');
    Route::get('prints','manage\giacuocvanchuyen\giacuocvanchuyenController@ketxuat');

    Route::get('xetduyet','manage\giacuocvanchuyen\giacuocvanchuyenController@xetduyet');
    Route::post('chuyenxd','manage\giacuocvanchuyen\giacuocvanchuyenController@chuyenxd');
    Route::post('tralai','manage\giacuocvanchuyen\giacuocvanchuyenController@tralai');
    Route::post('congbo','manage\giacuocvanchuyen\giacuocvanchuyenController@congbo');
    //Route::get('prints','manage\giacuocvanchuyen\giacuocvanchuyenController@bcgiadatdiaban');
    Route::get('timkiem','manage\giacuocvanchuyen\giacuocvanchuyenController@timkiem');
    Route::post('timkiem','manage\giacuocvanchuyen\giacuocvanchuyenController@ketquatk');
});

//giá đất theo phân loại
Route::group(['prefix'=>'giadatphanloai'],function (){
    Route::get('danhsach','manage\giadatphanloai\GiaDatPhanLoaiController@index');
    Route::get('new','manage\giadatphanloai\GiaDatPhanLoaiController@create');
    Route::post('new','manage\giadatphanloai\GiaDatPhanLoaiController@store');
    Route::get('modify','manage\giadatphanloai\GiaDatPhanLoaiController@edit');
    Route::post('modify','manage\giadatphanloai\GiaDatPhanLoaiController@update');
    Route::post('delete','manage\giadatphanloai\GiaDatPhanLoaiController@destroy');
    Route::post('chuyenhs','manage\giadatphanloai\GiaDatPhanLoaiController@chuyenhs');
    Route::get('print','manage\giadatphanloai\GiaDatPhanLoaiController@ketxuat');

    Route::get('xetduyet','manage\giadatphanloai\GiaDatPhanLoaiController@xetduyet');
    Route::post('chuyenxd','manage\giadatphanloai\GiaDatPhanLoaiController@chuyenxd');
    Route::post('tralai','manage\giadatphanloai\GiaDatPhanLoaiController@tralai');
    Route::post('congbo','manage\giadatphanloai\GiaDatPhanLoaiController@congbo');

    Route::get('timkiem','manage\giadatphanloai\GiaDatPhanLoaiController@timkiem');
    Route::post('timkiem','manage\giadatphanloai\GiaDatPhanLoaiController@ketquatk');
    //
});

//Lệ phí trước bạ
Route::resource('nhomlephitruocba','NhomLePhiTruocBaController');
Route::get('nhomlephitruocba/edit','NhomLePhiTruocBaController@edit');
Route::post('nhomlephitruocba/update','NhomLePhiTruocBaController@update');

Route::resource('lephitruocba','LePhiTruocBaController');
Route::post('lephitruocba/delete','LePhiTruocBaController@destroy');

Route::post('lephitruocba/hoanthanh','LePhiTruocBaController@hoanthanh');
Route::post('lephitruocba/huyhoanthanh','LePhiTruocBaController@huyhoanthanh');
Route::post('lephitruocba/congbo','LePhiTruocBaController@congbo');

Route::get('lephitruocbactdf/add','LePhiTruocBaCtDfController@store');
Route::get('lephitruocbactdf/show','LePhiTruocBaCtDfController@show');
Route::get('lephitruocbactdf/update','LePhiTruocBaCtDfController@update');
Route::get('lephitruocbactdf/del','LePhiTruocBaCtDfController@destroy');

Route::get('lephitruocbact/add','LePhiTruocBaCtController@store');
Route::get('lephitruocbact/show','LePhiTruocBaCtController@show');
Route::get('lephitruocbact/update','LePhiTruocBaCtController@update');
Route::get('lephitruocbact/del','LePhiTruocBaCtController@destroy');

Route::get('timkiemlephitruocba','LePhiTruocBaController@search');

//Giá thuê mặt đất-nước
Route::group(['prefix'=>'giathuematdatmatnuoc'], function (){
    Route::get('danhsach','GiaThueDatNuocController@index');
    Route::get('new','GiaThueDatNuocController@create');
    Route::get('modify','GiaThueDatNuocController@edit');
    Route::post('modify','GiaThueDatNuocController@update');
    Route::post('delete','GiaThueDatNuocController@destroy');
    Route::get('delete','GiaThueDatNuocController@destroy');//trường hợp thêm mới hồ sơ ko lưu
    Route::post('chuyenhs','GiaThueDatNuocController@chuyenhs');
    Route::get('print','GiaThueDatNuocController@ketxuat');

    Route::get('xetduyet','GiaThueDatNuocController@xetduyet');
    Route::post('chuyenxd','GiaThueDatNuocController@chuyenxd');
    Route::post('tralai','GiaThueDatNuocController@tralai');
    Route::post('congbo','GiaThueDatNuocController@congbo');

    Route::get('timkiem','GiaThueDatNuocController@timkiem');
    Route::post('timkiem','GiaThueDatNuocController@ketquatk');

    Route::get('chitiet/store','GiaThueDatNuocCtController@store');
    Route::get('chitiet/edit','GiaThueDatNuocCtController@edit');
    Route::get('chitiet/update','GiaThueDatNuocCtController@update');
    Route::get('chitiet/del','GiaThueDatNuocCtController@destroy');
});

//Giá rừng
Route::group(['prefix'=>'giarung'], function (){
    Route::get('danhmuc','manage\giarung\DmGiaRungController@index');
    Route::post('danhmuc','manage\giarung\DmGiaRungController@store');
    Route::post('update_dm','manage\giarung\DmGiaRungController@update');
    Route::post('delete_dm','manage\giarung\DmGiaRungController@destroy');
    Route::get('show_dm','manage\giarung\DmGiaRungController@show');
    //
    Route::get('danhsach','manage\giarung\GiaRungController@index');
    Route::get('new','manage\giarung\GiaRungController@create');
    Route::post('modify','manage\giarung\GiaRungController@store');
    Route::get('modify','manage\giarung\GiaRungController@edit');
    Route::get('get_hs','manage\giarung\GiaRungController@edit');
    Route::get('dinhkem','manage\giarung\GiaRungController@show_dk');

    Route::post('delete','manage\giarung\GiaRungController@destroy');
    Route::post('chuyenhs','manage\giarung\GiaRungController@chuyenhs');
    Route::get('prints','manage\giarung\GiaRungController@BcGiaRung');

    Route::get('xetduyet','manage\giarung\GiaRungController@xetduyet');
    Route::post('chuyenxd','manage\giarung\GiaRungController@chuyenxd');
    Route::post('tralai','manage\giarung\GiaRungController@tralai');
    Route::post('congbo','manage\giarung\GiaRungController@congbo');

    Route::get('store_ct','manage\giarung\GiaRungCtController@store');
    Route::get('get_ct','manage\giarung\GiaRungCtController@show');
    Route::get('del_ct','manage\giarung\GiaRungCtController@destroy');

    Route::get('nhandulieutuexcel','manage\giarung\GiaRungController@nhandulieutuexcel');
    Route::post('importexcel','manage\giarung\GiaRungController@importexcel');

    Route::get('timkiem','manage\giarung\GiaRungController@timkiem');
    Route::post('timkiem','manage\giarung\GiaRungController@ketquatk');

    Route::get('baocao','manage\giarung\giarungBcController@index');
    Route::post('baocao/tonghop','manage\giarung\giarungBcController@tonghop');
});

//Thuế tài nguyên
Route::group(['prefix'=>'giathuetn'], function (){
    Route::get('danhmuc','manage\thuetn\NhomThueTnController@index');
    Route::post('nhomdm','manage\thuetn\NhomThueTnController@store');
    Route::get('show_nhomdm','manage\thuetn\NhomThueTnController@show_nhomdm');
    Route::post('delete_nhomdm','manage\thuetn\NhomThueTnController@destroy');

    Route::get('danhmuc/detail','manage\thuetn\DmThueTnController@index');
    Route::post('dm','manage\thuetn\DmThueTnController@store');
    Route::post('delete_dm','manage\thuetn\DmThueTnController@destroy');
    Route::get('show_dm','manage\thuetn\DmThueTnController@show');
    Route::post('importexcel','manage\thuetn\DmThueTnController@importexcel');

    Route::get('thuetainguyen/nhandulieutuexcel','manage\thuetn\ThueTaiNguyenController@nhandulieutuexcel');
    Route::get('danhsach','manage\thuetn\ThueTaiNguyenController@index');
    Route::get('new','manage\thuetn\ThueTaiNguyenController@create');
    Route::get('edit_ct','manage\thuetn\ThueTaiNguyenCtController@edit');
    Route::get('update_ct','manage\thuetn\ThueTaiNguyenCtController@update');
    Route::post('store','manage\thuetn\ThueTaiNguyenController@store');

    Route::get('modify','manage\thuetn\ThueTaiNguyenController@edit');
    Route::patch('thuetainguyen/{id}','manage\thuetn\ThueTaiNguyenController@update');
    Route::post('delete','manage\thuetn\ThueTaiNguyenController@delete');
    Route::get('chitiet','manage\thuetn\ThueTaiNguyenController@show');

    Route::post('chuyenhs','manage\thuetn\ThueTaiNguyenController@chuyenhs');
    Route::get('xetduyet','manage\thuetn\ThueTaiNguyenController@xetduyet');
    Route::post('chuyenxd','manage\thuetn\ThueTaiNguyenController@chuyenxd');
    Route::post('tralai','manage\thuetn\ThueTaiNguyenController@tralai');
    Route::post('congbo','manage\thuetn\ThueTaiNguyenController@congbo');

    Route::get('timkiem','manage\thuetn\ThueTaiNguyenController@timkiem');
    Route::post('timkiem','manage\thuetn\ThueTaiNguyenController@ketquatk');

    //
    Route::post('thuetainguyen/hoanthanh','manage\thuetn\ThueTaiNguyenController@hoanthanh');
    Route::post('thuetainguyen/huyhoanthanh','manage\thuetn\ThueTaiNguyenController@huyhoanthanh');
    Route::post('thuetainguyen/congbo','manage\thuetn\ThueTaiNguyenController@congbo');
    Route::post('thuetainguyen/huycongbo','manage\thuetn\ThueTaiNguyenController@huycongbo');
    Route::get('thuetainguyen/{id}','manage\thuetn\ThueTaiNguyenController@show');
    Route::post('thuetainguyen/import_excel','manage\thuetn\ThueTaiNguyenController@importexcel');
    Route::post('thuetainguyen/export','manage\thuetn\ThueTaiNguyenController@export');
    Route::get('baocao','manage\thuetn\ReportsThueTnController@index');
    Route::post('bc1','manage\thuetn\ReportsThueTnController@Bc1');
});

//DV Khám chữa bệnh
Route::group(['prefix'=>'giadvkcb'], function (){
    Route::get('danhmuc','manage\giadvkcb\nhomdmkcbController@index');
    Route::post('nhomdm','manage\giadvkcb\nhomdmkcbController@store');
    Route::get('show_nhomdm','manage\giadvkcb\nhomdmkcbController@show_nhomdm');
    Route::post('delete_nhomdm','manage\giadvkcb\nhomdmkcbController@destroy');

    Route::get('danhmuc/detail','manage\giadvkcb\dvkcbdmController@index');
    Route::post('dm','manage\giadvkcb\dvkcbdmController@store');
    Route::post('delete_dm','manage\giadvkcb\dvkcbdmController@destroy');
    Route::get('show_dm','manage\giadvkcb\dvkcbdmController@show');
    Route::post('importexcel','manage\giadvkcb\dvkcbdmController@importexcel');

    Route::get('edit_ct','manage\giadvkcb\dvkcbctController@edit');
    Route::get('update_ct','manage\giadvkcb\dvkcbctController@update');


    Route::get('danhsach','manage\giadvkcb\DvKcbController@index');
    Route::get('new','manage\giadvkcb\DvKcbController@create');
    Route::get('modify','manage\giadvkcb\DvKcbController@edit');
    Route::post('modify','manage\giadvkcb\DvKcbController@store');
    Route::post('delete','manage\giadvkcb\DvKcbController@destroy');

    Route::post('chuyenhs','manage\giadvkcb\DvKcbController@chuyenhs');
    Route::get('prints','manage\giadvkcb\DvKcbController@ketxuat');
    Route::get('dinhkem','manage\giadvkcb\DvKcbController@show_dk');

    Route::get('xetduyet','manage\giadvkcb\DvKcbController@xetduyet');
    Route::post('chuyenxd','manage\giadvkcb\DvKcbController@chuyenxd');
    Route::post('tralai','manage\giadvkcb\DvKcbController@tralai');
    Route::post('congbo','manage\giadvkcb\DvKcbController@congbo');

    Route::get('timkiem','manage\giadvkcb\DvKcbController@timkiem');
    Route::post('timkiem','manage\giadvkcb\DvKcbController@ketquatk');
});

Route::group(['prefix'=>'trogiatrocuoc'], function (){
    Route::get('danhmuc','manage\trogiatrocuoc\trogiatrocuocdmController@index');
    Route::post('danhmuc','manage\trogiatrocuoc\trogiatrocuocdmController@store');
    Route::get('show_dm','manage\trogiatrocuoc\trogiatrocuocdmController@edit');
    Route::post('delete_dm','manage\trogiatrocuoc\trogiatrocuocdmController@destroy');
    //
    Route::get('danhsach','manage\trogiatrocuoc\trogiatrocuocController@index');
    Route::get('new','manage\trogiatrocuoc\trogiatrocuocController@create');
    Route::get('modify','manage\trogiatrocuoc\trogiatrocuocController@edit');
    Route::post('modify','manage\trogiatrocuoc\trogiatrocuocController@update');
    Route::post('delete','manage\trogiatrocuoc\trogiatrocuocController@destroy');
    Route::get('delete','manage\trogiatrocuoc\trogiatrocuocController@destroy');

    Route::get('store_ct','manage\trogiatrocuoc\trogiatrocuocctController@store');
    Route::get('get_ct','manage\trogiatrocuoc\trogiatrocuocctController@show');
    Route::get('del_ct','manage\trogiatrocuoc\trogiatrocuocctController@destroy');

    Route::post('chuyenhs','manage\trogiatrocuoc\trogiatrocuocController@chuyenhs');
    Route::get('prints','manage\trogiatrocuoc\trogiatrocuocController@ketxuat');

    Route::get('xetduyet','manage\trogiatrocuoc\trogiatrocuocController@xetduyet');
    Route::post('chuyenxd','manage\trogiatrocuoc\trogiatrocuocController@chuyenxd');
    Route::post('tralai','manage\trogiatrocuoc\trogiatrocuocController@tralai');
    Route::post('congbo','manage\trogiatrocuoc\trogiatrocuocController@congbo');

    Route::get('timkiem','manage\trogiatrocuoc\trogiatrocuocController@timkiem');
    Route::post('timkiem','manage\trogiatrocuoc\trogiatrocuocController@ketquatk');
});

Route::group(['prefix'=>'giahhdvcn'], function (){
    Route::get('danhmuc','manage\giahhdvcn\giahhdvcndmController@index');
    Route::post('danhmuc','manage\giahhdvcn\giahhdvcndmController@store');
    Route::get('show_dm','manage\giahhdvcn\giahhdvcndmController@edit');
    Route::post('delete_dm','manage\giahhdvcn\giahhdvcndmController@destroy');
    //
    Route::get('danhsach','manage\giahhdvcn\giahhdvcnController@index');
    Route::get('new','manage\giahhdvcn\giahhdvcnController@create');
    Route::get('modify','manage\giahhdvcn\giahhdvcnController@edit');
    Route::post('modify','manage\giahhdvcn\giahhdvcnController@update');
    Route::post('delete','manage\giahhdvcn\giahhdvcnController@destroy');
    Route::get('delete','manage\giahhdvcn\giahhdvcnController@destroy');

    Route::get('store_ct','manage\giahhdvcn\giahhdvcnctController@store');
    Route::get('get_ct','manage\giahhdvcn\giahhdvcnctController@show');
    Route::get('del_ct','manage\giahhdvcn\giahhdvcnctController@destroy');

    Route::post('chuyenhs','manage\giahhdvcn\giahhdvcnController@chuyenhs');
    Route::get('prints','manage\giahhdvcn\giahhdvcnController@ketxuat');
    Route::get('dinhkem','manage\giahhdvcn\giahhdvcnController@show_dk');

    Route::get('xetduyet','manage\giahhdvcn\giahhdvcnController@xetduyet');
    Route::post('chuyenxd','manage\giahhdvcn\giahhdvcnController@chuyenxd');
    Route::post('tralai','manage\giahhdvcn\giahhdvcnController@tralai');
    Route::post('congbo','manage\giahhdvcn\giahhdvcnController@congbo');

    Route::get('timkiem','manage\giahhdvcn\giahhdvcnController@timkiem');
    Route::post('timkiem','manage\giahhdvcn\giahhdvcnController@ketquatk');
});
//Giá HH-DV khác
Route::group(['prefix'=>'giahhdvk'], function (){
    //danh mục
    Route::get('danhmuc','NhomHhDvKController@index');
    Route::post('nhomdm','NhomHhDvKController@store');
    Route::get('show_nhomdm','NhomHhDvKController@show_nhomdm');
    Route::post('delete_nhomdm','NhomHhDvKController@destroy');
    Route::get('danhmuc/detail','DmHhDvKController@index');
    Route::post('dm','DmHhDvKController@store');
    Route::post('delete_dm','DmHhDvKController@destroy');
    Route::get('show_dm','DmHhDvKController@edit');
    //Danh mục hàng hóa theo đơn vị
    Route::get('dmdonvi','NhomHhDvKController@index_donvi');
    Route::get('add_dmdonvi','NhomHhDvKController@store_dmdonvi');
    Route::post('delete_dmdonvi','NhomHhDvKController@destroy_dmdonvi');
    //chi tiết hồ sơ
    Route::get('edit_ct','GiaHhDvKCtController@edit');
    Route::post('update_ct','GiaHhDvKCtController@update');
    Route::post('importexcel_chitiet','GiaHhDvKCtController@importexcel_chitiet');
    //hồ sơ
    Route::post('danhmucmau','GiaHhDvKController@filemau');
    Route::get('danhsach','GiaHhDvKController@index');
    Route::get('new','GiaHhDvKController@create');
    Route::post('store','GiaHhDvKController@store');
    Route::post('delete','GiaHhDvKController@destroy');
    Route::get('modify','GiaHhDvKController@edit');
    Route::get('chitiet','GiaHhDvKController@show');
    Route::post('chuyenhs','GiaHhDvKController@chuyenhs');
    //xét duyệt
    Route::get('xetduyet','GiaHhDvKController@xetduyet');
    Route::post('chuyenxd','GiaHhDvKController@chuyenxd');
    Route::post('tralai','GiaHhDvKController@tralai');
    Route::post('congbo','GiaHhDvKController@congbo');
    //Tìm kiếm
    Route::get('timkiem','GiaHhDvKController@timkiem');
    Route::post('timkiem','GiaHhDvKController@ketquatk');
    //Tổng hợp
    Route::get('tonghop','ThGiaHhDvKController@index');
    Route::post('tonghop/createthang','ThGiaHhDvKController@createthang');
    Route::post('tonghop/store','ThGiaHhDvKController@store');
    Route::get('tonghop/edit','ThGiaHhDvKController@edit');
    Route::get('tonghop/edit_ct','ThGiaHhDvKCtController@edit');
    Route::post('tonghop/update_ct','ThGiaHhDvKCtController@update');
    Route::post('tonghop/delete','ThGiaHhDvKController@destroy');
//
    Route::get('tonghop/exportXML','ThGiaHhDvKController@exportXML');
    Route::get('tonghop/exportEx','ThGiaHhDvKController@exportEx');
    Route::get('baocao','ReportsHhDvKController@index');
    Route::post('bc1','ReportsHhDvKController@bc1');
    Route::post('bc2','ReportsHhDvKController@bc2');
    Route::post('exWordBc2','ReportsHhDvKController@exWordBc2');

    Route::get('dinhkem','GiaHhDvKController@show_dk');
    Route::get('nhanexcel','GiaHhDvKController@nhanexcel');
    Route::post('import_excel','GiaHhDvKController@import_excel');
});

//Giá vàng, ngoại tệ (theo dõi theo ngày)
Route::group(['prefix'=>'giavangngoaite'], function (){
    //danh mục
    Route::get('danhmuc','manage\giavangngoaite\giavangngoaitedmController@index');
    Route::post('danhmuc','manage\giavangngoaite\giavangngoaitedmController@store');
    Route::post('delete_dm','manage\giavangngoaite\giavangngoaitedmController@destroy');
    Route::get('show_dm','manage\giavangngoaite\giavangngoaitedmController@edit');
    //chi tiết hồ sơ
    Route::get('edit_ct','manage\giavangngoaite\giavangngoaitectController@edit');
    Route::post('update_ct','manage\giavangngoaite\giavangngoaitectController@update');
    //hồ sơ
    Route::get('danhsach','manage\giavangngoaite\giavangngoaiteController@index');
    Route::get('new','manage\giavangngoaite\giavangngoaiteController@create');
    Route::post('store','manage\giavangngoaite\giavangngoaiteController@store');
    Route::post('delete','manage\giavangngoaite\giavangngoaiteController@destroy');
    Route::get('modify','manage\giavangngoaite\giavangngoaiteController@edit');
    Route::get('chitiet','manage\giavangngoaite\giavangngoaiteController@show');
    Route::post('chuyenhs','manage\giavangngoaite\giavangngoaiteController@chuyenhs');
    //xét duyệt
    Route::get('xetduyet','manage\giavangngoaite\giavangngoaiteController@xetduyet');
    Route::post('chuyenxd','manage\giavangngoaite\giavangngoaiteController@chuyenxd');
    Route::post('tralai','manage\giavangngoaite\giavangngoaiteController@tralai');
    Route::post('congbo','manage\giavangngoaite\giavangngoaiteController@congbo');

    Route::get('baocao','manage\giavangngoaite\giavangngoaitebcController@index');
    Route::post('bc1','manage\giavangngoaite\giavangngoaitebcController@bc1');
    Route::post('bc2','manage\giavangngoaite\giavangngoaitebcController@bc2');
});

//Phí Lệ phí
Route::group(['prefix'=>'giaphilephi'], function (){
    Route::get('danhmuc','DmPhiLePhiController@index');
    Route::post('danhmuc','DmPhiLePhiController@store');
    Route::get('show_dm','DmPhiLePhiController@edit');
    Route::post('delete_dm','DmPhiLePhiController@destroy');

    Route::get('danhsach','PhiLePhiController@index');
    Route::get('new','PhiLePhiController@create');
    Route::get('modify','PhiLePhiController@edit');
    Route::post('modify','PhiLePhiController@store');

    Route::post('delete','PhiLePhiController@destroy');

    Route::get('store_ct','PhiLePhiCtController@store');
    Route::get('show_ct','PhiLePhiCtController@show');
    Route::get('del_ct','PhiLePhiCtController@destroy');

    Route::post('chuyenhs','PhiLePhiController@chuyenhs');
    Route::get('prints','PhiLePhiController@ketxuat');

    Route::get('xetduyet','PhiLePhiController@xetduyet');
    Route::post('chuyenxd','PhiLePhiController@chuyenxd');
    Route::post('tralai','PhiLePhiController@tralai');
    Route::post('congbo','PhiLePhiController@congbo');
    Route::get('dinhkem','PhiLePhiController@dinhkem');

    Route::get('timkiem','PhiLePhiController@timkiem');
    Route::post('timkiem','PhiLePhiController@ketquatk');
});

//Đầu giá đất
Route::group(['prefix'=>'giadaugiadat'], function (){
    Route::get('danhsach','manage\giadaugiadat\DauGiaDatController@index');
    Route::get('new','manage\giadaugiadat\DauGiaDatController@create');
    Route::get('modify','manage\giadaugiadat\DauGiaDatController@edit');
    Route::post('modify','manage\giadaugiadat\DauGiaDatController@store');

    Route::post('delete','manage\giadaugiadat\DauGiaDatController@destroy');

    Route::get('get_khuvuc','manage\giadaugiadat\DauGiaDatCtController@getkhuvuc');
    Route::get('store_ct','manage\giadaugiadat\DauGiaDatCtController@store');
    Route::get('show_ct','manage\giadaugiadat\DauGiaDatCtController@show');
    Route::get('del_ct','manage\giadaugiadat\DauGiaDatCtController@destroy');

    Route::post('chuyenhs','manage\giadaugiadat\DauGiaDatController@chuyenhs');
    Route::get('prints','manage\giadaugiadat\DauGiaDatController@ketxuat');
    Route::get('dinhkem','manage\giadaugiadat\DauGiaDatController@show');

    Route::get('xetduyet','manage\giadaugiadat\DauGiaDatController@xetduyet');
    Route::post('chuyenxd','manage\giadaugiadat\DauGiaDatController@chuyenxd');
    Route::post('tralai','manage\giadaugiadat\DauGiaDatController@tralai');
    Route::post('congbo','manage\giadaugiadat\DauGiaDatController@congbo');

    Route::get('timkiem','manage\giadaugiadat\DauGiaDatController@timkiem');
    Route::post('timkiem','manage\giadaugiadat\DauGiaDatController@ketquatk');

    //

//    Route::get('thongtindaugiadat/print','manage\giadaugiadat\DauGiaDatController@ketxuat');
//    Route::resource('thongtindaugiadat','manage\giadaugiadat\DauGiaDatController');
//    Route::post('thongtindaugiadat/delete','manage\giadaugiadat\DauGiaDatController@destroy');
//    Route::post('thongtindaugiadat/hoanthanh','manage\giadaugiadat\DauGiaDatController@hoanthanh');
//    Route::post('thongtindaugiadat/huyhoanthanh','manage\giadaugiadat\DauGiaDatController@huyhoanthanh');
//    Route::post('thongtindaugiadat/congbo','manage\giadaugiadat\DauGiaDatController@congbo');
//    Route::post('thongtindaugiadat/huycongbo','manage\giadaugiadat\DauGiaDatController@huycongbo');
//
//    Route::get('timkiemthongtindaugiadat','manage\giadaugiadat\DauGiaDatController@search');
//
//    Route::get('thongtindaugiadatct','manage\giadaugiadat\DauGiaDatCtController@index');
//    Route::post('thongtindaugiadatct/store','manage\giadaugiadat\DauGiaDatCtController@store');
//    Route::get('thongtindaugiadatct/edit','manage\giadaugiadat\DauGiaDatCtController@edit');
//    Route::post('thongtindaugiadatct/update','manage\giadaugiadat\DauGiaDatCtController@update');
//    Route::post('thongtindaugiadatct/delete','manage\giadaugiadat\DauGiaDatCtController@destroy');
});

//Giá đất giao dịch thực tế
Route::group(['prefix'=>'giadatthitruong'], function (){
    Route::get('danhsach','manage\giadatthitruong\giadatthitruongController@index');
    Route::get('new','manage\giadatthitruong\giadatthitruongController@create');
    Route::get('modify','manage\giadatthitruong\giadatthitruongController@edit');
    Route::post('modify','manage\giadatthitruong\giadatthitruongController@store');
    Route::post('delete','manage\giadatthitruong\giadatthitruongController@destroy');

    Route::get('get_khuvuc','manage\giadatthitruong\giadatthitruongctController@getkhuvuc');
    Route::get('store_ct','manage\giadatthitruong\giadatthitruongctController@store');
    Route::get('show_ct','manage\giadatthitruong\giadatthitruongctController@show');
    Route::get('del_ct','manage\giadatthitruong\giadatthitruongctController@destroy');

    Route::post('chuyenhs','manage\giadatthitruong\giadatthitruongController@chuyenhs');
    Route::get('prints','manage\giadatthitruong\giadatthitruongController@ketxuat');

    Route::get('xetduyet','manage\giadatthitruong\giadatthitruongController@xetduyet');
    Route::post('chuyenxd','manage\giadatthitruong\giadatthitruongController@chuyenxd');
    Route::post('tralai','manage\giadatthitruong\giadatthitruongController@tralai');
    Route::post('congbo','manage\giadatthitruong\giadatthitruongController@congbo');

    Route::get('timkiem','manage\giadatthitruong\giadatthitruongController@timkiem');
    Route::post('timkiem','manage\giadatthitruong\giadatthitruongController@ketquatk');

    Route::get('baocao','manage\giadatthitruong\giadatthitruongBcController@index');
    Route::post('baocao/tonghop','manage\giadatthitruong\giadatthitruongBcController@tonghop');
});
//Đấu giá đất và tài sản gắn liền đất
Route::get('thongtindaugiadatts/print','manage\giadaugiadatts\DauGiaDatTsController@ketxuat');
Route::resource('thongtindaugiadatts','manage\giadaugiadatts\DauGiaDatTsController');
Route::post('thongtindaugiadatts/delete','manage\giadaugiadatts\DauGiaDatTsController@destroy');
Route::post('thongtindaugiadatts/hoanthanh','manage\giadaugiadatts\DauGiaDatTsController@hoanthanh');
Route::post('thongtindaugiadatts/huyhoanthanh','manage\giadaugiadatts\DauGiaDatTsController@huyhoanthanh');
Route::post('thongtindaugiadatts/congbo','manage\giadaugiadatts\DauGiaDatTsController@congbo');
Route::post('thongtindaugiadatts/huycongbo','manage\giadaugiadatts\DauGiaDatTsController@huycongbo');

Route::get('thongtindaugiadattsct','manage\giadaugiadatts\DauGiaDatTsCtController@index');
Route::post('thongtindaugiadattsct/store','manage\giadaugiadatts\DauGiaDatTsCtController@store');
Route::get('thongtindaugiadattsct/edit','manage\giadaugiadatts\DauGiaDatTsCtController@edit');
Route::post('thongtindaugiadattsct/update','manage\giadaugiadatts\DauGiaDatTsCtController@update');
Route::post('thongtindaugiadattsct/delete','manage\giadaugiadatts\DauGiaDatTsCtController@destroy');

//Giá thuê tài sản công


//tài sản công
Route::group(['prefix'=>'giathuetscong'], function (){
    Route::get('danhmuc','manage\giataisancong\GiaTaiSanCongDmController@index');
    Route::post('danhmuc','manage\giataisancong\GiaTaiSanCongDmController@store');
    Route::get('show_dm','manage\giataisancong\GiaTaiSanCongDmController@edit');
    Route::post('delete_dm','manage\giataisancong\GiaTaiSanCongDmController@destroy');

    Route::get('danhsach','GiaThueTsCongController@index');
    Route::get('new','GiaThueTsCongController@create');
    Route::get('modify','GiaThueTsCongController@edit');
    Route::post('modify','GiaThueTsCongController@update');
    Route::post('delete','GiaThueTsCongController@destroy');
    Route::get('delete','GiaThueTsCongController@destroy');

    Route::get('store_ct','GiaThueTsCongCtController@store');
    Route::get('get_ct','GiaThueTsCongCtController@show');
    Route::get('del_ct','GiaThueTsCongCtController@destroy');

    Route::post('chuyenhs','GiaThueTsCongController@chuyenhs');
    Route::get('prints','GiaThueTsCongController@ketxuat');

    Route::get('xetduyet','GiaThueTsCongController@xetduyet');
    Route::post('chuyenxd','GiaThueTsCongController@chuyenxd');
    Route::post('tralai','GiaThueTsCongController@tralai');
    Route::post('congbo','GiaThueTsCongController@congbo');

    Route::get('timkiem','GiaThueTsCongController@timkiem');
    Route::post('timkiem','GiaThueTsCongController@ketquatk');

//    Route::get('getBCLK','manage\gianuocsachsh\GiaNuocShBcController@getBCLK');
    Route::get('baocao','manage\giathuetscong\GiaThueTsCongBcController@index');
    Route::post('baocao/tonghop','manage\giathuetscong\GiaThueTsCongBcController@tonghop');
});

//giá tài sản công
Route::group(['prefix'=>'taisancong'], function (){
    Route::get('danhmuc','manage\giataisancong\GiaTaiSanCongDmController@index');
    Route::post('danhmuc','manage\giataisancong\GiaTaiSanCongDmController@store');
    Route::get('show_dm','manage\giataisancong\GiaTaiSanCongDmController@edit');
    Route::post('delete_dm','manage\giataisancong\GiaTaiSanCongDmController@destroy');

    Route::get('danhsach','manage\giataisancong\GiaTaiSanCongController@index');
    Route::get('new','manage\giataisancong\GiaTaiSanCongController@create');
    Route::get('modify','manage\giataisancong\GiaTaiSanCongController@edit');
    Route::post('modify','manage\giataisancong\GiaTaiSanCongController@store');
    Route::post('delete','manage\giataisancong\GiaTaiSanCongController@destroy');
    Route::get('dinhkem','manage\giataisancong\GiaTaiSanCongController@show_dk');
    Route::post('chuyenhs','manage\giataisancong\GiaTaiSanCongController@chuyenhs');
    Route::get('prints','manage\giataisancong\GiaTaiSanCongController@ketxuat');

    Route::get('store_ct','manage\giataisancong\GiaTaiSanCongCtController@store');
    Route::get('get_ct','manage\giataisancong\GiaTaiSanCongCtController@show');
    Route::get('del_ct','manage\giataisancong\GiaTaiSanCongCtController@destroy');

    Route::get('xetduyet','manage\giataisancong\GiaTaiSanCongController@xetduyet');
    Route::post('chuyenxd','manage\giataisancong\GiaTaiSanCongController@chuyenxd');
    Route::post('tralai','manage\giataisancong\GiaTaiSanCongController@tralai');
    Route::post('congbo','manage\giataisancong\GiaTaiSanCongController@congbo');

    Route::get('timkiem','manage\giataisancong\GiaTaiSanCongController@timkiem');
    Route::post('timkiem','manage\giataisancong\GiaTaiSanCongController@ketquatk');

    Route::get('danhsach/print','manage\giataisancong\GiaTaiSanCongController@ketxuat');
    Route::resource('giataisancong','manage\giataisancong\GiaTaiSanCongController');
    Route::post('giataisancong/delete','manage\giataisancong\GiaTaiSanCongController@destroy');
    Route::post('giataisancong/hoanthanh','manage\giataisancong\GiaTaiSanCongController@hoanthanh');
    Route::post('giataisancong/huyhoanthanh','manage\giataisancong\GiaTaiSanCongController@huyhoanthanh');
    Route::post('giataisancong/congbo','manage\giataisancong\GiaTaiSanCongController@congbo');
    Route::get('timkiemgiataisancong','manage\giataisancong\GiaTaiSanCongController@search');
});


//Giá Nước sạch sinh hoạt
Route::group(['prefix'=>'gianuocsachsinhhoat'], function (){
    Route::get('danhmuc','manage\gianuocsachsh\DmGiaNuocSachShController@index');
    Route::post('danhmuc','manage\gianuocsachsh\DmGiaNuocSachShController@store');
    Route::get('show_dm','manage\gianuocsachsh\DmGiaNuocSachShController@edit');
    Route::post('delete_dm','manage\gianuocsachsh\DmGiaNuocSachShController@destroy');

    Route::get('danhsach','manage\gianuocsachsh\GiaNuocShController@index');
    Route::get('new','manage\gianuocsachsh\GiaNuocShController@create');
    Route::get('modify','manage\gianuocsachsh\GiaNuocShController@edit');
    Route::post('modify','manage\gianuocsachsh\GiaNuocShController@update');
    Route::get('dinhkem','manage\gianuocsachsh\GiaNuocShController@show');

    Route::post('delete','manage\gianuocsachsh\GiaNuocShController@destroy');
    Route::post('chuyenhs','manage\gianuocsachsh\GiaNuocShController@chuyenhs');

    Route::get('xetduyet','manage\gianuocsachsh\GiaNuocShController@xetduyet');
    Route::post('chuyenxd','manage\gianuocsachsh\GiaNuocShController@chuyenxd');
    Route::post('tralai','manage\gianuocsachsh\GiaNuocShController@tralai');
    Route::post('congbo','manage\gianuocsachsh\GiaNuocShController@congbo');

    //Route::get('nhandulieutuexcel','manage\giarung\GiaNuocShController@nhandulieutuexcel');
    //Route::post('importexcel','manage\giarung\GiaNuocShController@importexcel');

    Route::get('timkiem','manage\gianuocsachsh\GiaNuocShController@timkiem');
    Route::post('timkiem','manage\gianuocsachsh\GiaNuocShController@ketquatk');
    Route::get('printf','manage\gianuocsachsh\GiaNuocShController@ketxuat');

    Route::get('edit_ct','manage\gianuocsachsh\GiaNuocShCtController@edit');
    Route::get('update_ct','manage\gianuocsachsh\GiaNuocShCtController@update');

    Route::get('getBCLK','manage\gianuocsachsh\GiaNuocShBcController@getBCLK');
    Route::get('baocao','manage\gianuocsachsh\GiaNuocShBcController@index');
    Route::post('baocao/baocaonuocsh1','manage\gianuocsachsh\GiaNuocShBcController@Bc1');
});
//Giá DV GD-ĐT
Route::group(['prefix'=>'giadvgddt'],function (){
    Route::get('danhmuc','manage\giadvgddt\giadvgddtdmController@index');
    Route::post('danhmuc','manage\giadvgddt\giadvgddtdmController@store');
    Route::get('show_dm','manage\giadvgddt\giadvgddtdmController@edit');
    Route::post('delete_dm','manage\giadvgddt\giadvgddtdmController@destroy');

    Route::get('danhsach','manage\giadvgddt\GiaDvGdDtController@index');
    Route::get('new','manage\giadvgddt\GiaDvGdDtController@create');
    Route::get('modify','manage\giadvgddt\GiaDvGdDtController@edit');
    Route::post('modify','manage\giadvgddt\GiaDvGdDtController@update');
    Route::post('delete','manage\giadvgddt\GiaDvGdDtController@destroy');
    Route::get('delete','manage\giadvgddt\GiaDvGdDtController@destroy');
    Route::get('dinhkem','manage\giadvgddt\GiaDvGdDtController@show');

    Route::get('store_ct','manage\giadvgddt\GiaDvGdDtCtController@store');
    Route::get('get_ct','manage\giadvgddt\GiaDvGdDtCtController@show');
    Route::get('del_ct','manage\giadvgddt\GiaDvGdDtCtController@destroy');

    Route::post('chuyenhs','manage\giadvgddt\GiaDvGdDtController@chuyenhs');
    Route::get('prints','manage\giadvgddt\GiaDvGdDtController@ketxuat');
    Route::get('inhoso','manage\giadvgddt\GiaDvGdDtController@inhoso');

    Route::get('xetduyet','manage\giadvgddt\GiaDvGdDtController@xetduyet');
    Route::post('chuyenxd','manage\giadvgddt\GiaDvGdDtController@chuyenxd');
    Route::post('tralai','manage\giadvgddt\GiaDvGdDtController@tralai');
    Route::post('congbo','manage\giadvgddt\GiaDvGdDtController@congbo');

    Route::get('timkiem','manage\giadvgddt\GiaDvGdDtController@timkiem');
    Route::post('timkiem','manage\giadvgddt\GiaDvGdDtController@ketquatk');
});

//Giá thuê mua nhà XH
Route::group(['prefix'=>'thuemuanhaxahoi'],function (){
    Route::get('danhmuc','manage\thuemuanhaxh\DmNhaXhController@index');
    Route::post('danhmuc','manage\thuemuanhaxh\DmNhaXhController@store');
    Route::post('update_dm','manage\thuemuanhaxh\DmNhaXhController@update');
    Route::post('delete_dm','manage\thuemuanhaxh\DmNhaXhController@destroy');
    Route::get('show_dm','manage\thuemuanhaxh\DmNhaXhController@show');
    //
    Route::get('danhsach','manage\thuemuanhaxh\GiaThueMuaNhaXhController@index');
    Route::get('new','manage\thuemuanhaxh\GiaThueMuaNhaXhController@create');
    Route::post('modify','manage\thuemuanhaxh\GiaThueMuaNhaXhController@update');
    Route::get('modify','manage\thuemuanhaxh\GiaThueMuaNhaXhController@edit');
    //Route::get('get_hs','manage\thuemuanhaxh\GiaThueMuaNhaXhController@edit');
    Route::post('delete','manage\thuemuanhaxh\GiaThueMuaNhaXhController@destroy');
    Route::post('chuyenhs','manage\thuemuanhaxh\GiaThueMuaNhaXhController@chuyenhs');
    Route::get('prints','manage\thuemuanhaxh\GiaThueMuaNhaXhController@BcGiaThueMuaNhaXh');
    Route::get('dinhkem','manage\thuemuanhaxh\GiaThueMuaNhaXhController@show_dk');

    Route::get('store_ct','manage\thuemuanhaxh\GiaThueMuaNhaXhCtController@store');
    Route::get('get_ct','manage\thuemuanhaxh\GiaThueMuaNhaXhCtController@show');
    Route::get('del_ct','manage\thuemuanhaxh\GiaThueMuaNhaXhCtController@destroy');

    Route::get('xetduyet','manage\thuemuanhaxh\GiaThueMuaNhaXhController@xetduyet');
    Route::post('chuyenxd','manage\thuemuanhaxh\GiaThueMuaNhaXhController@chuyenxd');
    Route::post('tralai','manage\thuemuanhaxh\GiaThueMuaNhaXhController@tralai');
    Route::post('congbo','manage\thuemuanhaxh\GiaThueMuaNhaXhController@congbo');

    Route::get('nhandulieutuexcel','manage\thuemuanhaxh\GiaThueMuaNhaXhController@nhandulieutuexcel');
    Route::post('importexcel','manage\thuemuanhaxh\GiaThueMuaNhaXhController@importexcel');

    Route::get('timkiem','manage\thuemuanhaxh\GiaThueMuaNhaXhController@timkiem');
    Route::post('timkiem','manage\thuemuanhaxh\GiaThueMuaNhaXhController@ketquatk');

    Route::get('baocao','manage\thuemuanhaxh\GiaThueMuaNhaXhBcController@index');
    Route::post('baocao/tonghop','manage\thuemuanhaxh\GiaThueMuaNhaXhBcController@tonghop');
});

//Giá thị trường
Route::get('thongtugiathitruong','manage\giathitruong\GiaThiTruongTtController@index');
Route::post('thongtugiathitruong','manage\giathitruong\GiaThiTruongTtController@store');
Route::get('thongtugiathitruong/edit','manage\giathitruong\GiaThiTruongTtController@edit');
Route::post('thongtugiathitruong/update','manage\giathitruong\GiaThiTruongTtController@update');
Route::get('thongtugiathitruong/nhandulieutuexcel','manage\giathitruong\GiaThiTruongTtController@nhandulieutuexcel');

Route::get('danhmucgiathitruong','manage\giathitruong\GiaThiTruongDmController@index');
Route::post('danhmucgiathitruong','manage\giathitruong\GiaThiTruongDmController@store');
Route::get('danhmucgiathitruong/edit','manage\giathitruong\GiaThiTruongDmController@edit');
Route::post('danhmucgiathitruong/update','manage\giathitruong\GiaThiTruongDmController@update');
Route::post('danhmucgiathitruong/importexcel','manage\giathitruong\GiaThiTruongDmController@importexcel');

Route::get('kekhaigiathitruong','manage\giathitruong\GiaThiTruongController@index');
Route::post('kekhaigiathitruong/create','manage\giathitruong\GiaThiTruongController@create');
Route::post('kekhaigiathitruong','manage\giathitruong\GiaThiTruongController@store');
Route::get('kekhaigiathitruong/{id}/edit','manage\giathitruong\GiaThiTruongController@edit');
Route::patch('kekhaigiathitruong/{id}','manage\giathitruong\GiaThiTruongController@update');
Route::get('kekhaigiathitruong/{id}','manage\giathitruong\GiaThiTruongController@show');
Route::post('kekhaigiathitruong/hoanthanh','manage\giathitruong\GiaThiTruongController@hoanthanh');
Route::post('kekhaigiathitruong/huyhoanthanh','manage\giathitruong\GiaThiTruongController@huyhoanthanh');
Route::post('kekhaigiathitruong/delete','manage\giathitruong\GiaThiTruongController@destroy');

Route::get('giathitruongct/edit','manage\giathitruong\GiaThiTruongCtController@edit');
Route::get('giathitruongct/update','manage\giathitruong\GiaThiTruongCtController@update');
Route::get('tkgiatrhitruong','manage\giathitruong\GiaThiTruongController@search');


Route::get('baocaogiathitruong','manage\giathitruong\GiaThiTruongBcController@index');
Route::post('baocaogiathitruong/baocaotonghop1','manage\giathitruong\GiaThiTruongBcController@baocaotonghop1');

//Bán nhà tái định cư
Route::get('bannhataidinhcu','manage\bannhataidinhcu\BanNhaTaiDinhCuController@index');
Route::post('bannhataidinhcu/add','manage\bannhataidinhcu\BanNhaTaiDinhCuController@store');
Route::get('bannhataidinhcu/edittt','manage\bannhataidinhcu\BanNhaTaiDinhCuController@edit');
Route::post('bannhataidinhcu/update','manage\bannhataidinhcu\BanNhaTaiDinhCuController@update');
Route::post('bannhataidinhcu/destroy','manage\bannhataidinhcu\BanNhaTaiDinhCuController@destroy');
Route::post('bannhataidinhcu/delete','manage\bannhataidinhcu\BanNhaTaiDinhCuController@multidelete');
Route::post('bannhataidinhcu/congbo','manage\bannhataidinhcu\BanNhaTaiDinhCuController@congbo');
Route::post('bannhataidinhcu/huycongbo','manage\bannhataidinhcu\BanNhaTaiDinhCuController@huycongbo');
Route::post('bannhataidinhcu/huyhoanthanh','manage\bannhataidinhcu\BanNhaTaiDinhCuController@huyhoanthanh');
Route::post('bannhataidinhcu/hoanthanh','manage\bannhataidinhcu\BanNhaTaiDinhCuController@hoanthanh');
Route::post('bannhataidinhcu/checkmulti','manage\bannhataidinhcu\BanNhaTaiDinhCuController@checkmulti');
Route::get('bannhataidinhcu/nhandulieutuexcel','manage\bannhataidinhcu\BanNhaTaiDinhCuController@nhandulieutuexcel');
Route::post('bannhataidinhcu/import_excel','manage\bannhataidinhcu\BanNhaTaiDinhCuController@importexcel');
Route::get('bannhataidinhcu/prints','manage\bannhataidinhcu\BanNhaTaiDinhCuController@BcBanNhaTaiDinhCu');

//Giá thuê nhà công vụ
Route::get('giathuenhacongvu','manage\thuenhacongvu\GiaThueNhaCongVuController@index');
Route::post('giathuenhacongvu/add','manage\thuenhacongvu\GiaThueNhaCongVuController@store');
Route::get('giathuenhacongvu/edittt','manage\thuenhacongvu\GiaThueNhaCongVuController@edit');
Route::post('giathuenhacongvu/update','manage\thuenhacongvu\GiaThueNhaCongVuController@update');
Route::post('giathuenhacongvu/destroy','manage\thuenhacongvu\GiaThueNhaCongVuController@destroy');
Route::post('giathuenhacongvu/delete','manage\thuenhacongvu\GiaThueNhaCongVuController@multidelete');
Route::post('giathuenhacongvu/congbo','manage\thuenhacongvu\GiaThueNhaCongVuController@congbo');
Route::post('giathuenhacongvu/huycongbo','manage\thuenhacongvu\GiaThueNhaCongVuController@huycongbo');
Route::post('giathuenhacongvu/hoanthanh','manage\thuenhacongvu\GiaThueNhaCongVuController@hoanthanh');
Route::post('giathuenhacongvu/huyhoanthanh','manage\thuenhacongvu\GiaThueNhaCongVuController@huyhoanthanh');
Route::post('giathuenhacongvu/checkmulti','manage\thuenhacongvu\GiaThueNhaCongVuController@checkmulti');
Route::get('giathuenhacongvu/nhandulieutuexcel','manage\thuenhacongvu\GiaThueNhaCongVuController@nhandulieutuexcel');
Route::post('giathuenhacongvu/import_excel','manage\thuenhacongvu\GiaThueNhaCongVuController@importexcel');
Route::get('giathuenhacongvu/prints','manage\thuenhacongvu\GiaThueNhaCongVuController@BcGiaThueNhaCongVu');

//Giá sản phẩm dịch vụ công ích
Route::group(['prefix'=>'giaspdvci'],function (){
    Route::get('danhmuc','manage\giaspdvci\giaspdvcidmController@index');
    Route::post('danhmuc','manage\giaspdvci\giaspdvcidmController@store');
    Route::get('show_dm','manage\giaspdvci\giaspdvcidmController@edit');
    Route::post('delete_dm','manage\giaspdvci\giaspdvcidmController@destroy');

    Route::get('danhsach','manage\giaspdvci\GiaSpDvCiController@index');
    Route::get('new','manage\giaspdvci\GiaSpDvCiController@create');
    Route::get('modify','manage\giaspdvci\GiaSpDvCiController@edit');
    Route::post('modify','manage\giaspdvci\GiaSpDvCiController@update');
    Route::post('delete','manage\giaspdvci\GiaSpDvCiController@destroy');
    Route::get('delete','manage\giaspdvci\GiaSpDvCiController@destroy');
    Route::get('dinhkem','manage\giaspdvci\GiaSpDvCiController@show_dk');

    Route::get('store_ct','manage\giaspdvci\GiaSpDvCiCtController@store');
    Route::get('get_ct','manage\giaspdvci\GiaSpDvCiCtController@show');
    Route::get('del_ct','manage\giaspdvci\GiaSpDvCiCtController@destroy');

    Route::post('chuyenhs','manage\giaspdvci\GiaSpDvCiController@chuyenhs');
    Route::get('prints','manage\giaspdvci\GiaSpDvCiController@ketxuat');

    Route::get('xetduyet','manage\giaspdvci\GiaSpDvCiController@xetduyet');
    Route::post('chuyenxd','manage\giaspdvci\GiaSpDvCiController@chuyenxd');
    Route::post('tralai','manage\giaspdvci\GiaSpDvCiController@tralai');
    Route::post('congbo','manage\giaspdvci\GiaSpDvCiController@congbo');

    Route::get('timkiem','manage\giaspdvci\GiaSpDvCiController@timkiem');
    Route::post('timkiem','manage\giaspdvci\GiaSpDvCiController@ketquatk');
});


//Giá lệ phí trước bạ nhà
Route::get('lephitruocbanha','manage\gialephitruocbanha\GiaLpTbNhaController@index');
Route::get('lephitruocbanha/create','manage\gialephitruocbanha\GiaLpTbNhaController@create');
Route::post('lephitruocbanha','manage\gialephitruocbanha\GiaLpTbNhaController@store');
Route::get('lephitruocbanha/{id}/edit','manage\gialephitruocbanha\GiaLpTbNhaController@edit');
Route::patch('lephitruocbanha/{id}','manage\gialephitruocbanha\GiaLpTbNhaController@update');
Route::get('lephitruocbanha/{id}','manage\gialephitruocbanha\GiaLpTbNhaController@show');

Route::post('lephitruocbanha/delete','manage\gialephitruocbanha\GiaLpTbNhaController@destroy');

Route::post('lephitruocbanha/huyhoanthanh','manage\gialephitruocbanha\GiaLpTbNhaController@huyhoanthanh');
Route::post('lephitruocbanha/hoanthanh','manage\gialephitruocbanha\GiaLpTbNhaController@hoanthanh');
Route::post('lephitruocbanha/congbo','manage\gialephitruocbanha\GiaLpTbNhaController@congbo');
Route::post('lephitruocbanha/huycongbo','manage\gialephitruocbanha\GiaLpTbNhaController@huycongbo');


Route::post('lptbnhaxdm/add','manage\gialephitruocbanha\GiaLpTbNhaCtXdmController@store');
Route::get('lptbnhaxdm/edit','manage\gialephitruocbanha\GiaLpTbNhaCtXdmController@edit');
Route::post('lptbnhaxdm/update','manage\gialephitruocbanha\GiaLpTbNhaCtXdmController@update');
Route::get('lptbnhaxdm/del','manage\gialephitruocbanha\GiaLpTbNhaCtXdmController@destroy');

Route::post('lptbnhaclcl/add','manage\gialephitruocbanha\GiaLpTbNhaCtClclController@store');
Route::get('lptbnhaclcl/edit','manage\gialephitruocbanha\GiaLpTbNhaCtClclController@edit');
Route::post('lptbnhaclcl/update','manage\gialephitruocbanha\GiaLpTbNhaCtClclController@update');
Route::get('lptbnhaclcl/del','manage\gialephitruocbanha\GiaLpTbNhaCtClclController@destroy');

//Giá giao dịch bất động sản
Route::group(['prefix'=>'giabatdongsan'],function (){
    Route::get('danhsach','manage\giagdbatdatsan\GiaGdBatDongSanController@index');
    Route::get('new','manage\giagdbatdatsan\GiaGdBatDongSanController@create');

    Route::get('modify','manage\giagdbatdatsan\GiaGdBatDongSanController@edit');
    Route::post('modify','manage\giagdbatdatsan\GiaGdBatDongSanController@store');
    Route::post('delete','manage\giagdbatdatsan\GiaGdBatDongSanController@destroy');
    Route::get('dinhkem','manage\giagdbatdatsan\GiaGdBatDongSanController@show');

    Route::post('chuyenhs','manage\giagdbatdatsan\GiaGdBatDongSanController@chuyenhs');
    //Route::get('prints','manage\giaspdvci\GiaSpDvCiController@ketxuat');

    Route::get('xetduyet','manage\giagdbatdatsan\GiaGdBatDongSanController@xetduyet');
    Route::post('chuyenxd','manage\giagdbatdatsan\GiaGdBatDongSanController@chuyenxd');
    Route::post('tralai','manage\giagdbatdatsan\GiaGdBatDongSanController@tralai');
    Route::post('congbo','manage\giagdbatdatsan\GiaGdBatDongSanController@congbo');

    Route::get('timkiem','manage\giagdbatdatsan\GiaGdBatDongSanController@timkiem');
    Route::post('timkiem','manage\giagdbatdatsan\GiaGdBatDongSanController@ketquatk');
});

//Giá trúng thầu của HH-DV được mua sắm theo QĐ của PL về đấu thầu
Route::group(['prefix'=>'muataisan'],function (){
    Route::get('danhsach', 'manage\muataisan\MuaTaiSanController@index');
    Route::get('new', 'manage\muataisan\MuaTaiSanController@create');
    Route::post('modify', 'manage\muataisan\MuaTaiSanController@store');
    Route::get('modify', 'manage\muataisan\MuaTaiSanController@edit');
    Route::get('dinhkem','manage\muataisan\MuaTaiSanController@show');
    Route::post('delete', 'manage\muataisan\MuaTaiSanController@destroy');

    Route::post('chuyenhs','manage\muataisan\MuaTaiSanController@chuyenhs');
    //Route::get('prints','manage\giaspdvci\GiaSpDvCiController@ketxuat');

    Route::get('xetduyet','manage\muataisan\MuaTaiSanController@xetduyet');
    Route::post('chuyenxd','manage\muataisan\MuaTaiSanController@chuyenxd');
    Route::post('tralai','manage\muataisan\MuaTaiSanController@tralai');
    Route::post('congbo','manage\muataisan\MuaTaiSanController@congbo');

    Route::get('timkiem','manage\muataisan\MuaTaiSanController@timkiem');
    Route::post('timkiem','manage\muataisan\MuaTaiSanController@ketquatk');
});

//Giá sản phẩm dịch vụ cụ thế
Route::group(['prefix'=>'giaspdvcuthe'],function (){
    Route::get('danhsach','manage\giaspdvcuthe\giaspdvcutheController@index');
    Route::get('new','manage\giaspdvcuthe\giaspdvcutheController@create');
    Route::get('modify','manage\giaspdvcuthe\giaspdvcutheController@edit');
    Route::post('modify','manage\giaspdvcuthe\giaspdvcutheController@store');
    Route::post('delete','manage\giaspdvcuthe\giaspdvcuthetroller@destroy');
    Route::get('dinhkem','manage\giaspdvcuthe\giaspdvcutheController@show');

    Route::get('store_ct','manage\giaspdvcuthe\giaspdvcuthectController@store');
    Route::get('edit_ct','manage\giaspdvcuthe\giaspdvcuthectController@show');
    Route::get('del_ct','manage\giaspdvcuthe\giaspdvcuthectController@destroy');
    Route::post('importexcel','manage\giaspdvcuthe\giaspdvcuthectController@importexcel');

    Route::post('chuyenhs','manage\giaspdvcuthe\giaspdvcutheController@chuyenhs');
    Route::get('prints','manage\giaspdvcuthe\giaspdvcutheController@ketxuat');

    Route::get('xetduyet','manage\giaspdvcuthe\giaspdvcutheController@xetduyet');
    Route::post('chuyenxd','manage\giaspdvcuthe\giaspdvcutheController@chuyenxd');
    Route::post('tralai','manage\giaspdvcuthe\giaspdvcutheController@tralai');
    Route::post('congbo','manage\giaspdvcuthe\giaspdvcutheController@congbo');
    //Route::get('prints','manage\giaspdvcuthe\giaspdvcutheController@bcgiadatdiaban');
    Route::get('timkiem','manage\giaspdvcuthe\giaspdvcutheController@timkiem');
    Route::post('timkiem','manage\giaspdvcuthe\giaspdvcutheController@ketquatk');
});

//Giá sản phẩm dịch vụ tối đa
Route::group(['prefix'=>'giaspdvtoida'],function (){
    Route::get('danhmuc','manage\giaspdvtoida\giaspdvtoidadmController@index');
    Route::post('danhmuc','manage\giaspdvtoida\giaspdvtoidadmController@store');
    Route::get('show_dm','manage\giaspdvtoida\giaspdvtoidadmController@edit');
    Route::post('delete_dm','manage\giaspdvtoida\giaspdvtoidadmController@destroy');

    Route::get('danhsach','manage\giaspdvtoida\giaspdvtoidaController@index');
    Route::get('new','manage\giaspdvtoida\giaspdvtoidaController@create');
    Route::get('modify','manage\giaspdvtoida\giaspdvtoidaController@edit');
    Route::post('modify','manage\giaspdvtoida\giaspdvtoidaController@store');
    Route::get('dinhkem','manage\giaspdvtoida\giaspdvtoidaController@show_dk');
    Route::post('delete','manage\giaspdvtoida\giaspdvtoidaController@destroy');
    Route::get('xoahs','manage\giaspdvtoida\giaspdvtoidaController@destroy');

    Route::get('store_ct','manage\giaspdvtoida\giaspdvtoidactController@store');
    Route::get('get_ct','manage\giaspdvtoida\giaspdvtoidactController@show');
    Route::get('del_ct','manage\giaspdvtoida\giaspdvtoidactController@destroy');
    Route::post('importexcel','manage\giaspdvtoida\giaspdvtoidactController@importexcel');

    Route::post('chuyenhs','manage\giaspdvtoida\giaspdvtoidaController@chuyenhs');
    Route::get('prints','manage\giaspdvtoida\giaspdvtoidaController@ketxuat');

    Route::get('xetduyet','manage\giaspdvtoida\giaspdvtoidaController@xetduyet');
    Route::post('chuyenxd','manage\giaspdvtoida\giaspdvtoidaController@chuyenxd');
    Route::post('tralai','manage\giaspdvtoida\giaspdvtoidaController@tralai');
    Route::post('congbo','manage\giaspdvtoida\giaspdvtoidaController@congbo');
    //Route::get('prints','manage\giaspdvtoida\giaspdvtoidaController@bcgiadatdiaban');
    Route::get('timkiem','manage\giaspdvtoida\giaspdvtoidaController@timkiem');
    Route::post('timkiem','manage\giaspdvtoida\giaspdvtoidaController@ketquatk');
});

//Giá sản phẩm dịch vụ khung giá
Route::group(['prefix'=>'giaspdvkhunggia'],function (){
    Route::get('danhmuc','manage\giaspdvkhunggia\giaspdvkhunggiadmController@index');
    Route::post('danhmuc','manage\giaspdvkhunggia\giaspdvkhunggiadmController@store');
    Route::get('show_dm','manage\giaspdvkhunggia\giaspdvkhunggiadmController@edit');
    Route::post('delete_dm','manage\giaspdvkhunggia\giaspdvkhunggiadmController@destroy');

    Route::get('danhsach','manage\giaspdvkhunggia\giaspdvkhunggiaController@index');
    Route::get('new','manage\giaspdvkhunggia\giaspdvkhunggiaController@create');
    Route::get('modify','manage\giaspdvkhunggia\giaspdvkhunggiaController@edit');
    Route::post('modify','manage\giaspdvkhunggia\giaspdvkhunggiaController@store');
    Route::post('delete','manage\giaspdvkhunggia\giaspdvkhunggiaController@destroy');
    Route::get('xoahs','manage\giaspdvkhunggia\giaspdvkhunggiaController@destroy');
    Route::get('dinhkem','manage\giaspdvkhunggia\giaspdvkhunggiaController@show_dk');

    Route::get('store_ct','manage\giaspdvkhunggia\giaspdvkhunggiactController@store');
    Route::get('get_ct','manage\giaspdvkhunggia\giaspdvkhunggiactController@show');
    Route::get('del_ct','manage\giaspdvkhunggia\giaspdvkhunggiactController@destroy');
    Route::post('importexcel','manage\giaspdvkhunggia\giaspdvkhunggiactController@importexcel');

    Route::post('chuyenhs','manage\giaspdvkhunggia\giaspdvkhunggiaController@chuyenhs');
    Route::get('prints','manage\giaspdvkhunggia\giaspdvkhunggiaController@ketxuat');

    Route::get('xetduyet','manage\giaspdvkhunggia\giaspdvkhunggiaController@xetduyet');
    Route::post('chuyenxd','manage\giaspdvkhunggia\giaspdvkhunggiaController@chuyenxd');
    Route::post('tralai','manage\giaspdvkhunggia\giaspdvkhunggiaController@tralai');
    Route::post('congbo','manage\giaspdvkhunggia\giaspdvkhunggiaController@congbo');
    //Route::get('prints','manage\giaspdvkhunggia\giaspdvkhunggiaController@bcgiadatdiaban');
    Route::get('timkiem','manage\giaspdvkhunggia\giaspdvkhunggiaController@timkiem');
    Route::post('timkiem','manage\giaspdvkhunggia\giaspdvkhunggiaController@ketquatk');
});
?>