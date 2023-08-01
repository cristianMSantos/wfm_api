<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RelatorioDap extends Model
{
    public $connection = 'sqlsrv';

    public function getRelatoriosDap($date)
    {
        $month = (int)$date[0]['month'];
        $year = (int)$date[0]['year'];
        return DB::connection('sqlsrv')->select(
            "SET NOCOUNT ON EXEC dbo.PS_Consulta_Ocorrencias_1 ?, ?",
            [$month, $year]);
    }
}

