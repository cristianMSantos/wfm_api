<?php

namespace App\Http\Controllers;

use App\Models\View_Funcionarios;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function listFuncionarios(Request $request)
    {
        $call = new View_Funcionarios();
        $list = $call->listFuncionarios($request->search);
        return json_encode($list);
    }

}
