<?php

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

use Illuminate\Support\Facades\Route;

Route::prefix('admin/tests')->name('tests.')->middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::post('/start', 'DuskTestController@index')->name('start');
    Route::post('/clear', 'DuskTestController@clear')->name('clear');
});
