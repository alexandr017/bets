<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Models\Football\FootballTour;
use Illuminate\Http\Request;
use App\Http\Requests\API\Football\FootballTourRequest;

class FootballToursController extends AdminFootballController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FootballTour::all();

        return ResponseAPI($data);
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
        $data = clearData($request->all());
        $tour = new FootballTour($data);
        $tour->save();

        return ResponseAPI($tour, 201, 'Created');
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
        $data = FootballTour::findOrFail($id);

        return ResponseAPI($data);
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
        $data = clearData($request->all());
        $tour = FootballTour::findOrFaild($id);
        $tour->update($data);

        return ResponseAPI($tour, 202, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = FootballTour::findOrFaild($id);
        $tour->delete();
        // удалить все привязки

        return ResponseAPI([], 410, 'Deleted');
    }


}
