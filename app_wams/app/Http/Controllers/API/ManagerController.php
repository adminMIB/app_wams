<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DocumentList;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $data = DocumentList::orderBy("created_at", "DESC")
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
                "no_dokumen" => "required|unique:list",
                "tgl_dokumen" => "required",
                "nama_institusi" => "required",
                "nama_project" => "required",
                "jenis_dokumen" => "required",
                "upload_dokumen" => "required|file",
                "nama_editor" => "required",
            ]);

            if ($validate->fails()){
             return response()->json($validate->errors());
            }

            $data = $request->upload_dokumen;
            $upload_dokumen = time().$data->getClientOriginalName();
            $data->move(public_path().'/upload_dokumen', $upload_dokumen);


          DocumentList::create([
            "no_dokumen" =>  $request->no_dokumen,
            "tgl_dokumen" =>  $request->tgl_dokumen,
            "nama_institusi" => $request->nama_institusi,
            "nama_project" => $request->nama_project,
            "jenis_dokumen" => $request->jenis_dokumen,
            "nama_editor" =>  $request->nama_editor,
            "upload_dokumen"=> $request->upload_dokumen
            
        
            ]);

            return response()->json([
                "status" => true,
                "message" => "Document berhasil disimpan "
            ]);
     } catch (\Exception $e) {
        return response()->json($e->getMessage());
    }
    }

    public function edit(Request $request, $id) 
    {     
        $getOneById = DocumentList::find($id);
        return response()->json(["status" => true, "data" => $getOneById]);
    }

    public function update(Request $request, $id)
    {
        $data =DocumentList::findOrFail($id);
        try {
            $validate = Validator::make($request->all(), [
                "no_dokumen" => "required|unique:uploads",
                "tgl_dokumen" => "required",
                "nama_institusi" => "required",
                "nama_project" => "required",
                "jenis_dokumen" => "required",
                "upload_dokumen" => "required|file",
                "nama_editor" => "required",
            ]);

            if ($validate->fails()){
                return response()->json($validate->errors());
               }
               $data = $request->upload_dokumen;
               $upload_dokumen = time().$data->getClientOriginalName();
               $data->move(public_path().'/upload_dokumen', $upload_dokumen);

            $data->update([
            "no_dokumen" =>  $request->no_dokumen,
            "tgl_dokumen" =>  $request->tgl_dokumen,
            "nama_institusi" => $request->nama_institusi,
            "nama_project" => $request->nama_project,
            "jenis_dokumen" => $request->jenis_dokumen,
            "nama_editor" =>  $request->nama_editor
            ]);

            return response()->json([
                "status" => true,
                "message" => "data berhasil dibah."
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = DocumentList::find($id);
        $data->delete();
        return response()->json(["status" => true, "massage" => "data berhas di dihapus"]);
    }
}
