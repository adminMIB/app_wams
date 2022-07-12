<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $data = Reports::orderBy("created_at","DESC")->paginate(10);

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }
    public function store(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),[
                "name_institusi" => "required|string|max:100",
                "name_project" => "required|string|max:200",
                "name_am" => "required|string|max:100",
                "hps" => "required|integer|min:1000",
                "status_approve" => "required|string|max:100",
            ],[
          
                "name_institusi.required" => "Nama Institusi harus sesuai!",
                "name_project.required" => "Nama Project harus sesuai!",
                "name_am.required" => "Nama AM harus sesuai!",
                "hps.required" => "HPS harus sesuai!",
                "status_approve.required" => "Approve harus sesuai!",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            Reports::create([
      
                "name_institusi" => $request->name_institusi,
                "name_project" => $request->name_project,
                "name_am" => $request->name_am,
                "hps" => $request->hps,
                "status_approve" => $request->status_approve,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Create Project'$request->name_project' berhasil dibuat",
            
            ]);
        } catch (\Exception $e) {
            return response()->json($e -> getMessage());
        } 
    }

    public function edit($id)
    {
        $reports = new Reports();
        $getOneById = Reports::find($id);

        return response()->json(["status" => true, "data" => $getOneById]);
    }

    public function update(Request $request, $id)
    {
        $reports = new Reports();
        $reports = Reports::findOrFail($id);

        try{
            $validate=Validator::make($request->all(),[
                "name_institusi" => "required|string|max:100",
                "name_project" => "required|string|max:200",
                "name_am" => "required|string|max:100",
                "hps" => "required|integer|min:1000",
                "status_approve" => "required|string|max:100",
            ],[
                "name_institusi.required" => "Nama Institusi berhasil diubah!",
                "name_project.required" => "Nama Project berhasil diubah!",
                "name_am.required" => "Nama AM berhasil diubah!",
                "hps.required" => "HPS berhasil diubah!",
                "status_approve.required" => "Approve berhasil diubah!",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $reports->update([
                "name_institusi" => $request->name_institusi,
                "name_project" => $request->name_project,
                "name_am" => $request->name_am,
                "hps" => $request->hps,
                "status_approve" => $request->status_approve,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Data $reports->name_institusi, berhasil diubah."
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    public function destroy($id)
    {
        $reports = new Reports();
       
        $reports = Reports::find($id);
        $reports -> delete();

        return response()->json([
            "status" => true, 
            "message" => "data dipindahkan ke tongsampah"
        ]);
    }

}
