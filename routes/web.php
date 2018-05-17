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

Route::get('', function () {
	//return view('welcome');
	if(Auth::check()){return Redirect::to('dashboard');}
	return Redirect::to('login');
});

/*-- Login --*/
Route::get('login', function () {
	return view('login');
})->name('Login');
Route::post('login','LoginController@login');

Route::group(['middleware' => ['auth']], function() {
	#Login
	Route::post('logout','LoginController@logout');

	#Dashboard
	Route::get('dashboard', 'HomeController@index')->name('Dashboard');
	Route::put('actualizar-foto-perfil/{id}', 'UsersController@updatePhotoProfile')->name('User.updatePictue');

	#Compañia
	Route::get('empresa', 'CompaniesController@index')->name('Company');
	Route::put('actualizar-empresa/{id}', 'CompaniesController@update')->name('Company.update');

	#Usuarios
	Route::get('usuarios-sistema', 'UsersController@index')->name('User.index1');
	Route::get('usuarios-aplicacion', 'UsersController@index')->name('User.index2');
	Route::get('formulatio-usuario/{id?}', 'UsersController@form')->name('User.form');
	Route::post('alta-usuario', 'UsersController@store')->name('User.store');
	Route::put('actualizar-usuario/{id}', 'UsersController@update')->name('User.update');
	Route::patch('status-usuario', 'UsersController@status')->name('User.status');
	Route::delete('eliminar-usuario/{id}', 'UsersController@destroy')->name('User.destroy');

	#Noticias
	Route::get('noticias', 'NewsController@index')->name('News');
	Route::get('formulatio-Noticias/{id?}', 'NewsController@form')->name('News.form');
	Route::post('alta-Noticia', 'NewsController@store')->name('News.store');
	Route::put('actualizar-Noticia/{id}', 'NewsController@update')->name('News.update');
	Route::patch('status-Noticia', 'NewsController@status')->name('News.status');
	Route::delete('eliminar-Noticia/{id}', 'NewsController@destroy')->name('News.destroy');
	Route::delete('eliminar-Noticias', 'NewsController@multipleDestroys')->name('News.multipleDestroys');

	#Banners
	Route::get('banners', 'BannersController@index')->name('Banner');
	Route::get('formulario-banners/{id?}', 'BannersController@form')->name('Banner.form');
	Route::post('alta-banner', 'BannersController@store')->name('Banner.store');
	Route::put('actualizar-banner/{id}', 'BannersController@update')->name('Banner.update');
	Route::patch('status-banner', 'BannersController@status')->name('Banner.status');
	Route::delete('eliminar-banner/{id}', 'BannersController@destroy')->name('Banner.destroy');
	Route::delete('eliminar-banners', 'BannersController@multipleDestroys')->name('Banner.multipleDestroys');

	#Faqs
	Route::get('faqs', 'FaqsController@index')->name('Faq');
	Route::get('formulario-faqs/{id?}', 'FaqsController@form')->name('Faq.form');
	Route::post('alta-faq', 'FaqsController@store')->name('Faq.store');
	Route::put('actualizar-faq/{id}', 'FaqsController@update')->name('Faq.update');
	Route::patch('status-faq', 'FaqsController@status')->name('Faq.status');
	Route::delete('eliminar-faq/{id}', 'FaqsController@destroy')->name('Faq.destroy');
	Route::delete('eliminar-faqs', 'FaqsController@multipleDestroys')->name('Faq.multipleDestroys');
});

#Rutas API
Route::prefix('apiv1')->group(function () {

});