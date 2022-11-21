<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cid extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB004_CID';
    protected $primaryKey = 'CO_CID';

    public function listarCid(){
        return Cid::select('CO_CID',
                            'NO_CID',
                            'IC_STATUS')
                            ->get();
    }
    public function buscarCid($CO_CID){
        return Cid::select('CO_CID',
                            'NO_CID',
                            'IC_STATUS')
                            ->where('CO_CID','=', $CO_CID)                                    
                            ->get();
    }
}

