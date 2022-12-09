<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    public $timestamps = false;
    protected $table = 'sc_bases.tb_funcao';
    protected $primaryKey = 'co_funcao';
    protected $keyType = 'string';

    public function listarFuncao(){
        return Funcao::get();
    }

    public function buscarFuncao($co_funcao){
        return Funcao::where('co_funcao','=', $co_funcao)->get();
    }
}
