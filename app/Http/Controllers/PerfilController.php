<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listPerfis()
    {
        $call = new Perfil();
        $list = $call->listPerfis();
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $co_perfil = $request->co_perfil; 
        if (Perfil::where('co_perfil', $co_perfil)->exists()){
            $perfil = Perfil::find($co_perfil);
            $perfil->co_perfil = is_null($request->co_perfil) ? $perfil->co_perfil : $request->co_perfil;
            $perfil->no_perfil = is_null($request->no_perfil) ? $perfil->no_perfil : $request->no_perfil;			
            $perfil->IC_STATUS = is_null($request->IC_STATUS) ? $perfil->IC_STATUS : $request->IC_STATUS;
            $perfil->save();

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

        $perfil = new Perfil;
        $perfil->co_perfil =  $request->co_perfil;
        $perfil->no_perfil =  $request->no_perfil;
        $perfil->IC_STATUS =  $request->IC_STATUS;
        $perfil->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $co_perfil = $request->co_perfil;
        //dd($co_perfil);
        if(Perfil::where('co_perfil', $co_perfil)->exists()){
            $perfil = perfil::find($co_perfil);
            $perfil->delete();

            return response()->json([
                "messege" =>"perfil deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"perfil nao encontrado"
            ], 404);
        }

    }


}
