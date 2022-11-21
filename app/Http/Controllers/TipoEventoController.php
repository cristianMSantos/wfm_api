<?php

namespace App\Http\Controllers;

use App\Models\TipoEvento;
use Illuminate\Http\Request;

class TipoEventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listar()
    {
        $call = new TipoEvento();
        $list = $call->listarTipoEvento();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_TIPO_EVENTO = $request->CO_TIPO_EVENTO;
     
        $call = new TipoEvento();
        $list = $call->buscarTipoEvento($CO_TIPO_EVENTO);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_TIPO_EVENTO = $request->CO_TIPO_EVENTO; 
        if (TipoEvento::where('CO_TIPO_EVENTO', $CO_TIPO_EVENTO)->exists()){
            $tipoEvento = TipoEvento::find($CO_TIPO_EVENTO);
            $tipoEvento->CO_TIPO_EVENTO = is_null($request->CO_TIPO_EVENTO) ? $tipoEvento->CO_TIPO_EVENTO : $request->CO_TIPO_EVENTO;
            $tipoEvento->NO_TIPO_EVENTO = is_null($request->NO_TIPO_EVENTO) ? $tipoEvento->NO_TIPO_EVENTO : $request->NO_TIPO_EVENTO;	
			$tipoEvento->IC_STATUS = is_null($request->IC_STATUS) ? $tipoEvento->IC_STATUS : $request->IC_STATUS;	
            $tipoEvento->save();

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

        $tipoEvento = new TipoEvento;
        $tipoEvento->CO_TIPO_EVENTO =  $request->CO_TIPO_EVENTO;
        $tipoEvento->NO_TIPO_EVENTO =  $request->NO_TIPO_EVENTO;
		$tipoEvento->IC_STATUS =  $request->IC_STATUS;	
        $tipoEvento->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_TIPO_EVENTO = $request->CO_TIPO_EVENTO;
        //dd($CO_TIPO_EVENTO);
        if(TipoEvento::where('CO_TIPO_EVENTO', $CO_TIPO_EVENTO)->exists()){
            $tipoEvento = TipoEvento::find($CO_TIPO_EVENTO);
            $tipoEvento->delete();

            return response()->json([
                "messege" =>"tipoEvento deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"tipoEvento nao encontrado"
            ], 404);
        }

    }
}
