<?php

namespace App\Http\Controllers\API\Tickets;

use App\Http\Controllers\API\APIController;

class BaseTicketsController extends APIController
{
    protected const PAGINATE_COUNT = 50;
}
