<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;

/**
 * @OA\Info(title="`Bets API`", version="0.1")
 */

class APIController extends Controller
{
    protected const ADMIN_ROLE = 1;

    protected function isAdmin(Request $request)
    {
        return $request->user()->role_id == self::ADMIN_ROLE;
    }


    protected function isUserEntity(Request $request, $entity)
    {
        if (isset($entity->user_id)) {
            if ( (int) $entity->user_id === $request->user()->id) {
                return true;
            }
        }

        return false;
    }


    public function __construct()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
