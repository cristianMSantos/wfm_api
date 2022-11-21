<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function listar(Request $request)
    {
        $call = new Evento();
        $list = $call->listarEvento();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_EVENTO = $request->CO_EVENTO;
     
        $call = new Evento();
        $list = $call->buscarEvento($CO_EVENTO);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_EVENTO = $request->CO_EVENTO; 
        if (Evento::where('CO_EVENTO', $CO_EVENTO)->exists()){
            $evento = Evento::find($CO_EVENTO);
            $evento->CO_EVENTO = is_null($request->CO_EVENTO) ? $evento->CO_EVENTO : $request->CO_EVENTO;
            $evento->CO_COL_EMP = is_null($request->CO_COL_EMP) ? $evento->CO_COL_EMP : $request->CO_COL_EMP;	
			$evento->DT_INICIO = is_null($request->DT_INICIO) ? $evento->DT_INICIO : $request->DT_INICIO;	
			$evento->DT_FIM = is_null($request->DT_FIM) ? $evento->DT_FIM : $request->DT_FIM;	
			$evento->CO_TIPO_EVENTO = is_null($request->CO_TIPO_EVENTO) ? $evento->CO_TIPO_EVENTO : $request->CO_TIPO_EVENTO;	
			$evento->NO_OBSERVACAO = is_null($request->NO_OBSERVACAO) ? $evento->NO_OBSERVACAO : $request->NO_OBSERVACAO;	
			$evento->CO_CID = is_null($request->CO_CID) ? $evento->CO_CID : $request->CO_CID;	
			$evento->CO_CRM = is_null($request->CO_CRM) ? $evento->CO_CRM : $request->CO_CRM;
			$evento->CO_CRIADOR = is_null($request->CO_CRIADOR) ? $evento->CO_CRIADOR : $request->CO_CRIADOR;
			$evento->DT_CRIACAO = is_null($request->DT_CRIACAO) ? $evento->DT_CRIACAO : $request->DT_CRIACAO;
			$evento->CO_EDITOR = is_null($request->CO_EDITOR) ? $evento->CO_EDITOR : $request->CO_EDITOR;
			$evento->DT_EDICAO = is_null($request->DT_EDICAO) ? $evento->DT_EDICAO : $request->DT_EDICAO;
            $evento->save();

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

        $evento = new Evento;
        $evento->CO_EVENTO =  $request->CO_EVENTO;
        $evento->CO_COL_EMP =  $request->CO_COL_EMP;
		$evento->DT_INICIO =  $request->DT_INICIO;	
		$evento->DT_FIM =  $request->DT_FIM;	
		$evento->CO_TIPO_EVENTO =  $request->CO_TIPO_EVENTO;	
		$evento->NO_OBSERVACAO =  $request->NO_OBSERVACAO;	
		$evento->CO_CID =  $request->CO_CID;	
		$evento->CO_CRM =  $request->CO_CRM;
		$evento->CO_CRIADOR =  $request->CO_CRIADOR;
		$evento->DT_CRIACAO =  $request->DT_CRIACAO;
		$evento->CO_EDITOR =  $request->CO_EDITOR;
		$evento->DT_EDICAO =  $request->DT_EDICAO;
        $evento->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_EVENTO = $request->CO_EVENTO;
        //dd($CO_EVENTO);
        if(Evento::where('CO_EVENTO', $CO_EVENTO)->exists()){
            $evento = Evento::find($CO_EVENTO);
            $evento->delete();

            return response()->json([
                "messege" =>"evento deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"evento nao encontrado"
            ], 404);
        }

    }
}
