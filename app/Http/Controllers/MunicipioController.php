<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function listar()
    {
        $call = new Municipio();
        $list = $call->listarMunicipio();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_MUNICIPIO = $request->CO_MUNICIPIO;
     
        $call = new Municipio();
        $list = $call->buscarMunicipio($CO_MUNICIPIO);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_MUNICIPIO = $request->CO_MUNICIPIO; 
        if (Municipio::where('CO_MUNICIPIO', $CO_MUNICIPIO)->exists()){
            $municipio = Municipio::find($CO_MUNICIPIO);
            $municipio->CO_MUNICIPIO = is_null($request->CO_MUNICIPIO) ? $municipio->CO_MUNICIPIO : $request->CO_MUNICIPIO;
            $municipio->NO_MUNICIPIO = is_null($request->NO_MUNICIPIO) ? $municipio->NO_MUNICIPIO : $request->NO_MUNICIPIO;	
			$municipio->CO_UF = is_null($request->CO_UF) ? $municipio->CO_UF : $request->CO_UF;	
            $municipio->save();

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

        $municipio = new Municipio;
        $municipio->CO_MUNICIPIO =  $request->CO_MUNICIPIO;
        $municipio->NO_MUNICIPIO =  $request->NO_MUNICIPIO;
		$municipio->CO_UF =  $request->CO_UF;	
        $municipio->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_MUNICIPIO = $request->CO_MUNICIPIO;
        //dd($CO_MUNICIPIO);
        if(Municipio::where('CO_MUNICIPIO', $CO_MUNICIPIO)->exists()){
            $municipio = Municipio::find($CO_MUNICIPIO);
            $municipio->delete();

            return response()->json([
                "messege" =>"municipio deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"municipio nao encontrado"
            ], 404);
        }

    }
}
