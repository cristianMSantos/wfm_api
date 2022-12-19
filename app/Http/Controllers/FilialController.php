<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Filial ;

class FilialController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function listar()
    {
        $call = new Filial();
        $list = $call->listarFilial();
        return json_encode($list);
    }
}
