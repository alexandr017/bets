<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use App\Models\Football\FootballBet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FootballBetsController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/client/bets/get-all-user-bets",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all bets current user")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Все
    public function getAllUserBets()
    {
        $userID = Auth::id();

        $data = FootballBet::where(['user_id' => $userID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/client/bets/get-user-bets-on-last-week",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all bets from last week of current user")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // на прошлой неделе
    public function getUserBetsOnLastWeek()
    {
        $weekEndDate = Carbon::now()->endOfWeek();

        $data =  DB::table('football_bets')
            ->leftJoin('football_matches','football_bets.football_match_id','football_matches.id')
            ->select('football_bets.*')
            ->whereBetween('football_matches.game_date', [Carbon::now(), $weekEndDate])
            ->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/client/bets/get-user-bets-on-nex-month",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all bets from next month of current user")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //В этом месяце
    public function getUserBetsOnNexMonth()
    {
        $weekEndDate = Carbon::now()->endOfMonth();

        $data =  DB::table('football_bets')
            ->leftJoin('football_matches','football_bets.football_match_id','football_matches.id')
            ->select('football_bets.*')
            ->whereBetween('football_matches.game_date', [Carbon::now(), $weekEndDate])
            ->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/client/bets/get-user-long-line-bets",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all long line bets of current user")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Долгострочные
    public function getUserLongLineBets()
    {
        $weekEndDate = Carbon::now()->endOfMonth();

        $data =  DB::table('football_bets')
            ->leftJoin('football_matches','football_bets.football_match_id','football_matches.id')
            ->select('football_bets.*')
            ->whereDate('football_matches.game_date', '>', $weekEndDate)
            ->get();

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/client/bets/get-all-users-by-match-id/{matchID}",
     *     tags={"Football Bets"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all bets users by match ID")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // все кто поставил на мачт
    public function getAllUsersByMatchID($matchID)
    {
        $matchID = (int) $matchID;

        $data = FootballBet::where(['football_match_id' => $matchID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }
}
