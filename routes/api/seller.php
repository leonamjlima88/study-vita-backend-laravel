<?php

use Illuminate\Support\Facades\Route;

/**
 * Seller (Vendedores)
 */
Route::group([
  'middleware' => ['X-Locale'],
  'namespace' => 'App\Http\Controllers\Api\Seller',
  'prefix' => '',
], function () {
  Route::get("/seller",         "SellerController@index")->name("seller.index");
  Route::post("/seller",        "SellerController@store")->name("seller.store");
  Route::get("/seller/{id}",    "SellerController@show")->name("seller.show");
  Route::put("/seller/{id}",    "SellerController@update")->name("seller.update");
  Route::delete("/seller/{id}", "SellerController@destroy")->name("seller.destroy");
});