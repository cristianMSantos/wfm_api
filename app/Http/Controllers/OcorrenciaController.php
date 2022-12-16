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

}
