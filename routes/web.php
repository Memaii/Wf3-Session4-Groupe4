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

// Route admin
Route::prefix('admin')->group(function ()
{
	// général
	Route::get('/', 'adminController@accueil')->middleware('auth')->name('admin');

	// boutiques
	Route::get('/boutiques', 'adminController@boutiques')->middleware('auth')->name('boutiques');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
