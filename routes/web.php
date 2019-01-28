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
//Route::get('my-home', 'HomeController@myHome');

//Route::get('my-users', 'HomeController@myUsers');
Auth::routes();

Route::get('/admin', 'AdminController@myUsers')->middleware('is_admin')->name('admin
	');

 Route::delete('admin/{admin}','AdminController@destroy')->name('user.delete');
 Route::get('/admin/{admin}/edit', 'AdminController@edit')->name('user.edit');
 Route::post('/admin/{admin}', 'AdminController@update')->name('user.update');

Route::get('/','IsbnController@index');

Route::get('/list','IsbnController@insertIsbn')->name('Isbn.insertIsbn');

Route::get('/title','IsbnController@getTitle');
Route::get('/addtolist','IsbnController@addtolist')->name('Isbn.addtolist');
Route::post('/downloadcsv','IsbnController@downloadcsv')->name('Isbn.downloadcsv');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Route::get('/list','')  



//Route::get('/home', 'HomeController@index')->name('home');
