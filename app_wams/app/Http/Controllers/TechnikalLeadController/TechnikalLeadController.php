<?php

namespace App\Http\Controllers\TechnikalLeadController;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use Illuminate\Http\Request;

class TechnikalLeadController extends Controller
{
    public function index()
    {   
        // $user = Auth::user();
        $admin = ListProjectAdmin::with('pmLead', 'technikelLead', 'sales')->orderBy("created_at", "DESC")->paginate(10);
    //    $admin =  ListProjectAdmin::where("signPm_lead", $user->id )->with('pmLead', 'technikelLead')->orderBy("created_at", "DESC")->paginate(10); 
        // $admin = User::with('listAdmin')->orderBy("created_at", "DESC")->paginate();

        return view('technikalLead.index', compact('admin'));
    }
}   
