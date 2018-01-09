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

Route::group([ 'prefix' => 'pollingexecutions' ], function() {
	Route::group([ 'prefix' => 'stats' ], function() {
		Route::get('bullet1', 'PollingExecutionController@bullet1');
		Route::get('bullet2', 'PollingExecutionController@bullet2');
		Route::get('bullet3', 'PollingExecutionController@bullet3');
		Route::get('bullet4', 'PollingExecutionController@bullet4');
	});
});

Route::resource('pollingexecutions', 'PollingExecutionController');
Route::resource('cars', 'CarController');