<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\ColaboradorHist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ColaboradorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function buscar($id)
    {
        $call = new Colaborador();
        $list = $call->buscar($id);
        return json_encode($list);

    }

    public function buscarColab(Request $request)
    {
        $call = new Colaborador();
        $list = $call->buscarColab($request->matriculaPlansul);
        return json_encode($list);

    }

    public function buscarGestor(Request $request)
    {
        $call = new Colaborador();
        $list = $call->buscarGestor($request->matriculaCaixa);
        return json_encode($list);

    }

    public function listAllGestores(Request $request)
    {
        $call = new Colaborador();
        $list = $call->listAllGestores($request->filiais);
       //dd($cpf);
        return json_encode($list);

    }

    public function listAllMonitores(Request $request)
    {
        $call = new Colaborador();
        $list = $call->listAllMonitores($request);
        return json_encode($list);
    }

    public function listAllSuperv(Request $request)
    {
        $call = new Colaborador();
        $list = $call->listAllSuperv($request);
        return json_encode($list);
    }

    public function listAllCoord(Request $request)
    {
        $call = new Colaborador();
        $list = $call->listAllCoord($request->filiais);
        return json_encode($list);
    } //listAllCoord //listAllSuperv 

    public function listar(Request $request)
    {
        $call = new Colaborador();
        $list = $call->listarColaborador($request);
        return json_encode($list);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('america/sao_paulo');

        $inputs = array_filter($request->all(), function($v, $k){
            return $k !== 'matriculaP' && $v !== null;
        }, ARRAY_FILTER_USE_BOTH);

        $inputsHist = array_filter($request->all(), function($v, $k){
            return $k !== 'matriculaP' && $k !== 'dt_hist_alteracao' && $v !== null;
        }, ARRAY_FILTER_USE_BOTH);

        if (Colaborador::whereIn('matricula', $request->matriculaP)->exists()){
            $colaborador = Colaborador::whereIn('matricula', $request->matriculaP)
            ->update($inputs);
            // ->update([
            //     'jorn_ent' => $request->jornEnt,
            //     'jorn_sai' => $request->jornSai,
            //     'mat_gestor' => $request->matGestor,
            //     'mat_monitor' => $request->matMonitor,
            //     'dt_hist_alteracao' => $request->histAlteracao,
            //     'dt_alteracao' =>  date('Y-m-d H:i', time())
            // ]);
        }else{
            return response()->json([
                "message" => "Colaborador not found"
            ], 404);
        }

        if(ColaboradorHist::whereIn('matricula', $request->matriculaP)->exists()){
            $colaboradorHist = ColaboradorHist::whereIn('matricula', $request->matriculaP)
            ->where(DB::raw("to_char(dt_historico, 'YYYY-MM-DD')"), '>=', $request->dt_hist_alteracao)
            ->update($inputsHist);
            // ->update([
            //     'login' => $request->matCaixa,
            //     'jorn_ent' => $request->jornEnt,
            //     'jorn_sai' => $request->jornSai,
            //     'mat_gestor' => $request->matGestor,
            //     'mat_monitor' => $request->matMonitor,
            // ]);
        }

        return response()->json([
            "massege" => "update successfully"
        ], 200);
    }
    public function create(Request $request)
    {

        date_default_timezone_set('america/sao_paulo');

        $contrato = new Colaborador;
		$contrato->matricula = $request->matriculaP;
		$contrato->login = $request->matCaixa;
        $contrato->nome = $request->nomeCompleto;
        $contrato->filial = $request->filial['value'];
        $contrato->co_funcao = $request->funcao['value'];
        $contrato->dtnascimento = $request->dtNasc;
        $contrato->dtadmissao = $request->dtAdm;
        $contrato->dtdemissao = $request->dtDem;
        $contrato->id_situacao = 1;
        $contrato->jorn_ent = $request->jornEnt;
        $contrato->jorn_sai = $request->jornSai;
        $contrato->mat_gestor = $request->matGestor;
        $contrato->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }

    public function delete(Request $request)
    {
        return $request;
        $co_colaborador = $request->co_colaborador;
        //dd($co_colaborador);
        if(Colaborador::where('co_colaborador', $co_colaborador)->exists()){
            $colaborador = Colaborador::find($co_colaborador);
            $colaborador->delete();

            return response()->json([
                "messege" =>"colaborador deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"colaborador nao encontrado"
            ], 404);
        }

    }

}
