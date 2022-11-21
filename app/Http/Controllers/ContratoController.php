<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller

{
 
    public function listar()
    {
        $call = new Contrato();
        $list = $call->listarContrato();
        return json_encode($list);
    }
    public function buscar(Request $request)
    {
        
        $co_contrato = $request->co_contrato;
     
        $call = new Contrato();
        $list = $call->buscarContrato($co_contrato);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $co_contrato = $request->co_contrato; 
        if (Contrato::where('co_contrato', $co_contrato)->exists()){
            $contrato = Contrato::find($co_contrato);
            $contrato->co_contrato = is_null($request->co_contrato) ? $contrato->co_contrato : $request->co_contrato;
			$contrato->CO_MUNICIPIO = is_null($request->CO_MUNICIPIO) ? $contrato->CO_MUNICIPIO : $request->CO_MUNICIPIO;	
			$contrato->CO_CENTRAL = is_null($request->CO_CENTRAL) ? $contrato->CO_CENTRAL : $request->CO_CENTRAL;
            $contrato->no_contrato = is_null($request->no_contrato) ? $contrato->no_contrato : $request->no_contrato;
            $contrato->nu_contrato = is_null($request->nu_contrato) ? $contrato->nu_contrato : $request->nu_contrato;	
			$contrato->nu_cnpj_contrato = is_null($request->nu_cnpj_contrato) ? $contrato->nu_cnpj_contrato : $request->nu_cnpj_contrato;	
			$contrato->NO_ENDERECO = is_null($request->NO_ENDERECO) ? $contrato->NO_ENDERECO : $request->NO_ENDERECO;	
			$contrato->NO_COMPLEMENTO = is_null($request->NO_COMPLEMENTO) ? $contrato->NO_COMPLEMENTO : $request->NO_COMPLEMENTO;	
			$contrato->ic_status = is_null($request->ic_status) ? $contrato->ic_status : $request->ic_status;	
            $contrato->save();

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
        $contrato = new Contrato;
        $contrato->no_contrato = $request->contrato;
        $contrato->nu_contrato = $request->numContrato;
        $contrato->nu_cnpj_contrato = $request->cnpj;
        $contrato->no_dominio = $request->dominio;
        $contrato->no_empresa = $request->empresa;
        $contrato->ic_status = $request->iniStatus['value'];

        $contrato->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $co_contrato = $request->co_contrato;
        //dd($co_contrato);
        if(Contrato::where('co_contrato', $co_contrato)->exists()){
            $contrato = Contrato::find($co_contrato);
            $contrato->delete();

            return response()->json([
                "messege" =>"contrato deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"contrato nao encontrado"
            ], 404);
        }

    }

}

