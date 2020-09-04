<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use App\Http\Requests\API\Football\FootballMatchRequest;
use App\Models\Football\FootballMatch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FootballMatchesController extends AdminFootballController
{
    private const PAGINATE_COUNT = 50;

    // все прошедшие игры
    public function getAllPastMatches()
    {
        $data = FootballMatch::whereDate('game_date', '<', Carbon::now())->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }


    // все будущие игры
    public function getAllNextMatches()
    {
        $data = FootballMatch::whereDate('game_date', '>', Carbon::now())->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }



    // все прошедшие игры определенного тура
    public function getPastMatchesByTourID(Request $request)
    {
        $tourID = (int) $request['tour_id'];

        $data = FootballMatch
            ::where(['football_tour_id' => $tourID])
            ->whereDate('game_date', '<', Carbon::now())
            ->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    // предстоящие матчи определенного тура
    public function getNextMatchesTourID(Request $request)
    {
        $tourID = (int) $request['tour_id'];

        $data = FootballMatch
            ::where(['football_tour_id' => $tourID])
            ->whereDate('game_date', '>', Carbon::now())
            ->get();

        return ResponseAPI($data);
    }


    //На этой неделе
    public function getMatchesOnNextWeek()
    {
        $weekEndDate = Carbon::now()->endOfWeek();

        $data = FootballMatch
            ::whereBetween('game_date', [Carbon::now(), $weekEndDate])
            ->get();

        return ResponseAPI($data);
    }

    //В этом месяце
    public function getMatchesOnNexMonth()
    {
        $weekEndDate = Carbon::now()->endOfMonth();

        $data = FootballMatch
            ::whereBetween('game_date', [Carbon::now(), $weekEndDate])
            ->get();

        return ResponseAPI($data);
    }



}
