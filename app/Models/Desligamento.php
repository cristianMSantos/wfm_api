<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Desligamento extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_info_deslig';

    protected $primaryKey = 'id_desligamento';

    public function buscarColab($matriculaP){
        return Desligamento::from('sc_bases.tb_info_deslig as d')
            ->select(
                'dt_alteracao',
                'dt_desligamento',
                'dt_homologacao',
                'dt_registro',
                'ic_ativo',
                'id_desligamento',
                'd.id_local_homologacao',
                'lo.local_homologacao',
                'd.id_tipo_desligamento',
                'tp.tipo_desligamento',
                'justificativa',
                'mat_alteracao',
                'mat_empregado',
                'mat_registro',
            )
            ->join('sc_bases.tb_tp_desligamento as tp', 'd.id_tipo_desligamento', '=', 'tp.id_tipo_desligamento')
            ->join('sc_bases.tb_local_hom_deslig as lo', 'd.id_local_homologacao', '=', 'lo.id_local_homologacao')
            ->whereIn('mat_empregado', $matriculaP)
            ->get();
    }
}

