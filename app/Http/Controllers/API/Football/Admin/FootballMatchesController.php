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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FootballMatch::all();

        return ResponseAPI($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FootballMatchRequest  $request
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FootballMatch::findOrFail($id);

        return ResponseAPI($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FootballMatchRequest  $request
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
