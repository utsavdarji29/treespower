<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/optimize-clear', function() {
     $exitCode = Artisan::call('optimize:clear');
 });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'UserController@login')->name('login');
Route::post('/logout','UserController@Logout')->name('logout');
Route::get('/get_profile', 'UserController@get_profile')->name('get_profile');
Route::post('/edit_profile', 'UserController@edit_profile')->name('edit_profile');
Route::post('/forgotPassword', 'UserController@forgotPassword')->name('forgotPassword');

//Jobtask
Route::get('/get_task', 'JobController@get_task')->name('get_task');
Route::get('/get_task_detail', 'JobController@get_task_detail')->name('get_task_detail');
Route::post('/save_task', 'JobController@save_task')->name('save_task');
Route::post('/update_taskStatus','JobController@update_taskStatus')->name('update_taskStatus');

//Tree
Route::get('/get_treeDetail', 'TreeController@get_treeDetail')->name('get_treeDetail');
Route::get('/get_treeList', 'TreeController@get_treeList')->name('get_treeList');

Route::post('/save_treereport','TreeController@save_treereport')->name('save_treereport');
Route::post('/edit_treereport','TreeController@edit_treereport')->name('edit_treereport');

Route::post('/edit_treedetail','TreeController@edit_treedetail')->name('edit_treedetail');

Route::get('/get_newTreeReport', 'TreeController@get_newTreeReport')->name('get_newTreeReport');
Route::get('/get_checkedTreeReport', 'TreeController@get_checkedTreeReport')->name('get_checkedTreeReport');
Route::get('/get_treeReport', 'TreeController@get_treeReport')->name('get_treeReport');

Route::post('/delete_treeimage','TreeController@delete_treeimage')->name('delete_treeimage');
Route::get('/get_treeIdDetails', 'TreeController@get_treeIdDetails')->name('get_treeIdDetails');