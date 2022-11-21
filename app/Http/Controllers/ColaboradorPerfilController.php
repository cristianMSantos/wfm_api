<?php

namespace App\Http\Controllers;

use App\Models\ColaboradorPerfil;
use Illuminate\Http\Request;

class ColaboradorPerfilController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function listar()
    {
        $call = new ColaboradorPerfil();
        $list = $call->listarColaboradorPerfil();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_COL_PERFIL = $request->CO_COL_PERFIL;
     
        $call = new ColaboradorPerfil();
        $list = $call->buscarColaboradorPerfil($CO_COL_PERFIL);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_COL_PERFIL = $request->CO_COL_PERFIL; 
        if (ColaboradorPerfil::where('CO_COL_PERFIL', $CO_COL_PERFIL)->exists()){
            $colaboradorPerfil = ColaboradorPerfil::find($CO_COL_PERFIL);
            $colaboradorPerfil->CO_COL_PERFIL = is_null($request->CO_COL_PERFIL) ? $colaboradorPerfil->CO_COL_PERFIL : $request->CO_COL_PERFIL;
			$colaboradorPerfil->CO_COL_MATRICULA = is_null($request->CO_COL_MATRICULA) ? $colaboradorPerfil->CO_COL_MATRICULA : $request->CO_COL_MATRICULA;	
			$colaboradorPerfil->CO_CONTRATO = is_null($request->CO_CONTRATO) ? $colaboradorPerfil->CO_CONTRATO : $request->CO_CONTRATO;
            $colaboradorPerfil->CO_PERFIL = is_null($request->CO_PERFIL) ? $colaboradorPerfil->CO_PERFIL : $request->CO_PERFIL;
            $colaboradorPerfil->IC_STATUS = is_null($request->IC_STATUS) ? $colaboradorPerfil->IC_STATUS : $request->IC_STATUS;	
			$colaboradorPerfil->CO_COL_MAT_CAD = is_null($request->CO_COL_MAT_CAD) ? $colaboradorPerfil->CO_COL_MAT_CAD : $request->CO_COL_MAT_CAD;	
			$colaboradorPerfil->DT_CADASTRO = is_null($request->DT_CADASTRO) ? $colaboradorPerfil->DT_CADASTRO : $request->DT_CADASTRO;	
            $colaboradorPerfil->save();

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

        $colaboradorPerfil = new ColaboradorPerfil;
        $colaboradorPerfil->CO_COL_PERFIL =  $request->CO_COL_PERFIL;
		$colaboradorPerfil->CO_COL_MATRICULA =  $request->CO_COL_MATRICULA;	
		$colaboradorPerfil->CO_CONTRATO =  $request->CO_CONTRATO;
        $colaboradorPerfil->CO_PERFIL =  $request->CO_PERFIL;
		$colaboradorPerfil->IC_STATUS =  $request->IC_STATUS;	
		$colaboradorPerfil->CO_COL_MAT_CAD =  $request->CO_COL_MAT_CAD;	
		$colaboradorPerfil->DT_CADASTRO =  $request->DT_CADASTRO;		
        $colaboradorPerfil->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_COL_PERFIL = $request->CO_COL_PERFIL;
        //dd($CO_COL_PERFIL);
        if(ColaboradorPerfil::where('CO_COL_PERFIL', $CO_COL_PERFIL)->exists()){
            $colaboradorPerfil = colaboradorPerfil::find($CO_COL_PERFIL);
            $colaboradorPerfil->delete();

            return response()->json([
                "messege" =>"colaboradorPerfil deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"colaboradorPerfil nao encontrado"
            ], 404);
        }

    }

}