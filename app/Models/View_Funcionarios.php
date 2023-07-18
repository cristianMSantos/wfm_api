<?php

namespace App\models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use DB;

class View_Funcionarios extends Model
{
    public $timestamps = false;
    protected $table = 'public.vw_funcionario';
    protected $primaryKey = 'matricula_pl';

    function contemSomenteNumeros($str) {
        // Expressão regular para verificar se a string possui somente números
        return preg_match('/^\d+$/', $str) === 1;
    }
      
    public function listFuncionarios($colaborador){
        $result = View_Funcionarios::select('matricula_pl', 'no_operador', DB::raw("(
            CASE
              WHEN EXISTS (
                SELECT 1 FROM tb_usuario WHERE matricula = matricula_pl
              )
              THEN TRUE 
              ELSE FALSE
            END
          ) AS has_access"));
          
          if($this->contemSomenteNumeros($colaborador)){
            $result->where('matricula_pl', $colaborador);
          }else{
            $result->where('no_operador', 'LIKE', '%'.strtoupper($colaborador).'%');
          }
          
        $result = $result->where('id_situacao', 1)->orderBy('no_operador', 'asc')->get()->toArray();
        return $result;
    }

    public function getAuthUser(){
        $login = Auth::user()->matricula;

        $user = View_Funcionarios::where('matricula_pl', $login)->get();

        return $user;
    }

}
