<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Acessos extends Model
{
 
    public $timestamps = false;
    protected $table = 'public.tb_usuario';
    protected $primaryKey = 'co_usuario';

    public function listarAcessos()
    {
        // au = acesso usuario;
        return Acessos::from('public.tb_usuario as au')->select(
                                'au.co_usuario as id',
                                'au.matricula',
                                'vwf.no_operador',
                                'au.co_perfil',
                                'au.dt_criacao',
                                'au.mat_criacao',
                                'au.dt_alteracao',
                                'au.mat_alteracao',
                                'au.ic_ativo',
                                'perfil.no_perfil')
                                ->join('public.tb_perfis as perfil', 'au.co_perfil', '=', 'perfil.co_perfil')
                                ->leftJoin('public.vw_funcionario as vwf', 'au.matricula', '=', 'vwf.matricula_pl')
                                ->get();
    }

    public function resetPassword($matricula, $senha)
    {
        date_default_timezone_set('america/sao_paulo');

        if (Acessos::where('matricula', $matricula)->exists()
            && $senha != '1ae765da44b163c8d6cb8051bc35192b') { // A senha está com criptografia, esse valor é do hash da plansul123.

            Acessos::where('matricula', $matricula)
            ->update([
                'senha' => $senha,
                'dt_alteracao' => date('Y-m-d H:i', time()),
            ]);
        }else {
            return response()->json([
                "message" => "New password cannot be the same password default"
            ], 409);
        }

        return response()->json([
            "massege" => "update successfully"
        ], 200);
    }
}


