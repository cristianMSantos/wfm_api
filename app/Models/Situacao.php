<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    public $timestamps = false;
    protected $table = 'gente.Situacao';
    protected $primaryKey = 'co_situacao';
    
    public function listarSituacao(){
        return Situacao::get();
    }
    public function buscarSituacao($co_situacao){
        return Situacao::where('co_situacao','=', $co_situacao)->get();
    }
}
