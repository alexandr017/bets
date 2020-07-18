<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Model;

class FootballCategory extends Model
{
    protected $table = 'football_categories';

    protected $fillable = ['category_title'];

    public $timestamps = false;
}
