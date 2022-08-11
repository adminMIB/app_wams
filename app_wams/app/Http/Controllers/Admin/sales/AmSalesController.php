<?php

namespace App\Http\Controllers\Admin\sales;

use App\Http\Controllers\Controller;
use App\Models\Elearning;
use App\Models\SalesOpty;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AmSalesController extends Controller
{
    public function index(Request $request)
    {
    $sales = SalesOpty::all();
        if($request->has('cari')) {
            $sales=SalesOpty::where('Date', 'LIKE', '%'.$request->cari. '%')->get();
        }else{
            $sales = SalesOpty::paginate(5);
    }
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $ele = Elearning::all();
        
        return view('SALES.inputsales',compact('ele'));
    }

    public function show($id)
    {
        $pmLead = Role::with('users')->where("name", "PM Lead")->get();
        $technikalLead = Role::with('users')->where("name", "Technikal Lead")->get();

        $detail = SalesOpty::with('elearnings', 'pmLead', 'technikelLead')->find($id);
        // return $detail;
        return view('admin.sales.show', compact('detail', 'pmLead', 'technikalLead'));
    }


    public function update(Request $request, $id)
    {
        $sales = SalesOpty::find($id);

        // return $request->signPm_lead;
        $sales->update([
            "pmLead_id" =>$request->pmLead_id,
            "TechnikalLead_id"=> $request->TechnikalLead_id,
        ]);

        return redirect('adminproject/sales');
    }

}
