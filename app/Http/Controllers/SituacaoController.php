<?php

namespace App\Http\Controllers;

use App\Models\Situacao;
use Illuminate\Http\Request;

class SituacaoController extends Controller
{
    public function listar()
    {
        $call = new Situacao();
        $list = $call->listarSituacao();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $co_situacao = $request->co_situacao;
     
        $call = new Situacao();
        $list = $call->buscar($co_situacao);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $co_situacao = $request->co_situacao; 
        if (Situacao::where('co_situacao', $co_situacao)->exists()){
            $situacao = Situacao::find($co_situacao);
            $situacao->co_situacao = is_null($request->co_situacao) ? $situacao->co_situacao : $request->co_situacao;
            $situacao->no_situacao = is_null($request->no_situacao) ? $situacao->no_situacao : $request->no_situacao;	
			$situacao->ic_status = is_null($request->ic_status) ? $situacao->ic_status : $request->ic_status;	
            $situacao->save();

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

        $situacao = new Situacao;
        $situacao->co_situacao =  $request->co_situacao;
        $situacao->no_situacao =  $request->no_situacao;
		$situacao->ic_status =  $request->ic_status;	
        $situacao->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $co_situacao = $request->co_situacao;
        //dd($co_situacao);
        if(Situacao::where('co_situacao', $co_situacao)->exists()){
            $situacao = Situacao::find($co_situacao);
            $situacao->delete();

            return response()->json([
                "messege" =>"situacao deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"situacao nao encontrado"
            ], 404);
        }

    }

}
