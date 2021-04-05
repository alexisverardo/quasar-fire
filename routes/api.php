<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('topsecret', 'GeoLocationController@showMessage');
Route::post('topsecret_split/{satelite_name}', 'GeoLocationController@splitMode');
Route::get('topsecret_split', 'GeoLocationController@showSplitMode');
