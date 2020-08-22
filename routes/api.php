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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('profile', 'UserController@getAuthenticatedUser');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



// роуты для футбола
Route::group(['prefix' => 'football', 'namespace' => 'API\Football', 'as' => 'football.', 'middleware' => 'api'], function () {
    Route::resource('categories', 'FootballCategoriesController');
    Route::get('tours/categories/{id}', 'FootballToursController@getToursByCategoryID')->name('torus.get_tours_by_category_id');
    Route::resource('tours', 'FootballToursController');
    Route::resource('matches', 'FootballMatchesController');
    Route::resource('bets', 'FootballBetsController');
});




