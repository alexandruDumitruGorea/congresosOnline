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

Route::get('/', 'NavController@index');

Auth::routes(['verify' => true]);

Route::get('admin', 'NavController@adminIndex');

Route::resource('congress', 'CongressController');

Route::resource('presentation', 'PresentationController');

Route::resource('organizator', 'OrganizatorController');

Route::resource('speaker', 'SpeakerController');

Route::get('user', 'UserController@edit');
Route::put('user', 'UserController@update');
Route::put('user/password', 'UserController@password');
Route::get('user/file/{userfile?}', 'UserController@imagefile');
Route::get('speakersajax', 'UserController@speakersajax');

Route::resource('assistant-presentation', 'AssistantPresentationController');
Route::get('assistant-presentation/pdf/{pdffile?}', 'AssistantPresentationController@pdffile');

Route::get('pay', 'AssistantPresentationController@create');
Route::post('paycorrect', 'AssistantPresentationController@store');
Route::get('download', 'AssistantPresentationController@download');

Route::get('urlcertificate/{title?}', 'PresentationController@urlcertificate');
Route::get('certificate', 'PresentationController@certificate');
