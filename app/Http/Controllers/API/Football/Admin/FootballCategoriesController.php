<?php

namespace App\Http\Controllers\API\Football\Admin;

use Illuminate\Http\Request;
use App\Models\Football\FootballCategory;
use App\Http\Requests\API\Football\FootballCategoryRequest;
use Auth;

class FootballCategoriesController extends AdminFootballController
{
    /**
     * @OA\GET(
     *     path="/api/football/admin/categories",
     *     tags={"Football Categories"},
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
        $data = FootballCategory::query()->paginate(self::PAGINATE_COUNT);

        return ResponseAPI($data);
    }


    /**
     * @OA\POST(
     *     path="/api/football/admin/categories",
     *     tags={"Football Categories"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="category_title", in="query", description="Title of football category", required=true),
     *     @OA\Response(response="201", description="Store a newly created resource in storage")
     * )
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FootballCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FootballCategoryRequest $request)
    {
        $data = clearData($request->all());
        $category = new FootballCategory($data);
        $category->save();

        return ResponseAPI($category, 201, 'Created');
    }

    /**
     * @OA\GET(
     *     path="/api/football/admin/categories/{id}",
     *     tags={"Football Categories"},
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
        $data = FootballCategory::findOrFail($id);

        return ResponseAPI($data);
    }

    /**
     * @OA\PUT(
     *     path="/api/football/admin/categories/{id}",
     *     tags={"Football Categories"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Parameter(name="category_title", in="query", description="Title of football category", required=true),
     *     @OA\Response(response="202", description="Update the specified resource in storage.")
     * )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FootballCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FootballCategoryRequest $request, $id)
    {
        $data = clearData($request->all());
        $category = FootballCategory::findOrFail($id);
        $category->update($data);

        return ResponseAPI($category, 202, 'Updated');
    }

    /**
     * @OA\DELETE(
     *     path="/api/football/admin/categories/{id}",
     *     tags={"Football Categories"},
     *     @OA\Parameter(name="token", in="query", description="Token auth", required=true),
     *     @OA\Response(response="410", description="Remove the specified resource from storage.")
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = FootballCategory::findOrFail($id);
        $category->delete();
        // удалить все привязки

        return ResponseAPI([], 410, 'Deleted');
    }
}
