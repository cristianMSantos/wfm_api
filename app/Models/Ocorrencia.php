<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Ocorrencia extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_ocorrencias';

    protected $primaryKey = 'id_ocorrencia';

    public function listarOcorrencia(){

        $dataPassada = date('Y-m-d H:i', time() - 15);

        return Colaborador::from('sc_bases.tb_ocorrencias as oc')
        ->select('id_ocorrencia', 'dh_inicio_ocorrencia', 'dh_fim_ocorrencia', 'mat_empregado', 'nome', 'login', 'id_tipo_ocorrencia', 'cid', 'de_ocorrencia'
        , 'mat_registro', 'dt_registro', 'mat_homologacao', 'dt_homologacao', 'ic_ativo', 'observacao', 'oc.mat_alteracao', 'oc.dt_alteracao'
        , DB::raw("to_char(dh_inicio_ocorrencia, 'dd/MM/yyyy') as dh_inicio_ocor")
        , DB::raw("to_char(dh_fim_ocorrencia, 'dd/MM/yyyy') as dh_fim_ocor")
        , DB::raw("to_char(dt_registro, 'dd/MM/yyyy HH24:MI:SS') as dt_reg")
        , DB::raw("to_char(oc.dt_alteracao, 'dd/MM/yyyy HH24:MI:SS') as dt_alt")
        , DB::raw("to_char(dh_inicio_ocorrencia, 'dd/MM/yyyy HH24:MI:SS') as dh_inicio_comp")
        , DB::raw("to_char(dh_fim_ocorrencia, 'dd/MM/yyyy HH24:MI:SS') as dh_fim_comp")
        , DB::raw("CONCAT(login, ' - ', nome) as login_nome")
        , DB::raw("to_char(dh_inicio_ocorrencia, 'HH24:MI:SS') as hr_inicio_ocor")
        , DB::raw("to_char(dh_fim_ocorrencia, 'HH24:MI:SS') as hr_fim_ocor") )
        ->join('sc_bases.tb_empregados as emp', 'oc.mat_empregado', 'emp.matricula')
       // ->whereBetween('oc.dh_inicio_ocorrencia', [$dataPassada, $dtHoje])
        ->where('oc.dh_inicio_ocorrencia', '>=', $dataPassada)
        ->where('oc.ic_ativo', '=', '1')
        ->get();
    }

    public function listarOcorrenciaFiltro(Request $request){

        //dd($request);
        $filiais = [];
        $gestores = [];
        $supervisores = [];
        $ocorrencias= [];
        $dataPassada = date('Y-m-d H:i', time() - 15);
        $dtAdm = $request->filters ? $request->filters['dtAdmInterval'] : '';
        $matriculas = $request->filters ? $request->filters['matriculas'] : '';
       // $matriculasReg = $request->filters ? $request->filters['matriculasReg'] : '';

        if($request->filters['iniFilial']){
            foreach ($request->filters['iniFilial'] as $key => $filial) {
            array_push($filiais, $filial['value']);
            }
        }

        if($request->filters['iniGestor']){
            foreach ($request->filters['iniGestor'] as $key => $gestor) {
              array_push($gestores, $gestor['value']);
            }
          }

        if($request->filters['iniSupervisor'])
            foreach ($request->filters['iniSupervisor'] as $key => $supervisor) {
              array_push($supervisores, $supervisor['value']);
        }

        if($request->filters['iniSituacao'])
            foreach ($request->filters['iniSituacao'] as $key => $situacoes) {
                array_push($ocorrencias, $situacoes['value']);
        }

        $list = Colaborador::from('sc_bases.tb_ocorrencias as oc')
        ->select('id_ocorrencia', 'dh_inicio_ocorrencia', 'dh_fim_ocorrencia', 'mat_empregado', 'nome', 'login', 'id_tipo_ocorrencia', 'cid', 'de_ocorrencia'
        , 'mat_registro', 'dt_registro', 'mat_homologacao', 'dt_homologacao', 'ic_ativo', 'observacao', 'oc.mat_alteracao', 'oc.dt_alteracao'
        , DB::raw("to_char(dh_inicio_ocorrencia, 'dd/MM/yyyy') as dh_inicio_ocor")
        , DB::raw("to_char(dh_fim_ocorrencia, 'dd/MM/yyyy') as dh_fim_ocor")
        , DB::raw("to_char(dt_registro, 'dd/MM/yyyy HH24:MI:SS') as dt_reg")
        , DB::raw("to_char(oc.dt_alteracao, 'dd/MM/yyyy HH24:MI:SS') as dt_alt")
        , DB::raw("to_char(dh_inicio_ocorrencia, 'dd/MM/yyyy HH24:MI:SS') as dh_inicio_comp")
        , DB::raw("to_char(dh_fim_ocorrencia, 'dd/MM/yyyy HH24:MI:SS') as dh_fim_comp")
        , DB::raw("CONCAT(login, ' - ', nome) as login_nome")
        , DB::raw("to_char(dh_inicio_ocorrencia, 'HH24:MI:SS') as hr_inicio_ocor")
        , DB::raw("to_char(dh_fim_ocorrencia, 'HH24:MI:SS') as hr_fim_ocor") )
        ->join('sc_bases.tb_empregados as emp', 'oc.mat_empregado', 'emp.matricula')
        ->where('oc.ic_ativo', '=', '1');
       // ->whereBetween('oc.dh_inicio_ocorrencia', [$dataPassada, $dtHoje])

        if($matriculas){
            $list->whereIn('oc.mat_empregado', $matriculas);
        }/*
        if($matriculasReg){
            $list->whereIn('oc.mat_registro', $matriculasReg);
        }*/
        if($supervisores){
            $list->whereIn('emp.mat_gestor', $supervisores);
        }else if($gestores){
            $list->whereIn('emp.mat_gestor', $gestores);
        }
        if($ocorrencias){
            $list->whereIn('oc.id_tipo_ocorrencia', $ocorrencias);
        }
        if(count($dtAdm) == 2){
            $list->whereBetween('oc.dh_inicio_ocorrencia', $dtAdm);
        }else if($dtAdm){
            $list->where('oc.dh_inicio_ocorrencia', $dtAdm);
        }
        if($filiais){
            $list->whereIn('emp.filial', $filiais);
        }

        if($matriculas == false && $supervisores == false && $gestores == false && $ocorrencias == false && $dtAdm == false){
            $list->where('oc.dh_inicio_ocorrencia', '>=', $dataPassada);
        }

        $list = $list->get();

        return $list;
    }

}
