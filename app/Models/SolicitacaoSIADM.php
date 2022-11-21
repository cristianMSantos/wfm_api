<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SolicitacaoSIADM extends Model
{
    
    public $timestamps = false;
    protected $table = 'GENTE.SIADMTB003_SOLICITACAO';
    
    protected $primaryKey = 'CO_SOLICITACAO';

    public function listarSolicitacaoSIADM(){
        return DB::table('GENTE.SIADMTB003_SOLICITACAO')->select('CO_SOLICITACAO',
                                                    'CO_SISTEMA',
                                                    'IC_TIPO',
                                                    'CO_COL_MATRICULA',
                                                    'CO_SITUACAO',
                                                    'CO_CONTRATO',                                                  
                                                    'CO_COL_MAT_CAD',
                                                    'DT_CADASTRO')
                                                 ->get();
    }

    public function buscarSolicitacaoSIADM($CO_SOLICITACAO){
        return DB::table('GENTE.SIADMTB003_SOLICITACAO')->select('CO_SOLICITACAO',
                                        'CO_SISTEMA',
                                        'IC_TIPO',
                                        'CO_COL_MATRICULA',
                                        'CO_SITUACAO',
                                        'CO_CONTRATO',
                                        'CO_COL_MAT_CAD',
                                        'DT_CADASTRO')
                                    ->where('CO_SOLICITACAO','=', $CO_SOLICITACAO)
                                    ->get();
    }
}

