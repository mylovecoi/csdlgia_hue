<?php
Route::resource('baocaochisogiatieudung','ChiSoGiaTieuDungController');
Route::post('baocaochisogiatieudung/delete','ChiSoGiaTieuDungController@destroy');
Route::post('baocaochisogiatieudung/hoanthanh','ChiSoGiaTieuDungController@hoanthanh');
Route::post('baocaochisogiatieudung/congbo','ChiSoGiaTieuDungController@congbo');
Route::post('baocaochisogiatieudung/huyhoanthanh','ChiSoGiaTieuDungController@huyhoanthanh');


Route::group(['prefix'=>'ChiSoCPI'],function (){
    Route::get('DanhMuc','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMucController@index');
    Route::post('DanhMuc','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMucController@store');
    Route::get('ChiTietDM','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMucController@ChiTiet');
    Route::post('ChiTietDM','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMucController@LuuChiTiet');
    Route::get('show_nhomdm','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMucController@show_nhomdm');
    Route::get('show_hanghoa','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DanhMucController@show_hanghoa');

    Route::group(['prefix'=>'TieuChi'],function (){
        Route::get('DanhSach','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_TieuChiController@index');
        Route::post('DanhSach','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_TieuChiController@store');
        Route::get('layTieuChi','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_TieuChiController@layTieuChi');
        Route::post('Xoa','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_TieuChiController@destroy');
        
    });

    Route::group(['prefix'=>'DuBao'],function (){
        Route::get('KichBan','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DuBaoController@KichBan');
        Route::post('KichBan','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DuBaoController@storeKichBan');
        
        Route::get('ChiTiet','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DuBaoController@ChiTiet');
        Route::post('ChiTiet','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DuBaoController@storeChiTiet');

        Route::get('DuBao','manage\vanbanplvegia\chisogiatieudung\chisogiatieudung_DuBaoController@DuBao');
        
    });
});
?>