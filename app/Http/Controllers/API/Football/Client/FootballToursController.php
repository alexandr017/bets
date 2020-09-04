<?php

namespace App\Http\Controllers\API\Football\Client;

use App\Http\Controllers\API\Football\BaseFootballController;
use App\Models\Football\FootballTour;

class FootballToursController extends BaseFootballController
{
    public function getToursByCategoryID($id)
    {
        $id = (int) $id;
        $data = FootballTour::where(['football_category_id' => $id])->get();

        return ResponseAPI($data);
    }
}
