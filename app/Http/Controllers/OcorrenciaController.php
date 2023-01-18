<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OcorrenciaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function listar()
    {
        $call = new Ocorrencia();
        $list = $call->listarOcorrencia();
        return json_encode($list);
    }

    public function create(Request $request)
    {

        date_default_timezone_set('america/sao_paulo');

        $matriculaPlansul = $request->matPlansul;
        $Ocorrencia = new Ocorrencia;
        $Ocorrencia->dh_inicio_ocorrencia = $request->dtInicio . ' ' . $request->horaInicio;
        $Ocorrencia->dh_fim_ocorrencia  = $request->dtFim . ' ' . $request->horaFim;
        $Ocorrencia->mat_empregado  = $matriculaPlansul;
        $Ocorrencia->id_tipo_ocorrencia = $request->SitOcor["value"];
        $Ocorrencia->de_ocorrencia = $request->SitOcor["state"];
        $Ocorrencia->mat_registro = $request->matPlansulREg;
        $Ocorrencia->dt_registro  = date('Y-m-d H:i', time());
        $Ocorrencia->ic_ativo = 1;
        $Ocorrencia->observacao = $request->observacao;
        $Ocorrencia->save();

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('america/sao_paulo');
        $id_ocorrencia = $request->ocorrencia;
        var_dump($id_ocorrencia);

        if (Ocorrencia::where('id_ocorrencia', $id_ocorrencia)->exists()){

            $ocorrencia = Ocorrencia::where('id_ocorrencia', $id_ocorrencia)->update([
                'dh_inicio_ocorrencia' => $request->dtInicio . ' ' . $request->horaInicio,
                'dh_fim_ocorrencia'  => $request->dtFim . ' ' . $request->horaFim,
                'id_tipo_ocorrencia' => $request->SitOcor["value"],
                'de_ocorrencia' => $request->SitOcor["state"],
                'observacao' => $request->observacao,
                'mat_alteracao' => $request->matPlansulREg,
                'dt_alteracao' =>  date('Y-m-d H:i', time()),
            ]);
        }else{
            return response()->json([
                "message" => "Ocorrencia nao encontrada"
            ], 404);
        }
        return response()->json([
            "massege" => "update successfully"
        ], 200);
    }

    public function delete(Request $request)
    {

        $id_ocorrencia = $request->ocorrencia;
        if(Ocorrencia::where('id_ocorrencia', $id_ocorrencia)->exists()){
            $delete = Ocorrencia::find($id_ocorrencia);
           // $delete->delete();

           $delete = Ocorrencia::where('id_ocorrencia', $id_ocorrencia)->update([
                'ic_ativo' => 0,
                'observacao' => $request->justificativa,
                'mat_alteracao' => $request->matPlansulREg,
                'dt_alteracao' =>  date('Y-m-d H:i', time()),
            ]);

            return response()->json([
                "messege" =>"Ocorrencia deletada"
            ], 202);
        }else{
            return response()->json([
                "messege" =>"Ocorrencia nao encontrada"
            ], 404);
        }

    }

}
