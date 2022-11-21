<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SistemaSIADM extends Model
{
    
    public $timestamps = false;
    protected $table = 'GENTE.SIADMTB001_SISTEMA';
    
    protected $primaryKey = 'CO_SISTEMA';

    public function listarSistemas(){
        return DB::table('GENTE.SIADMTB001_SISTEMA')->select('CO_SISTEMA',
                                                    'NO_SISTEMA',
                                                    'DE_LINK',
                                                    'IC_BOTAO',
                                                    'NO_BUSCA',
                                                    'IC_SOMENTE_CAIXA',
                                                    'IC_STATUS',
                                                    'CO_COL_MAT_CAD',
                                                    'DT_CADASTRO')
                                                 ->get();
    }

    public function buscarSistema($CO_SISTEMA){
        return DB::table('GENTE.SIADMTB001_SISTEMA')->select('CO_SISTEMA',
                                        'NO_SISTEMA',
                                        'DE_LINK',
                                        'IC_BOTAO',
                                        'NO_BUSCA',
                                        'IC_SOMENTE_CAIXA',
                                        'IC_STATUS',
                                        'CO_COL_MAT_CAD',
                                        'DT_CADASTRO')
                                    ->where('CO_SISTEMA','=', $CO_SISTEMA)
                                    ->get();
    }
}
