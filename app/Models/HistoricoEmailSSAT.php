<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoricoEmailSSAT extends Model
{
    
    public $timestamps = false;
    protected $table = 'GENTE.SSATTB003_HISTORICO_EMAIL';
    
    protected $primaryKey = 'CO_HISTORICO';

    public function listarHistoricoEmailSSAT(){
        return DB::table('GENTE.SSATTB003_HISTORICO_EMAIL')->select('CO_HISTORICO',
                                                    'CO_MAT_RESET',
                                                    'CO_MAT_SOLICITANTE',
                                                    'DT_EMAIL',
                                                    'CO_CONTRATO',                                                  
                                                    'IC_STATUS',
                                                    'CO_MAT_GESTOR')
                                                 ->get();
    }

    public function buscarHistoricoEmailSSAT($CO_HISTORICO){
        return DB::table('GENTE.SSATTB003_HISTORICO_EMAIL')->select('CO_HISTORICO',
                                        'CO_MAT_RESET',
                                        'CO_MAT_SOLICITANTE',
                                        'DT_EMAIL',
                                        'CO_CONTRATO',
                                        'IC_STATUS',
                                        'CO_MAT_GESTOR')
                                    ->where('CO_HISTORICO','=', $CO_HISTORICO)
                                    ->get();
    }
}
