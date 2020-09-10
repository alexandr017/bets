<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Models\Football\FootballBet;
use Illuminate\Http\Request;

class FootballBetsController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/admin/bets/get-all-users-bets",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all bets all users")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsersBets()
    {
        $data = FootballBet::query()->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/admin/bets/get-all-user-bets/{userID}",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all bets by user ID")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUserBets($userID)
    {
        $userID = (int) $userID;

        $data = FootballBet::where(['user_id' => $userID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/admin/bets/get-all-users-by-match-id/{matchID}",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all bets by match ID")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsersByMatchID($matchID)
    {
        $matchID = (int) $matchID;

        $data = FootballBet::where(['football_match_id' => $matchID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }
}
