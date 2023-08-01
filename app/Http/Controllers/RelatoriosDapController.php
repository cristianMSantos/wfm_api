<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelatorioDap;

class RelatoriosDapController extends Controller
{
    public function list(Request $request)
    {
        $relatorio = new RelatorioDap;
        $list = $relatorio->getRelatoriosDap($request);
        return json_encode($list);
    }
}
