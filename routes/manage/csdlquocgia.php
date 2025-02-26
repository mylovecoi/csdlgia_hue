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
