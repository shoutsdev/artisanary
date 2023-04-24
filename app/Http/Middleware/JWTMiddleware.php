<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException)
                return response()->json([
                    'error' => __('Token is invalid')
                ]);
            elseif ($e instanceof TokenExpiredException)
                return response()->json([
                    'error' => __('Token is Expired')
                ]);
            else
                return response()->json([
                    'error' => __('Authorization Token Not Found')
                ]);
        }
        if ($user):
            return $next($request);
        else:
            return response()->json([
                'error' => __('Invalid Token')
            ]);
        endif;
    }
}
