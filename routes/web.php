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


Route::get('/', 'SiteController@index')->name('welcome');


Auth::routes();

Route::get('/verify', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/addcoment', 'CommentController@add_coment')->name('add_comment');
Route::post('/block/{id}', 'CommentController@block_comment')->name('block_comment');
Route::post('/delete/{id}', 'CommentController@delete_comment')->name('delete_comment');
Route::post('/publish/{id}', 'CommentController@publish_comment')->name('publish_comment');
Route::post('/blockuser/{id}', 'UserController@block_user')->name('block_user');
Route::post('/deleteuser/{id}', 'UserController@delete_user')->name('delete_user');
Route::get('/blocked', 'UserController@blocked_user')->name('blocked_user');
Route::get('/deleted', 'UserController@deleted_user')->name('deleted_user');
Route::post('/activateuser/{id}', 'UserController@activate_user')->name('activate_user');
Route::get('/blockedcomment', 'CommentController@blockedcomments')->name('blocked_comments');
Route::post('/filtr','CommentController@filtr')->name('filtr');
Route::get('/seemore/{id}','CommentController@seemore')->name('see_more');
Route::get('/allcomments','CommentController@allcomments')->name('all_comments');



