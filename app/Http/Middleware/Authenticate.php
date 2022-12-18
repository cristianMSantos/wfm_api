<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class Authenticate extends BaseMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $user=JWTAuth::parseToken()->authenticate();
        }catch(\Exception $e){
            if($e instanceof\Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status'=>'Token is Invalid'], 401);
            }elseif($e instanceof\Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status'=>'Token is Expired'], 401);
            }else{
                return response()->json(['status'=>'Authorization Token not found'], 401);
            }
        }
        return $next($request);
    }
}
