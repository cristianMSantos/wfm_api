<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uf extends Model

{
    public $timestamps = false;
    protected $table = 'gente.Uf';
    protected $primaryKey = 'co_uf';
    
    public function listarUf(){
        return Uf::orderBy('no_uf', 'asc')->get();
    }
    public function buscarUf($co_uf){
        return Uf::where('co_uf','=', $co_uf)->get();
    }
}