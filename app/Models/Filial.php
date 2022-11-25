<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    public $timestamps = false;
    protected $table = 'sc_bases.tb_filial';
    protected $primaryKey = 'id_filial';

    public function listarFilial(){
        return Filial::get();
    }
}
