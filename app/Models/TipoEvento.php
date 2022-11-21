<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB005_TIPO_EVENTO';
    protected $primaryKey = 'CO_TIPO_EVENTO';
    
    public function listarTipoEvento(){
        return TipoEvento::select('CO_TIPO_EVENTO',
                                    'NO_TIPO_EVENTO',
                                    'IC_STATUS')
                                    ->get();
    }
    public function buscarTipoEvento($CO_TIPO_EVENTO){
        return TipoEvento::select('CO_TIPO_EVENTO',
                                    'NO_TIPO_EVENTO',
                                    'IC_STATUS')
                                    ->where('CO_TIPO_EVENTO','=', $CO_TIPO_EVENTO)                                    
                                    ->get();
    }
}
