<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = ['theme','user_id'];
}
