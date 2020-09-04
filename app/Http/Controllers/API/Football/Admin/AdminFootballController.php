<?php

namespace App\Http\Controllers\API\Football\Admin;

use App\Http\Controllers\API\Football\BaseFootballController;


class AdminFootballController extends BaseFootballController
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
