<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use App\Models\ColaboradorHist;
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

        $matriculaPlansul = $request->matPlansul[0];
    var_dump( $request->dtInicio . ' ' . $request->horaInicio);
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

}
