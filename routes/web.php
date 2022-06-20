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
    return redirect('login');
});

/*Route per la registrazione/logout e controllo dati*/
Route::get('register', 'App\Http\Controllers\RegisterController@register_form');
Route::post('register', 'App\Http\Controllers\RegisterController@do_register');
Route::get('logout','App\Http\Controllers\RegisterController@logout');
Route::get('register/email/{query}', 'App\Http\Controllers\RegisterController@checkEmail');
Route::get('register/username/{query}', 'App\Http\Controllers\RegisterController@checkUsername');


/*Route per il login */

Route::get('login', 'App\Http\Controllers\RegisterController@login_form');
Route::post('login', 'App\Http\Controllers\RegisterController@do_login');


/*Route per la home */


Route::get('home', 'App\Http\Controllers\HomeController@home');
Route::get('post', 'App\Http\Controllers\FeedController@post');
Route::get('spotify', 'App\Http\Controllers\FeedController@spotify');
Route::get('favorite', 'App\Http\Controllers\FavoriteController@index');
Route::get('post_liked', 'App\Http\Controllers\FavoriteController@post_liked');
Route::get('/search_post/{q}', 'App\Http\Controllers\FeedController@search_post');
Route::get('/delete_post/{q}', 'App\Http\Controllers\FeedController@delete_post');
Route::get('/likes/{id_post}', 'App\Http\Controllers\LikeController@likes');


/*Route creazione post */

Route::get('create', 'App\Http\Controllers\CreateController@index');
Route::post('create', 'App\Http\Controllers\CreateController@do_create');

/*Route news e feedback con MongoDB */


Route::get('news','App\Http\Controllers\NewsController@news');
Route::get('/news/getnews','App\Http\Controllers\NewsController@getnews');
Route::get('feedback','App\Http\Controllers\FeedbackController@feedback');
Route::post('feedback/send_feedback','App\Http\Controllers\FeedbackController@send_feedback');
