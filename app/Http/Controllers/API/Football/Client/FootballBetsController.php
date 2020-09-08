<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use App\Models\Football\FootballBet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FootballBetsController extends AdminFootballController
{
    private const PAGINATE_COUNT = 50;

    // Все
    public function getAllUserBets()
    {
        $userID = Auth::id();

        $data = FootballBet::where(['user_id' => $userID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    // на прошлой неделе
    public function getUserBetsOnLastWeek()
    {
        $weekEndDate = Carbon::now()->endOfWeek();

        $data =  DB::table('football_bets')
            ->leftJoin('football_matches','football_bets.football_match_id','football_matches.id')
            ->select('football_bets.*')
            ->whereBetween('football_matches.game_date', [Carbon::now(), $weekEndDate])
            ->get();

        return ResponseAPI($data);
    }

    //В этом месяце
    public function getUserBetsOnNexMonth()
    {
        $weekEndDate = Carbon::now()->endOfMonth();

        $data =  DB::table('football_bets')
            ->leftJoin('football_matches','football_bets.football_match_id','football_matches.id')
            ->select('football_bets.*')
            ->whereBetween('football_matches.game_date', [Carbon::now(), $weekEndDate])
            ->get();

        return ResponseAPI($data);
    }

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


    // все кто поставил на мачт
    public function getAllUsersByMatchID($matchID)
    {
        $matchID = (int) $matchID;

        $data = FootballBet::where(['football_match_id' => $matchID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }
}
