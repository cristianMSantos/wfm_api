<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ColaboradorHist extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_empregados_hist';

    protected $primaryKey = 'matricula';
}

