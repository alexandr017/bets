<?php

namespace App\Http\Controllers\API\Football;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\APIController;

class BaseFootballController extends APIController
{
    protected const PAGINATE_COUNT = 50;
}
