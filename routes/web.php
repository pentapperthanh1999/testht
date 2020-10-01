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

Route::resource('posts', 'PostController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pdf', 'PostController@createPDF')->name('pdf');
//Create file upload form
Route::get('/upload-file', 'FileUploadController@createForm');
// Store file
Route::post('/upload-file', 'FileUploadController@fileUpload')->name('fileUpload');
//Contact
Route::get('contact', 'ContactController@sendMail')->name('contact');