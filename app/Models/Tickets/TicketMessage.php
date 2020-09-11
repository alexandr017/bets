<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'user_appeal_messages';

    protected $fillable = ['user_appeal_theme_id','sender','message','status','status_for_admin','status_for_user'];

}
