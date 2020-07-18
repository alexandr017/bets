<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //

    protected $table = 'project_balance';

    protected $fillable = ['balance'];

    public $timestamps = false;

}
