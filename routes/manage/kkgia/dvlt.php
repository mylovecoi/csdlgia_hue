<?php
Route::resource('thongtincskd','manage\kekhaigia\kkdvlt\CsKdDvLtController');
Route::get('thongtincskdkkdvlt','manage\kekhaigia\kkdvlt\KkGiaDvLtController@ttcskd');
//Route::resource('kekhaigiadvlt','manage\kekhaigia\kkdvlt\KkGiaDvLtController');
Route::get('kekhaigiadvlt','manage\kekhaigia\kkdvlt\KkGiaDvLtController@index');
Route::get('kekhaigiadvlt/create','manage\kekhaigia\kkdvlt\KkGiaDvLtController@create');
Route::post('kekhaigiadvlt/store','manage\kekhaigia\kkdvlt\KkGiaDvLtController@store');
Route::get('kekhaigiadvlt/edit','manage\kekhaigia\kkdvlt\KkGiaDvLtController@edit');
Route::get('kekhaigiadvlt/prints','manage\kekhaigia\kkdvlt\KkGiaDvLtController@show');

Route::get('kekhaigiadvlt/nhanexcel','manage\kekhaigia\kkdvlt\KkGiaDvLtController@nhanexcel');
Route::post('kekhaigiadvlt/create_excel','manage\kekhaigia\kkdvlt\KkGiaDvLtController@create_excel');

Route::get('kekhaigiadvlt/kiemtra','manage\kekhaigia\kkdvlt\KkGiaDvLtController@ktchuyendvlt');
Route::post('kekhaigiadvlt/chuyen','manage\kekhaigia\kkdvlt\KkGiaDvLtController@chuyen');
Route::get('kekhaigiadvlt/get_sohs','manage\kekhaigia\kkdvlt\KkGiaDvLtController@showlydo');
Route::post('kekhaigiadvlt/delete','manage\kekhaigia\kkdvlt\KkGiaDvLtController@delete');


//Route::get('/kekhaigiadvltctdf/store','manage\kekhaigia\kkdvlt\KkGiaDvLtCtDfController@store');
//Route::get('/kekhaigiadvltctdf/edit','manage\kekhaigia\kkdvlt\KkGiaDvLtCtDfController@edit');
//Route::get('/kekhaigiadvltctdf/update','manage\kekhaigia\kkdvlt\KkGiaDvLtCtDfController@update');
//Route::get('/kekhaigiadvltctdf/delete','manage\kekhaigia\kkdvlt\KkGiaDvLtCtDfController@destroy');

Route::get('/kekhaigiadvltct/store','manage\kekhaigia\kkdvlt\KkGiaDvLtCtController@store');
Route::get('/kekhaigiadvltct/edit','manage\kekhaigia\kkdvlt\KkGiaDvLtCtController@edit');
Route::get('/kekhaigiadvltct/update','manage\kekhaigia\kkdvlt\KkGiaDvLtCtController@update');
Route::get('/kekhaigiadvltct/delete','manage\kekhaigia\kkdvlt\KkGiaDvLtCtController@destroy');

Route::get('xetduyetkkgiadvlt','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@index');
Route::post('xetduyetkkgiadvlt/tralai','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@tralai');
Route::get('xetduyetkkgiadvlt/ttnhanhs','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@ttnhanhs');
Route::post('xetduyetkkgiadvlt/nhanhs','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@nhanhs');
Route::post('xetduyetkkgiadvlt/chuyenxd','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@chuyenxd');
Route::post('xetduyetkkgiadvlt/congbo','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@congbo');
//Ajax xd
Route::get('xetduyetkkgiadvlt/ttdnkkdvlt','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@ttdnkkdvlt');

Route::get('timkiemkkgiadvlt','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@search');
Route::get('timkiemkkgiadvlt/printf','manage\kekhaigia\kkdvlt\KkGiaDvLtXdController@printf');

Route::get('baocaokekhaidvlt','manage\kekhaigia\kkdvlt\ReportsKkDvLtController@index');
Route::post('reports/kekhaidvlt/BC5','manage\kekhaigia\kkdvlt\ReportsKkDvLtController@dvltbc5');
Route::post('reports/kekhaidvlt/BC6','manage\kekhaigia\kkdvlt\ReportsKkDvLtController@dvltbc6');

?>