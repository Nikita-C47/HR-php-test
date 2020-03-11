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

// Погода в Брянске
Route::get('/', 'SiteController@showWeather')->name('weather');
// Заказы
Route::get('/orders', 'OrdersController@index')->name('orders');
Route::get('/orders/tabbed', 'OrdersController@indexTabbed')->name('orders-tabbed');
Route::get('/orders/{id?}', 'OrdersController@edit')->name('edit-order');
Route::post('/orders/{id?}', 'OrdersController@update');
// Товары
Route::get('/products', 'ProductsController@index')->name('products');
Route::post('/products/update-price/{id}', 'ProductsController@updatePrice')->name('update-price');
