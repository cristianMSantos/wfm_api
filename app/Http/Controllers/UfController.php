<?php

namespace App\Http\Controllers;

use App\Models\Uf;
use Illuminate\Http\Request;

class UfController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }
    
    public function listar()
    {
        $call = new Uf();
        $list = $call->listarUf();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $co_uf = $request->co_uf;
     
        $call = new Uf();
        $list = $call->buscarUf($co_uf);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $co_uf = $request->co_uf; 
        if (Uf::where('co_uf', $co_uf)->exists()){
            $uf = Uf::find($co_uf);
            $uf->co_uf = is_null($request->co_uf) ? $uf->co_uf : $request->co_uf;
            $uf->no_uf = is_null($request->no_uf) ? $uf->no_uf : $request->no_uf;	
			$uf->de_uf = is_null($request->de_uf) ? $uf->de_uf : $request->de_uf;	
            $uf->save();

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

        $uf = new Uf;
        $uf->co_uf =  $request->co_uf;
        $uf->no_uf =  $request->no_uf;
		$uf->de_uf =  $request->de_uf;	
        $uf->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $co_uf = $request->co_uf;
        //dd($co_uf);
        if(Uf::where('co_uf', $co_uf)->exists()){
            $uf = Uf::find($co_uf);
            $uf->delete();

            return response()->json([
                "messege" =>"uf deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"uf nao encontrado"
            ], 404);
        }

    }
}
