<?php

namespace App\Http\Controllers;

use App\Models\Teste;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\View_Colaborador;

class TesteController extends Controller
{


    public function index()
    {
        return response()->json('teste de conexão');
    }

}
