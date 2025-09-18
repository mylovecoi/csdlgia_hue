<?php

use App\Http\Controllers\csdlquocgia\qg_giathitruongController;
use App\Http\Controllers\csdlquocgia\qg_racthaiController;
use App\Http\Controllers\csdlquocgia\qg_thuetainguyenController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'csdlquocgia'], function () {
    // Route::group(['prefix' => 'qg_racthai'], function () {
    //     Route::get('danhmuc', [qg_racthaiController::class, 'danhmuc']);
    //     Route::get('hoso', [qg_racthaiController::class, 'hoso']);        
    // });
    // Route::group(['prefix' => 'qg_giathitruong'], function () {
    //     Route::get('danhmuc', [qg_giathitruongController::class, 'danhmuc']);
    //     Route::get('hoso', [qg_giathitruongController::class, 'hoso']);        
    // });
    // Route::group(['prefix' => 'qg_thuetainguyen'], function () {
    //     Route::get('danhmuc', [qg_thuetainguyenController::class, 'danhmuc']);
    //     Route::get('hoso', [qg_thuetainguyenController::class, 'hoso']);        
    // });
    Route::group(['prefix'=>'qg_giathuetn'], function(){
        //Nhận danh mục
        Route::get('nhandanhmuc','csdlquocgia\qg_giathuetnController@nhandanhmuc');
        Route::post('chuyendm','csdlquocgia\qg_giathuetnController@chuyendm');
        Route::get('innhandanhmuccsdlqg','csdlquocgia\qg_giathuetnController@innhandanhmuccsdlqg');

        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_giathuetnController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_giathuetnController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_giathuetnController@innhanhosocsdlqg');

        //Truyền danh mục
        Route::get('danhmuc','csdlquocgia\qg_giathuetnController@truyendanhmuc');
        Route::get('show_nhomdm','csdlquocgia\qg_giathuetnController@show_nhomdm');
        Route::post('capnhatdanhmuc','csdlquocgia\qg_giathuetnController@capnhatdanhmuc');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_giathuetnController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_giathuetnController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_giathuetnController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_giathuetnController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_giathuetnController@congbo_hoso');
    });

    Route::group(['prefix'=>'qg_giahhdvcn'], function(){
        //Nhận danh mục
        Route::get('nhandanhmuc','csdlquocgia\qg_giahhdvcnController@nhandanhmuc');
        Route::post('chuyendm','csdlquocgia\qg_giahhdvcnController@chuyendm');

        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_giahhdvcnController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_giahhdvcnController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_giahhdvcnController@innhanhosocsdlqg');

        //Truyền danh mục
        Route::get('danhmuc','csdlquocgia\qg_giahhdvcnController@truyendanhmuc');
        Route::get('show_nhomdm','csdlquocgia\qg_giahhdvcnController@show_nhomdm');
        Route::post('capnhatdanhmuc','csdlquocgia\qg_giahhdvcnController@capnhatdanhmuc');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_giahhdvcnController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_giahhdvcnController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_giahhdvcnController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_giahhdvcnController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_giahhdvcnController@congbo_hoso');
    });

    Route::group(['prefix'=>'qg_giadvgddt'], function(){
        //Nhận danh mục
        Route::get('nhandanhmuc','csdlquocgia\qg_giadvgddtController@nhandanhmuc');
        Route::post('chuyendm','csdlquocgia\qg_giadvgddtController@chuyendm');

        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_giadvgddtController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_giadvgddtController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_giadvgddtController@innhanhosocsdlqg');

        //Truyền danh mục
        Route::get('danhmuc','csdlquocgia\qg_giadvgddtController@truyendanhmuc');
        Route::get('show_nhomdm','csdlquocgia\qg_giadvgddtController@show_nhomdm');
        Route::post('capnhatdanhmuc','csdlquocgia\qg_giadvgddtController@capnhatdanhmuc');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_giadvgddtController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_giadvgddtController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_giadvgddtController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_giadvgddtController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_giadvgddtController@congbo_hoso');
    });

    Route::group(['prefix'=>'qg_giaspdvci'], function(){
        //Nhận danh mục
        Route::get('nhandanhmuc','csdlquocgia\qg_giaspdvciController@nhandanhmuc');
        Route::post('chuyendm','csdlquocgia\qg_giaspdvciController@chuyendm');

        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_giaspdvciController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_giaspdvciController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_giaspdvciController@innhanhosocsdlqg');

        //Truyền danh mục
        Route::get('danhmuc','csdlquocgia\qg_giaspdvciController@truyendanhmuc');
        Route::get('show_nhomdm','csdlquocgia\qg_giaspdvciController@show_nhomdm');
        Route::post('capnhatdanhmuc','csdlquocgia\qg_giaspdvciController@capnhatdanhmuc');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_giaspdvciController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_giaspdvciController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_giaspdvciController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_giaspdvciController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_giaspdvciController@congbo_hoso');
    });

    Route::group(['prefix'=>'qg_giaphilephi'], function(){
        //Nhận danh mục
        Route::get('nhandanhmuc','csdlquocgia\qg_giaphilephiController@nhandanhmuc');
        Route::post('chuyendm','csdlquocgia\qg_giaphilephiController@chuyendm');

        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_giaphilephiController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_giaphilephiController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_giaphilephiController@innhanhosocsdlqg');

        //Truyền danh mục
        Route::get('danhmuc','csdlquocgia\qg_giaphilephiController@truyendanhmuc');
        Route::get('show_nhomdm','csdlquocgia\qg_giaphilephiController@show_nhomdm');
        Route::post('capnhatdanhmuc','csdlquocgia\qg_giaphilephiController@capnhatdanhmuc');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_giaphilephiController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_giaphilephiController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_giaphilephiController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_giaphilephiController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_giaphilephiController@congbo_hoso');
    });

    Route::group(['prefix'=>'qg_giahhdvk'], function(){
        //Nhận danh mục
        Route::get('nhandanhmuc','csdlquocgia\qg_giahhdvkController@nhandanhmuc');
        Route::post('chuyendm','csdlquocgia\qg_giahhdvkController@chuyendm');

        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_giahhdvkController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_giahhdvkController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_giahhdvkController@innhanhosocsdlqg');

        //Truyền danh mục
        Route::get('danhmuc','csdlquocgia\qg_giahhdvkController@truyendanhmuc');
        Route::get('show_nhomdm','csdlquocgia\qg_giahhdvkController@show_nhomdm');
        Route::post('capnhatdanhmuc','csdlquocgia\qg_giahhdvkController@capnhatdanhmuc');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_giahhdvkController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_giahhdvkController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_giahhdvkController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_giahhdvkController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_giahhdvkController@congbo_hoso');
    });

    Route::group(['prefix'=>'qg_thamdinhgia'], function(){
        //Nhận danh mục
        Route::get('nhandanhmuc','csdlquocgia\qg_thamdinhgiaController@nhandanhmuc');
        Route::post('chuyendm','csdlquocgia\qg_thamdinhgiaController@chuyendm');

        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_thamdinhgiaController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_thamdinhgiaController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_thamdinhgiaController@innhanhosocsdlqg');

        //Truyền danh mục
        Route::get('danhmuc','csdlquocgia\qg_thamdinhgiaController@truyendanhmuc');
        Route::get('show_nhomdm','csdlquocgia\qg_thamdinhgiaController@show_nhomdm');
        Route::post('capnhatdanhmuc','csdlquocgia\qg_thamdinhgiaController@capnhatdanhmuc');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_thamdinhgiaController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_thamdinhgiaController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_thamdinhgiaController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_thamdinhgiaController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_thamdinhgiaController@congbo_hoso');
    });

    Route::group(['prefix'=>'qg_kkgiaetanol'], function(){
        //Nhận hồ sơ
        Route::get('nhanhoso','csdlquocgia\qg_kkgiaetanolController@nhanhoso');
        Route::post('chuyenhs','csdlquocgia\qg_kkgiaetanolController@chuyenhs');
        Route::get('innhanhosocsdlqg','csdlquocgia\qg_kkgiaetanolController@innhanhosocsdlqg');

        //Truyền hồ sơ
        Route::get('hoso','csdlquocgia\qg_kkgiaetanolController@truyenhoso');
        Route::get('show_hoso','csdlquocgia\qg_kkgiaetanolController@show_hoso');
        Route::post('capnhathoso','csdlquocgia\qg_kkgiaetanolController@capnhathoso');

        //Công bố dữ liệu
        Route::get('congbo_danhmuc','csdlquocgia\qg_kkgiaetanolController@congbo_danhmuc');
        Route::get('congbo_hoso','csdlquocgia\qg_kkgiaetanolController@congbo_hoso');
    });
});