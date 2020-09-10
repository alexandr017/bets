<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use App\Http\Requests\API\Football\FootballMatchRequest;
use App\Models\Football\FootballMatch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FootballMatchesController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/client/matches/get-all-past-matches",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all past matches")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // все прошедшие игры
    public function getAllPastMatches()
    {
        $data = FootballMatch::whereDate('game_date', '<', Carbon::now())->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/client/matches/get-all-next-matches",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all next matches")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // все будущие игры
    public function getAllNextMatches()
    {
        $data = FootballMatch::whereDate('game_date', '>', Carbon::now())->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }


    /**
     * @OA\GET(
     *     path="/api/football/client/matches/get-past-matches-by-tour-id/{tourID}",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all past matches by tour ID")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // все прошедшие игры определенного тура
    public function getPastMatchesByTourID($tourID)
    {
        $tourID = (int) $tourID;

        $data = FootballMatch
            ::where(['football_tour_id' => $tourID])
            ->whereDate('game_date', '<', Carbon::now())
            ->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }


    /**
     * @OA\GET(
     *     path="/api/football/client/matches/get-next-matches-tour-id/{tourID}",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all next matches by tour ID")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // предстоящие матчи определенного тура
    public function getNextMatchesTourID($tourID)
    {
        $tourID = (int) $tourID;

        $data = FootballMatch
            ::where(['football_tour_id' => $tourID])
            ->whereDate('game_date', '>', Carbon::now())
            ->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/client/matches/get-matches-on-next-week",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all matches on next week")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //На этой неделе
    public function getMatchesOnNextWeek()
    {
        $weekEndDate = Carbon::now()->endOfWeek();

        $data = FootballMatch
            ::whereBetween('game_date', [Carbon::now(), $weekEndDate])
            ->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\GET(
     *     path="/api/football/client/matches/get-matches-on-nex-month",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Get all matches on next month")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //В этом месяце
    public function getMatchesOnNexMonth()
    {
        $weekEndDate = Carbon::now()->endOfMonth();

        $data = FootballMatch
            ::whereBetween('game_date', [Carbon::now(), $weekEndDate])
            ->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }



}
