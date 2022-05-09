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


Route::get('/', 'HomeController@index')->middleware('auth');
Auth::routes();

Route::get('home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('Dashboard/{id?}', 'HomeController@Dashboard')->name('Dashboard')->middleware('auth');
Route::get('All', 'HomeController@AllUsers')->name('All')->middleware('auth');
Route::post('changestatu', 'HomeController@changestatus')->name('changestatu')->middleware('auth');
Route::post('delete', 'HomeController@delete_user')->name('delete')->middleware('auth');
Route::resource('tickets', 'TicketController')->only(['index','show','create','store'])->middleware('auth');
Route::resource('comments', 'CommentController')->only('store')->middleware('auth');
