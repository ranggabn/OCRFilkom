<?php

use App\Http\Controllers\UploadController;
use Hamcrest\Text\SubstringMatcher;
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

/*Route::get('/', function() {
    return view('index');
});*/

Route::get('/', 'IndexController@index');
Route::get('/mou', 'UploadController@mou');
Route::get('/moa', 'UploadController2@moa');

Route::post('/upload', 'UploadController@create');
Route::post('/upload2', 'UploadController2@create2');
Route::post('/submit', 'UploadController@save');
Route::post('/submit2', 'UploadController2@save');
