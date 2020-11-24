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

use App\Image;


//Generales
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//User
Route::get('/configuracion','userController@configuracion')->name('configuracion');
Route::get('/cambiarContraseña','userController@contraseña')->name('password');
Route::get('/user/avatar/{filename}','userController@getImage')->name('user.avatar');
Route::post('user/update','userController@update')->name('user.update');
Route::post('user/updatePW','userController@updatePW')->name('user.updatePW');
Route::get('/profile/{id}','userController@profile')->name('profile');
Route::get('/perfiles/{search?}','userController@index')->name('user.index');
Route::get('profile/delete/{id}','userController@delete')->name('user.delete');

//Imagen
Route::get('/subir-imagen','imageController@create')->name('image.create');
Route::post('/imagen-subida','imageController@saveImg')->name('subirImagen');
Route::get('/image/file/{filename}','imageController@getImage')->name('image.file');
Route::get('/image/{id}','imageController@detail')->name('image.detail');
Route::get('/borrarImagen/{id}','imageController@delete')->name('borrarImagen');
Route::get('/editar/{id}','imageController@edit')->name('image.edit');
Route::post('/actualizar','imageController@update')->name('image.update');

//Comment
Route::post('/comment/save','commentController@save')->name('subirComment');
Route::get('/comment/delete/{id}','commentController@delete')->name('comment.delete');

//Like
Route::get('/like/{image_id}','likeController@like')->name('saveLike');
Route::get('/dislike/{image_id}','likeController@dislike')->name('dislike');
Route::get('/like','likeController@index')->name('like');




