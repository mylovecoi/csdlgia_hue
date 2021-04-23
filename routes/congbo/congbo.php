<?php
//Định giá
Route::get('giahanghoadichvu','HomeController@congbo');
Route::get('coming','HomeController@coming');
Route::get('cbgiadatdiaban','congbo\dinhgia\CongboGiaDatDiaBanController@index');

Route::get('cbgiadaugiadat','congbo\dinhgia\CongboGiaDauGiaDatController@index');
//Route::get('cbgiadaugiadat/{id}','congbo\dinhgia\CongboGiaDauGiaDatController@show');

Route::get('cbgiathuetainguyen','congbo\dinhgia\CongBoGiaThueTaiNguyenController@index');

Route::get('cbgiathuedatnuoc','congbo\dinhgia\CongboGiaThueDatNuocController@index');
Route::get('cbgiarung','congbo\dinhgia\CongboGiaRungController@index');
Route::get('cbthuemuanhaxh','congbo\dinhgia\CongboThueMuaNhaXHController@index');
Route::get('cbgiathuenhacongvu','congbo\dinhgia\CongboGiaThueNhaCongVuController@index');
Route::get('cbgianuocsachsinhhoat','congbo\dinhgia\CongboGiaNuocSinhHoatController@index');
Route::get('cbgiathuetaisan','congbo\dinhgia\CongboGiaThueTaiSanController@index');
Route::get('cbgiadvgiaoducdaotao','congbo\dinhgia\CongboGiaDvGiaoDucDaoTaoController@index');
Route::get('cbdichvukcb','congbo\dinhgia\CongboGiaDvKhamChuaBenhController@index');
Route::get('cbgialephitruocba','congbo\gialephi\CongboGiaLePhiTruocBaController@index');
Route::get('cbphilephi','congbo\philephi\CongboPhiLePhiController@index');

//Kê khai giá
    //phần I
Route::get('cbkkgiavlxd','congbo\kekhaigia\CongboVatLieuXayDungController@index');
Route::get('cbkkgiaxmtxd','congbo\kekhaigia\CongboGiaXMTXDController@index');
Route::get('cbkkgiadvhdtm','congbo\kekhaigia\CongboGiaHDTMController@index');
Route::get('cbkkgiatacn','congbo\kekhaigia\CongboGiaTACNController@index');
Route::get('cbgiagiay','congbo\kekhaigia\CongboGiaGiayController@index');
Route::get('cbgiasach','congbo\kekhaigia\CongboGiaSachController@index');
Route::get('cbgiaetanol','congbo\kekhaigia\CongboGiaEtanolController@index');
Route::get('cbthamdinhgia','congbo\kekhaigia\CongboThamDinhGiaController@index');
Route::get('cbvanbanqlnnvegia','congbo\vanbanqlnn\CongboVanBanQLNNController@index');
Route::get('danhsachusertaphuan','congbo\taphuan\DanhSachUserTapHuanController@index');
Route::get('cbgiadatpl','congbo\dinhgia\CongboGiaDatPhanLoaiController@index');
Route::get('cbgiathuetscong','congbo\dinhgia\CongboGiaThueTaiSanController@index');
Route::get('cbgiaspdvci','congbo\dinhgia\CongboGiaSpDvCiController@index');
    //Phần II
Route::get('cbtrogiatrocuoc','congbo\dinhgia\trogiatrocuocController@index');
Route::get('cbgiahhdvcn','congbo\dinhgia\CongboGiaHhDvCnController@index');
Route::get('cbgiacuocvanchuyen','congbo\dinhgia\CongbogiacuocvanchuyenController@index');

//cbbinhongia
Route::get('cbbinhongia','congbo\CongBoBinhOnGiaController@index');
//Kê khai-niêm yết giá
Route::get('cbxmtxd','congbo\kekhaigia\CongboGiaXMTXDController@index');
Route::get('cbthan','congbo\kekhaigia\CongboGiaThanController@index');
Route::get('cbtacn','congbo\kekhaigia\CongboGiaTACNController@index');
Route::get('cbgiay','congbo\kekhaigia\CongboGiaGiayController@index');
Route::get('cbsach','congbo\kekhaigia\CongboGiaSachController@index');

//Văn bản quản lý nhà nước
Route::get('cbvbqlnn','congbo\vanbanqlnn\CongboVanBanQLNNController@index');

//Văn bản phục vụ công tác quản lý nhà nước
Route::get('cbttqlnn','congbo\ttqlnn\ThongTuPVCTQLNNController@index');
?>