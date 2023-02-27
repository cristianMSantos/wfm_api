<?php

namespace App\Http\Controllers;

use App\Models\Desligamento;
use App\Models\TpDesligamento;
use App\Models\LocalHom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DesligamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function tpDeslig()
    {
        $call = new TpDesligamento();
        $list = $call->listartpDeslig();
        return json_encode($list);
    }

    public function locaisHom()
    {
        $call = new LocalHom();
        $list = $call->listarLocaisHom();
        return json_encode($list);
    }

    public function buscarColab(Request $request)
    {
        $call = new Desligamento();
        $list = $call->buscarColab($request->matriculaP);
        return json_encode($list);
    }

    public function create(Request $request){

        date_default_timezone_set('america/sao_paulo');

        if(!Desligamento::whereIn('mat_empregado', $request->matriculaP)->exists()){
            $desligamento = new Desligamento;
            $desligamento->mat_empregado = $request->matriculaP[0];
            $desligamento->id_tipo_desligamento = $request->iniTpDeslg['value'];
            $desligamento->dt_desligamento = $request->dtDeslig;
            $desligamento->ic_cracha = $request->iniCracha['value'];
            $desligamento->ic_headset = $request->iniHeadSet['value'];
            $desligamento->dt_homologacao = $request->dtHom;
            $desligamento->id_local_homologacao = $request->iniLocalHom['value'];
            $desligamento->mat_registro = $request->matricula_alteracao;
            $desligamento->dt_registro = date('Y-m-d H:i', time());
            $desligamento->justificativa = $request->justificativa;
            $desligamento->ic_certificado_digital = isset($request->iniCertDigital['value']) ? $request->iniCertDigital['value'] : null;
            $desligamento->ic_ativo = 1;
            $desligamento->save();
    
            return response()->json([
                "massege" => "created successfully"
            ], 200);
        }
    }

    public function update(Request $request){
        date_default_timezone_set('america/sao_paulo');
        if(Desligamento::whereIn('mat_empregado', $request->matriculaP)->exists()){
            $desligamento = Desligamento::whereIn('mat_empregado', $request->matriculaP)
                ->update([
                    'dt_desligamento' => $request->dtDeslig,
                    'id_tipo_desligamento' => $request->iniTpDeslg['value'],
                    'ic_cracha' => $request->iniCracha['value'],
                    'ic_headset' => $request->iniHeadSet['value'],
                    'dt_homologacao' => $request->dtHom,
                    'id_local_homologacao' => $request->iniLocalHom['value'],
                    'justificativa' => $request->justificativa,
                    'mat_alteracao' => $request->matricula_alteracao,
                    'ic_certificado_digital' => $request->iniCertDigital['value'],
                    'dt_alteracao' => date('Y-m-d H:i', time())
                ]);

                return response()->json([
                    "massege" => "update successfully"
                ], 200);
                
        }else{
            return response()->json([
                "message" => "Colaborador not found"
            ], 404);
        }
    }
}
