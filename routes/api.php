<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('/catalogs', 'Admin\ApiControllers\CatalogController');
Route::resource('/products', 'Admin\ApiControllers\ProductController');
Route::resource('/categories', 'Admin\ApiControllers\CategoryController');
Route::resource('/filters', 'Admin\ApiControllers\FilterController');
Route::resource('/manufacturers', 'Admin\ApiControllers\ManufacturerController');
Route::delete('/remove/manufacturers', 'Admin\ApiControllers\ManufacturerController@remove');
Route::delete('/remove/categories', 'Admin\ApiControllers\CategoryController@remove');
Route::delete('/remove/filters', 'Admin\ApiControllers\FilterController@remove');
Route::delete('/remove/products', 'Admin\ApiControllers\ProductController@remove');
