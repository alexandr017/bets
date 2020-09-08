<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use Illuminate\Http\Request;

class FootballFavoriteMatchesController extends AdminFootballController
{
    //Избранные
    public function getFavorites()
    {
        $userID = Auth::id();

        $data = DB::table('football_matches')
            ->leftJoin('football_favorite_matches', 'football_matches.id','football_favorite_matches.football_match_id')
            ->select('football_matches.*')
            ->where(['football_favorite_matches.user_id' => $userID])
            ->get();

        return ResponseAPI($data);

    }


    public function setFavorite($matchID)
    {
        $data = [
            'football_match_id' => (int) $matchID,
            'user_id' => Auth::id()
        ];

        $favoriteMatch = new FootballFavoriteMatch($data);
        $favoriteMatch->save();

        return ResponseAPI($data, 201, 'Created');

    }

    public function remoteFavorite($matchID)
    {
        $matchID = (int) $matchID;
        $userID = Auth::id();

        DB::delete("delete from football_matches where user_id=? and football_match_id=?", [$userID,$matchID]);

        return ResponseAPI([], 410, 'Deleted');
    }
}
