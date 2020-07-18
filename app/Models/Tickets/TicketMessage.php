<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'tickets_messages';

    protected $fillable = ['ticket_id','user_id','message','status'];

}
