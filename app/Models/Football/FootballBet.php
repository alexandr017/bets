<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;

class FootballBet extends Model
{

    protected $table = 'football_bets';

    protected $fillable = [
        'football_match_id',
        'user_id',
        'sum_in',
        'sum_out',
        'to_player',
        'status'
    ];

}
