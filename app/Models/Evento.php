<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB014_EVENTOS';
    protected $primaryKey = 'CO_EVENTO';
    
    public function listarEvento(){
        return Evento::select('CO_EVENTO',
                                'CO_COL_EMP',
                                'DT_INICIO',
                                'DT_FIM',
                                'CO_TIPO_EVENTO',
                                'NO_OBSERVACAO',
                                'CO_CID',
                                'CO_CRM',
                                'CO_CRIADOR',
                                'DT_CRIACAO',
                                'CO_EDITOR',
                                'DT_EDICAO')
                                ->get();
    }
    public function buscarEvento($CO_EVENTO){
        return Evento::select('CO_EVENTO',
                                'CO_COL_EMP',
                                'DT_INICIO',
                                'DT_FIM',
                                'CO_TIPO_EVENTO',
                                'NO_OBSERVACAO',
                                'CO_CID',
                                'CO_CRM',
                                'CO_CRIADOR',
                                'DT_CRIACAO',
                                'CO_EDITOR',
                                'DT_EDICAO')
                                ->where('CO_EVENTO','=', $CO_EVENTO)                                    
                                ->get();
    }
    
}
