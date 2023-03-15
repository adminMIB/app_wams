<?php

namespace App\Http\Controllers\PM;
use App\Http\Controllers\Controller;
use App\Models\Bast;
use App\Models\ListProjectAdmin;
use App\Models\ListProjet;
use App\Models\ListToPm;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use App\Models\Weekly;
use App\Models\WeeklyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPmController extends Controller
{
    public function index()
    {
       
        $is = Weekly::select(DB::raw("COUNT(*) as count"))
        ->where('status',1)
        ->pluck('count');

        $dn =Weekly::select(DB::raw("COUNT(*) as count"))
        ->where('status',2)
        ->pluck('count');

       
        $nama_client = Weekly::all();
        $categories = [];
        $td = [];
        $is=[];
        $dn=[];

        $data = Weekly::with('listL')->get();
        foreach($nama_client as $nc){
            $categories[]= $nc->listL->institusi;
            $td[]=$nc->select(DB::raw("COUNT(*) as count"))
            ->where('status',0)
            ->pluck('count');
            $is[]=$nc->select(DB::raw("COUNT(*) as count"))
            ->where('status',1)
            ->pluck('count');
            $dn[]=$nc->select(DB::raw("COUNT(*) as count"))
            ->where('status',2)
            ->pluck('count');


        }

        $pipebyname = SalesOrder::select('id', 'institusi')->get()->groupBy(function($pipebyname) {
            return $pipebyname->institusi;
        });
        $namacontract = [];
            
            foreach ($pipebyname as $key => $value) {
                $namacontract[] = $key;
            }

            // contract
            $jumlahContract = [];
            $pipebycontract = SalesOrder::select('id', 'institusi')->where('status', 1)->get()->groupBy(function($pipebycontract) {
                return $pipebycontract->weeklies->status;
            });

            foreach ($pipebycontract as $key => $value) {
                $jumlahContract[] = count($value);
            }
            
            // return $namacontract;
           
        // dd(json_encode($st));

        $cp = Bast::where('status','Completed')->count();
        $op = Bast::where('status','Open')->count();
        $hl = Bast::where('status','Hold')->count();
        return view('dashboardpm',compact('cp','op','hl','data','namacontract','jumlahContract'));


    }

}
