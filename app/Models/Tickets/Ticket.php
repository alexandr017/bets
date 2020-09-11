<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'user_appeal_themes';

    protected $fillable = ['user_id', 'theme', 'status'];
}
