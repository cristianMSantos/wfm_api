<?php

namespace App\Http\Controllers;

use App\Models\SituacaoSIADM;
use Illuminate\Http\Request;

class SituacaoSIADMController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listar(Request $request)
    {
        $call = new SituacaoSIADM();
        $list = $call->listarSituacaoSIADM();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_SITUACAO = $request->CO_SITUACAO;
       
        $call = new SituacaoSIADM();
        $list = $call->buscarSituacaoSIADM($CO_SITUACAO);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_SITUACAO = $request->CO_SITUACAO; 
        if (SituacaoSIADM::where('CO_SITUACAO', $CO_SITUACAO)->exists()){
            $situacaoSIADM = SituacaoSIADM::find($CO_SITUACAO);
            $situacaoSIADM->CO_SITUACAO = is_null($request->CO_SITUACAO) ? $situacaoSIADM->CO_SITUACAO : $request->CO_SITUACAO;
            $situacaoSIADM->NO_SITUACAO = is_null($request->NO_SITUACAO) ? $situacaoSIADM->NO_SITUACAO : $request->NO_SITUACAO;			
            $situacaoSIADM->save();

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

        $situacaoSIADM = new SituacaoSIADM;
        $situacaoSIADM->CO_SITUACAO =  $request->CO_SITUACAO;
        $situacaoSIADM->NO_SITUACAO =  $request->NO_SITUACAO;
        $situacaoSIADM->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_SITUACAO = $request->CO_SITUACAO;
        //dd($CO_SITUACAO);
        if(SituacaoSIADM::where('CO_SITUACAO', $CO_SITUACAO)->exists()){
            $situacaoSIADM = situacaoSIADM::find($CO_SITUACAO);
            $situacaoSIADM->delete();

            return response()->json([
                "messege" =>"situacaoSIADM deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"situacaoSIADM nao encontrado"
            ], 404);
        }

    }


}
