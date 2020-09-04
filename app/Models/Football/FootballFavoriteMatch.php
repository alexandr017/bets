<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class FootballFavoriteMatch extends Model
{
    protected $table = 'football_favorite_matches';

    protected $fillable = ['football_match_id', 'user_id'];

    public function matches()
    {
        return $this->belongsTo(FootballMatch::class, 'football_match_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
