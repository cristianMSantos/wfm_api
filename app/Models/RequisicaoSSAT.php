<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequisicaoSSAT extends Model
{
    
    public $timestamps = false;
    protected $table = 'GENTE.SSATTB002_REQUISICAO';
    
    protected $primaryKey = 'CO_REQUISICAO';

    public function listarRequisicaoSSAT(){
        return DB::table('GENTE.SSATTB002_REQUISICAO')->select('CO_REQUISICAO',
                                                    'CO_MAT_RESET',
                                                    'CO_MAT_SOLICITANTE',
                                                    'CO_CONTRATO',                                                  
                                                    'IC_STATUS',
                                                    'DT_RESET')
                                                 ->get();
    }

    public function buscarRequisicaoSSAT($CO_REQUISICAO){
        return DB::table('GENTE.SSATTB002_REQUISICAO')->select('CO_REQUISICAO',
                                        'CO_MAT_RESET',
                                        'CO_MAT_SOLICITANTE',
                                        'CO_CONTRATO',
                                        'IC_STATUS',
                                        'DT_RESET')
                                    ->where('CO_REQUISICAO','=', $CO_REQUISICAO)
                                    ->get();
    }
}

