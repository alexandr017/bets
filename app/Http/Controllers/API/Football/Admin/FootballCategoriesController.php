<?php

namespace App\Http\Controllers\API\Football\Admin;

use Illuminate\Http\Request;
use App\Models\Football\FootballCategory;
use App\Http\Requests\API\Football\FootballCategoryRequest;
use Auth;

class FootballCategoriesController extends AdminFootballController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FootballCategory::all();

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FootballCategory::findOrFail($id);

        return ResponseAPI($data);
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
        $data = clearData($request->all());
        $category = FootballCategory::findOrFaild($id);
        $category->update($data);

        return ResponseAPI($category, 202, 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = FootballCategory::findOrFaild($id);
        $category->delete();
        // удалить все привязки

        return ResponseAPI([], 410, 'Deleted');
    }
}
