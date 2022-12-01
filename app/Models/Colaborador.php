<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Colaborador extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_empregados';

    protected $primaryKey = 'matricula';

    public function listarColaborador(){
        return Colaborador::from('sc_bases.tb_empregados as emp')
        ->select('nome', 'matricula', 'f.de_funcao', 's.de_situacao', 'login', 'filial',
        'emp.co_funcao', 'dtnascimento', 'dtadmissao', 'emp.id_situacao', 'jorn_ent', 'jorn_sai', 'mat_gestor', 'mat_monitor')
        ->join('sc_bases.tb_funcao as f', 'emp.co_funcao', 'f.co_funcao')
        ->join('sc_bases.tb_situacao as s', 'emp.id_situacao', 's.id_situacao')
        ->get();
    }

    public function buscarGestor($matricula){
        return Colaborador::where('login','=', $matricula)->get();
    }
}

