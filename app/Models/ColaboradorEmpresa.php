<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColaboradorEmpresa extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB012_COLABORADOR_EMPRESA';
    protected $primaryKey = 'ID_COL_EMPRESA';

    public function listarColaboradorEmpresa(){
        return DB::table('GENTE.BASETB012_COLABORADOR_EMPRESA as cpw')->select('cpw.ID_COL_EMPRESA',
                                                'cpw.CO_SETOR',
                                                'cpw.CO_CARGO',
                                                'cpw.CO_COLABORADOR',
                                                'cpw.CO_CONTRATO',
                                                'cpw.DT_ADMISSAO',
                                                'cpw.DT_DEMISSAO',
                                                'b.NO_SITUACAO',
                                                'cpw.HR_ENTRADA',
                                                'cpw.HR_SAIDA',
                                                'cpw.CO_LOGIN_DAC',
                                                'cpw.DT_CADASTRO',
                                                'cpw.CO_COLAB_CADASTRO',
                                                'cpw.CO_SUPERIOR')
                                    ->join('GENTE.BASETB007_SITUACAO as b','b.CO_SITUACAO','=','cpw.CO_SITUACAO')
                                    ->get();
    }
    public function buscarPorcontratoEmp($CO_CONTRATO, $CO_EMPRESA, $CO_SITUACAO){
        return DB::table('GENTE.BASETB012_COLABORADOR_EMPRESA as cpw')->select('cpw.ID_COL_EMPRESA',
                                            'cpw.CO_SETOR',
                                            'cpw.CO_CARGO',
                                            'cpw.CO_COLABORADOR',
                                            'cpw.CO_CONTRATO',
                                            'cpw.DT_ADMISSAO',
                                            'cpw.DT_DEMISSAO',
                                            'b.NO_SITUACAO',
                                            'cpw.HR_ENTRADA',
                                            'cpw.HR_SAIDA',
                                            'cpw.CO_LOGIN_DAC',
                                            'cpw.DT_CADASTRO',
                                            'cpw.CO_COLAB_CADASTRO',
                                            'cpw.CO_SUPERIOR')
                                    ->join('GENTE.BASETB007_SITUACAO as b','b.CO_SITUACAO','=','cpw.CO_SITUACAO')
                                    ->where('cpw.CO_CONTRATO','=', $CO_CONTRATO)->where('cpw.CO_EMPRESA','=', $CO_EMPRESA)
                                    ->where('cpw.CO_SITUACAO','=', $CO_SITUACAO)
                                    ->get();
    }
    public function buscarColaboradorEmpresa($ID_COL_EMPRESA){
        return DB::table('GENTE.BASETB012_COLABORADOR_EMPRESA as cpw')->select('cpw.ID_COL_EMPRESA',
                                            'cpw.CO_SETOR',
                                            'cpw.CO_CARGO',
                                            'cpw.CO_COLABORADOR',
                                            'cpw.CO_CONTRATO',
                                            'cpw.DT_ADMISSAO',
                                            'cpw.DT_DEMISSAO',
                                            'b.NO_SITUACAO',
                                            'cpw.HR_ENTRADA',
                                            'cpw.HR_SAIDA',
                                            'cpw.CO_LOGIN_DAC',
                                            'cpw.DT_CADASTRO',
                                            'cpw.CO_COLAB_CADASTRO',
                                            'cpw.CO_SUPERIOR')
                                    ->join('GENTE.BASETB007_SITUACAO as b','b.CO_SITUACAO','=','cpw.CO_SITUACAO')
                                    ->where('ID_COL_EMPRESA','=', $ID_COL_EMPRESA)
                                    ->get();
    }
}
