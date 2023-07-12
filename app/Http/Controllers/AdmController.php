<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acessos;
use App\Models\View_Funcionarios;
use DB;

class AdmController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAccess()
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

        $auth = new View_Funcionarios;
        $auth = $auth->getAuthUser(); //Trás a matrícula do usuário local; 
        $login = $auth[0]->matricula_pl;

        foreach ($request->colaborador as $users) {
            $newAcessos = new Acessos();
            $newAcessos->matricula = $users['matricula_pl'];
            $newAcessos->senha = '1ae765da44b163c8d6cb8051bc35192b'; // senha padrão plansul123 criptografada.                                
            $newAcessos->co_perfil = $request->perfil['co_perfil'];
            $newAcessos->dt_criacao = date('Y-m-d H:i', time());
            $newAcessos->mat_criacao = $login;
            $newAcessos->ic_ativo = 1;
            $newAcessos->save();
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

        $colaboradores = View_Colaborador::from('sc_bases.vw_funcionario as vwf') // vwf = vw funcionário.
            ->select(
                'vwf.matricula',
                'vwf.nome',
                'vwf.mat_gestor',
                DB::raw("(CASE WHEN usuario.co_usuario IS NOT NULL THEN 1 ELSE 0 END) AS CADASTRADO")
            ) // CADASTRADO está em Usuario.vue
            ->leftJoin('public.tb_usuario as usuario', 'vwf.matricula', '=', 'usuario.matricula')
            ->whereIn('vwf.matricula', $matriculas)
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
        date_default_timezone_set('america/sao_paulo'); //Ajusta a hora do dt_alteracao.
        $user = new View_Colaborador;
        $user = $user->getAuthUser(); //Trás a matrícula do usuário local; 
        $login = $user[0]->matricula;

        $co_usuario = $request->usersTableList[0]['co_usuario'];
        if (Acessos::where('co_usuario', $co_usuario)->exists()) {
            $userAcesso = Acessos::find($co_usuario); 

            $userAcesso->co_perfil = $request->perfilSelected;
            $userAcesso->dt_alteracao = date('Y-m-d H:i', time());
            $userAcesso->mat_alteracao = $login;
            $userAcesso->save();
    
            return response()->json([
                "massege" => "updated successfully"
            ], 200);
        } else {
            return response()->json([
                "massege" => "Internal Server Error"
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        date_default_timezone_set('america/sao_paulo');

        $user = new View_Colaborador;
        $user = $user->getAuthUser();
        $login = $user[0]->matricula;

        //rows contém apenas alguns dados do usuário.
        foreach ($request->rows as $users) {
            $resetPassword = Acessos::where('matricula', $users['matricula'])->first(); 
            if ($resetPassword !== null) {
                $resetPassword->senha = '1ae765da44b163c8d6cb8051bc35192b'; // senha padrão plansul123 criptografada.                                
                $resetPassword->dt_alteracao = date('Y-m-d H:i', time());
                $resetPassword->mat_alteracao = $login;
                $resetPassword->save();
            }
        }

        return response()->json([
            "message" => "updated successfully"
        ], 200);
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
        $remove = $remove->whereIn('matricula', $request->acesso)->delete();

        return $remove;
    }
}
