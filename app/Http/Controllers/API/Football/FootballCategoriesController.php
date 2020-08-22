<?php

namespace App\Http\Controllers\API\Football;

use Illuminate\Http\Request;
use App\Models\Football\FootballCategory;
use App\Http\Requests\API\Football\FootballCategoryRequest;

class FootballCategoriesController extends BaseFootballController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FootballCategory::all();

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
     * @param  \Illuminate\Http\FootballCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FootballCategoryRequest $request)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }


        $data = clearData($request->all());
        $category = new FootballCategory($data);
        $category->save();

        return response()->json([
            'status' => 201,
            'details' => 'Created',
            'data' => $category
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
        $data = FootballCategory::findOrFail($id);

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
        $data = FootballCategory::findOrFail($id);

        return response()->json([
            'status' => 200,
            'details' => 'OK',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FootballCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FootballCategoryRequest $request, $id)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }

        $data = clearData($request->all());
        $category = FootballCategory::findOrFaild($id);
        $category->update($data);

        return response()->json([
            'status' => 202,
            'details' => 'Updated',
            'data' => $category
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (! $this->isAdmin($request)) {
            return response()->json([
                'status' => 403,
                'details' => 'Access is denied',
                'data' => []
            ], 403);
        }

        $category = FootballCategory::findOrFaild($id);
        $category->delete();
        // удалить все привязки

        return response()->json([
            'status' => 410,
            'details' => 'Deleted',
            'data' => []
        ], 410);
    }
}
