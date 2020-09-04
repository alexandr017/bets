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
        'game_date',
        'status'
    ];

    public function favorites()
    {
        return $this->hasMany(FootballFavoriteMatch::class, 'football_match_id');
    }

}
