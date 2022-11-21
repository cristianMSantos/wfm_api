<?php

namespace App\Http\Controllers;

use App\Models\Teste;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TesteController extends Controller
{


    public function buscar(Request $request)
    {

        $cpf = $request->cpf;


        $call = new Teste();
        $list = $call->buscarEmpregado($cpf);
        //dd($cpf);
        return response()->json($list)->header('Access-Control-Allow-Origin', '*');
    }

    public function listar(Request $request)
    {
        $call = new Teste();
        $list = $call->listarTeste();
        return response()->json($list)->header('Access-Control-Allow-Origin', '*');
    }

    public function update(Request $request)
    {
        $CO_COLABORADOR = $request->CO_COLABORADOR;
        // dd($CO_COLABORADOR);
        if (Teste::where('CO_COLABORADOR', $CO_COLABORADOR)->exists()) {
            $colaborador = Teste::find($CO_COLABORADOR);
            $colaborador->CO_MUNICIPIO = is_null($request->CO_MUNICIPIO) ? $colaborador->CO_MUNICIPIO : $request->CO_MUNICIPIO;
            $colaborador->CO_CPF = is_null($request->CO_CPF) ? $colaborador->CO_CPF : $request->CO_CPF;
            $colaborador->NO_COLABORADOR = is_null($request->NO_COLABORADOR) ? $colaborador->NO_COLABORADOR : $request->NO_COLABORADOR;
            $colaborador->IC_SEXO = is_null($request->IC_SEXO) ? $colaborador->IC_SEXO : $request->IC_SEXO;
            $colaborador->CO_CEP = is_null($request->CO_CEP) ? $colaborador->CO_CEP : $request->CO_CEP;
            $colaborador->NO_ENDERECO = is_null($request->NO_ENDERECO) ? $colaborador->NO_ENDERECO : $request->NO_ENDERECO;
            $colaborador->NO_COMPLEMENTO_ENDERECO = is_null($request->NO_COMPLEMENTO_ENDERECO) ? $colaborador->NO_COMPLEMENTO_ENDERECO : $request->NO_COMPLEMENTO_ENDERECO;
            $colaborador->NO_BAIRRO = is_null($request->NO_BAIRRO) ? $colaborador->NO_BAIRRO : $request->NO_BAIRRO;
            $colaborador->NU_RG = is_null($request->NU_RG) ? $colaborador->NU_RG : $request->NU_RG;
            $colaborador->CO_UF_RG = is_null($request->CO_UF_RG) ? $colaborador->CO_UF_RG : $request->CO_UF_RG;
            $colaborador->DE_RG_EMISSOR = is_null($request->DE_RG_EMISSOR) ? $colaborador->DE_RG_EMISSOR : $request->DE_RG_EMISSOR;
            $colaborador->NO_EMAIL = is_null($request->NO_EMAIL) ? $colaborador->NO_EMAIL : $request->NO_EMAIL;
            $colaborador->DT_NASCIMENTO = is_null($request->DT_NASCIMENTO) ? $colaborador->DT_NASCIMENTO : $request->DT_NASCIMENTO;
            $colaborador->DT_CADASTRO = is_null($request->DT_CADASTRO) ? $colaborador->DT_CADASTRO : $request->DT_CADASTRO;
            $colaborador->save();

            return response()->json([
                "massege" => "update successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "not found"
            ], 404);
        }
    }
    public function create(Request $request)
    {

        //  dd($request);
        $colaborador = new Teste();
        $colaborador->CO_MUNICIPIO =  $request->CO_MUNICIPIO;
        $colaborador->CO_CPF =  $request->CO_CPF;
        $colaborador->NO_COLABORADOR =  $request->NO_COLABORADOR;
        $colaborador->IC_SEXO =  $request->IC_SEXO;
        $colaborador->CO_CEP =  $request->CO_CEP;
        $colaborador->NO_ENDERECO =  $request->NO_ENDERECO;
        $colaborador->NO_COMPLEMENTO_ENDERECO =  $request->NO_COMPLEMENTO_ENDERECO;
        $colaborador->NO_BAIRRO =  $request->NO_BAIRRO;
        $colaborador->NU_RG = $request->NU_RG;
        $colaborador->CO_UF_RG =  $request->CO_UF_RG;
        $colaborador->DE_RG_EMISSOR =  $request->DE_RG_EMISSOR;
        $colaborador->NO_EMAIL =  $request->NO_EMAIL;
        $colaborador->DT_NASCIMENTO =  $request->DT_NASCIMENTO;
        $colaborador->DT_CADASTRO =  $request->DT_CADASTRO;
        $colaborador->save();

        return response()->json([
            "massege" => "created successfully"

        ], 200);
    }

    public function delete(Request $request)
    {
        $CO_COLABORADOR = $request->CO_COLABORADOR;
        //dd($CO_COLABORADOR);
        if (Teste::where('CO_COLABORADOR', $CO_COLABORADOR)->exists()) {
            $colaborador = Teste::find($CO_COLABORADOR);
            $colaborador->delete();

            return response()->json([
                "messege" => "colaborador deletado"
            ], 202);
        } else {
            return response()->json([
                "messege" => "colaborador nao encontrado"
            ], 404);
        }
    }
}
