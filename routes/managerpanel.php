<?php



// use Illuminate\Support\Facades\Route;



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



Route::get('', function () {

    return redirect('/login');

})->name('index');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@submitlogin')->name('submitlogin');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::post('/forgotpassword', 'AuthController@forgotpassword')->name('forgotpassword');
Route::group(['middleware' => 'auth:manager'], function(){

	//Dashboard

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	//USER

	Route::get('/manageuser', 'UserController@manage')->name('user.manage');
	Route::get('/adduser', 'UserController@add')->name('user.add');
	Route::post('/adduser', 'UserController@save')->name('user.save');
	Route::get('/edituser/{id}', 'UserController@edit')->name('user.edit');
	Route::post('/edituser', 'UserController@update')->name('user.update');
	Route::get('/deleteuser/{id}', 'UserController@delete')->name('user.delete');
	Route::get('/searchuser', 'UserController@search')->name('user.search');


	//Manager

	Route::get('/managemanager', 'ManagerController@manage')->name('manager.manage');

	Route::get('/addmanager', 'ManagerController@add')->name('manager.add');

	Route::post('/addmanager', 'ManagerController@save')->name('manager.save');

	Route::get('/editmanager/{id}', 'ManagerController@edit')->name('manager.edit');

	Route::post('/editmanager', 'ManagerController@update')->name('manager.update');

	Route::get('/deletemanager/{id}', 'ManagerController@delete')->name('manager.delete');

	Route::get('/searchmanager', 'ManagerController@search')->name('manager.search');



	//Manager

	Route::get('/managecategory', 'CategoryController@manage')->name('category.manage');

	Route::get('/addcategory', 'CategoryController@add')->name('category.add');

	Route::post('/addcategory', 'CategoryController@save')->name('category.save');

	Route::get('/editcategory/{id}', 'CategoryController@edit')->name('category.edit');

	Route::post('/editcategory', 'CategoryController@update')->name('category.update');

	Route::get('/deletecategory/{id}', 'CategoryController@delete')->name('category.delete');

	Route::get('/searchcategory', 'CategoryController@search')->name('category.search');



	//Job

	Route::get('/managejob', 'JobController@manage')->name('job.manage');
	Route::get('/addjob/{id}', 'JobController@add')->name('job.add');

	Route::post('/addjob', 'JobController@save')->name('job.save');

	Route::get('/editjob/{id}', 'JobController@edit')->name('job.edit');

	Route::post('/editjob', 'JobController@update')->name('job.update');

	Route::get('/deletejob/{id}', 'JobController@delete')->name('job.delete');

	Route::get('/searchjob', 'JobController@search')->name('job.search');
	Route::get('/searchtreeoperator', 'JobController@searchtreeoperator')->name('job.searchtreeoperator');
	Route::get('/searchjoblocation', 'JobController@searchjoblocation')->name('job.searchjoblocation');
	Route::get('/ajaxgetuser', 'JobController@ajaxgetuser')->name('job.ajaxgetuser');

	Route::get('/viewjob/{id}', 'JobController@view')->name('job.view');
	Route::get('/updateAll', 'JobController@updateAll')->name('job.updateAll');

	//Tree
	Route::get('/managetree', 'TreeController@manage')->name('tree.manage');
	Route::get('/edittree/{id}', 'TreeController@edit')->name('tree.edit');
	Route::post('/edittree', 'TreeController@update')->name('tree.update');
	Route::get('/deletetree/{id}', 'TreeController@delete')->name('tree.delete');
	Route::get('/deletetreeimage/{id}', 'TreeController@deletetreeimage')->name('tree.deletetreeimage');
	Route::get('/viewtree/{id}', 'TreeController@view')->name('tree.view');
	Route::get('/searchtree', 'TreeController@search')->name('tree.search');


	//Report
	Route::get('/managereport', 'ReportController@manage')->name('report.manage');
	Route::get('/updateReportAll', 'ReportController@updateReportAll')->name('report.updateReportAll');
	Route::get('/viewreport/{id}', 'ReportController@view')->name('report.view');
	Route::get('/searchreport', 'ReportController@search')->name('report.search');
	Route::get('/searchtreereport', 'ReportController@searchtreereport')->name('report.searchtreereport');
	Route::get('/searchtreereportlocation', 'ReportController@searchtreereportlocation')->name('report.searchtreereportlocation');
	Route::get('/deletereport/{id}', 'ReportController@delete')->name('report.delete');
});



?>