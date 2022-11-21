<?php

namespace App\Http\Controllers;

use App\Models\Setor;
use Illuminate\Http\Request;

class SetorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listar()
    {
        $call = new Setor();
        $list = $call->listarSetor();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_SETOR = $request->CO_SETOR;
     
        $call = new Setor();
        $list = $call->buscarSetor($CO_SETOR);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_SETOR = $request->CO_SETOR; 
        if (Setor::where('CO_SETOR', $CO_SETOR)->exists()){
            $setor = Setor::find($CO_SETOR);
            $setor->CO_SETOR = is_null($request->CO_SETOR) ? $setor->CO_SETOR : $request->CO_SETOR;
            $setor->NO_SETOR = is_null($request->NO_SETOR) ? $setor->NO_SETOR : $request->NO_SETOR;	
			$setor->CO_EMPRESA = is_null($request->CO_EMPRESA) ? $setor->CO_EMPRESA : $request->CO_EMPRESA;	
			$setor->CO_CONTRATO = is_null($request->CO_CONTRATO) ? $setor->CO_CONTRATO : $request->CO_CONTRATO;	
			$setor->IC_STATUS = is_null($request->IC_STATUS) ? $setor->IC_STATUS : $request->IC_STATUS;	
            $setor->save();

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

        $setor = new Setor;
        $setor->CO_SETOR =  $request->CO_SETOR;
        $setor->NO_SETOR =  $request->NO_SETOR;
		$setor->CO_EMPRESA =  $request->CO_EMPRESA;	
		$setor->CO_CONTRATO =  $request->CO_CONTRATO;	
		$setor->IC_STATUS =  $request->IC_STATUS;	
        $setor->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_SETOR = $request->CO_SETOR;
        //dd($CO_SETOR);
        if(Setor::where('CO_SETOR', $CO_SETOR)->exists()){
            $setor = Setor::find($CO_SETOR);
            $setor->delete();

            return response()->json([
                "messege" =>"setor deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"setor nao encontrado"
            ], 404);
        }

    }



}
