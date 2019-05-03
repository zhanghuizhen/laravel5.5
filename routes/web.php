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
    Route::get('register', 'RegisterController@registerView');
    Route::post('register', 'RegisterController@register');
    Route::post('adminregister', 'RegisterController@adminRegister');

    //登录
    Route::get('login', 'LoginController@loginView');
    Route::post('login', 'LoginController@login');
    Route::post('adminlogin', 'LoginController@adminLogin');

    //注销登录
    Route::get('logout', 'LogoutController@logout');
});

//前台路由组
Route::group(['namespace' => 'Home', 'prefix' => 'home'], function(){
    // 控制器在 "App\Http\Controllers\Home" 命名空间下

    //前台index
    Route::get('/index', 'IndexController@index');

    //用户
    Route::post('user/edit', 'UserController@edit');

    Route::get('user/show', 'UserController@show');

    Route::get('user/topic', 'UserController@getUserTopic');

    //话题
    Route::get('topic/index', 'TopicController@index');

    Route::post('topic/store', 'TopicController@store');

    Route::post('topic/update', 'TopicController@update');

    Route::post('topic/delete', 'TopicController@delete');

    Route::get('topic/show', 'TopicController@show');

    //公告
    Route::get('notice/index', 'NoticeController@index');

    Route::get('notice/show', 'NoticeController@show');

    //报事报修
    Route::get('repair/index', 'RepairController@index');

    Route::get('repair/show', 'RepairController@show');

    Route::post('repair/store', 'RepairController@store');

    Route::post('repair/update', 'RepairController@update');

    Route::post('repair/delete', 'RepairController@delete');

    //生活服务
    Route::get('service/index', 'ServiceController@index');

    Route::get('service/show', 'ServiceController@show');

    Route::post('service/store', 'ServiceController@store');

    Route::post('service/update', 'ServiceController@update');

    Route::post('service/delete', 'ServiceController@delete');

    //投诉建议
    Route::get('suggest/index', 'SuggestController@index');

    Route::get('suggest/show', 'SuggestController@show');

    Route::post('suggest/store', 'SuggestController@store');

    Route::post('suggest/update', 'SuggestController@update');

    Route::post('suggest/delete', 'SuggestController@delete');

    //评论
    Route::get('comment/index', 'CommentController@index');

    Route::get('comment/show', 'CommentController@show');

    Route::post('comment/store', 'CommentController@store');

    Route::post('comment/update', 'CommentController@update');

    Route::post('comment/delete', 'CommentController@delete');
});

//后台路由组
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    // 控制器在 "App\Http\Controllers\Admin" 命名空间下

    //后台index
    Route::get('/index', 'IndexController@index');

    //话题
    Route::get('topic/index', 'TopicController@index');
    Route::get('topic/{state}', 'TopicController@getListByState');
    Route::post('topic/content', 'TopicController@getListByContent');

    Route::delete('topic/delete/{id}', 'TopicController@delete');
    Route::get('topic/show/{id}', 'TopicController@show');
    Route::post('topic/publish/{id}', 'TopicController@publish');
    Route::post('topic/offline', 'TopicController@offline');
    Route::put('topic/publish/{id}', 'TopicController@publish');
    Route::put('topic/offline/{id}', 'TopicController@offline');

    //公告
    Route::get('notice/index', 'NoticeController@index');
    Route::get('notice/create', 'NoticeController@showCreate');

    Route::get('notice/{state}', 'NoticeController@getListByState');
    Route::post('notice/content', 'NoticeController@getListByContent');

    Route::post('notice/store', 'NoticeController@store');
    Route::post('notice/upload', 'NoticeController@upload');

    Route::get('notice/edit/{id}', 'NoticeController@edit');
    Route::post('notice/update/{id}', 'NoticeController@update');

    Route::delete('notice/delete/{id}', 'NoticeController@delete');

    Route::put('notice/publish/{id}', 'NoticeController@publish');
    Route::put('notice/offline/{id}', 'NoticeController@offline');

    Route::get('notice/show/{id}', 'NoticeController@show');

    //报事报修
    Route::get('repair/index', 'RepairController@index');
    Route::get('repair/{state}', 'RepairController@getListByState');
    Route::post('repair/part', 'RepairController@getListByPart');

    Route::get('repair/show/{id}', 'RepairController@show');
    Route::delete('repair/delete/{id}', 'RepairController@delete');
    Route::put('repair/finish/{id}', 'RepairController@finish');

    //生活服务
    Route::get('service/index', 'ServiceController@index');
    Route::get('service/{state}', 'ServiceController@getListByState');
    Route::get('service/{type}', 'ServiceController@getListByType');

    Route::get('service/show/{id}', 'ServiceController@show');
    Route::delete('service/delete/{id}', 'ServiceController@delete');
    Route::put('service/finish/{id}', 'ServiceController@finish');

    //评论
    Route::get('comment/index', 'CommentController@index');
    Route::get('comment/{state}', 'CommentController@getListByState');
    Route::post('comment/content', 'CommentController@getListByContent');

    Route::get('comment/show/{id}', 'CommentController@show');
    Route::delete('comment/delete/{id}', 'CommentController@delete');
    Route::put('comment/publish/{id}', 'CommentController@publish');
    Route::put('comment/offline/{id}', 'CommentController@offline');

    //投诉建议
    Route::get('suggest/index', 'SuggestController@index');
    Route::get('suggest/show/{id}', 'SuggestController@show');
    Route::delete('suggest/delete/{id}', 'SuggestController@delete');

    Route::get('suggest/{state}', 'SuggestController@getListByState');
    Route::post('suggest/description', 'SuggestController@getListByDescription');

    //用户
    Route::get('user/index', 'UserController@index');
    Route::get('user/admin/{admin}', 'UserController@getListByAdmin');
    Route::post('user/username', 'UserController@getListByUsername');

    Route::get('user/show/{id}', 'UserController@show');
    Route::put('user/set/{id}', 'UserController@setAdmin');
    Route::put('user/cancel/{id}', 'UserController@cancelAdmin');

    //小区
    Route::get('address/index', 'AddressController@index');

    Route::get('address/create', 'AddressController@showCreate');
    Route::post('address/store', 'AddressController@store');
    Route::post('address/address', 'AddressController@getListByAddress');

    Route::get('address/edit/{id}', 'AddressController@edit');
    Route::post('address/update/{id}', 'AddressController@update');

    Route::delete('address/delete/{id}', 'AddressController@delete');

    Route::get('address/show/{id}', 'AddressController@show');

});

Auth::routes();

Route::get('/home', 'HomeController@index');
