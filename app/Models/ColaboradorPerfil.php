<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColaboradorPerfil extends Model

{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB016_COLABORADOR_PERFIL';
    protected $primaryKey = 'CO_COL_PERFIL';
    
    public function listarColaboradorPerfil(){
        return ColaboradorPerfil::select('CO_COL_PERFIL',
                                'CO_COL_MATRICULA',
                                'CO_CONTRATO',
                                'CO_PERFIL',
                                'IC_STATUS',
                                'CO_COL_MAT_CAD',
                                'DT_CADASTRO')
                                ->get();
    }
    public function buscarColaboradorPerfil($CO_COL_PERFIL){
        return ColaboradorPerfil::select('CO_COL_PERFIL',
                                'CO_COL_MATRICULA',
                                'CO_CONTRATO',
                                'CO_PERFIL',
                                'IC_STATUS',
                                'CO_COL_MAT_CAD',
                                'DT_CADASTRO')
                                ->where('CO_COL_PERFIL','=', $CO_COL_PERFIL)                                    
                                ->get();
    }
    
}
