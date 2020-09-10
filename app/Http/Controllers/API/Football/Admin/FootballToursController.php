<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Models\Football\FootballTour;
use Illuminate\Http\Request;
use App\Http\Requests\API\Football\FootballTourRequest;

class FootballToursController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/admin/tours",
     *     tags={"Football Tours"},
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
        $data = FootballTour::query()->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }

    /**
     * @OA\POST(
     *     path="/api/football/admin/tours",
     *     tags={"Football Tours"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="football_category_id", in="query", description="ID of football category", required=true),
     *     @OA\Parameter(name="tour_title", in="query", description="Title of football category", required=true),
     *     @OA\Response(response="201", description="Store a newly created resource in storage")
     * )
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
     * @OA\GET(
     *     path="/api/football/admin/tours/{id}",
     *     tags={"Football Tours"},
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
        $data = FootballTour::findOrFail($id);

        return ResponseAPI($data);
    }

    /**
     * @OA\PUT(
     *     path="/api/football/admin/torus/{id}",
     *     tags={"Football Tours"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="football_category_id", in="query", description="ID of football category", required=true),
     *     @OA\Parameter(name="tour_title", in="query", description="Title of football category", required=true),
     *     @OA\Response(response="202", description="Update the specified resource in storage.")
     * )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FootballTourRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FootballTourRequest $request, $id)
    {
        $data = clearData($request->all());
        $tour = FootballTour::findOrFail($id);
        $tour->update($data);

        return ResponseAPI($tour, 202, 'Updated');
    }

    /**
     * @OA\DELETE(
     *     path="/api/football/admin/torus/{id}",
     *     tags={"Football Tours"},
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
        $tour = FootballTour::findOrFail($id);
        $tour->delete();
        // удалить все привязки

        return ResponseAPI([], 410, 'Deleted');
    }

    /**
     * @OA\GET(
     *     path="/api/football/admin/tours/get-tours-by-category-id/{id}",
     *     tags={"Football Tours"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Display a listing of the resource")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToursByCategoryID($id)
    {
        $id = (int) $id;
        $data = FootballTour::where(['football_category_id' => $id])->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }


}
