<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Algorithms\Frontend\Calculation;

class ResultController extends Controller
{

    public function static(){

        $win1 = [
            'й' => 4,
            'ц' => 3,
            'у' => 1,
            'к' => 5
        ];

        $win2 = [
            'щ' => 2,
            'з' => 9,
            'х' => 8,
            'ъ' => 7
        ];

        $draw = [
            'е' => 10,
            'н' => 1,
            'г' => 2,
            'ш' => 5
        ];

        $match = new Calculation($win1, $win2, $draw);

    }

    public function random(){
        $win1 = [];
        $win2 = [];
        $draw = [];

        $win1_counter = rand(1,10);
        $win2_counter = rand(1,10);
        $draw_counter = rand(1,10);

        for ($i = 0; $i < $win1_counter; $i++) {
            $win1[rand(1,1000000)] = rand(1,15);
        }

        for ($i = 0; $i < $win2_counter; $i++) {
            $win2[rand(1,1000000)] = rand(1,15);
        }

        for ($i = 0; $i < $draw_counter; $i++) {
            $draw[rand(1,1000000)] = rand(1,15);
        }

        $match = new Calculation($win1, $win2, $draw);

    }



}
