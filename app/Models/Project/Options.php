<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table = 'project_options';

    protected $fillable = ['key','value'];

    public $timestamps = false;
}
