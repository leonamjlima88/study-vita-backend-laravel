<?php

use Illuminate\Support\Facades\Route;

/**
 * Product (Estoque)
 */
Route::group([
  'middleware' => ['X-Locale'],
  'namespace' => 'App\Http\Controllers\Api\Product',
  'prefix' => '',
], function () {
  Route::get("/product",         "ProductController@index")->name("product.index");
  Route::post("/product",        "ProductController@store")->name("product.store");
  Route::get("/product/{id}",    "ProductController@show")->name("product.show");
  Route::put("/product/{id}",    "ProductController@update")->name("product.update");
  Route::delete("/product/{id}", "ProductController@destroy")->name("product.destroy");
});