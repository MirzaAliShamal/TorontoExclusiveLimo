<?php

use Illuminate\Support\Facades\Route;

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
require __DIR__.'/auth.php';

Route::get('/', 'HomeController@home')->name('home');
Route::get('airport-limousine', 'HomeController@airportLimo')->name('airport.limo');
Route::get('casino-limousine', 'HomeController@casinoLimo')->name('casino.limo');
Route::get('chauffeuring-limousine', 'HomeController@chaufferLimo')->name('chauffer.limo');
Route::get('childseat-limousine', 'HomeController@childseatLimo')->name('childseat.limo');
Route::get('funeral-limousine', 'HomeController@funeralLimo')->name('funeral.limo');
Route::get('niaggra-limousine', 'HomeController@niaggraLimo')->name('niaggra.limo');
Route::get('nightout-limousine', 'HomeController@nightoutLimo')->name('nightout.limo');
Route::get('prom-limousine', 'HomeController@promLimo')->name('prom.limo');
