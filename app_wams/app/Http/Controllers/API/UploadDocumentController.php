<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UploadDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadDocumentController extends Controller
{
    public function index(Request $request)
    {
        $data = UploadDocument::orderBy("created_at", "DESC")->paginate(10);

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "no_doc" => "required|string|max:30|unique:upload_documents",
                "tgl_up" => "required|date",
                "institusi" => "required|string|max:30",
                "project" => "required|string|max:30",
                "jenis_doc" => "required|string|max:30",
                "up_doc" => "required|file",
            ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $nmu = $request->up_doc;
        $up_doc = time().$nmu->getClientOriginalName();
        $nmu->move(public_path().'/files/upDoc', $up_doc);

        UploadDocument::create([
            "no_doc" => $request->no_doc,
            "tgl_up" => $request->tgl_up,
            "institusi" => $request->institusi,
            "project" => $request->project,
            "jenis_doc" => $request->jenis_doc,
            "up_doc" => $request->upload = $up_doc
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
