<?php

namespace App\Http\Controllers;

use App\Models\SistemaSIADM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SistemaSIADMController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
  
    public function buscar(Request $request)
    {
        
        $CO_SISTEMA = $request->CO_SISTEMA;
    
        
        $call = new SistemaSIADM();
        $list = $call->buscarSistemaSIADM($CO_SISTEMA);
       //dd($CO_SISTEMA);
        return json_encode($list);
       
    }

    public function listar()
    {
        $call = new SistemaSIADM();
        $list = $call->listarSistemaSIADMs();
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_SISTEMA = $request->CO_SISTEMA;
       // dd($CO_SISTEMA);
        if (SistemaSIADM::where('CO_SISTEMA', $CO_SISTEMA)->exists()){
            $sistemaSIADM = SistemaSIADM::find($CO_SISTEMA);
            $sistemaSIADM->NO_SISTEMA = is_null($request->NO_SISTEMA) ? $sistemaSIADM->NO_SISTEMA : $request->NO_SISTEMA;
            $sistemaSIADM->DE_LINK = is_null($request->DE_LINK) ? $sistemaSIADM->DE_LINK : $request->DE_LINK;
            $sistemaSIADM->IC_BOTAO = is_null($request->IC_BOTAO) ? $sistemaSIADM->IC_BOTAO : $request->IC_BOTAO;
            $sistemaSIADM->NO_BUSCA = is_null($request->NO_BUSCA) ? $sistemaSIADM->NO_BUSCA : $request->NO_BUSCA;
            $sistemaSIADM->IC_SOMENTE_CAIXA = is_null($request->IC_SOMENTE_CAIXA) ? $sistemaSIADM->IC_SOMENTE_CAIXA : $request->IC_SOMENTE_CAIXA;
            $sistemaSIADM->IC_STATUS = is_null($request->IC_STATUS) ? $sistemaSIADM->IC_STATUS : $request->IC_STATUS;
            $sistemaSIADM->CO_COL_MAT_CAD = is_null($request->CO_COL_MAT_CAD) ? $sistemaSIADM->CO_COL_MAT_CAD : $request->CO_COL_MAT_CAD;
            $sistemaSIADM->DT_CADASTRO = is_null($request->DT_CADASTRO) ? $sistemaSIADM->DT_CADASTRO : $request->DT_CADASTRO;		
            $sistemaSIADM->save();

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
        $sistemaSIADM = new SistemaSIADM();
        $sistemaSIADM->NO_SISTEMA =  $request->NO_SISTEMA;
        $sistemaSIADM->DE_LINK =  $request->DE_LINK;
        $sistemaSIADM->IC_BOTAO =  $request->IC_BOTAO;
        $sistemaSIADM->NO_BUSCA =  $request->NO_BUSCA;
        $sistemaSIADM->IC_SOMENTE_CAIXA =  $request->IC_SOMENTE_CAIXA;
        $sistemaSIADM->IC_STATUS =  $request->IC_STATUS;
        $sistemaSIADM->CO_COL_MAT_CAD =  $request->CO_COL_MAT_CAD;
        $sistemaSIADM->DT_CADASTRO =  $request->DT_CADASTRO;
        $sistemaSIADM->save();

        return response()->json([
            "massege" => "created successfully"
            
        ], 200);
    }

    public function delete(Request $request)
    {
        $CO_SISTEMA = $request->CO_SISTEMA;
        //dd($CO_SISTEMA);
        if(SistemaSIADM::where('CO_SISTEMA', $CO_SISTEMA)->exists()){
            $sistemaSIADM = SistemaSIADM::find($CO_SISTEMA);
            $sistemaSIADM->delete();

            return response()->json([
                "messege" =>"sistemaSIADM deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"sistemaSIADM nao encontrado"
            ], 404);
        }

    }
  
}


