<?php

namespace App\Http\Controllers\API\Football;

use App\Models\Football\FootballTour;
use Illuminate\Http\Request;
use App\Http\Requests\API\Football\FootballTourRequest;

class FootballToursController extends BaseFootballController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FootballTour::all();

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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FootballTourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FootballTourRequest $request)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }


        $data = clearData($request->all());
        $tour = new FootballTour($data);
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
    public function show($id)
    {
        $data = FootballTour::findOrFail($id);

        return response()->json([
            'status' => 200,
            'details' => 'OK',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FootballTour::findOrFail($id);

        return response()->json([
            'status' => 200,
            'details' => 'OK',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FootballTourRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FootballTourRequest $request, $id)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }

        $data = clearData($request->all());
        $tour = FootballTour::findOrFaild($id);
        $tour->update($data);

        return response()->json([
            'status' => 202,
            'details' => 'Updated',
            'data' => $tour
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FootballTourRequest $request, $id)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }

        $tour = FootballTour::findOrFaild($id);
        $tour->delete();
        // удалить все привязки

        return response()->json([
            'status' => 410,
            'details' => 'Deleted',
            'data' => []
        ], 410);
    }

    public function getToursByCategoryID($id)
    {
        $data = FootballTour::where(['football_category_id' => $id])->get();

        return response()->json([
            'status' => 200,
            'details' => 'OK',
            'data' => $data
        ]);
    }
}
