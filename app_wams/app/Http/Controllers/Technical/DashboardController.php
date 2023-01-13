<?php

namespace App\Http\Controllers\Technical;
use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\ListProjet;
use App\Models\SalesOpty;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::with('detail')->get();


        $projectSales = SalesOpty::with('userTechnikalsPipe.userTechnikal')->get();
        $projectAdmin = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userTechnikal', 'ltoproject.bast')->get();

            $dataProjectMenang = [];
            $dataProjectKalah = [];
            $dataProjectDataOven = [];
            $dataProjects = [];

            if ($request->dari_tgl || $request->sampai_tgl) {
                $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
                $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
                $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($data as $key => $value) {
                    $dataProjectMenang[] =  $value;
                }
            } else {
                foreach ($projectSales as $key => $value) {
                    $dataProjects [] = $value;
                    switch ($value->Status) {
                        case 'PO/Contract':
                                $dataProjectMenang [] = $value;                            
                            break;
                        case 'Lost':
                                $dataProjectKalah [] = $value;         
                                // return $dataProjectKalah;                          
                            break;
                        default:
                            break;
                    }
                }
            }
    

            if ($request->dari_tgl || $request->sampai_tgl) {
                $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
                $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
                $data = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($data as $key => $value) {
                    $dataProjectMenang[] =  $value;
                }
            } else {
                foreach ($projectAdmin as $key => $value) {
                    $dataProjects [] = $value;
                    switch ($value->Status) {
                        case 'PO/Contract':
                                $dataProjectMenang [] = $value;                            
                            break;
                        case 'Lost':
                                $dataProjectKalah [] = $value;  
                                // return $dataProjectKalah;                          
                            break;    
                        default:                            
                            break;
                    }

                }
            }




        return view('dashboardTeknikal', compact('datas','data', 'projectAdmin', 'projectSales', 'dataProjectMenang', 'dataProjectKalah'));

    
    
    }
}
