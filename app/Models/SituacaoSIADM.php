<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacaoSIADM extends Model

{
    public $timestamps = false;
    protected $table = 'GENTE.SIADMTB002_SITUACAO';
    protected $primaryKey = 'CO_SITUACAO';

    public function listarSituacaoSIADM(){
        return SituacaoSIADM::select('CO_SITUACAO',
                            'NO_SITUACAO')
                            ->get();
    }
    public function buscarSituacaoSIADM($CO_SITUACAO){
        return SituacaoSIADM::select('CO_SITUACAO',
                            'NO_SITUACAO')
                            ->where('CO_SITUACAO','=', $CO_SITUACAO)                                    
                            ->get();
    }
}

