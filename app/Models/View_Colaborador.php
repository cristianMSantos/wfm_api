<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class View_Colaborador extends Model
{
    public $timestamps = false;
    protected $table = 'gente.vw_colaborador';
    protected $primaryKey = 'co_colaborador';

    public function getAuthUser(){
        if(isset($_SERVER['AUTH_USER'])){
            //usuário logado retorna o e-mail. É utilizado apenas o login
            $login = substr($_SERVER['AUTH_USER'], 10);
        }else{
            // se estiver no local host ele seta sua matrícula
            $login = get_current_user();
        }
        $user = View_Colaborador::where('mat_colaborador', $login)->get();

        return $user;
    }
}
