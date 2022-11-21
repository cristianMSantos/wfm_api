<?php

namespace App\Http\Controllers;

use App\Models\RequisicaoSSAT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequisicaoSSATController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
  
    public function buscar(Request $request)
    {
        
        $CO_REQUISICAO = $request->CO_REQUISICAO;
    
        
        $call = new RequisicaoSSAT();
        $list = $call->buscarRequisicaoSSAT($CO_REQUISICAO);
       //dd($CO_REQUISICAO);
        return json_encode($list);
       
    }

    public function listar()
    {
        $call = new RequisicaoSSAT();
        $list = $call->listarRequisicaoSSAT();
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_REQUISICAO = $request->CO_REQUISICAO;
       // dd($CO_REQUISICAO);
        if (RequisicaoSSAT::where('CO_REQUISICAO', $CO_REQUISICAO)->exists()){
            $requisicaoSSAT = RequisicaoSSAT::find($CO_REQUISICAO);
            $requisicaoSSAT->CO_MAT_RESET = is_null($request->CO_MAT_RESET) ? $requisicaoSSAT->CO_MAT_RESET : $request->CO_MAT_RESET;
            $requisicaoSSAT->CO_MAT_SOLICITANTE = is_null($request->CO_MAT_SOLICITANTE) ? $requisicaoSSAT->CO_MAT_SOLICITANTE : $request->CO_MAT_SOLICITANTE;
            $requisicaoSSAT->CO_CONTRATO = is_null($request->CO_CONTRATO) ? $requisicaoSSAT->CO_CONTRATO : $request->CO_CONTRATO;
            $requisicaoSSAT->IC_STATUS = is_null($request->IC_STATUS) ? $requisicaoSSAT->IC_STATUS : $request->IC_STATUS;
            $requisicaoSSAT->DT_RESET = is_null($request->DT_RESET) ? $requisicaoSSAT->DT_RESET : $request->DT_RESET;		
            $requisicaoSSAT->save();

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
        $requisicaoSSAT = new RequisicaoSSAT();
        $requisicaoSSAT->CO_MAT_RESET =  $request->CO_MAT_RESET;
        $requisicaoSSAT->CO_MAT_SOLICITANTE =  $request->CO_MAT_SOLICITANTE;
        $requisicaoSSAT->CO_CONTRATO =  $request->CO_CONTRATO;
        $requisicaoSSAT->IC_STATUS =  $request->IC_STATUS;
        $requisicaoSSAT->DT_RESET =  $request->DT_RESET;
        $requisicaoSSAT->save();

        return response()->json([
            "massege" => "created successfully"
            
        ], 200);
    }

    public function delete(Request $request)
    {
        $CO_REQUISICAO = $request->CO_REQUISICAO;
        //dd($CO_REQUISICAO);
        if(RequisicaoSSAT::where('CO_REQUISICAO', $CO_REQUISICAO)->exists()){
            $requisicaoSSAT = RequisicaoSSAT::find($CO_REQUISICAO);
            $requisicaoSSAT->delete();

            return response()->json([
                "messege" =>"requisicaoSSAT deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"requisicaoSSAT nao encontrado"
            ], 404);
        }

    }
  
}


