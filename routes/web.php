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

Route::get('/', function () {
    return view('welcome');
});

/*http://XXXXXX.jp/admin/news/create にアクセスが来たら、
Controller Admin\NewsController のAction addに渡す*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    /*->middleware('auth')でログインしていない場合はログイン画面へリダイレクトされるように*/
    /* get ブラウザから URLを入力して Webページを開くとき*/
    Route::get('news/create', 'Admin\NewsController@add');
    /* post クライアントからさまざまなデータを送信する　*/
    Route::post('news/create', 'Admin\NewsController@create');
    Route::get('news', 'Admin\NewsController@index');
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    Route::get('news/delete', 'Admin\NewsController@delete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    /* ログインしていない場合、app/Http/Middleware/Authenticate.phpへ　*/
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::post('profile/edit', 'Admin\ProfileController@update');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
