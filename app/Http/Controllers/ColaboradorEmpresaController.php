<?php

namespace App\Http\Controllers;
use App\Models\ColaboradorEmpresa;
use Illuminate\Http\Request;

class ColaboradorEmpresaController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
       
    }
    
    public function buscar(Request $request)
    {
        
        $ID_COL_EMPRESA = $request->ID_COL_EMPRESA;
      
      
        $call = new ColaboradorEmpresa();
        $list = $call->buscarColaboradorEmpresa($ID_COL_EMPRESA);
        
        return json_encode($list);
    }

    public function listar()
    {
        $call = new ColaboradorEmpresa();
        $list = $call->listarColaboradorEmpresa();
        return json_encode($list);
    }
    public function buscarPorContrato(Request $request)
    {
        
        $CO_CONTRATO = $request->CO_CONTRATO;
        $CO_EMPRESA = $request->CO_EMPRESA;
        $CO_SITUACAO = $request->CO_SITUACAO;
      
        $call = new ColaboradorEmpresa();
        $list = $call->buscarPorcontratoEmp($CO_CONTRATO, $CO_EMPRESA, $CO_SITUACAO);
        
        return json_encode($list);
    }

    public function update(Request $request)
    {
        $ID_COL_EMPRESA = $request->ID_COL_EMPRESA; 
        if (ColaboradorEmpresa::where('ID_COL_EMPRESA', $ID_COL_EMPRESA)->exists()){
            $colaboradorEmpresa = ColaboradorEmpresa::find($ID_COL_EMPRESA);
            $colaboradorEmpresa->ID_COL_EMPRESA = is_null($request->ID) ? $colaboradorEmpresa->ID_COL_EMPRESA : $request->ID_COL_EMPRESA;
            $colaboradorEmpresa->CO_SETOR = is_null($request->CO_SETOR) ? $colaboradorEmpresa->CO_SETOR : $request->CO_SETOR;
            $colaboradorEmpresa->CO_CARGO = is_null($request->CO_CARGO) ? $colaboradorEmpresa->CO_CARGO : $request->CO_CARGO;	
			$colaboradorEmpresa->CO_COLABORADOR = is_null($request->CO_COLABORADOR) ? $colaboradorEmpresa->CO_COLABORADOR : $request->CO_COLABORADOR;
			$colaboradorEmpresa->CO_CONTRATO = is_null($request->CO_CONTRATO) ? $colaboradorEmpresa->CO_CONTRATO : $request->CO_CONTRATO;
			$colaboradorEmpresa->DT_ADMISSAO = is_null($request->DT_ADMISSAO) ? $colaboradorEmpresa->DT_ADMISSAO : $request->DT_ADMISSAO;	
			$colaboradorEmpresa->DT_DEMISSAO = is_null($request->DT_DEMISSAO) ? $colaboradorEmpresa->DT_DEMISSAO : $request->DT_DEMISSAO;						
			$colaboradorEmpresa->CO_SITUACAO = is_null($request->CO_SITUACAO) ? $colaboradorEmpresa->CO_SITUACAO : $request->CO_SITUACAO;
			$colaboradorEmpresa->HR_ENTRADA = is_null($request->HR_ENTRADA) ? $colaboradorEmpresa->HR_ENTRADA : $request->HR_ENTRADA;
			$colaboradorEmpresa->HR_SAIDA = is_null($request->HR_SAIDA) ? $colaboradorEmpresa->HR_SAIDA : $request->HR_SAIDA;
			$colaboradorEmpresa->CO_LOGIN_DAC = is_null($request->CO_LOGIN_DAC) ? $colaboradorEmpresa->CO_LOGIN_DAC : $request->CO_LOGIN_DAC;
			$colaboradorEmpresa->DT_CADASTRO = is_null($request->DT_CADASTRO) ? $colaboradorEmpresa->DT_CADASTRO : $request->DT_CADASTRO;
			$colaboradorEmpresa->CO_COLAB_CADASTRO = is_null($request->CO_COLAB_CADASTRO) ? $colaboradorEmpresa->CO_COLAB_CADASTRO : $request->CO_COLAB_CADASTRO;
			$colaboradorEmpresa->CO_SUPERIOR = is_null($request->CO_SUPERIOR) ? $colaboradorEmpresa->CO_SUPERIOR : $request->CO_SUPERIOR;
            $colaboradorEmpresa->save();

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

        $colaboradorEmpresa = new ColaboradorEmpresa;
        $colaboradorEmpresa->ID_COL_EMPRESA =  $request->ID_COL_EMPRESA;
        $colaboradorEmpresa->CO_SETOR =  $request->CO_SETOR;
		$colaboradorEmpresa->CO_CARGO =  $request->CO_CARGO;	
		$colaboradorEmpresa->CO_COLABORADOR =  $request->CO_COLABORADOR;
		$colaboradorEmpresa->CO_CONTRATO =  $request->CO_CONTRATO;
		$colaboradorEmpresa->DT_ADMISSAO =  $request->DT_ADMISSAO;	
		$colaboradorEmpresa->DT_DEMISSAO =  $request->DT_DEMISSAO;					
		$colaboradorEmpresa->CO_SITUACAO =  $request->CO_SITUACAO;		
		$colaboradorEmpresa->HR_ENTRADA =  $request->HR_ENTRADA;
		$colaboradorEmpresa->HR_SAIDA =  $request->HR_SAIDA;
		$colaboradorEmpresa->CO_LOGIN_DAC =  $request->CO_LOGIN_DAC;
		$colaboradorEmpresa->DT_CADASTRO = $request->DT_CADASTRO;
		$colaboradorEmpresa->CO_COLAB_CADASTRO =  $request->CO_COLAB_CADASTRO;
		$colaboradorEmpresa->CO_SUPERIOR =  $request->CO_SUPERIOR;
        $colaboradorEmpresa->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }
  
    public function delete(Request $request)
    {
        $ID_COL_EMPRESA = $request->ID_COL_EMPRESA;
        //dd($ID_COL_EMPRESA);
        if(ColaboradorEmpresa::where('ID_COL_EMPRESA', $ID_COL_EMPRESA)->exists()){
            $colaboradorEmpresa = ColaboradorEmpresa::find($ID_COL_EMPRESA);
            $colaboradorEmpresa->delete();

            return response()->json([
                "messege" =>"colaboradorEmpresa deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"colaboradorEmpresa nao encontrado"
            ], 404);
        }

    }



}
