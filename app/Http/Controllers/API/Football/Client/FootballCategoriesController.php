<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use App\Models\Football\FootballCategory;

class FootballCategoriesController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/client/categories/get-all-categories",
     *     tags={"Football Categories"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="page", in="query", description="Number of pagination page"),
     *     @OA\Response(response="200", description="Display a listing of the resource")
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCategories()
    {
        $data = FootballCategory::query()->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }
}
