<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\ColaboradorHist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ColaboradorController extends Controller
{


    public function buscarGestor($matricula)
    {

        $call = new Colaborador();
        $list = $call->buscarGestor($matricula);
       //dd($cpf);
        return json_encode($list);

    }

    public function listar()
    {
        $call = new Colaborador();
        $list = $call->listarColaborador();
        return json_encode($list);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('america/sao_paulo');

        if (Colaborador::where('matricula', $request->matriculaP)->exists()){

            $colaborador = Colaborador::where('matricula', $request->matriculaP)->update([
                'login' => $request->matCaixa,
                'jorn_ent' => $request->jornEnt,
                'jorn_sai' => $request->jornSai,
                'mat_gestor' => $request->matGestor,
                'mat_monitor' => $request->matMonitor,
                'dt_hist_alteracao' => $request->histAlteracao,
                'dt_alteracao' =>  date('Y-m-d H:i', time())
            ]);
        }else{
            return response()->json([
                "message" => "Colaborador not found"
            ], 404);
        }

        if(ColaboradorHist::where('matricula', $request->matriculaP)->where(DB::raw("to_char(dt_historico, 'YYYY-MM-DD')"), $request->histAlteracao)->exists()){
            $colaboradorHist = ColaboradorHist::where('matricula', $request->matriculaP)->where(DB::raw("to_char(dt_historico, 'YYYY-MM-DD')"), $request->histAlteracao)
            ->update([
                'login' => $request->matCaixa,
                'jorn_ent' => $request->jornEnt,
                'jorn_sai' => $request->jornSai,
                'mat_gestor' => $request->matGestor,
                'mat_monitor' => $request->matMonitor,
            ]);
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
