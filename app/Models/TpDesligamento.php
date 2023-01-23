<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TpDesligamento extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_tp_desligamento';

    protected $primaryKey = 'id_tipo_desligamento';

    public function listartpDeslig(){
        return TpDesligamento::get();
    }
}

