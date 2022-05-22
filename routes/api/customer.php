<?php

use Illuminate\Support\Facades\Route;

/**
 * Customer (Clientes)
 */
Route::group([
  'middleware' => ['X-Locale'],
  'namespace' => 'App\Http\Controllers\Api\Customer',
  'prefix' => '',
], function () {
  Route::get("/customer",         "CustomerController@index")->name("customer.index");
  Route::post("/customer",        "CustomerController@store")->name("customer.store");
  Route::get("/customer/{id}",    "CustomerController@show")->name("customer.show");
  Route::put("/customer/{id}",    "CustomerController@update")->name("customer.update");
  Route::delete("/customer/{id}", "CustomerController@destroy")->name("customer.destroy");
});
