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
    // PUBLIC VIEW RESPONSE ENDPOINTS
    Route::group(['prefix' => '/public'], function () {
        Route::get('/reservations/{publicReservation}', 'Reservations\PublicReservationsController@show');
        Route::get('/reservations/{publicReservation}/confirm', 'Reservations\PublicReservationsController@confirm');
        Route::get('/reservations/{publicReservation}/cancel', 'Reservations\PublicReservationsController@cancel');
    });

    // PUBLIC JSON RESPONSE ENDPOINTS
    Route::group(['prefix' => '/api/public'], function () {
        Route::get('/reservations/{publicReservation}', 'Reservations\ApiPublicReservationsController@show');
        Route::put('/reservations/{publicReservation}', 'Reservations\ApiPublicReservationsController@update');
        Route::post('/reservations/{publicReservation}/cancel', 'Reservations\ApiPublicReservationsController@cancel');

        Route::post('/reservations/{publicReservation}/substitute', 'Reservations\ApiPublicReservationSubstituteController@store');
    });

    // JSON RESPONSE CALLS
    Route::group(['prefix' => '/api'], function () {
        Route::get('/courses', 'Courses\ApiCoursesController@index');

        Route::get('/course-dates', 'Courses\ApiCourseDatesController@index');
    });

    // VIEW RESPONSE CALLS
    Route::get('/', 'HomeController@index');

    Route::get('/reservations', 'Reservations\ReservationsController@index');
    Route::get('/rezervace', 'Reservations\ReservationsController@index');
    Route::post('/reservations', 'Reservations\ReservationsController@store');

    Route::get('/kurzy/{course}', 'Courses\CoursesController@show');

    Route::get('/terminy', 'Courses\CourseDatesController@index');

    Route::get('/kontakty', 'ContactsController@index');

    Route::get('/cenik', 'PricesController@index');

    Route::group(['prefix' => '/admin', 'namespace' => 'Admin\\'], function () {
        Route::get('/stats', 'StatsController@index');

        Route::get('/', 'AdminController@index');

        Route::get('/dashboard', 'DashboardController@index');

        Route::get('/courses', 'Courses\CoursesController@index');
        Route::get('/courses/create', 'Courses\CoursesController@create');
        Route::get('/courses/{course}', 'Courses\CoursesController@show');
        Route::post('/courses', 'Courses\CoursesController@store');
        Route::get('/courses/{course}/edit', 'Courses\CoursesController@edit');
        Route::put('/courses/{course}', 'Courses\CoursesController@update');
        Route::delete('/courses/{course}', 'Courses\CoursesController@destroy');

        Route::get('/course-dates', 'Courses\CourseDatesController@index');
        Route::get('/course-dates/create', 'Courses\CourseDatesController@create');
        Route::get('/course-dates/{courseDate}', 'Courses\CourseDatesController@show');
        Route::post('/course-dates', 'Courses\CourseDatesController@store');
        Route::put('/course-dates/{courseDate}', 'Courses\CourseDatesController@update');
        Route::delete('/course-dates/{courseDate}', 'Courses\CourseDatesController@destroy');
        Route::post('/course-dates/{courseDate}/complete', 'Courses\CourseDatesController@complete');

        Route::post('/course-dates/{courseDate}/first-information', 'Courses\CourseDateFirstInformationController@save');

        Route::post('/course-dates/{courseDate}/final-information', 'Courses\CourseDateFinalInformationController@save');

        Route::get('/reservations', 'Reservations\ReservationsController@index');
        Route::get('/reservations/{reservation}', 'Reservations\ReservationsController@show');
        Route::get('/reservations/create', 'Reservations\ReservationsController@create');
        Route::post('/reservations', 'Reservations\ReservationsController@store');
        Route::get('/reservations/{reservation}/edit', 'Reservations\ReservationsController@edit');
        Route::put('/reservations/{reservation}', 'Reservations\ReservationsController@update');
        Route::delete('/reservations/{reservation}', 'Reservations\ReservationsController@destroy');
        Route::post('/reservations/{reservation}/approve', 'Reservations\ReservationsController@approve');
        Route::post('/reservations/{reservation}/reject', 'Reservations\ReservationsController@reject');
        Route::post('/reservations/{reservation}/complete', 'Reservations\ReservationsController@complete');
        // Route::get('/courses/{course}/dates', 'Courses\CourseDatesController@index');
        // Route::get('/courses/{course}/dates/{courseDate}', 'Courses\CourseDatesController@show');
        // Route::get('/courses/{course}/dates/create', 'Courses\CourseDatesController@create');
        // Route::post('/courses/{course}/dates', 'Courses\CourseDatesController@store');
        // Route::get('/courses/{course}/dates/{courseDate}/edit', 'Courses\CourseDatesController@edit');
        // Route::put('/courses/{course}/dates/{courseDate}', 'Courses\CourseDatesController@update');
        // Route::delete('/courses/{course}/dates/{courseDate}', 'Courses\CourseDatesController@destroy');

        Route::get('/reservations', 'Reservations\ReservationsController@index');

        Route::get('/lecturers', 'Lecturers\LecturersController@index');

        Route::get('/attendees', 'Attendees\AttendeesController@index');
    });
});
