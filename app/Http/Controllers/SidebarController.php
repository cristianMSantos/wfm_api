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
                        'text' => 'Starred',
                        'route' => '/user',
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
                        'text' => 'Starred',
                        'route' => '/teste',
                    ],
                ],
                'section' => 'Teste',
            ],
        ];
        return response()->json($menuItems);
    }



 

 
   

    

}
