<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;

class FootballMatch extends Model
{
    protected $table = 'football_matches';

    protected $fillable = [
        'football_tour_id',
        'player_1',
        'player_2',
        'win',
        'player_1_goals',
        'player_2_goals',
        'status'
    ];

}
