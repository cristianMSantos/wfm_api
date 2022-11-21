<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    public $timestamps = false;
    protected $table = 'gente.Perfil';
    protected $primaryKey = 'co_perfil';

    public function listarPerfil(){
        return Perfil::get();
    }
    public function buscarPerfil($co_perfil){
        return Perfil::where('co_perfil','=', $co_perfil)->get();
    }
}
