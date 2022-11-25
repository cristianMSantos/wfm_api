<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SisfinController extends Controller
{
    public function search($matricula){

        $user = DB::connection('pgsql2')->table('sisfin.tb_funcionario')
            ->select()->where('cdmatrfuncionario', $matricula)->get();

        return json_encode($user);
    }
}
