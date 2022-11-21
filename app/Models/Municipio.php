<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB003_MUNICIPIO';
    protected $primaryKey = 'CO_MUNICIPIO';
    
    public function listarMunicipio(){
        return Municipio::select('CO_MUNICIPIO',
                                'NO_MUNICIPIO',
                                'CO_UF')
                                ->get();
    }
    public function buscarMunicipio($CO_MUNICIPIO){
        return Municipio::select('CO_MUNICIPIO',
                                'NO_MUNICIPIO',
                                'CO_UF')
                                ->where('CO_MUNICIPIO','=', $CO_MUNICIPIO)                                    
                                ->get();
    }
}