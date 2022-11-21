<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB006_SETOR';
    protected $primaryKey = 'CO_SETOR';
    
    public function listarSetor(){
        return Setor::select('CO_SETOR',
                            'NO_SETOR',
                            'CO_EMPRESA',
                            'CO_CONTRATO',
                            'IC_STATUS')
                            ->get();
    }
    public function buscarSetor($CO_SETOR){
        return Setor::select('CO_SETOR',
                            'NO_SETOR',
                            'CO_EMPRESA',
                            'CO_CONTRATO',
                            'IC_STATUS')
                            ->where('CO_SETOR','=', $CO_SETOR)                                    
                            ->get();
    }
}
