<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Models\Football\FootballMatch;
use Illuminate\Http\Request;
use App\Http\Requests\API\Football\FootballMatchRequest;
use Carbon\Carbon;
use Auth;
use DB;

class FootballMatchesController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/admin/matches",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Display a listing of the resource")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FootballMatch::query()->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\POST(
     *     path="/api/football/admin/matches",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth",  required=true),
     *     @OA\Parameter(name="football_tour_id", in="query", description="ID of football tour [integer]", required=true),
     *     @OA\Parameter(name="player_1", in="query", description="Player 1 name [string]", required=true),
     *     @OA\Parameter(name="player_2", in="query", description="Player 2 name [string]", required=true),
     *     @OA\Parameter(name="win", in="query", description="Winner [integer:-1/0/1]"),
     *     @OA\Parameter(name="player_1_goals", in="query", description="Goals of player 1 [integer]"),
     *     @OA\Parameter(name="player_2_goals", in="query", description="Goals of player 2 [integer]"),
     *     @OA\Parameter(name="game_date", in="query", description="Match date [date]", required=true),
     *     @OA\Parameter(name="status", in="query", description="Match status [integer]", required=true),
     *     @OA\Response(response="201", description="Store a newly created resource in storage")
     * )
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\API\Football\FootballMatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FootballMatchRequest $request)
    {
        $data = clearData($request->all());
        $match = new FootballMatch($data);
        $match->save();

        return ResponseAPI($match, 201, 'Created');

    }

    /**
     * @OA\GET(
     *     path="/api/football/admin/matches/{id}",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Response(response="200", description="Display the specified resource")
     * )
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = FootballMatch::findOrFail($id);

        return ResponseAPI($data);
    }

    /**
     * @OA\PUT(
     *     path="/api/football/admin/matches/{id}",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="football_tour_id", in="query", description="ID of football tour [integer]", required=true),
     *     @OA\Parameter(name="player_1", in="query", description="Player 1 name [string]", required=true),
     *     @OA\Parameter(name="player_2", in="query", description="Player 2 name [string]", required=true),
     *     @OA\Parameter(name="win", in="query", description="Winner [integer:-1/0/1]"),
     *     @OA\Parameter(name="player_1_goals", in="query", description="Goals of player 1 [integer]"),
     *     @OA\Parameter(name="player_2_goals", in="query", description="Goals of player 2 [integer]"),
     *     @OA\Parameter(name="game_date", in="query", description="Match date [date]", required=true),
     *     @OA\Parameter(name="status", in="query", description="Match status [integer]", required=true),
     *     @OA\Response(response="202", description="Update the specified resource in storage.")
     * )
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\API\Football\FootballMatchRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FootballMatchRequest $request, $id)
    {
        $data = clearData($request->all());
        $match = FootballMatch::findOrFail($id);
        $match->update($data);

        return ResponseAPI($match, 202, 'Updated');
    }

    /**
     * @OA\DELETE(
     *     path="/api/football/admin/matches/{id}",
     *     tags={"Football Matches"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Response(response="410", description="Remove the specified resource from storage.")
     * )
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $match = FootballMatch::findOrFail($id);
        $match->delete();
        // удалить все привязки

        return ResponseAPI([], 410, 'Deleted');
    }


}
