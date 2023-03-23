<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'front\AuthController@login')->name('login');
Route::post('login', 'front\AuthController@submitlogin')->name('submitlogin');
//Route::post('/login/{id?}', 'front\AuthController@submitlogin')->name('submitlogin');
Route::get('logout', 'front\AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function() {


   // Route::get('/qrtree/{id}', 'front\TreeController@viewtree')->name('tree.viewtree');
    Route::get('/viewtree/{id}', 'front\TreeController@view')->name('tree.view');

    
});
?>