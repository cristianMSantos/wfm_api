<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
 
    public $timestamps = false;
    protected $table = 'gente.Cargo';
    protected $primaryKey = 'co_cargo_funcao]';

    public function listarCargo(){
        return Cargo::get();
    }
    public function buscarCargo($co_cargo_funcao){
        return Cargo::where('co_contrato','=', $co_cargo_funcao)->get();
    }
}

