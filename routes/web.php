<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LeagueController;
use \App\Http\Controllers\TeamController;
use \App\Http\Controllers\MatchController;
use \App\Http\Controllers\StadiumController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('team', TeamController::class);
Route::resource('league', LeagueController::class);
Route::resource('match', MatchController::class);
Route::resource('stadium', StadiumController::class);

Route::group(['prefix' => '/match/{match}/event'], function () {
    Route::get('/create', 'App\Http\Controllers\MatchEventController@create');
    Route::post('/', 'App\Http\Controllers\MatchEventController@store')->name('event.store');
});

Route::get('/stat', 'App\Http\Controllers\StatisticController@index');

