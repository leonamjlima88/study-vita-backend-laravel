<?php

use Illuminate\Support\Facades\Route;

/**
 * Opportunity (Oportunidades)
 */
Route::group([
  'middleware' => ['X-Locale'],
  'namespace' => 'App\Http\Controllers\Api\Opportunity',
  'prefix' => '',
], function () {
  Route::get("/opportunity",         "OpportunityController@index")->name("opportunity.index");
  Route::post("/opportunity",        "OpportunityController@store")->name("opportunity.store");
  Route::get("/opportunity/{id}",    "OpportunityController@show")->name("opportunity.show");
  Route::put("/opportunity/{id}",    "OpportunityController@update")->name("opportunity.update");
  Route::delete("/opportunity/{id}", "OpportunityController@destroy")->name("opportunity.destroy");
});
