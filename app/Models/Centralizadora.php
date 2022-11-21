<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centralizadora extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB008_CENTRALIZADORA';
    protected $primaryKey = 'CO_CENTRAL';

    public function listarCentralizadora(){
        return Centralizadora::select('CO_CENTRAL',
                                'NO_CENTRAL',
                                'NU_CGC',
                                'IC_STATUS')
                                ->get();
    }
    public function buscarCentralizadora($CO_CENTRAL){
        return Centralizadora::select('CO_CENTRAL',
                                'NO_CENTRAL',
                                'NU_CGC',
                                'IC_STATUS')
                                ->where('CO_CENTRAL','=', $CO_CENTRAL)                                    
                                ->get();
    }
}
