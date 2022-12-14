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
        , 'mat_registro', 'dt_registro', 'mat_homologacao', 'dt_homologacao', 'ic_ativo'
        , DB::raw("to_char(dh_inicio_ocorrencia, 'dd/MM/yyyy') as dh_inicio_ocor") 
        , DB::raw("CONCAT(login, ' - ', nome) as login_nome") )
        //DB::raw("FORMAT(DD_ATENDIMENTO, 'HH:mm:ss') as 'HH_ATENDIMENTO'"),) CONCAT(login, ' - ', nome)
        ->join('sc_bases.tb_empregados as emp', 'oc.mat_empregado', 'emp.matricula')
       // ->join('sc_bases.tb_situacao as s', 'emp.id_situacao', 's.id_situacao_sisfin')
        ->get();
    }

}
