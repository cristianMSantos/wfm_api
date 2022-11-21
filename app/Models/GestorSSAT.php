<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GestorSSAT extends Model
{
    
    public $timestamps = false;
    protected $table = 'GENTE.SSATTB001_GESTOR';
    
    protected $primaryKey = 'CO_GESTOR';

    public function listarGestorSSAT(){
        return DB::table('GENTE.SSATTB001_GESTOR')->select('CO_GESTOR',
                                                    'CO_MATRICULA',
                                                    'IC_TIPO',
                                                    'DE_SENHA',
                                                    'DT_ALTERACAO',
                                                    'CO_CONTRATO',                                                  
                                                    'IC_SENHA_INVALIDA',
                                                    'CO_CONTRATO_SIADM')
                                                 ->get();
    }

    public function buscarGestorSSAT($CO_GESTOR){
        return DB::table('GENTE.SSATTB001_GESTOR')->select('CO_GESTOR',
                                        'CO_MATRICULA',
                                        'IC_TIPO',
                                        'DE_SENHA',
                                        'DT_ALTERACAO',
                                        'CO_CONTRATO',
                                        'IC_SENHA_INVALIDA',
                                        'CO_CONTRATO_SIADM')
                                    ->where('CO_GESTOR','=', $CO_GESTOR)
                                    ->get();
    }
}

