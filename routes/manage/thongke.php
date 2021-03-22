<?php
//DV Khám chữa bệnh
Route::group(['prefix'=>'thongke'], function (){
    Route::get('hanhchinh','thongkeController@hanhchinh');
    Route::get('doanhnghiep','thongkeController@doanhnghiep');
});
?>