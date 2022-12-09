<?php

namespace App\Http\Controllers;

use App\Models\Funcao ;
use Illuminate\Http\Request;


class FuncaoController extends Controller
{

    public function listar()
    {
        $call = new Funcao();
        $list = $call->listarFuncao();
        return json_encode($list);
    }

}