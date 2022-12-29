<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ocorrencia extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_ocorrencias';

    protected $primaryKey = 'id_ocorrencia';

    public function listarOcorrencia(){
        return Colaborador::from('sc_bases.tb_ocorrencias as oc')
        ->select('id_ocorrencia', 'dh_inicio_ocorrencia', 'dh_fim_ocorrencia', 'mat_empregado', 'nome', 'login', 'id_tipo_ocorrencia', 'cid', 'de_ocorrencia'
        , 'mat_registro', 'dt_registro', 'mat_homologacao', 'dt_homologacao', 'ic_ativo', 'observacao'
        , DB::raw("to_char(dh_inicio_ocorrencia, 'dd/MM/yyyy') as dh_inicio_ocor")
        , DB::raw("to_char(dh_fim_ocorrencia, 'dd/MM/yyyy') as dh_fim_ocor")
        , DB::raw("to_char(dh_inicio_ocorrencia, 'dd/MM/yyyy HH24:MI:SS') as dh_inicio_comp")
        , DB::raw("to_char(dh_fim_ocorrencia, 'dd/MM/yyyy HH24:MI:SS') as dh_fim_comp")
        , DB::raw("CONCAT(login, ' - ', nome) as login_nome")
        , DB::raw("to_char(dh_inicio_ocorrencia, 'HH24:MI:SS') as hr_inicio_ocor")
        , DB::raw("to_char(dh_fim_ocorrencia, 'HH24:MI:SS') as hr_fim_ocor") )
        ->join('sc_bases.tb_empregados as emp', 'oc.mat_empregado', 'emp.matricula')
        ->where('oc.dh_inicio_ocorrencia', '>=', '2022-12-01 00:00:00')
        ->where('oc.ic_ativo', '=', '1')
        ->get();
    }

}
