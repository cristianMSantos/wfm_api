<?php

namespace App\Http\Controllers;

use App\Models\Cargo ;
use Illuminate\Http\Request;


class CargoController extends Controller
{

    public function listar()
    {
        $call = new Cargo();
        $list = $call->listarCargo();
        return json_encode($list);
    }

    public function buscar(Request $request)
    {
        $co_cargo_funcao = $request->co_cargo_funcao;
       
       
      
        $call = new Cargo();
        $list = $call->buscarCargo($co_cargo_funcao);
        return json_encode($list);
    }
    public function update(Request $request)
    {
        $co_cargo_funcao = $request->co_cargo_funcao; 
        if (Cargo::where('co_cargo_funcao', $co_cargo_funcao)->exists()){
            $cargo = Cargo::find($co_cargo_funcao);
            $cargo->co_cargo_funcao = is_null($request->co_cargo_funcao) ? $cargo->co_cargo_funcao : $request->co_cargo_funcao;
            $cargo->no_cargo_funcao = is_null($request->no_cargo_funcao) ? $cargo->no_cargo_funcao : $request->no_cargo_funcao;
            $cargo->co_contrato = is_null($request->co_contrato) ? $cargo->co_contrato : $request->co_contrato;
            $cargo->ic_status = is_null($request->ic_status) ? $cargo->ic_status : $request->ic_status;
            $cargo->save();

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
        $no_cargo_funcao = $request->cargo;
        $co_contrato = $request->contrato['value'];
        $verifyCargos = Cargo::where('no_cargo_funcao', $no_cargo_funcao)->where('co_contrato', $co_contrato)->exists();
        if($verifyCargos) {
            return response()->json([
                "massege" => "Cargo já cadastrado!"
            ], 409);
        } else {
            foreach ($no_cargo_funcao as $no_cargo) {
                $cargo = new Cargo;
                $cargo->no_cargo_funcao = $no_cargo;  
                $cargo->co_contrato =  $co_contrato;
                $cargo->ic_status = 1;
                $cargo->save();
            }             
        }
        return response()->json([
            "massege" => "Cadastrado com Sucesso!"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $co_cargo_funcao = $request->co_cargo_funcao;
        //dd($co_cargo_funcao);
        if(Cargo::where('co_cargo_funcao', $co_cargo_funcao)->exists()){
            $cargo = Cargo::find($co_cargo_funcao);
            $cargo->delete();

            return response()->json([
                "messege" =>"cargofuncao deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"cargofuncao nao encontrado"
            ], 404);
        }

    }

 
}
