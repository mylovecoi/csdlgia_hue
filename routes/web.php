<?php
use Illuminate\Support\Facades\Route;

Route::get('','HomeController@index');
Route::get('thongtinhotro','system\dsvanphongController@hotro');
//Route::get('/testword', 'HomeController@testword');
//Route::get('/ajax/checkngay','AjaxController@checkngay');
//Route::get('/ajax/checkngaykk','AjaxController@checkngaykk');
//Route::get('/ajax/checkusername','AjaxController@checkusername');
//Route::get('/ajax/checkmaqhns','AjaxController@checkmaqhns');
//Route::get('/ajax/checkmasothue','AjaxController@checkmasothue');
//Route::get('/ajax/registerthongtin','AjaxController@registerthongtin');
//Route::get('/ajax/getTown','AjaxController@getTown');
//Route::get('ajax/reggetper','AjaxController@reggetper');

//Register
//include('system/register.php');
//End Register

//System
include('system/system.php');
//End System

//Manage
include('manage/bog.php');
/*include('manage/giaetanol.php');
include('manage/giasach.php');
include('manage/giathan.php');
include('manage/giagiay.php');*/
//include('manage/dangkygia.php');
include('manage/dinhgia.php');
include('manage/thamdinhgia.php');
include('manage/thamdinhgiahh.php');
include('manage/kekhaigia.php');
include('manage/vbqlnn.php');
include('manage/thanhlytaisan.php');
include('manage/cungcapgiahh.php');
//include('manage/muataisan.php');
include('manage/phichuyengia.php');
include('manage/chisogiatieudung.php');
include('manage/giagocvlxd.php');
include('manage/giadatduan.php');
include('manage/ttpvctqlnn.php');
include('manage/thongke.php');
include('manage/csdlquocgia.php');

//End Manage

//View
include('congbo/congbo.php');

//End view



