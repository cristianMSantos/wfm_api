<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalHom extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_local_hom_deslig';

    protected $primaryKey = 'id_local_homologacao';

    public function listarLocaisHom(){
        return LocalHom::get();
    }
}

