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

    Route::get('client/categories/get-all-categories', 'Client\FootballCategoriesController@getAllCategories')->name('categories.client.get-all-categories');
    Route::resource('admin/categories', 'Admin\FootballCategoriesController'); // CRUD

    Route::get('client/tours/get-tours-by-category-id/{id}', 'Client\FootballToursController@getToursByCategoryID')->name('tours.client.get-tours-by-category-id');
    Route::get('admin/tours/get-tours-by-category-id/{id}', 'Admin\FootballToursController@getToursByCategoryID')->name('tours.admin.get-tours-by-category-id');
    Route::resource('admin/tours', 'Admin\FootballToursController'); // CRUD

    Route::get('client/matches/get-all-past-matches', 'Client\FootballMatchesController@getAllPastMatches')->name('matches.client.get-all-past-matches');
    Route::get('client/matches/get-all-next-matches', 'Client\FootballMatchesController@getAllNextMatches')->name('matches.client.get-all-next-matches');
    Route::get('client/matches/get-past-matches-by-tour-id/{tourID}', 'Client\FootballMatchesController@getPastMatchesByTourID')->name('matches.client.get-past-matches-by-tour-id');
    Route::get('client/matches/get-next-matches-tour-id/{tourID}', 'Client\FootballMatchesController@getNextMatchesTourID')->name('matches.client.get-next-matches-tour-id');
    Route::get('client/matches/get-matches-on-next-week', 'Client\FootballMatchesController@getMatchesOnNextWeek')->name('matches.client.get-matches-on-next-week');
    Route::get('client/matches/get-matches-on-nex-month', 'Client\FootballMatchesController@getMatchesOnNexMonth')->name('matches.client.get-matches-on-nex-month');
    Route::resource('admin/matches', 'Admin\FootballMatchesController'); // CRUD

    Route::get('client/favorite-matches/get-favorites', 'Client\FootballFavoriteMatchesController@getFavorites')->name('favorite-matches.client.get-favorites');
    Route::post('client/favorite-matches/set-favorite/{matchID}', 'Client\FootballFavoriteMatchesController@setFavorite')->name('favorite-matches.client.set-favorite');
    Route::delete('client/favorite-matches/remote-favorite/{matchID}', 'Client\FootballFavoriteMatchesController@remoteFavorite')->name('favorite-matches.client.remote-favorite');
    Route::get('admin/favorite-matches/get-favorite-matches-all-users', 'Admin\FootballFavoriteMatchesController@getFavoriteMatchesAllUsers')->name('favorite-matches.admin.get-favorite-matches-all-users');


    Route::get('client/bets/get-all-user-bets', 'Client\FootballBetsController@getAllUserBets')->name('bets.client.get-all-user-bets');
    Route::get('client/bets/get-user-bets-on-last-week', 'Client\FootballBetsController@getUserBetsOnLastWeek')->name('bets.client.get-user-bets-on-last-week');
    Route::get('client/bets/get-user-bets-on-nex-month', 'Client\FootballBetsController@getUserBetsOnNexMonth')->name('bets.client.get-user-bets-on-nex-month');
    Route::get('client/bets/get-user-long-line-bets', 'Client\FootballBetsController@getUserLongLineBets')->name('bets.client.get-user-long-line-bets');
    Route::get('client/bets/get-all-users-by-match-id/{matchID}', 'Client\FootballBetsController@getAllUsersByMatchID')->name('bets.client.get-all-users-by-match-id');
    Route::get('admin/bets/get-all-users-bets', 'Admin\FootballBetsController@getAllUsersBets')->name('bets.admin.get-all-users-bets');
    Route::get('admin/bets/get-user-bets-on-last-week/{userID}', 'Admin\FootballBetsController@getUserBetsOnLastWeek')->name('bets.admin.get-user-bets-on-last-week');
    Route::get('admin/bets/get-all-users-by-match-id/{matchID}', 'Admin\FootballBetsController@getAllUsersByMatchID')->name('bets.admin.get-all-users-by-match-id');

});




