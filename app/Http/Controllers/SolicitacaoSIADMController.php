<?php

namespace App\Http\Controllers;

use App\Models\SolicitacaoSIADM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolicitacaoSIADMController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
  
    public function buscar(Request $request)
    {
        
        $CO_SOLICITACAO = $request->CO_SOLICITACAO;
    
        
        $call = new SolicitacaoSIADM();
        $list = $call->buscarSolicitacaoSIADM($CO_SOLICITACAO);
       //dd($CO_SOLICITACAO);
        return json_encode($list);
       
    }

    public function listar()
    {
        $call = new SolicitacaoSIADM();
        $list = $call->listarSolicitacaoSIADM();
        return json_encode($list);
    }
  

    public function update(Request $request)
    {
        $CO_SOLICITACAO = $request->CO_SOLICITACAO;
       // dd($CO_SOLICITACAO);
        if (SolicitacaoSIADM::where('CO_SOLICITACAO', $CO_SOLICITACAO)->exists()){
            $solicitacaoSIADM = SolicitacaoSIADM::find($CO_SOLICITACAO);
            $solicitacaoSIADM->CO_SISTEMA = is_null($request->CO_SISTEMA) ? $solicitacaoSIADM->CO_SISTEMA : $request->CO_SISTEMA;
            $solicitacaoSIADM->IC_TIPO = is_null($request->IC_TIPO) ? $solicitacaoSIADM->IC_TIPO : $request->IC_TIPO;
            $solicitacaoSIADM->CO_COL_MATRICULA = is_null($request->CO_COL_MATRICULA) ? $solicitacaoSIADM->CO_COL_MATRICULA : $request->CO_COL_MATRICULA;
            $solicitacaoSIADM->CO_SITUACAO = is_null($request->CO_SITUACAO) ? $solicitacaoSIADM->CO_SITUACAO : $request->CO_SITUACAO;
            $solicitacaoSIADM->CO_CONTRATO = is_null($request->CO_CONTRATO) ? $solicitacaoSIADM->CO_CONTRATO : $request->CO_CONTRATO;
            $solicitacaoSIADM->IC_STATUS = is_null($request->IC_STATUS) ? $solicitacaoSIADM->IC_STATUS : $request->IC_STATUS;
            $solicitacaoSIADM->CO_COL_MAT_CAD = is_null($request->CO_COL_MAT_CAD) ? $solicitacaoSIADM->CO_COL_MAT_CAD : $request->CO_COL_MAT_CAD;
            $solicitacaoSIADM->DT_CADASTRO = is_null($request->DT_CADASTRO) ? $solicitacaoSIADM->DT_CADASTRO : $request->DT_CADASTRO;		
            $solicitacaoSIADM->save();

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
        $solicitacaoSIADM = new SolicitacaoSIADM();
        $solicitacaoSIADM->CO_SISTEMA =  $request->CO_SISTEMA;
        $solicitacaoSIADM->IC_TIPO =  $request->IC_TIPO;
        $solicitacaoSIADM->CO_COL_MATRICULA =  $request->CO_COL_MATRICULA;
        $solicitacaoSIADM->CO_SITUACAO =  $request->CO_SITUACAO;
        $solicitacaoSIADM->CO_CONTRATO =  $request->CO_CONTRATO;
        $solicitacaoSIADM->IC_STATUS =  $request->IC_STATUS;
        $solicitacaoSIADM->CO_COL_MAT_CAD =  $request->CO_COL_MAT_CAD;
        $solicitacaoSIADM->DT_CADASTRO =  $request->DT_CADASTRO;
        $solicitacaoSIADM->save();

        return response()->json([
            "massege" => "created successfully"
            
        ], 200);
    }

    public function delete(Request $request)
    {
        $CO_SOLICITACAO = $request->CO_SOLICITACAO;
        //dd($CO_SOLICITACAO);
        if(SolicitacaoSIADM::where('CO_SOLICITACAO', $CO_SOLICITACAO)->exists()){
            $solicitacaoSIADM = SolicitacaoSIADM::find($CO_SOLICITACAO);
            $solicitacaoSIADM->delete();

            return response()->json([
                "messege" =>"solicitacaoSIADM deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"solicitacaoSIADM nao encontrado"
            ], 404);
        }

    }
  
}


