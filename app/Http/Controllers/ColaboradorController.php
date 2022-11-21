<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColaboradorController extends Controller
{

  
    public function buscar(Request $request)
    {
        
        $cpf = $request->cpf;
    
        
        $call = new Colaborador();
        $list = $call->buscarEmpregado($cpf);
       //dd($cpf);
        return json_encode($list);
       
    }

    public function listar(Request $request)
    {
        $call = new Colaborador();
        $list = $call->listarColaborador();
        return json_encode($list);
    }
    
    public function update(Request $request)
    {
        $co_colaborador = $request->co_colaborador;
       // dd($co_colaborador);
        if (Colaborador::where('co_colaborador', $co_colaborador)->exists()){
            $colaborador = Colaborador::find($co_colaborador);
            $colaborador->CO_MUNICIPIO = is_null($request->CO_MUNICIPIO) ? $colaborador->CO_MUNICIPIO : $request->CO_MUNICIPIO;
            $colaborador->co_cpf = is_null($request->co_cpf) ? $colaborador->co_cpf : $request->co_cpf;
            $colaborador->no_colaborador = is_null($request->no_colaborador) ? $colaborador->no_colaborador : $request->no_colaborador;
            $colaborador->ic_sexo = is_null($request->ic_sexo) ? $colaborador->ic_sexo : $request->ic_sexo;
            $colaborador->CO_CEP = is_null($request->CO_CEP) ? $colaborador->CO_CEP : $request->CO_CEP;
            $colaborador->NO_ENDERECO = is_null($request->NO_ENDERECO) ? $colaborador->NO_ENDERECO : $request->NO_ENDERECO;
            $colaborador->NO_COMPLEMENTO_ENDERECO = is_null($request->NO_COMPLEMENTO_ENDERECO) ? $colaborador->NO_COMPLEMENTO_ENDERECO : $request->NO_COMPLEMENTO_ENDERECO;
            $colaborador->NO_BAIRRO = is_null($request->NO_BAIRRO) ? $colaborador->NO_BAIRRO : $request->NO_BAIRRO;
            $colaborador->nu_rg = is_null($request->nu_rg) ? $colaborador->nu_rg : $request->nu_rg;
            $colaborador->CO_UF_RG = is_null($request->CO_UF_RG) ? $colaborador->CO_UF_RG : $request->CO_UF_RG;
            $colaborador->DE_RG_EMISSOR = is_null($request->DE_RG_EMISSOR) ? $colaborador->DE_RG_EMISSOR : $request->DE_RG_EMISSOR;
            $colaborador->NO_EMAIL = is_null($request->NO_EMAIL) ? $colaborador->NO_EMAIL : $request->NO_EMAIL;
			$colaborador->dt_nascimento = is_null($request->dt_nascimento) ? $colaborador->dt_nascimento : $request->dt_nascimento;
			$colaborador->DT_CADASTRO = is_null($request->DT_CADASTRO) ? $colaborador->DT_CADASTRO : $request->DT_CADASTRO;			
            $colaborador->save();

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

        date_default_timezone_set('america/sao_paulo');

        $contrato = new Colaborador;
		$contrato->mat_colaborador = $request->matCaixa;	
		$contrato->co_cpf = $request->cpf;
        $contrato->no_colaborador = $request->nomeCompleto;
		$contrato->no_social = $request->nomeSocial;	
		$contrato->ic_sexo = $request->sexo['value']; //rever
		$contrato->dt_nascimento = $request->dtNasc;	
		$contrato->DT_CADASTRO = date('Y-m-d H:i:s', time());
		$contrato->nu_rg = $request->rg;
        $contrato->org_expedidor = $request->orgExpedidor;
        $contrato->co_cargo_funcao = $request->cargo['value']; //rever	
        $contrato->dt_admissao = $request->dtAdm;
        $contrato->co_contrato = $request->contrato['value']; //rever	
        $contrato->co_situacao = $request->situacao['value']; //rever
        foreach($request->ufExpedidor as $uf) {
            $contrato->uf_expedidor = $uf;
        }
        $contrato->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }

    public function delete(Request $request)
    {
        $co_colaborador = $request->co_colaborador;
        //dd($co_colaborador);
        if(Colaborador::where('co_colaborador', $co_colaborador)->exists()){
            $colaborador = Colaborador::find($co_colaborador);
            $colaborador->delete();

            return response()->json([
                "messege" =>"colaborador deletado"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"colaborador nao encontrado"
            ], 404);
        }

    }
  
}
