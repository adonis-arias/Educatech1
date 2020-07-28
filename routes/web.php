<?php

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

Route::get('/','DashboardController@index')->name('app.dashboard');

Route::get('login','Auth\AutenticacionController@showLoginForm')->name('app.login.form');
Route::post('login','Auth\AutenticacionController@login')->name('app.login.submit');
Route::post('logout','Auth\AutenticacionController@logout')->name('app.logout');
//Cursos
Route::get('cursos','CourseController@showPage')->name('app.course.page');
