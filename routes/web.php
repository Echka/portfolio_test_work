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
    Route::view('/brief/show/{id}', 'admin.main');
    Route::view('/brief/create_update/{id}', 'admin.main');


    Route::group(['prefix' => 'profile'], function() {

        Route::get('get', 'ProfileController@get');
        Route::get('get_list', 'ProfileController@getList');
        Route::get('get_by_user/{user_id}', 'ProfileController@getByUser');
        Route::put('update/{id}', 'ProfileController@update');
    });

    Route::group(['prefix' => 'brief'], function() {

        Route::get('get/{id}', 'BriefController@get');
        Route::get('get_list', 'BriefController@getList');
        Route::get('store', 'BriefController@store');
        Route::delete('destroy/{id}', 'BriefController@destroy');
        Route::put('update/{id}', 'BriefController@update');

        Route::group(['middleware' => 'brief.check'], function() {
            Route::group(['prefix' => 'education'], function() {

                Route::get('get/{id}', 'EducationController@get');
                Route::get('get_list', 'EducationController@getList');
                Route::get('store', 'EducationController@store');
                Route::delete('destroy/{id}', 'EducationController@destroy');
                Route::put('update/{id}', 'EducationController@update');
            });

            Route::group(['prefix' => 'work_experiences'], function() {

                Route::get('get/{id}', 'WorkExpController@get');
                Route::get('get_list', 'WorkExpController@getList');
                Route::get('store', 'WorkExpController@store');
                Route::delete('destroy/{id}', 'WorkExpController@destroy');
                Route::put('update/{id}', 'WorkExpController@update');
            });
        });
    });
});

