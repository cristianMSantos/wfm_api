<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class View_Colaborador extends Model
{
    public $timestamps = false;
    protected $table = 'sc_bases.vw_funcionario';
    protected $primaryKey = 'matricula';

    public function getAuthUser(){
        // if(isset($_SERVER['AUTH_USER'])){
        //     //usuário logado retorna o e-mail. É utilizado apenas o login
        //     $login = substr($_SERVER['AUTH_USER'], 10);
        // }else{
        //     // se estiver no local host ele seta sua matrícula
        //     $login = get_current_user();
        // }

        $login = 113707;

        $user = View_Colaborador::where('matricula', $login)->get();

        return $user;
    }
}
