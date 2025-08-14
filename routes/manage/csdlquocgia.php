<?php

use App\Http\Controllers\csdlquocgia\qg_giathitruongController;
use App\Http\Controllers\csdlquocgia\qg_racthaiController;
use App\Http\Controllers\csdlquocgia\qg_thuetainguyenController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'csdlquocgia'], function () {
    Route::group(['prefix' => 'qg_racthai'], function () {
        Route::get('danhmuc', [qg_racthaiController::class, 'danhmuc']);
        Route::get('hoso', [qg_racthaiController::class, 'hoso']);        
    });
    Route::group(['prefix' => 'qg_giathitruong'], function () {
        Route::get('danhmuc', [qg_giathitruongController::class, 'danhmuc']);
        Route::get('hoso', [qg_giathitruongController::class, 'hoso']);        
    });
    Route::group(['prefix' => 'qg_thuetainguyen'], function () {
        Route::get('danhmuc', [qg_thuetainguyenController::class, 'danhmuc']);
        Route::get('hoso', [qg_thuetainguyenController::class, 'hoso']);        
    });
});

Route::group(['prefix'=>'qg_giathuetn'], function(){
    //Nhận danh mục
    Route::get('nhandanhmuc','csdlquocgia\qg_giathuetnController@nhandanhmuc');
    Route::get('innhandanhmuccsdlqg','csdlquocgia\qg_giathuetnController@innhandanhmuccsdlqg');

    //Nhận hồ sơ
    Route::get('nhanhoso','csdlquocgia\qg_giathuetnController@nhanhoso');
    Route::get('innhanhosocsdlqg','csdlquocgia\qg_giathuetnController@innhanhosocsdlqg');

    //Truyền danh mục
    Route::get('danhmuc','csdlquocgia\qg_giathuetnController@truyendanhmuc');
    Route::get('show_nhomdm','csdlquocgia\qg_giathuetnController@show_nhomdm');
    Route::post('capnhatdanhmuc','csdlquocgia\qg_giathuetnController@capnhatdanhmuc');

    //Truyền hồ sơ
    Route::get('hoso','csdlquocgia\qg_giathuetnController@truyenhoso');
    Route::get('show_hoso','csdlquocgia\qg_giathuetnController@show_hoso');
    Route::post('capnhathoso','csdlquocgia\qg_giathuetnController@capnhathoso');
});

Route::group(['prefix'=>'qg_giahhdvcn'], function(){
    //Nhận danh mục
    Route::get('nhandanhmuc','csdlquocgia\qg_giahhdvcnController@nhandanhmuc');
    Route::get('innhandanhmuccsdlqg','csdlquocgia\qg_giahhdvcnController@innhandanhmuccsdlqg');

    //Nhận hồ sơ
    Route::get('nhanhoso','csdlquocgia\qg_giahhdvcnController@nhanhoso');
    Route::get('innhanhosocsdlqg','csdlquocgia\qg_giahhdvcnController@innhanhosocsdlqg');

    //Truyền danh mục
    Route::get('danhmuc','csdlquocgia\qg_giahhdvcnController@truyendanhmuc');
    Route::get('show_nhomdm','csdlquocgia\qg_giahhdvcnController@show_nhomdm');
    Route::post('capnhatdanhmuc','csdlquocgia\qg_giahhdvcnController@capnhatdanhmuc');

    //Truyền hồ sơ
    Route::get('hoso','csdlquocgia\qg_giahhdvcnController@truyenhoso');
    Route::get('show_hoso','csdlquocgia\qg_giahhdvcnController@show_hoso');
    Route::post('capnhathoso','csdlquocgia\qg_giahhdvcnController@capnhathoso');
});