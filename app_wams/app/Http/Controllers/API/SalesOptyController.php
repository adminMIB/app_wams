<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SalesOpty;
class SalesOptyController extends Controller
{
    public function index(Request $request)
    {
        $data = SalesOpty::with('timelines')->orderBy("created_at" , "DESC")->paginate(10);

        return response()->json([
            "status" => "true",
            "data" => $data
        ]);

    }

    public function store(Request $request)
    {
        try{
            $validate = Validator::make($request->all(), [
                "NamaClient" => "required|string",
                "NamaProject" => "required|string",
                "Date" => "required|date",
                "timeline" => "required",
                "Angka" => "required|integer",
                "Status" => "required|string",
                "Note" => "required|string"
            ]);
            
            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            SalesOpty::create([
                "NamaClient" => $request->NamaClient,
                "NamaProject" => $request->NamaProject,
                "Date" => $request->Date,
                "timeline" => $request->timeline,
                "Angka" => $request->Angka,
                "Status" => $request->Status,
                "Note" => $request->Note
            ]);

            return response()->json([
                "status" => true,
                "message" => "berhasil dibuat"
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
