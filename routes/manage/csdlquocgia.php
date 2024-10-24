<?php

use App\Http\Controllers\csdlquocgia\qg_racthaiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'csdlquocgia'], function () {
    Route::group(['prefix' => 'qg_racthai'], function () {
        Route::get('danhmuc', [qg_racthaiController::class, 'danhmuc']);
        Route::get('hoso', [qg_racthaiController::class, 'hoso']);        
    });
});
