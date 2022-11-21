<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ColaboradorMatricula;
class ColaboradorMatriculaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listar(Request $request)
    {
        $call = new ColaboradorMatricula();
        $list = $call->listarColaboradorMatricula();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_REGISTRO = $request->CO_REGISTRO;
     
        $call = new ColaboradorMatricula();
        $list = $call->buscarColaboradorMatricula($CO_REGISTRO);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_REGISTRO = $request->CO_REGISTRO; 
        if (ColaboradorMatricula::where('CO_REGISTRO', $CO_REGISTRO)->exists()){
            $ColaboradorMatricula = ColaboradorMatricula::find($CO_REGISTRO);
            $ColaboradorMatricula->CO_REGISTRO = is_null($request->CO_REGISTRO) ? $ColaboradorMatricula->CO_REGISTRO : $request->CO_REGISTRO;
            $ColaboradorMatricula->CO_COL_EMP = is_null($request->CO_COL_EMP) ? $ColaboradorMatricula->CO_COL_EMP : $request->CO_COL_EMP;
            $ColaboradorMatricula->CO_MATRICULA = is_null($request->CO_MATRICULA) ? $ColaboradorMatricula->CO_MATRICULA : $request->CO_MATRICULA;	
			$ColaboradorMatricula->DT_INICIO = is_null($request->DT_INICIO) ? $ColaboradorMatricula->DT_INICIO : $request->DT_INICIO;	
			$ColaboradorMatricula->DT_FIM = is_null($request->DT_FIM) ? $ColaboradorMatricula->DT_FIM : $request->DT_FIM;	
			$ColaboradorMatricula->MOTIVO = is_null($request->MOTIVO) ? $ColaboradorMatricula->MOTIVO : $request->MOTIVO;	
			$ColaboradorMatricula->DT_CADASTRO = is_null($request->DT_CADASTRO) ? $ColaboradorMatricula->DT_CADASTRO : $request->DT_CADASTRO;	
            $ColaboradorMatricula->save();

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

        $ColaboradorMatricula = new ColaboradorMatricula;
        $ColaboradorMatricula->CO_REGISTRO =  $request->CO_REGISTRO;
        $ColaboradorMatricula->CO_COL_EMP =  $request->CO_COL_EMP;
		$ColaboradorMatricula->CO_MATRICULA =  $request->CO_MATRICULA;	
		$ColaboradorMatricula->DT_INICIO =  $request->DT_INICIO;	
		$ColaboradorMatricula->DT_FIM =  $request->DT_FIM;	
		$ColaboradorMatricula->MOTIVO =  $request->MOTIVO;	
		$ColaboradorMatricula->DT_CADASTRO =  $request->DT_CADASTRO;	
        $ColaboradorMatricula->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_REGISTRO = $request->CO_REGISTRO;
        //dd($CO_REGISTRO);
        if(ColaboradorMatricula::where('CO_REGISTRO', $CO_REGISTRO)->exists()){
            $ColaboradorMatricula = ColaboradorMatricula::find($CO_REGISTRO);
            $ColaboradorMatricula->delete();

            return response()->json([
                "messege" =>"ColaboradorMatricula deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"ColaboradorMatricula nao encontrado"
            ], 404);
        }

    }



}
