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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//首頁
Route::get('/', 'Welcome@main')->name('welcome');

//管理設定------------------
//管理頁面
Route::get('/admin/list', 'Admin@main')->name('admin');
//部門管理
Route::get('/admin/department', 'Admin@department')->name('department');
//權限管理
Route::get('/admin/competence', 'Admin@competence')->name('competence');
//會員管理
Route::get('/admin/member', 'Admin@member')->name('member');


