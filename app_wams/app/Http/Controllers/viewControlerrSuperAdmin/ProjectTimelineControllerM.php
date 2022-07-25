<?php

namespace App\Http\Controllers\viewControlerrSuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\ProjectTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectTimelineControllerM extends Controller
{
    public function index()
    {
        $data = ProjectTimeline::all();
        return view('superAdmin.ProjectManagement.dashboardProjectTimeline', compact('data'));
    }

    public function create() 
    {
        $data = ProjectTimeline::all();
        return view('superAdmin.ProjectManagement.addProjectTimeline', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "nama_institusi" => "required",
                "nama_project" => "required",
                "nama_sales" => "required",
                "start_date" => "required",
                "finish_date" => "required",
                "sign_to" => "required",
                "sign_to_pm" => "required"
            ],[
                "nama_institusi.required" => "Field tidak boleh kosong",
                "nama_project.required" => "Field tidak boleh kosong",
                "nama_sales.required" => "Field tidak boleh kosong",
                "start_date.required" => "Field tidak boleh kosong",
                "finish_date.required" => "Field tidak boleh kosong",
                "sign_to.required" => "Field tidak boleh kosong",
                "sign_to_pm.required" => "Field tidak boleh kosong"
            ]);
    
            if($validate->fails()) {
                
            return redirect()->route('input')
            ->with('error','Field tidak boleh kosong');
            }
    
            ProjectTimeline::create([
                "nama_institusi" => $request->nama_institusi,
                "nama_project" => $request->nama_project,
                "nama_sales" => $request->nama_sales,
                "start_date" => $request->start_date,
                "finish_date" => $request->finish_date,
                "sign_to" => $request->sign_to,
                "sign_to_pm" => $request->sign_to_pm
            ]);

            return redirect('index');
    
            
        } catch(\Exception $e) {
            return response()->json($e->getMessage());
        }                    
        
    }
}
