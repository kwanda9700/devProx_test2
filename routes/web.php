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

// Route::get('form', 'DataController@create')->name('form.create');
Route::get('/', 'App\Http\Controllers\DataController@index');
Route::get('create', 'App\Http\Controllers\DataController@create')->name('create');
Route::post('upload', 'App\Http\Controllers\DataController@upload')->name('upload');
// Route::post('/uploadFile', 'PagesController@uploadFile');
Route::post('store', 'App\Http\Controllers\DataController@store')->name('form.store');
Route::get('success', 'App\Http\Controllers\DataController@success')->name('success');

// Route::get('upload', function () {
    
// });
