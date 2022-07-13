<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CreateWeekly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateWeekliesController extends Controller
{
    public function index(Request $request)
    {
        $data = CreateWeekly::orderBy("created_at","DESC")->paginate(10);

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        try{
            $validate = Validator::make($request->all(),[
                "client_name" => "required|string|max:100",
                "project_name" => "required|string|max:200",
                "uraian_job" => "required|string|max:200",
                "status_job" => "required|string|max:200",
                "note" => "required|string|max:1000",
               
            ],[
          
                "client_name.required" => "Nama Client harus sesuai!",
                "project_name.required" => "Nama Project harus sesuai!",
                "uraian_job.required" => "Uraian Job harus sesuai!",
                "status_job.required" => "Status Job harus sesuai!",
                "note.required" => "Note harus sesuai!",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            CreateWeekly::create([
      
                "client_name" => $request->client_name,
                "project_name" => $request->project_name,
                "uraian_job" => $request->uraian_job,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "status_job" => $request->status_job,
                "note" => $request->note,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Create Report Weekly'$request->client_name' berhasil dibuat",
            
            ]);
        } catch (\Exception $e) {
            return response()->json($e -> getMessage());
        } 
    }

    public function edit($id)
    {
        $createweeklies = new CreateWeekly();
        $getOneById = CreateWeekly::find($id);

        return response()->json(["status" => true, "data" => $getOneById]);
    }

    public function update(Request $request, $id)
    {
        $createweeklies= new CreateWeekly();
        $createweeklies= CreateWeekly::findOrFail($id);

        try{
            $validate=Validator::make($request->all(),[
                "client_name" => "required|string|max:100",
                "project_name" => "required|string|max:200",
                "uraian_job" => "required|string|max:200",
                "status_job" => "required|string|max:200",
                "note" => "required|string|max:1000",
               
            ],[
          
                "client_name.required" => "Nama Client harus sesuai!",
                "project_name.required" => "Nama Project harus sesuai!",
                "uraian_job.required" => "Uraian Job harus sesuai!",
                "status_job.required" => "Status Job harus sesuai!",
                "note.required" => "Note harus sesuai!",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $createweeklies->update([
                "client_name" => $request->client_name,
                "project_name" => $request->project_name,
                "uraian_job" => $request->uraian_job,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "status_job" => $request->status_job,
                "note" => $request->note,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Data '$createweeklies->client_name', berhasil diubah."
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    
    public function destroy($id)
    {
        $createweeklies = new CreateWeekly();
       
        $createweeklies = CreateWeekly::find($id);
        $createweeklies -> delete();

        return response()->json([
            "status" => true, 
            "message" => "data dipindahkan ke tongsampah"
        ]);
    }
}
