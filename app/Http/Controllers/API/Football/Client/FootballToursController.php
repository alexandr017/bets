<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\BaseFootballController;
use App\Models\Football\FootballTour;

class FootballToursController extends BaseFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/client/tours/get-tours-by-category-id/{id}",
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
