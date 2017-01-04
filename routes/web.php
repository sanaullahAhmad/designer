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

Route::get('/', 'homeController@create');
Route::get('/get-catimages', 'homeController@getCatImages');
Route::get('/get-bgimages', 'homeController@getBgImages');
Route::get('/gettemplatename', 'homeController@getTemplateName');
Route::get('/get-templates', 'homeController@getTemplates');
Route::get('/getextategory', 'homeController@getTextCategory');
Route::get('/loadtemplate', 'homeController@loadtemplate');
Route::get('/uploadimage', 'homeController@uploadimage');
Route::get('/getuploadimages', 'homeController@getUploadImages');
Route::get('/get_texts', 'homeController@get_texts');
Route::get('/gettempCategory', 'homeController@gettempCategory');
Route::get('/getCategory', 'homeController@getCategory');
Route::get('/bg_categories', 'homeController@bg_categories');
Route::get('/get_uploadimages', 'homeController@get_uploadimages');
Route::get('/loadtext', 'homeController@loadtext');
Route::get('/gettempCatmat', 'homeController@gettempCatmat');
Route::post('/deleteBackground', 'homeController@deleteBackground');
Route::post('/addcategory', 'homeController@addcategory');
Route::post('/deletetempcategory', 'homeController@deletetempcategory');
Route::post('/deletecategory', 'homeController@deletecategory');
Route::post('/deletebgcategory', 'homeController@deletebgcategory');
Route::post('/deletetextcategory', 'homeController@deletetextcategory');
Auth::routes();

Route::get('/administrator', 'AdminController@index');
