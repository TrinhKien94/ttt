<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'BookController@index');
Route::get('/search', 'BookController@searchForm');
Route::post('/search','BookController@postSearch');
Route::get('/search/result','BookController@searchResult');

Route::get('/book_info/{id}', 'BookController@book_info');
Route::get('/book_cate/{id}', 'BookController@book_cate');
Route::post('/book/comment','CommentController@postComment');

Route::get('/cart','CartController@show');
Route::post('/cart','CartController@post');
Route::post('/cart_update','CartController@update');
Route::post('/cart_delete','CartController@delete');
Route::post('/cart_remove','CartController@remove');

Route::get('/order','OrderController@store');
Route::get('/order/history','OrderController@history');
Route::get('/order/{id}','OrderController@show');
Route::post('/order/','OrderController@order_one');
Route::controllers([
	'auth'=>'Auth\AuthController',
	'password'=>'Auth\PasswordController',
]);
//
Route::get('/admin/login', 'AdminUserController@login');
Route::post('/admin/login', 'AdminUserController@checkLogin');
//
Route::get('/admin_users', 'AdminUserController@admin_users');
Route::post('/admin_users', 'AdminUserController@search_user');
Route::post('/delete_user/', 'AdminUserController@delete_user');
Route::post('/admin_users/toAdmin', 'AdminUserController@upToAdmin');
Route::post('/admin_users/toUser','AdminUserController@downToUser');
//
Route::get('/admin_books', 'AdminBookController@admin_books');
Route::get('/admin_books/result', 'AdminBookController@search_book');
Route::post('/book/delete', 'AdminBookController@delete_book');
Route::post('/book/undo_delete', 'AdminBookController@undo_delete');
Route::get('/admin/book/post', 'AdminBookController@showCreateFrom');
Route::post('/admin/book/post', 'AdminBookController@actionCreate');
Route::get('/admin/book/edit/{id}', 'AdminBookController@showUpdateForm');
Route::post('/admin/book/update', 'AdminBookController@actionUpdate');
Route::get('/admin/categories','AdminBookController@showCateUpdate');
Route::post('/admin/categories/add', 'AdminBookController@addCategory');
Route::post('/admin/book_cate/add','AdminBookController@addBookCate');
Route::post('/admin/book_cate/update','AdminBookController@updateBookCate');
Route::post('/admin/categories/update','AdminBookController@updateCategory');
Route::get('/admin/orders','AdminOrderController@history');
Route::post('/admin/orders/done','AdminOrderController@done');
Route::post('/admin/orders/nodone','AdminOrderController@noDone');
//
Route::post('/request','RequestBookController@addRequest');
Route::get('/request', 'AdminRequestBookController@showRequestList');
Route::post('/setReadStt','AdminRequestBookController@read');
Route::post('/request/delete', 'AdminRequestBookController@delete');
//
Route::get('/test','TestController@index');