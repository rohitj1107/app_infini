<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categorie', 'CategorieController@getAllCategorie');
Route::get('categorie/{id}', 'CategorieController@getCategorie');
Route::get('categorie/categorie_name/{categorie_name}', 'CategorieController@getCategorieNameSearch');
Route::post('categorie', 'CategorieController@createCategorie');
Route::put('categorie/update/{id}', 'CategorieController@updateCategorie');
Route::delete('categorie/{id}','CategorieController@deleteCategorie');

Route::get('product', 'ProducteController@getAllProduct');
Route::get('product/{id}', 'ProducteController@getProduct');
Route::get('product/categorie/{categorie_name}', 'ProducteController@getProductCategorie');
Route::get('product/product_name/{product_name}', 'ProducteController@getProductNameSearch');
Route::post('product', 'ProducteController@createProduct');
Route::put('product/update/{id}', 'ProducteController@updateProduct');
Route::delete('product/{id}','ProducteController@deleteProduct');
