<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    public $timestamps = false;
    protected $table = 'sc_bases.tb_situacao';
    protected $primaryKey = 'id_situacao';

    public function listarSituacao(){
        return Situacao::from('sc_bases.tb_situacao')->orderBy('de_situacao')->get();
    //    return Situacao::where('ic_situacao_sisfin', '=', '1')->get();
    }
    public function buscarSituacao($id_situacao){
        return Situacao::where('id_situacao','=', $id_situacao)->get();
    }
    public function listarSituacaoCP(){
        return Situacao::from('sc_bases.tb_situacao as oc')->whereNull('id_situacao_sisfin')->orWhere('id_situacao_sisfin', '=', '9999')->orderBy('de_situacao')->get();
    }
}
