<?php

namespace App\Http\Controllers\API\Tickets\Admin;

use App\Http\Controllers\API\Tickets\BaseTicketsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTicketsController extends BaseTicketsController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function($request, $next) {

            if (! $this->isAdmin($request)) {
                return ResponseAPI([], 403, 'Access is denied');
            }

            return $next($request);
        });

    }
}
