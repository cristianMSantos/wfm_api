<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Acessos extends Model
{
 
    public $timestamps = false;
    protected $table = 'gente.Acessos';
    protected $primaryKey = 'CO_Acesso';

    public function listarAcessos(){
        return Acessos::from('gente.Acessos as ac')->select(
                                'col.no_colaborador'
                                ,'ac.mat_colaborador'
                                ,'ac.co_perfil'
                                ,'pf.no_perfil'
                                ,DB::raw("SUBSTRING(
                                    (
                                        SELECT ','+cast(CONC_CONT.[co_contrato] as varchar)  AS [text()]
                                        FROM [gente].[Acessos] CONC_CONT
                                        WHERE CONC_CONT.[mat_colaborador] = [ac].[mat_colaborador]
                                        ORDER BY CONC_CONT.[mat_colaborador]
                                        FOR XML PATH (''), TYPE
                                    ).value('text()[1]','nvarchar(max)'), 2, 1000) [co_contrato]")
                                ,DB::raw("SUBSTRING(
                                    (
                                        SELECT ','+cast([co].[no_empresa] as varchar)  AS [text()]
                                        FROM [gente].[Acessos] CONC_CONT
                                        left join [gente].[Contrato] as [co] on CONC_CONT.[co_contrato] = [co].[co_contrato]
                                        WHERE CONC_CONT.[mat_colaborador] = [ac].[mat_colaborador]
                                        ORDER BY CONC_CONT.[mat_colaborador]
                                        FOR XML PATH (''), TYPE
                                    ).value('text()[1]','nvarchar(max)'), 2, 1000) AS [no_empresa]")
                                ,'ac.dt_cadastro'
                                ,'dt_criado_por'
                                ,'dt_atualizacao')
                                ->join('gente.Colaborador as col', 'ac.mat_colaborador', '=', 'col.mat_colaborador')
                                ->join('gente.Perfil as pf', 'ac.co_perfil', '=', 'pf.co_perfil')
                                ->distinct()
                                ->get();
    }
    public function buscarAcessos($co_acesso){
        return Cargo::select('co_acesso',
                                    'mat_colaborador',
                                    'co_perfil',
                                    'co_contrato',
                                    'dt_cadastro',
                                    'dt_criado_por',
                                    'dt_atualizacao')
                                    ->where('co_acesso','=', $co_acesso)                                    
                                    ->get();
    }
}

