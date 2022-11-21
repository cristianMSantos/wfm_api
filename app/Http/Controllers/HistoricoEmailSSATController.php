<?php

namespace App\Http\Controllers;

use App\Models\HistoricoEmailSSAT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoricoEmailSSATController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
  
    public function buscar(Request $request)
    {
        
        $CO_HISTORICO = $request->CO_HISTORICO;
    
        
        $call = new HistoricoEmailSSAT();
        $list = $call->buscarHistoricoEmailSSAT($CO_HISTORICO);
       //dd($CO_HISTORICO);
        return json_encode($list);
       
    }

    public function listar(Request $request)
    {
        $call = new HistoricoEmailSSAT();
        $list = $call->listarHistoricoEmailSSAT();
        return json_encode($list);
    }
    public function buscarPorContrato(Request $request)
    {
        
        $contrato = $request->contrato;
        $empresa = $request->empresa;
        $situacao = $request->situacao;
      
        $call = new HistoricoEmailSSAT();
        $list = $call->buscarPorcontratoEmp($contrato, $empresa, $situacao);
        
        return json_encode($list);
    }
    public function update(Request $request)
    {
        $CO_HISTORICO = $request->CO_HISTORICO;
       // dd($CO_HISTORICO);
        if (HistoricoEmailSSAT::where('CO_HISTORICO', $CO_HISTORICO)->exists()){
            $historicoEmailSSAT = HistoricoEmailSSAT::find($CO_HISTORICO);
            $historicoEmailSSAT->CO_MAT_RESET = is_null($request->CO_MAT_RESET) ? $historicoEmailSSAT->CO_MAT_RESET : $request->CO_MAT_RESET;
            $historicoEmailSSAT->CO_MAT_SOLICITANTE = is_null($request->CO_MAT_SOLICITANTE) ? $historicoEmailSSAT->CO_MAT_SOLICITANTE : $request->CO_MAT_SOLICITANTE;
            $historicoEmailSSAT->DT_EMAIL = is_null($request->DT_EMAIL) ? $historicoEmailSSAT->DT_EMAIL : $request->DT_EMAIL;
            $historicoEmailSSAT->CO_CONTRATO = is_null($request->CO_CONTRATO) ? $historicoEmailSSAT->CO_CONTRATO : $request->CO_CONTRATO;
            $historicoEmailSSAT->IC_STATUS = is_null($request->IC_STATUS) ? $historicoEmailSSAT->IC_STATUS : $request->IC_STATUS;
            $historicoEmailSSAT->CO_MAT_GESTOR = is_null($request->CO_MAT_GESTOR) ? $historicoEmailSSAT->CO_MAT_GESTOR : $request->CO_MAT_GESTOR;		
            $historicoEmailSSAT->save();

            return response()->json([
                "massege" => "update successfully"
            ], 200);
        }else{
           return response()->json([
               "message" => "not found"
           ], 404); 
        } 
    }  
    public function create(Request $request)    
    {

      //  dd($request);
        $historicoEmailSSAT = new HistoricoEmailSSAT();
        $historicoEmailSSAT->CO_MAT_RESET =  $request->CO_MAT_RESET;
        $historicoEmailSSAT->CO_MAT_SOLICITANTE =  $request->CO_MAT_SOLICITANTE;
        $historicoEmailSSAT->DT_EMAIL =  $request->DT_EMAIL;
        $historicoEmailSSAT->CO_CONTRATO =  $request->CO_CONTRATO;
        $historicoEmailSSAT->IC_STATUS =  $request->IC_STATUS;
        $historicoEmailSSAT->CO_MAT_GESTOR =  $request->CO_MAT_GESTOR;
        $historicoEmailSSAT->save();

        return response()->json([
            "massege" => "created successfully"
            
        ], 200);
    }

    public function delete(Request $request)
    {
        $CO_HISTORICO = $request->CO_HISTORICO;
        //dd($CO_HISTORICO);
        if(HistoricoEmailSSAT::where('CO_HISTORICO', $CO_HISTORICO)->exists()){
            $historicoEmailSSAT = HistoricoEmailSSAT::find($CO_HISTORICO);
            $historicoEmailSSAT->delete();

            return response()->json([
                "messege" =>"historicoEmailSSAT deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"historicoEmailSSAT nao encontrado"
            ], 404);
        }

    }
  
}


