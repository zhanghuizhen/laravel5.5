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

//Route::get('/index', 'IndexController@index');
//
//Route::prefix('admin')->group(function () {
//    Route::get('index', 'Admin\IndexController@index');
//});
//
//Route::namespace('Home')->group(function () {
//    // 在 "App\Http\Controllers\Home" 命名空间下的控制器
//
//    Route::get('/index', 'IndexController@index');
//});

//Route::get('home/index', 'Home\IndexController@index');
//Route::get('admin/index', 'Admin\IndexController@index');
//Route::get('home/user/user', 'Home\UserController@user');

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
    Route::get('topic/index', [
        'as' => 'topic/index', 'uses' => 'TopicController@index'
    ]);

    //话题创建
    Route::post('topic/store', [
        'as' => 'topic/store', 'uses' => 'TopicController@store'
    ]);

    //话题更新
    Route::put('topic/update/{id}', [
        'as' => 'topic/update/{id}', 'uses' => 'TopicController@update'
    ]);

    //话题删除
    Route::delete('topic/delete/{id}', [
        'as' => 'topic/delete/{id}', 'uses' => 'TopicController@delete'
    ]);

    //话题删除
    Route::get('topic/show/{id}', [
        'as' => 'topic/show/{id}', 'uses' => 'TopicController@show'
    ]);

    //话题发布
    Route::put('topic/publish/{id}', [
        'as' => 'topic/publish/{id}', 'uses' => 'TopicController@publish'
    ]);

    //话题下线
    Route::put('topic/offline/{id}', [
        'as' => 'topic/offline/{id}', 'uses' => 'TopicController@offline'
    ]);


    //公告列表
    Route::get('notice/index', [
        'as' => 'notice/index', 'uses' => 'NoticeController@index'
    ]);

    //公告创建
    Route::post('notice/store', [
        'as' => 'notice/store', 'uses' => 'NoticeController@store'
    ]);

    //公告更新
    Route::put('notice/update/{id}', [
        'as' => 'notice/update/{id}', 'uses' => 'NoticeController@update'
    ]);

    //公告删除
    Route::delete('notice/delete/{id}', [
        'as' => 'notice/delete/{id}', 'uses' => 'NoticeController@delete'
    ]);

});
