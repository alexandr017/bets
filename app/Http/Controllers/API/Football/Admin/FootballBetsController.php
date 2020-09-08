<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Models\Football\FootballBet;
use Illuminate\Http\Request;

class FootballBetsController extends AdminFootballController
{
    private const PAGINATE_COUNT = 50;

    public function getAllUsersBets()
    {
        $data = FootballBet::paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    public function getAllUserBets($userID)
    {
        $userID = (int) $userID;

        $data = FootballBet::where(['user_id' => $userID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }


    public function getAllUsersByMatchID($matchID)
    {
        $matchID = (int) $matchID;

        $data = FootballBet::where(['football_match_id' => $matchID])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }
}