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

Route::get('/', 'ProductController@index')->name('index');
Route::get('/product-detail/{id}', 'ProductController@detail');
Route::get('/product-filter', 'ProductController@filter');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/add', 'CartController@add');
Route::get('/cart/remove', 'CartController@remove');
Route::get('/cart/update', 'CartController@update');
Route::post('/order/store', 'OrderController@store');
Route::get('/order/view/{order_id}/{_token}', 'OrderController@view')->name('order.view');
Route::get('/order/delete/{id}','OrderController@delete')->name('order.delete');//delele order----------
Route::get('/payment/{order_id}/{_token}', 'PaymentController@store')->name('order.payment');
Route::post('/payment/{order_id}/{_token}', 'PaymentController@store');
Route::get('/order/history','OrderController@history')->name('order.history');

Route::group(['prefix' => 'admin', 'middleware'    =>  ['web', 'auth', 'admin'] ], function(){
    Route::get('/', 'AdminController@adminView');


    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@getProductManagerPage')->name('productsManager');
        Route::get('/datatables', 'ProductController@getProductsDatatables')->name('productsDatatables');
        Route::post('/edit/{id}', 'ProductController@editProduct')->name('editProduct');
        Route::get('/api/{id}', 'ProductController@getProductAPI')->name('productDetailAPI');
        Route::post('/create', 'ProductController@createProduct')->name('createProduct');
        Route::get('/{id}', 'ProductController@productDetail')->name('productDetail');
        Route::get('delete/{id}', 'ProductController@deleteManager')->name('deleteProductManager');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@getUsersManager')->name('usersManager');
        Route::get('/datatables', 'UserController@getUsersDatatables')->name('usersDatatables');
        Route::get('delete/{id}', 'UserController@deleteManager')->name('deleteUserManager');
        Route::post('/edit/{id}', 'UserController@editManager')->name('editUserManager');
        Route::get('/api/{id}', 'UserController@getUserAPI')->name('productDetailAPI');
        Route::post('/create', 'UserController@createManager')->name('createUserManager');
        Route::get('/{id}', 'UserController@userDetail')->name('userDetail');
    });

    Route::prefix('orders')->group(function () {
      Route::get('/datatables', 'OrderController@getOrdersDatatables')->name('orders.datatables');
      Route::get('/', 'OrderController@getOrderView');
      Route::get('/{id}', 'OrderController@getOrderDetailView');
      Route::get('/{id}/datatables', 'OrderController@getOrderItemsDatatables')->name('orders-detail.datatables');
      Route::get('/{id}/delete', 'OrderController@destroy');
      Route::get('/{id}/edit', 'OrderController@getOrder');
      Route::get('/{id}/api', 'OrderController@getOrderApi');
      Route::post('/{id}', 'OrderController@setStatusOrder');
    });
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
