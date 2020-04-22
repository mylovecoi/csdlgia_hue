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


//Giá đất địa bàn (bảng giá đất)
Route::group(['prefix'=>'giacldat'],function (){
    Route::get('danhmuc','manage\giadatdiaban\TtGiaDatDiaBanController@index');
    Route::post('danhmuc','manage\giadatdiaban\TtGiaDatDiaBanController@store');
    Route::post('update_dm','manage\giadatdiaban\TtGiaDatDiaBanController@update');
    Route::post('delete_dm','manage\giadatdiaban\TtGiaDatDiaBanController@destroy');
    Route::get('show_dm','manage\giadatdiaban\TtGiaDatDiaBanController@show');

    Route::get('danhsach','GiaDatDiaBanController@index');
    Route::post('modify','GiaDatDiaBanController@store');
    Route::get('get_hs','GiaDatDiaBanController@edit');
    Route::post('delete','GiaDatDiaBanController@destroy');

    Route::post('chuyenhs','GiaDatDiaBanController@chuyenhs');
    Route::post('chuyenhs_mul','GiaDatDiaBanController@chuyenhs_mul');
    Route::get('print','manage\giadatphanloai\GiaDatPhanLoaiController@ketxuat');

    Route::get('xetduyet','GiaDatDiaBanController@xetduyet');
    Route::post('chuyenxd','GiaDatDiaBanController@chuyenxd');
    Route::post('chuyenxd_mul','GiaDatDiaBanController@chuyenxd_mul');
    Route::post('tralai','GiaDatDiaBanController@tralai');
    Route::post('tralai_mul','GiaDatDiaBanController@tralai_mul');
    Route::post('congbo','GiaDatDiaBanController@congbo');
    Route::post('congbo_mul','GiaDatDiaBanController@congbo_mul');
    Route::get('prints','GiaDatDiaBanController@bcgiadatdiaban');

    Route::get('nhandulieutuexcel','GiaDatDiaBanController@nhandulieutuexcel');
    Route::post('import_excel','GiaDatDiaBanController@importexcel');
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
    Route::post('modify','manage\giarung\GiaRungController@store');
    Route::get('get_hs','manage\giarung\GiaRungController@edit');

    Route::post('delete','manage\giarung\GiaRungController@destroy');
    Route::post('chuyenhs','manage\giarung\GiaRungController@chuyenhs');
    Route::get('prints','manage\giarung\GiaRungController@BcGiaRung');

    Route::get('xetduyet','manage\giarung\GiaRungController@xetduyet');
    Route::post('chuyenxd','manage\giarung\GiaRungController@chuyenxd');
    Route::post('tralai','manage\giarung\GiaRungController@tralai');
    Route::post('congbo','manage\giarung\GiaRungController@congbo');

    Route::get('nhandulieutuexcel','manage\giarung\GiaRungController@nhandulieutuexcel');
    Route::post('importexcel','manage\giarung\GiaRungController@importexcel');

    Route::get('timkiem','manage\giarung\GiaRungController@timkiem');
    Route::post('timkiem','manage\giarung\GiaRungController@ketquatk');
});

//Thuế tài nguyên

Route::get('nhomthuetn','manage\thuetn\NhomThueTnController@index');
Route::post('nhomthuetn','manage\thuetn\NhomThueTnController@store');
Route::get('nhomthuetn/show','manage\thuetn\NhomThueTnController@show');
Route::post('nhomthuetn/update','manage\thuetn\NhomThueTnController@update');
Route::get('dmthuetn','manage\thuetn\DmThueTnController@index');
Route::post('dmthuetn','manage\thuetn\DmThueTnController@store');
Route::get('dmthuetn/show','manage\thuetn\DmThueTnController@show');
Route::post('dmthuetn/update','manage\thuetn\DmThueTnController@update');
Route::post('dmthuetn/delete','manage\thuetn\DmThueTnController@destroy');
Route::post('dmthuetn/importexcel','manage\thuetn\DmThueTnController@importexcel');

Route::get('thuetainguyen/nhandulieutuexcel','manage\thuetn\ThueTaiNguyenController@nhandulieutuexcel');
Route::get('thuetainguyen','manage\thuetn\ThueTaiNguyenController@index');
Route::post('thuetainguyen/create','manage\thuetn\ThueTaiNguyenController@create');
Route::post('thuetainguyen','manage\thuetn\ThueTaiNguyenController@store');
Route::get('thuetainguyen/{id}/edit','manage\thuetn\ThueTaiNguyenController@edit');
Route::patch('thuetainguyen/{id}','manage\thuetn\ThueTaiNguyenController@update');
Route::post('thuetainguyen/delete','manage\thuetn\ThueTaiNguyenController@delete');
Route::post('thuetainguyen/hoanthanh','manage\thuetn\ThueTaiNguyenController@hoanthanh');
Route::post('thuetainguyen/huyhoanthanh','manage\thuetn\ThueTaiNguyenController@huyhoanthanh');
Route::post('thuetainguyen/congbo','manage\thuetn\ThueTaiNguyenController@congbo');
Route::post('thuetainguyen/huycongbo','manage\thuetn\ThueTaiNguyenController@huycongbo');
Route::get('thuetainguyen/{id}','manage\thuetn\ThueTaiNguyenController@show');


Route::post('thuetainguyen/import_excel','manage\thuetn\ThueTaiNguyenController@importexcel');
Route::post('thuetainguyen/export','manage\thuetn\ThueTaiNguyenController@export');

Route::get('thuetainguyenct/edit','manage\thuetn\ThueTaiNguyenCtController@edit');
Route::get('thuetainguyenct/update','manage\thuetn\ThueTaiNguyenCtController@update');

Route::get('baocaothuetainguyen','manage\thuetn\ReportsThueTnController@index');
Route::post('/baocaothuetainguyen/bc1','manage\thuetn\ReportsThueTnController@Bc1');

//DV Khám chữa bệnh
Route::group(['prefix'=>'giadvkcb'], function (){
    Route::get('danhmuc','manage\giadvkcb\dvkcbdmController@index');
    Route::post('danhmuc','manage\giadvkcb\dvkcbdmController@store');
    Route::get('show_dm','manage\giadvkcb\dvkcbdmController@edit');
    Route::post('delete_dm','manage\giadvkcb\dvkcbdmController@destroy');

    Route::get('danhsach','manage\giadvkcb\DvKcbController@index');
    Route::get('get_hs','manage\giadvkcb\DvKcbController@edit');
    Route::post('modify','manage\giadvkcb\DvKcbController@store');
    Route::post('delete','manage\giadvkcb\DvKcbController@destroy');

    Route::post('chuyenhs','manage\giadvkcb\DvKcbController@chuyenhs');
    Route::get('prints','manage\giadvkcb\DvKcbController@ketxuat');

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
    //chi tiết hồ sơ
    Route::get('edit_ct','GiaHhDvKCtController@edit');
    Route::post('update_ct','GiaHhDvKCtController@update');
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

    Route::get('nhanexcel','GiaHhDvKController@nhanexcel');
    Route::post('import_excel','GiaHhDvKController@import_excel');
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

    Route::get('timkiem','PhiLePhiController@timkiem');
    Route::post('timkiem','PhiLePhiController@ketquatk');
});


//Đầu giá đất
Route::get('thongtindaugiadat/print','manage\giadaugiadat\DauGiaDatController@ketxuat');
Route::resource('thongtindaugiadat','manage\giadaugiadat\DauGiaDatController');
Route::post('thongtindaugiadat/delete','manage\giadaugiadat\DauGiaDatController@destroy');
Route::post('thongtindaugiadat/hoanthanh','manage\giadaugiadat\DauGiaDatController@hoanthanh');
Route::post('thongtindaugiadat/huyhoanthanh','manage\giadaugiadat\DauGiaDatController@huyhoanthanh');
Route::post('thongtindaugiadat/congbo','manage\giadaugiadat\DauGiaDatController@congbo');
Route::post('thongtindaugiadat/huycongbo','manage\giadaugiadat\DauGiaDatController@huycongbo');

Route::get('timkiemthongtindaugiadat','manage\giadaugiadat\DauGiaDatController@search');

//Route::get('thongtindaugiadatctdf/store','DauGiaDatCtDfController@store');
//Route::get('thongtindaugiadatctdf/show','DauGiaDatCtDfController@show');
//Route::get('thongtindaugiadatctdf/update','DauGiaDatCtDfController@update');
//Route::get('thongtindaugiadatctdf/del','DauGiaDatCtDfController@destroy');

Route::get('thongtindaugiadatct','manage\giadaugiadat\DauGiaDatCtController@index');
Route::post('thongtindaugiadatct/store','manage\giadaugiadat\DauGiaDatCtController@store');
Route::get('thongtindaugiadatct/edit','manage\giadaugiadat\DauGiaDatCtController@edit');
Route::post('thongtindaugiadatct/update','manage\giadaugiadat\DauGiaDatCtController@update');
Route::post('thongtindaugiadatct/delete','manage\giadaugiadat\DauGiaDatCtController@destroy');

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
});

//giá tài sản công
Route::get('giataisancong/print','manage\giataisancong\GiaTaiSanCongController@ketxuat');
Route::resource('giataisancong','manage\giataisancong\GiaTaiSanCongController');
Route::post('giataisancong/delete','manage\giataisancong\GiaTaiSanCongController@destroy');
Route::post('giataisancong/hoanthanh','manage\giataisancong\GiaTaiSanCongController@hoanthanh');
Route::post('giataisancong/huyhoanthanh','manage\giataisancong\GiaTaiSanCongController@huyhoanthanh');
Route::post('giataisancong/congbo','manage\giataisancong\GiaTaiSanCongController@congbo');
Route::get('timkiemgiataisancong','manage\giataisancong\GiaTaiSanCongController@search');

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

    Route::get('store_ct','manage\giadvgddt\GiaDvGdDtCtController@store');
    Route::get('get_ct','manage\giadvgddt\GiaDvGdDtCtController@show');
    Route::get('del_ct','manage\giadvgddt\GiaDvGdDtCtController@destroy');

    Route::post('chuyenhs','manage\giadvgddt\GiaDvGdDtController@chuyenhs');
    Route::get('prints','manage\giadvgddt\GiaDvGdDtController@ketxuat');

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
    Route::post('modify','manage\thuemuanhaxh\GiaThueMuaNhaXhController@update');
    Route::get('get_hs','manage\thuemuanhaxh\GiaThueMuaNhaXhController@edit');
    Route::post('delete','manage\thuemuanhaxh\GiaThueMuaNhaXhController@destroy');
    Route::post('chuyenhs','manage\thuemuanhaxh\GiaThueMuaNhaXhController@chuyenhs');
    Route::get('prints','manage\thuemuanhaxh\GiaThueMuaNhaXhController@BcGiaThueMuaNhaXh');

    Route::get('xetduyet','manage\thuemuanhaxh\GiaThueMuaNhaXhController@xetduyet');
    Route::post('chuyenxd','manage\thuemuanhaxh\GiaThueMuaNhaXhController@chuyenxd');
    Route::post('tralai','manage\thuemuanhaxh\GiaThueMuaNhaXhController@tralai');
    Route::post('congbo','manage\thuemuanhaxh\GiaThueMuaNhaXhController@congbo');

    Route::get('nhandulieutuexcel','manage\thuemuanhaxh\GiaThueMuaNhaXhController@nhandulieutuexcel');
    Route::post('importexcel','manage\thuemuanhaxh\GiaThueMuaNhaXhController@importexcel');

    Route::get('timkiem','manage\thuemuanhaxh\GiaThueMuaNhaXhController@timkiem');
    Route::post('timkiem','manage\thuemuanhaxh\GiaThueMuaNhaXhController@ketquatk');
    //
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

    Route::get('thongtinmuataisan/create', 'manage\muataisan\MuaTaiSanController@create');
    Route::post('thongtinmuataisan', 'manage\muataisan\MuaTaiSanController@store');
    Route::get('thongtinmuataisan/dinhkem', 'manage\muataisan\MuaTaiSanController@show');
    Route::post('thongtinmuataisan/delete', 'manage\muataisan\MuaTaiSanController@destroy');
    Route::get('thongtinmuataisan/{id}/edit', 'manage\muataisan\MuaTaiSanController@edit');
    Route::patch('thongtinmuataisan/{id}', 'manage\muataisan\MuaTaiSanController@update');
    Route::post('thongtinmuataisan/hoanthanh', 'manage\muataisan\MuaTaiSanController@hoanthanh');
    Route::post('thongtinmuataisan/huyhoanthanh', 'manage\muataisan\MuaTaiSanController@huyhoanthanh');
    Route::post('thongtinmuataisan/congbo', 'manage\muataisan\MuaTaiSanController@congbo');
    Route::post('thongtinmuataisan/huycongbo', 'manage\muataisan\MuaTaiSanController@huycongbo');
});

?>