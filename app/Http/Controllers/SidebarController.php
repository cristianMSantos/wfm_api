<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SidebarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function fillMenu(Request $request){
        $menuItems = [
            [
                'id' => 'dashboard',
                'icon' => 'DashboardOutlined',
                'text' => 'Dashboard',
                'hasSubItems' => false,
                'route' => '/dashboard',
                'section' => 'Ferramentas',
            ],
            [
                'id' => 'recrutamento',
                'icon' => 'AssignmentIndOutlined',
                'text' => 'Recrutamento',
                'hasSubItems' => true,
                'subItems' => [
                    [ 
                        'id' => 'recrutamento-teste',
                        'icon' => 'StarBorder',
                        'text' => 'SubRecrutamento', 
                        'route' => '/recrutamento/subRecrutamento',
                    ],
                    [
                        'id' => 'recrutamento-teste2',
                        'icon' => 'StarBorder',
                        'text' => 'SubRecrutamento2',
                        'route' => '/recrutamento/subRecrutamento2',
                    ],
                ],
                'section' => 'Departamentos',
            ],
            [
                'id' => 'trafego',
                'icon' => 'DataThresholdingOutlined',
                'text' => 'Tráfego',
                'hasSubItems' => true,
                'subItems' => [
                    [
                        'id' => 'trafego-teste',
                        'icon' => 'StarBorder',
                        'text' => 'SubTrafego',
                        'route' => '/trafego/subTrafego',
                    ],
                ],
                'section' => 'Departamentos',
            ],
            [
                'id' => 'acessos',
                'icon' => 'LockPersonOutlined',
                'text' => 'Acessos',
                'hasSubItems' => false,
                'route' => '/acessos',
                'section' => 'Administração',
            ],
        ];

        return response()->json($menuItems);
    }

    public function create(Request $request){
        return $request;
    }
}
