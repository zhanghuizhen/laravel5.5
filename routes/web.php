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

Route::namespace('Auth')->prefix('auth')->group(function () {
    // 在 "App\Http\Controllers\Auth" 命名空间下的控制器
    //注册
    Route::post('register', 'RegisterController@register');

    //登录
    Route::post('login', 'LoginController@login');

    //注销登录
    Route::post('logout', 'LogoutController@logout');
});

//前台路由组
Route::group(['namespace' => 'Home', 'prefix' => 'home'], function(){
    // 控制器在 "App\Http\Controllers\Home" 命名空间下

    //前台index
    Route::get('/index', 'IndexController@index');

});

//后台路由组
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    // 控制器在 "App\Http\Controllers\Admin" 命名空间下

    //后台index
    Route::get('/index', 'IndexController@index');

    //话题列表
    Route::get('topic/index', 'TopicController@index');

    //话题创建
    Route::post('topic/store', 'TopicController@store');

    //话题更新
    Route::put('topic/update/{id}', 'TopicController@update');

    //话题删除
    Route::delete('topic/delete/{id}', 'TopicController@delete');

    //话题详情
    Route::get('topic/show/{id}', 'TopicController@show');

    //话题发布
    Route::put('topic/publish/{id}', 'TopicController@publish');

    //话题下线
    Route::put('topic/offline/{id}', 'TopicController@offline');

    //公告
    Route::get('notice/index', 'NoticeController@index');

    Route::post('notice/store', 'NoticeController@store');

    Route::put('notice/update/{id}', 'NoticeController@update');

    Route::delete('notice/delete/{id}', 'NoticeController@delete');

    Route::put('notice/publish/{id}', 'NoticeController@publish');

    Route::put('notice/offline/{id}', 'NoticeController@offline');

    Route::get('notice/show/{id}', 'NoticeController@show');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
