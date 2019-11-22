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

Route::group(['namespace' => 'prosvujusmev\\'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('/reservations', 'Reservations\ReservationsController@index');

    Route::group(['prefix' => '/admin', 'namespace' => 'Admin\\'], function () {
        Route::get('/', 'AdminController@index');

        Route::get('/courses', 'Courses\CoursesController@index');
        Route::get('/courses/create', 'Courses\CoursesController@create');
        Route::get('/courses/{course}', 'Courses\CoursesController@show');
        Route::post('/courses', 'Courses\CoursesController@store');
        Route::get('/courses/{course}/edit', 'Courses\CoursesController@edit');
        Route::put('/courses/{course}', 'Courses\CoursesController@update');
        Route::delete('/courses/{course}', 'Courses\CoursesController@destroy');
    });
});
