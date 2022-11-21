<?php

namespace App\Http\Controllers;

use App\Models\Cid;
use Illuminate\Http\Request;

class CidController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listar(Request $request)
    {
        $call = new Cid();
        $list = $call->listarCid();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $CO_CID = $request->CO_CID;
       
        $call = new Cid();
        $list = $call->buscarCid($CO_CID);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $CO_CID = $request->CO_CID; 
        if (Cid::where('CO_CID', $CO_CID)->exists()){
            $cid = Cid::find($CO_CID);
            $cid->CO_CID = is_null($request->CO_CID) ? $cid->CO_CID : $request->CO_CID;
            $cid->NO_CID = is_null($request->NO_CID) ? $cid->NO_CID : $request->NO_CID;			
            $cid->IC_STATUS = is_null($request->IC_STATUS) ? $cid->IC_STATUS : $request->IC_STATUS;
            $cid->save();

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

        $cid = new Cid;
        $cid->CO_CID =  $request->CO_CID;
        $cid->NO_CID =  $request->NO_CID;
        $cid->IC_STATUS =  $request->IC_STATUS;
        $cid->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $CO_CID = $request->CO_CID;
        //dd($CO_CID);
        if(Cid::where('CO_CID', $CO_CID)->exists()){
            $cid = cid::find($CO_CID);
            $cid->delete();

            return response()->json([
                "messege" =>"cid deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"cid nao encontrado"
            ], 404);
        }

    }


}
