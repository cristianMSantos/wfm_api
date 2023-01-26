<?php

namespace App\Http\Middleware;
use App\Models\View_Colaborador;
use Closure;

class Gestor {

    public function handle($request, Closure $next) {
        $user = new View_Colaborador;
        $user = $user->getAuthUser();
        
        if ($user[0]['co_perfil'] == 1 || $user[0]['co_perfil'] == 2 || $user[0]['co_perfil'] == 4) {
            return $next($request);
        } else {
            return response()->json([
                "error" => "Unauthorized"
            ], 401);
        }
    }
}