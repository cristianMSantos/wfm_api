<?php

namespace App\Http\Controllers;

use App\Models\Centralizadora;
use Illuminate\Http\Request;

class CentralizadoraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listar()
    {
        $call = new Centralizadora();
        $list = $call->listarCentralizadora();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        $CO_CENTRAL = $request->CO_CENTRAL;
     
        $call = new Centralizadora();
        $list = $call->buscarCentralizadora($CO_CENTRAL);
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_CENTRAL = $request->CO_CENTRAL; 
        if (Centralizadora::where('CO_CENTRAL', $CO_CENTRAL)->exists()){
            $centralizadora = Centralizadora::find($CO_CENTRAL);
            $centralizadora->CO_CENTRAL = is_null($request->CO_CENTRAL) ? $centralizadora->CO_CENTRAL : $request->CO_CENTRAL;
            $centralizadora->NO_CENTRAL = is_null($request->NO_CENTRAL) ? $centralizadora->NO_CENTRAL : $request->NO_CENTRAL;
			$centralizadora->NU_CGC = is_null($request->NU_CGC) ? $centralizadora->NU_CGC : $request->NU_CGC;
            $centralizadora->IC_STATUS = is_null($request->IC_STATUS) ? $centralizadora->IC_STATUS : $request->IC_STATUS;
            $centralizadora->save();

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

        $centralizadora = new Centralizadora;
        $centralizadora->CO_CENTRAL =  $request->CO_CENTRAL;
        $centralizadora->NO_CENTRAL =  $request->NO_CENTRAL;
		$centralizadora->NU_CGC =  $request->NU_CGC;
        $centralizadora->IC_STATUS =  $request->IC_STATUS;
        $centralizadora->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_CENTRAL = $request->CO_CENTRAL;
        //dd($CO_CENTRAL);
        if(Centralizadora::where('CO_CENTRAL', $CO_CENTRAL)->exists()){
            $centralizadora = Centralizadora::find($CO_CENTRAL);
            $centralizadora->delete();

            return response()->json([
                "messege" =>"central deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"central nao encontrado"
            ], 404);
        }

    }

}
