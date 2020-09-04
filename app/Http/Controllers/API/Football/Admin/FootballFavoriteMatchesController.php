<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Http\Controllers\API\Football\BaseFootballController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FootballFavoriteMatchesController extends BaseFootballController
{
    public function getFavoriteMatchesAllUsers()
    {
        $data = DB::table('football_matches')
            ->leftJoin('football_favorite_matches', 'football_matches.id','football_favorite_matches.football_match_id')
            ->select('football_matches.*')
            ->get();

        return ResponseAPI($data);
    }
}
