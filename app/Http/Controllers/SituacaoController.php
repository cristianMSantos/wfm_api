<?php

namespace App\Http\Controllers;

use App\Models\Situacao;
use Illuminate\Http\Request;

class SituacaoController extends Controller
{
    public function listar()
    {
        $call = new Situacao();
        $list = $call->listarSituacao();
        return json_encode($list);
    }

}
