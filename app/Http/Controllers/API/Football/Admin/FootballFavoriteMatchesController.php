<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Http\Controllers\API\Football\BaseFootballController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FootballFavoriteMatchesController extends BaseFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/admin/favorite-matches/get-favorite-matches-all-users",
     *     tags={"Football Favorites Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all favorites matches all users")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFavoriteMatchesAllUsers()
    {
        $data = DB::table('football_matches')
            ->leftJoin('football_favorite_matches', 'football_matches.id','football_favorite_matches.football_match_id')
            ->select('football_matches.*')
            ->pagination(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }
}
