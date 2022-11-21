<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Colaborador extends Model
{
    
    public $timestamps = false;
    protected $table = 'gente.Colaborador';
    
    protected $primaryKey = 'co_colaborador';

    public function listarColaborador(){
        return Colaborador::get();
    }

    public function buscarEmpregado($cpf){
        return Colaborador::where('co_cpf','=', $cpf)->get();
    }
}

