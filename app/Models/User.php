<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = false;
    protected $table = 'public.tb_usuario';
    protected $primaryKey = 'co_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
      'co_usuario',
      'matricula',
      'senha',
      'co_perfil',
      'dt_criacao',
      'mat_criacao',
      'dt_alteracao',
      'mat_alteracao',
      'ic_ativo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'senha'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/


    public function getAuthPassword()
    {
        return Hash::make($this->senha) ;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getUser(){
        return User::from('public.tb_usuario as user')
        ->select(
            'user.co_usuario',
            'user.matricula',
            'user.senha',
            'user.co_perfil',
            'user.dt_criacao',
            'user.mat_criacao',
            'user.dt_alteracao',
            'user.mat_alteracao',
            'user.ic_ativo',
            'emp.nome'
        )
        ->join('sc_bases.tb_empregados as emp', 'user.matricula', '=', 'emp.matricula')
        ->where('user.matricula', $this->matricula)
        ->first();
    }

    public function resetPassword($matricula, $senha){
        return $matricula;
    }
}
