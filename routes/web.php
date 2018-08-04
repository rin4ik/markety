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

Route::get('/catalogs', 'CatalogController@index')->name('catalogs');
Route::get('/catalogs/{catalog}', 'CatalogController@show')->name('catalog.show');
Route::get('/', 'HomeController@index');
Route::get('/catalog', function () {
    return view('pages.catalog');
});
Route::get('/cart', function () {
    return view('pages.cart');
});
Route::get('/brands', function () {
    return view('pages.brands');
});
Route::get('/search', function () {
    return view('pages.search');
});
Route::get('/product', function () {
    return view('pages.product');
});
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.pages.index');
    });
    Route::resource('/catalogs', 'Admin\CatalogController');
    Route::resource('/categories', 'Admin\CategoryController');
    Route::resource('/manufacturers', 'Admin\ManufacturerController');
    Route::resource('/filters', 'Admin\FilterController');
    Route::resource('/products', 'Admin\ProductController');
});
