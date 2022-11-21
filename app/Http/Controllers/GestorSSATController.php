<?php

namespace App\Http\Controllers;

use App\Models\GestorSSAT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GestorSSATController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
  
    public function buscar(Request $request)
    {
        
        $CO_GESTOR = $request->CO_GESTOR;
    
        
        $call = new GestorSSAT();
        $list = $call->buscarGestorSSAT($CO_GESTOR);
       //dd($CO_GESTOR);
        return json_encode($list);
       
    }

    public function listar()
    {
        $call = new GestorSSAT();
        $list = $call->listarGestorSSAT();
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_GESTOR = $request->CO_GESTOR;
       // dd($CO_GESTOR);
        if (GestorSSAT::where('CO_GESTOR', $CO_GESTOR)->exists()){
            $gestorSSAT = GestorSSAT::find($CO_GESTOR);
            $gestorSSAT->CO_MATRICULA = is_null($request->CO_MATRICULA) ? $gestorSSAT->CO_MATRICULA : $request->CO_MATRICULA;
            $gestorSSAT->IC_TIPO = is_null($request->IC_TIPO) ? $gestorSSAT->IC_TIPO : $request->IC_TIPO;
            $gestorSSAT->DE_SENHA = is_null($request->DE_SENHA) ? $gestorSSAT->DE_SENHA : $request->DE_SENHA;
            $gestorSSAT->DT_ALTERACAO = is_null($request->DT_ALTERACAO) ? $gestorSSAT->DT_ALTERACAO : $request->DT_ALTERACAO;
            $gestorSSAT->CO_CONTRATO = is_null($request->CO_CONTRATO) ? $gestorSSAT->CO_CONTRATO : $request->CO_CONTRATO;
            $gestorSSAT->IC_STATUS = is_null($request->IC_STATUS) ? $gestorSSAT->IC_STATUS : $request->IC_STATUS;
            $gestorSSAT->IC_SENHA_INVALIDA = is_null($request->IC_SENHA_INVALIDA) ? $gestorSSAT->IC_SENHA_INVALIDA : $request->IC_SENHA_INVALIDA;
            $gestorSSAT->CO_CONTRATO_SIADM = is_null($request->CO_CONTRATO_SIADM) ? $gestorSSAT->CO_CONTRATO_SIADM : $request->CO_CONTRATO_SIADM;		
            $gestorSSAT->save();

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
        $gestorSSAT = new GestorSSAT();
        $gestorSSAT->CO_MATRICULA =  $request->CO_MATRICULA;
        $gestorSSAT->IC_TIPO =  $request->IC_TIPO;
        $gestorSSAT->DE_SENHA =  $request->DE_SENHA;
        $gestorSSAT->DT_ALTERACAO =  $request->DT_ALTERACAO;
        $gestorSSAT->CO_CONTRATO =  $request->CO_CONTRATO;
        $gestorSSAT->IC_STATUS =  $request->IC_STATUS;
        $gestorSSAT->IC_SENHA_INVALIDA =  $request->IC_SENHA_INVALIDA;
        $gestorSSAT->CO_CONTRATO_SIADM =  $request->CO_CONTRATO_SIADM;
        $gestorSSAT->save();

        return response()->json([
            "massege" => "created successfully"
            
        ], 200);
    }

    public function delete(Request $request)
    {
        $CO_GESTOR = $request->CO_GESTOR;
        //dd($CO_GESTOR);
        if(GestorSSAT::where('CO_GESTOR', $CO_GESTOR)->exists()){
            $gestorSSAT = GestorSSAT::find($CO_GESTOR);
            $gestorSSAT->delete();

            return response()->json([
                "messege" =>"gestorSSAT deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"gestorSSAT nao encontrado"
            ], 404);
        }

    }
  
}


