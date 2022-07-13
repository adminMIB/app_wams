<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        $data = Upload::orderBy("created_at", "DESC")
        ->paginate(10);

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        try {
        $validate = Validator::make($request->all(), [
                "no_dokumen" => "required|unique:uploads",
                "tgl_upload" => "required",
                "nama_institusi" => "required",
                "nama_project" => "required",
                "jenis_dokumen" => "required",
                "upload_dokumen" => "required|file",
            ]);

            if ($validate->fails()){
             return response()->json($validate->errors());
            }

            $data = $request->upload_dokumen;
            $upload_dokumen = time().$data->getClientOriginalName();
            $data->move(public_path().'/upload_dokumen', $upload_dokumen);


           Upload::create([
            "no_dokumen" =>  $request->no_dokumen,
            "tgl_upload" =>  $request->tgl_upload,
            "nama_institusi" => $request->nama_institusi,
            "nama_project" => $request->nama_project,
            "jenis_dokumen" => $request->jenis_dokumen,
            "upload_dokumen" =>  $request->upload = $upload_dokumen,
        
            ]);

            return response()->json([
                "status" => true,
                "message" => "Document berhasil disimpan "
            ]);
     } catch (\Exception $e) {
        return response()->json($e->getMessage());
    }
    }
    public function destroy($id)
    {
        $data = Upload::find($id);
        $data->delete();
        return response()->json(["status" => true, "massage" => "data berhas il dihapus"]);
    }
}
