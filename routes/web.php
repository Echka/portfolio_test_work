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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
    'namespace' => 'Admin'
], function() {

    Route::view('/', 'admin.main');
    Route::view('/brief', 'admin.main');


    Route::group(['prefix' => 'brief'], function() {

        Route::get('get', 'BriefController@get');
        Route::get('store', 'BriefController@store');
        Route::delete('destroy/{id}', 'BriefController@destroy');
        Route::put('update/{id}', 'BriefController@update');

        Route::group(['middleware' => 'brief.check'], function() {
            Route::group(['prefix' => 'education'], function() {

                Route::get('get', 'EducationController@get');
                Route::get('store', 'EducationController@store');
                Route::delete('destroy/{id}', 'EducationController@destroy');
                Route::put('update/{id}', 'EducationController@update');
            });
        });
    });
});

