<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\Admin\AdminFootballController;
use App\Models\Football\FootballCategory;

class FootballCategoriesController extends AdminFootballController
{
    public function getAllCategories()
    {
        $data = FootballCategory::all();

        return ResponseAPI($data);
    }
}
