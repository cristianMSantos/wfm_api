<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    public $timestamps = false;
    protected $table = 'public.tb_perfis';
    protected $primaryKey = 'co_perfil';

    public function listPerfis(){
        return Perfil::get();
    }
}
