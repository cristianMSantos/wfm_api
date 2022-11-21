<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acessos;
use App\Models\View_Colaborador;
use DB;

class AdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acessos = new Acessos();
        $list = $acessos->listarAcessos();
        return json_encode($list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        var_dump('CREAT');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('america/sao_paulo');

        $user = new View_Colaborador;
        $user = $user->getAuthUser();

        $login = $user[0]->mat_colaborador;
        // dd($request);
        foreach ($request->usersTableList as $key => $users) {
            if($request->perfilSelected == 3) {
                $newAcessos = new Acessos();
                $newAcessos->co_contrato = $request->contratoSelected;
                $newAcessos->mat_colaborador = strtoupper($users['matricula']);                                
                $newAcessos->co_perfil = $request->perfilSelected;
                $newAcessos->dt_cadastro = date('Y-m-d H:i', time());
                $newAcessos->dt_criado_por = $login;
                $newAcessos->dt_atualizacao = date('Y-m-d H:i', time());
                $newAcessos->save();
            }else{                                                           
                foreach($request->contratoSelected as $contrato) {
                    $newAcessos = new Acessos(); 
                    $newAcessos->mat_colaborador = strtoupper($users['matricula']);                                
                    $newAcessos->co_perfil = $request->perfilSelected;
                    $newAcessos->co_contrato = $contrato;
                    $newAcessos->dt_cadastro = date('Y-m-d H:i', time());
                    $newAcessos->dt_criado_por = $login;
                    $newAcessos->dt_atualizacao = date('Y-m-d H:i', time());
                    $newAcessos->save();
                }
            }
        
            // $newAcessos->dt_cadastro = date('Y-m-d H:i:s', time());
            // $newAcessos->dt_criado_por = $login;
            // $newAcessos->dt_atualizacao = date('Y-m-d H:i:s', time());
            // $newAcessos->save();
        }

        return response()->json([
            "massege" => "created successfully"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($matriculas)
    {
        $matriculas = preg_split("/[\s,;]+/", $matriculas, -1, PREG_SPLIT_NO_EMPTY);

        $colaboradores = View_Colaborador::from('gente.vw_colaborador as vw')
            ->select('vw.mat_colaborador', 'no_colaborador', 'co.no_contrato', 'no_empresa', DB::raw("(CASE WHEN ace.co_acesso IS NOT NULL THEN 1 ELSE 0 END) AS CADASTRADO"))
            ->join('gente.Contrato as co', 'co.co_contrato', '=', 'vw.co_contrato')
            ->leftJoin('gente.Acessos as ace', 'vw.mat_colaborador', '=', 'ace.mat_colaborador')
            ->whereIn('vw.mat_colaborador', $matriculas)
            ->get();

        return json_encode($colaboradores);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        var_dump('EDIT');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        date_default_timezone_set('america/sao_paulo');
        $acessos = new Acessos();
        $acessos = $acessos->where('mat_colaborador', $request->usersTableList[0]['matricula'])->delete();
        
        self::store($request);
            
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $remove = new Acessos();
        $remove = $remove->whereIn('mat_colaborador', $request->acesso)->delete();
        
        return $remove;
    }
}
