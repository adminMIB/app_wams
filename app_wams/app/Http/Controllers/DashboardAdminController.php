<?php

namespace App\Http\Controllers;

use App\Models\ListProjectAdmin;
use App\Models\SalesOpty;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{

    public function index()
    {
        $dataPiplane =  SalesOpty::where('Status', 'PO/Contract')->count();
        $dataAdmin =  ListProjectAdmin::where('Status', 'PO/Contract')->count();
        $dataPOAdmin = ListProjectAdmin::where('Status', 'PO/Contract')->count();
        $dataPoPiplane = SalesOpty::where('Status', 'PO/Contract')->count();

        // jumlaj data po
        $jumlahPoProject = $dataPOAdmin + $dataPoPiplane;

        $dataLostAdmin = ListProjectAdmin::where('Status', 'Lost')->count();
        $dataLostPiplane = SalesOpty::where('Status', 'Lost')->count();

        // jumlah data lost
        $jumlahLostProject = $dataLostAdmin + $dataLostPiplane;

        // !data contract oppty -> STATUS PO
        $datDianLubisPO =  SalesOpty::where('Status', 'PO/Contract')->where('name_user' , 'Dian Lubis')->count();
        $datDianLOctaviaPO =  SalesOpty::where('Status', 'PO/Contract')->where('name_user' , 'Dian Octavia')->count();
        $datMeithaPO =  SalesOpty::where('Status', 'PO/Contract')->where('name_user' , 'Meita')->count();


        //! ALL DATA PROJECT BY PIPLANE
        $datDianLubisALL =  SalesOpty::where('name_user' , 'Dian Lubis')->count();
        $datDianLOctaviaALL =  SalesOpty::where('name_user' , 'Dian Octavia')->count();
        $datMeithaAll =  SalesOpty::where('name_user' , 'Meita')->count();

        //!ESTIMATED AMOUTN PO / DEAL
        $estimaedAmoutnDianOctaviaPO = SalesOpty::where("name_user", "Dian Octavia")->where("Status", "PO/Contract")->get();
        // return $estimaedAmoutnPO;

        
        return view('superAdmin.dashboardSuperAdmin', compact('dataPiplane', 'dataAdmin', 'jumlahPoProject', 'jumlahLostProject', 'datDianLubisPO', 'datDianLOctaviaPO', 'datMeithaPO', 'estimaedAmoutnDianOctaviaPO', 'datDianLubisALL', 'datDianLOctaviaALL', 'datMeithaAll'));
    }

    public function menu()
    {
        return view('superAdmin.AllMenu');
    }

}
