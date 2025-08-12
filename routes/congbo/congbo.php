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
Route::get('cbgiavang','congbo\dinhgia\CongboGiaVangController@index');
Route::get('cbgiahhdvk','congbo\dinhgia\CongboGiaHhDvkController@index');
Route::get('cbgiagocvlxd','congbo\dinhgia\CongboGiaGocVlXdController@index');

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
//Route::get('cbxmtxd','congbo\kekhaigia\CongboGiaXMTXDController@index');
//Route::get('cbthan','congbo\kekhaigia\CongboGiaThanController@index');
//Route::get('cbtacn','congbo\kekhaigia\CongboGiaTACNController@index');
//Route::get('cbgiay','congbo\kekhaigia\CongboGiaGiayController@index');
//Route::get('cbsach','congbo\kekhaigia\CongboGiaSachController@index');

Route::get('cbkekhaigia','congbo\kekhaigia\CongboKeKhaiGiaController@donvi');
Route::get('cblinhvuckk','congbo\kekhaigia\CongboKeKhaiGiaController@linhvuc');
Route::get('timkiemkekhai','congbo\kekhaigia\CongboKeKhaiGiaController@timkiem');

//Văn bản quản lý nhà nước
Route::get('cbvbqlnn','congbo\vanbanqlnn\CongboVanBanQLNNController@index');

//Văn bản phục vụ công tác quản lý nhà nước
Route::get('cbttqlnn','congbo\ttqlnn\ThongTuPVCTQLNNController@index');
//Văn bản phục vụ công tác quản lý nhà nước
Route::get('cbgiavangngoaite','congbo\CongBoController@cbgiavangngoaite');

// //Nhận hồ sơ
// Route::get('cbketnoigiathuetn/nhanhoso','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@nhanhoso');
// Route::get('cbketnoigiathuetn/innhanhosocsdlqg','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@innhanhosocsdlqg');

//Truyền danh mục
Route::get('cbketnoigiathuetn/danhmuc','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@truyendanhmuc');
// Route::get('cbketnoigiathuetn/show_nhomdm','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@show_nhomdm');
// Route::post('cbketnoigiathuetn/capnhatdanhmuc','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@capnhatdanhmuc');

// //Truyền hồ sơ kê khai
// Route::get('cbketnoigiathuetn/hoso','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@truyenhoso');
// Route::get('cbketnoigiathuetn/show_hoso','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@show_hoso');
// Route::post('cbketnoigiathuetn/capnhathoso','congbo\ketnoi\CongBoKetNoiCSDLGiaThueTn@capnhathoso');

Route::group(['prefix'=>'CBKetNoiAPI'],function (){
    Route::get('ThietLapChung','congbo\ketnoi\CongBoAPIController@ThietLapChung');
    Route::post('LuuChung','congbo\ketnoi\CongBoAPIController@LuuChung');
    Route::get('LayTLChung','congbo\ketnoi\CongBoAPIController@LayTLChung');
    Route::post('XoaTLChung','congbo\ketnoi\CongBoAPIController@XoaTLChung');
    Route::post('LinkKetNoi','congbo\ketnoi\CongBoAPIController@LinkKetNoi');
    Route::get('getLink','congbo\ketnoi\CongBoAPIController@getLink');
    
    //Chi tiết
    Route::get('ThietLapChiTiet','congbo\ketnoi\CongBoAPIController@ThietLapChiTiet');
    Route::get('HoSo','congbo\ketnoi\CongBoAPIController@ThietLapHoSo');
    Route::post('LuuHoSo','congbo\ketnoi\CongBoAPIController@LuuHoSo');
    Route::post('LuuHoSoChiTiet','congbo\ketnoi\CongBoAPIController@LuuHoSoChiTiet');
    Route::get('LayHoSo','congbo\ketnoi\CongBoAPIController@LayHoSo');
    Route::get('LayHoSoChiTiet','congbo\ketnoi\CongBoAPIController@LayHoSoChiTiet');
    Route::post('XoaHoSo','congbo\ketnoi\CongBoAPIController@XoaHoSo');
    Route::post('XoaHoSoChiTiet','congbo\ketnoi\CongBoAPIController@XoaHoSoChiTiet');

    Route::post('MacDinh','congbo\ketnoi\CongBoAPIController@MacDinh');
    Route::get('DanhSachKetNoi','congbo\ketnoi\CongBoAPIController@DanhSachKetNoi');
    
    //Truyền hồ sơ
    Route::post('TruyenHoSo','_dungchung\KetNoiCSDLQuocGiaController@send_post');
    Route::get('XemHoSo','_dungchung\KetNoiCSDLQuocGiaController@XemHoSo');
});
?>