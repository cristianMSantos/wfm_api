<?php

namespace App\models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class View_Funcionarios extends Model
{
    public $timestamps = false;
    protected $table = 'public.vw_funcionario';
    protected $primaryKey = 'matricula_pl';
    
    public function listFuncionarios($colaborador){
        return View_Funcionarios::where('no_operador', 'LIKE', '%'.$colaborador.'%')->where('id_situacao', 1)->orderBy('no_operador', 'asc')->get()->toArray();
    }
}
