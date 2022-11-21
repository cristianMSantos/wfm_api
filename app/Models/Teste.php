<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teste extends Model
{
    public $timestamps = false;
    protected $table = 'GENTE.BASETB011_COLABORADOR';

    protected $primaryKey = 'CO_COLABORADOR';

    public function listarTeste()
    {
        return DB::table('GENTE.BASETB011_COLABORADOR')->select(
            'CO_COLABORADOR',
            'CO_MUNICIPIO',
            'CO_CPF',
            'NO_COLABORADOR',
            'IC_SEXO',
            'CO_CEP',
            'NO_ENDERECO',
            'NO_COMPLEMENTO_ENDERECO',
            'NO_BAIRRO',
            'NU_RG',
            'CO_UF_RG',
            'DE_RG_EMISSOR',
            'NO_EMAIL',
            'DT_NASCIMENTO',
            'DT_CADASTRO'
        )
            ->get();
    }

    public function buscarEmpregado($cpf)
    {
        return DB::table('GENTE.BASETB011_COLABORADOR')->select(
            'CO_COLABORADOR',
            'CO_MUNICIPIO',
            'CO_CPF',
            'NO_COLABORADOR',
            'IC_SEXO',
            'CO_CEP',
            'NO_ENDERECO',
            'NO_COMPLEMENTO_ENDERECO',
            'NO_BAIRRO',
            'NU_RG',
            'CO_UF_RG',
            'DE_RG_EMISSOR',
            'NO_EMAIL',
            'DT_NASCIMENTO',
            'DT_CADASTRO'
        )
            ->where('CO_CPF', '=', $cpf)
            ->get();
    }
}
