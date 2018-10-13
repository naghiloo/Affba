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

Route::get('/', 'HomeController@main');
 
Auth::routes();

Route::get('/landing', function() {
    return view('faq');
});

Route::post('/link/create', 'LinkController@create');

route::group(['middleware' => 'auth'], function(){
    //Route::get('/link/', 'LinkController@list');
    Route::get('/link/{shortUrl?}', 'LinkController@stats');
    Route::get('/link/{shortUrl?}/edit', 'LinkController@edit');
    Route::get('/logout', function() {
        Auth::logout();
        return Redirect::to('/');
    });
});
Route::post('/update', 'LinkController@updateLink')->name('updateLink');

Route::get('/faq', function() {
    return view('faq');
});

Route::post('/faq', 'FormController@contact');

Route::get('/terms', function() {
    return view('terms');
});

Route::get('/about-us', function() {
    return view('about-us');
});

Route::get('/contact', function() {
    return view('contact');
});

Route::post('/contact', 'FormController@contact');

Route::get('/{shortLink}', 'LinkController@redirect');
