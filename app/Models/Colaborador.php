<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Colaborador extends Model
{

    public $timestamps = false;
    protected $table = 'sc_bases.tb_empregados';

    protected $primaryKey = 'matricula';

    public function listarColaborador(Request $request){
      $filiais = [];
      $gestores = [];
      $monitores = [];
      $situacoes = [];
      $dtAdm = $request->filters ? $request->filters['dtAdmInterval'] : '';
      $dtDem = $request->filters ? $request->filters['dtDemInterval'] : '';
      $cpf = $request->filters ? $request->filters['cpf'] : '';
      $matriculas = $request->filters ? $request->filters['matriculas'] : '';

      if($request->filters){
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

        if($request->filters['iniMonitor'])
          foreach ($request->filters['iniMonitor'] as $key => $monitor) {
            array_push($monitores, $monitor['value']);
          }

        if($request->filters['iniMonitor']){
          foreach ($request->filters['iniMonitor'] as $key => $monitor) {
            array_push($monitores, $monitor['value']);
          }
        }

        if($request->filters['iniSituacao']){
          foreach ($request->filters['iniSituacao'] as $key => $situacao) {
            array_push($situacoes, $situacao['value']);
          }
        }
      }


        $list = Colaborador::from('sc_bases.tb_empregados as emp')
        ->select('nome', 'matricula', 'f.de_funcao', 's.de_situacao', 'login', 'filial',
        'emp.co_funcao', 'dtnascimento', 'dtadmissao', 'emp.id_situacao', 'jorn_ent', 'jorn_sai', 'mat_gestor', 'mat_monitor')
        ->join('sc_bases.tb_funcao as f', 'emp.co_funcao', 'f.co_funcao')
        ->join('sc_bases.tb_situacao as s', 'emp.id_situacao', 's.id_situacao_sisfin');

        if($request->filters){
          if($situacoes){
              $list->whereIn('emp.id_situacao', $situacoes);
          }
        }else{
          $list->where('emp.id_situacao', '1');
        }

        if($request->filters){
          if($filiais){
              $list->whereIn('emp.filial', $filiais);
          }

          if($gestores){
              $list->whereIn('emp.mat_gestor', $gestores);
          }

          if($monitores){
              $list->whereIn('emp.mat_monitor', $monitores);
          }

          if($matriculas){
              $list->whereIn('emp.login', $matriculas);
          }

          if($cpf){
              $list->where('emp.cpf', $cpf);
          }

          if(count($dtAdm) == 2){
              $list->whereBetween('emp.dtadmissao', $dtAdm);
          }else if($dtAdm){
              $list->where('emp.dtadmissao', $dtAdm);
          }

          if(count($dtDem) == 2){
              $list->whereBetween('emp.dtdemissao', $dtDem);
          }else if($dtDem){
              $list->where('emp.dtdemissao', $dtDem);
          }

        }

        $list = $list->get();

        return $list;
    }

    public function buscarGestor($matricula){
       // return Colaborador::where('login','=', $matricula)->get();

       return Colaborador::from('sc_bases.tb_empregados as emp')
       ->select('emp.login', 'emp.matricula', 'emp.nome', 'emp.mat_gestor', 'gestor.nome as nome_gestor'
        ,'emp.cpf', 'emp.pis', 'emp.filial', 'emp.co_funcao', 'emp.dt_funcao', 'emp.dtnascimento', 'emp.dtadmissao', 'emp.dtdemissao', 'emp.id_situacao'
        , 'emp.dt_situacao', 'emp.jorn_ent', 'emp.jorn_sai', 'emp.mat_monitor', 'emp.mat_alteracao', 'emp.dt_hist_alteracao', 'emp.dt_alteracao'
       , DB::raw("CONCAT(emp.mat_gestor, ' - ', gestor.nome) as mn_gestor") )
       ->join('sc_bases.tb_empregados as gestor', 'emp.mat_gestor', '=', 'gestor.login')
       ->where('emp.login','=', $matricula)->get();

    }

    public function listAllGestores($filiais){

        $contratos = [];
        if($filiais){
            foreach ($filiais as $key => $filial) {
              array_push($contratos, $filial['value']);
            }
        }

        $list =  Colaborador::from('sc_bases.tb_empregados as emp')
        ->select()
        ->leftJoin('sc_bases.tb_funcao as f', 'emp.co_funcao', '=', 'f.co_funcao')
        ->whereIn('f.co_funcao', function($query){
            $query->select('co_funcao')
            ->from('sc_bases.tb_funcao')
            ->where('de_funcao', 'like', "%COORD%")
            ->Orwhere('de_funcao', 'like', "%SUPERV%")
            ->Orwhere('de_funcao', 'like', "%GERENTE%");
        })
        ->where('emp.id_situacao', '1');

        if($contratos){
          $list->whereIn('emp.filial', $contratos);
        }

        $list = $list->get();

        return $list;
    }

    public function listAllMonitores($request){
      $superior = [];
        if($request->gestores){
            foreach ($request->gestores as $key => $gestor) {
              array_push($superior, $gestor['value']);
            }
        }

      $contrato = [];
        if($request->filiais){
            foreach ($request->filiais as $key => $filial) {
              array_push($contrato, $filial['value']);
            }
        }

      $list = Colaborador::from('sc_bases.tb_empregados as emp')
        ->select('emp.mat_monitor as login', 'emp2.nome', 'f.de_funcao')
        ->join('sc_bases.tb_situacao as s', 'emp.id_situacao', '=', 's.id_situacao_sisfin')
        ->join('sc_bases.tb_empregados as emp2', 'emp2.login', '=', 'emp.mat_monitor')
        ->join('sc_bases.tb_funcao as f', 'emp2.co_funcao', '=', 'f.co_funcao')
        ->where('f.co_funcao', '000000232')
        ->where('emp.id_situacao', '1');

        if($superior){
          $list->whereIn('emp.mat_gestor', $superior);
        }

        if($contrato){
          $list->whereIn('emp.filial', $contrato);
        }

        $list =  $list->distinct()->get();

        return $list;
    }
}

