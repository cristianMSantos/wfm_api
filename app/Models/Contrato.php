<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    public $timestamps = false;
    protected $table = 'gente.Contrato';
    protected $primaryKey = 'co_contrato';
    
    public function listarContrato(){
        return Contrato::get();
    }
    public function buscarContrato($CO_CONTRATO){
        return Contrato::where('co_contrato','=', $CO_CONTRATO)->get();
    }
}
