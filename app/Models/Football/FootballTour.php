<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;

class FootballTour extends Model
{
    protected $table = 'football_tours';

    protected $fillable = ['football_category_id', 'tour_title'];

    public $timestamps = false;
}
