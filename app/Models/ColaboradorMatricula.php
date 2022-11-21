<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColaboradorMatricula extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB013_COLABORADOR_MATRICULA';
    protected $primaryKey = 'CO_REGISTRO';
    
    public function listarColaboradorMatricula(){
        return ColaboradorMatricula::select('CO_REGISTRO',
                                'CO_COL_EMP',
                                'CO_MATRICULA',
                                'DT_INICIO',
                                'DT_FIM',
                                'CO_TIPO_EVENTO',
                                'DT_CADASTRO')
                                ->get();
    }
    public function buscarColaboradorMatricula($CO_REGISTRO){
        return ColaboradorMatricula::select('CO_REGISTRO',
                                        'CO_COL_EMP',
                                        'CO_MATRICULA',
                                        'DT_INICIO',
                                        'DT_FIM',
                                        'CO_TIPO_EVENTO',
                                        'DT_CADASTRO')
                                ->where('CO_REGISTRO','=', $CO_REGISTRO)                                    
                                ->get();
    }
}
