<?php

namespace App\Http\Controllers\SALES;
use App\Http\Controllers\Controller;
use App\Models\Bast;
use App\Models\ListProjectAdmin;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAmSalesController extends Controller
{
    public function index()
    {
        $qq = SalesOrder::all()->count();
        $Smenang = SalesOpty::where('Status', 'PO/Contract')->count();
        $Amenang = ListProjectAdmin::where('Status', 'PO/Contract')->count();
        
        $Skalah = SalesOpty::where('Status', 'Lost')->count();
        $Akalah = ListProjectAdmin::where('Status', 'Lost')->count();
        
        $Spres = SalesOpty::where('Status', 'Presentation/Demo')->count();
        $Sspro = SalesOpty::where('Status', 'Send Proposal')->count();
        $Sproc = SalesOpty::where('Status', 'Proc. Process')->count();
        $Sbidd = SalesOpty::where('Status', 'Bidding')->count();
        $Ssppbj = SalesOpty::where('Status', 'SPPBJ')->count();
        
        $Apres = ListProjectAdmin::where('Status', 'Presentation/Demo')->count();
        $Aspro = ListProjectAdmin::where('Status', 'Send Proposal')->count();
        $Aproc = ListProjectAdmin::where('Status', 'Proc. Process')->count();
        $Abidd = ListProjectAdmin::where('Status', 'Bidding')->count();
        $Asppbj = ListProjectAdmin::where('Status', 'SPPBJ')->count();

        $pselesai = Bast::where('status', 'Completed')->count();
        
        $Aberjalan = $Apres+$Aspro+$Aproc+$Abidd+$Asppbj;
        $Sberjalan = $Spres+$Sspro+$Sproc+$Sbidd+$Ssppbj;
        
        $totalberjalan = $Aberjalan + $Sberjalan;
        $totalmenang = $Smenang + $Amenang;
        $totalkalah = $Skalah + $Akalah;
        
        $salespipe = SalesOpty::where('name_user', Auth::user()->name)->count();
        $salespipedian = SalesOpty::all()->count();
        // dd($totalberjalan);

        $pipebyname = SalesOpty::select('id', 'name_user')->get()->groupBy(function($pipebyname) {
            return $pipebyname->name_user;
        });

        $namacontract = [];
        
        foreach ($pipebyname as $key => $value) {
            $namacontract[] = $key;
        }
        // contract
        $pipebycontract = SalesOpty::select('id', 'name_user', 'contract_amount')->where('Status', 'PO/Contract')->get()->groupBy(function($pipebycontract) {
            return $pipebycontract->name_user;
        });

        $jumlahContract = [];
        
        foreach ($pipebycontract as $key => $value) {
            $totjumlahContract = 0;
            foreach ($value as $val) {
                $totjumlahContract += $val->contract_amount;
            }
            $jumlahContract[] = $totjumlahContract;
        }
        // return $namacontract;
        // lost
        $pipebylost = SalesOpty::select('id', 'name_user', 'contract_amount')->where('Status', 'Lost')->get()->groupBy(function($pipebylost) {
            return $pipebylost->name_user;
        });

        $jumlahlost = [];
        
        foreach ($pipebylost as $key => $value) {
            $totjumlahContract = 0;
            foreach ($value as $val) {
                $totjumlahContract += $val->contract_amount;
            }
            $jumlahlost[] = $totjumlahContract;
        }
        // return $jumlahlost;

        // estimated
        $pipebyesti = SalesOpty::select('id', 'name_user', 'estimated_amount')->get()->groupBy(function($pipebyesti) {
            return $pipebyesti->name_user;
        });

        $jumlahesti = [];
        
        foreach ($pipebyesti as $key => $value) {
            $totjumlahesti = 0;
            foreach ($value as $val) {
                $totjumlahesti += $val->estimated_amount;
            }
            $jumlahesti[] = $totjumlahesti;
        }
        // return $jumlahesti;

        // $totalpipecont = SalesOpty::where('Status', 'PO/Contract')->sum('contract_amount');
        // $totalpipelost = SalesOpty::where('Status', 'Lost')->sum('contract_amount');
        // $totalpipeesti = SalesOpty::sum('estimated_amount');
        // return $totalpipeesti;

        return view('dashboardAmSales', compact('qq','namacontract','jumlahContract','jumlahlost','jumlahesti','totalmenang','totalberjalan', 'salespipe', 'totalkalah','salespipedian', 'pselesai'));
    }
}
