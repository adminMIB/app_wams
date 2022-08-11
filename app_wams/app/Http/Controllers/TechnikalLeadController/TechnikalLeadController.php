<?php

namespace App\Http\Controllers\TechnikalLeadController;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\ListProjectPm;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class TechnikalLeadController extends Controller
{
    public function index()
    {   
        // $user = Auth::user();
        $admin = ListProjectAdmin::orderBy("created_at", "DESC")->paginate(10);
    //    $admin =  ListProjectAdmin::where("signPm_lead", $user->id )->with('pmLead', 'technikelLead')->orderBy("created_at", "DESC")->paginate(10); 
        // $admin = User::with('listAdmin')->orderBy("created_at", "DESC")->paginate();

        return view('technikalLead.index', compact('admin'));
    }

    public function indexViewWo()
    {
        $data = SalesOrder::all();
        $datas = SalesOrder::all()->count();
        $detailId =  SalesOrder::all();
        $user = Role::with('users')->where("name", "PM Lead")->get();
        $listPm = ListProjectPm::all();

        return view('technikalLead.indexViewWo', compact('data', 'datas', 'user', 'listPm'));
    }

    public function showViwWo($id, Request $request)
    {
        $detailId = SalesOrder::find($id);
        $datas = SalesOrder::all()->count(); 

        return view('technikalLead.showViewWo', compact('detailId', 'datas'));
        // return $detailId;

    }

    public function indexSalesOpty(Request $request)
    {
       $sales = SalesOpty::all();
      if($request->has('cari')) {
        $sales=SalesOpty::where('Date', 'LIKE', '%'.$request->cari. '%')->get();
      }else{
        $sales = SalesOpty::paginate(5);
    }
        return view('technikalLead.indexViewSalesOpty', compact('sales'));
    }

    public function showSalesOpty($id)
    {
        $detail = SalesOpty::with('elearnings')->find($id);
        return view('technikalLead.showSalesOpty', compact('detail'));
    }
}   
