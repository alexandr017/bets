<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use Illuminate\Http\Request;

class FootballFavoriteMatchesController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/client/favorite-matches/get-favorites",
     *     tags={"Football Favorites Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all favorites matches of current user")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Избранные
    public function getFavorites()
    {
        $userID = Auth::id();

        $data = DB::table('football_matches')
            ->leftJoin('football_favorite_matches', 'football_matches.id','football_favorite_matches.football_match_id')
            ->select('football_matches.*')
            ->where(['football_favorite_matches.user_id' => $userID])
            ->pagitanion(self::PAGINATE_COUNT);

        return ResponseAPI($data);

    }

    /**
     * @OA\POST(
     *     path="/api/football/client/favorite-matches/set-favorite/{matchID}",
     *     tags={"Football Favorites Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Response(response="201", description="Set favorite match for current user")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * @OA\DELETE(
     *     path="/api/football/client/favorite-matches/remote-favorite/{matchID}",
     *     tags={"Football Favorites Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Response(response="410", description="Delete favorite match for current user")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function remoteFavorite($matchID)
    {
        $matchID = (int) $matchID;
        $userID = Auth::id();

        DB::delete("delete from football_matches where user_id=? and football_match_id=?", [$userID,$matchID]);

        return ResponseAPI([], 410, 'Deleted');
    }
}
