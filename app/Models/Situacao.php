<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    public $timestamps = false;
    protected $table = 'sc_bases.vw_situacao';
    protected $primaryKey = 'id_situacao';

    public function listarSituacao(){
        return Situacao::get();
    }
    public function buscarSituacao($id_situacao){
        return Situacao::where('id_situacao','=', $id_situacao)->get();
    }
    public function listarSituacaoCP(){
        return Situacao::from('sc_bases.tb_situacao as oc')->whereNull('id_situacao_sisfin')->orderBy('de_situacao')->get();
    }
}
