<?php

namespace App\Http\Middleware;
use Closure;

class Adm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $login = json_encode(auth('api')->user()->getUser()); //Retorna um objeto com alguns arrays.
        $login = json_decode($login);

        if (isset($login->matricula)) {
            if ($login->matricula && $login->co_perfil == 1 || $login->co_perfil == 2 || $login->co_perfil == 4) {
                return $next($request);
            } else {
                return response()->json([
                    "error" => "Unauthorized"
                ], 401);
            }
        }
    }
}
