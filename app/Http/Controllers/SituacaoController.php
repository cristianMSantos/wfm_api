<?php

namespace App\Http\Controllers;

use App\Models\Situacao;
use Illuminate\Http\Request;

class SituacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function listar()
    {
        $call = new Situacao();
        $list = $call->listarSituacao();
        return json_encode($list);
    }

    public function listarCP()
    {
        $call = new Situacao();
        $list = $call->listarSituacaoCP();
        return json_encode($list);
    }


}
