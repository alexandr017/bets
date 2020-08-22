<?php

namespace App\Http\Controllers\API\Football;

use App\Models\Football\FootballMatch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FootballMatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FootballMatch::all();

        return response()->json([
            'status' => 200,
            'details' => 'OK',
            'data' => $data
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }


        $data = clearData($request->all());
        $tour = new FootballMatch($data);
        $tour->save();

        return response()->json([
            'status' => 201,
            'details' => 'Created',
            'data' => $tour
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }


        $data = clearData($request->all());
        $tour = new FootballMatch($data);
        $tour->save();

        return response()->json([
            'status' => 201,
            'details' => 'Created',
            'data' => $tour
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pastMatches()
    {

    }
}
