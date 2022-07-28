<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListProjectTech;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class ListProjectTechController extends Controller
{
    public function index()
    {
        $data = ListProjectTech::orderBy("created_at", "DESC")
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
                "jenis_dokumen" => "required",
                "upload_dokumen" => "required",
                "user_id" => "required",
                "project_id" => "required",

            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }


            $data = $request->upload_dokumen;
            $name = '';
            foreach ($data as $dokumen) {
                $fileName = $dokumen->getClientOriginalName();
                $dokumen->move(public_path() . '/upload_dokumen', $fileName);
                $name = $name . $fileName . ".";
            }

            $data = ListProjectTech::create([

                "jenis_dokumen" => $request->jenis_dokumen,
                "user_id" => $request->user_id,
                "project_id" => $request->project_id,
                "upload_dokumen" => $request->upload_dokumen = $name,

            ]);

            return response()->json([
                "status" => true,
                "message" => "List Project Technikal berhasil disimpan ",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $getOneById = ListProjectTech::find($id);
        return response()->json(["status" => true, "data" => $getOneById]);
    }

    public function update(Request $request, $id)
    {
        $data = ListProjectTech::findOrFail($id);
        if (File::exists('upload_dokumen/' . $ele->upload_dokumen)) {
            File::delete('upload_dokumen/' . $ele->upload_dokumen);
        }
        try {
            $validate = Validator::make($request->all(), [
               
                "jenis_dokumen" => "required",
                "upload_dokumen" => "required",
                "user_id" => "required",
                "project_id" => "required"

            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }


            $data = $request->upload_dokumen;
            $fileName = $data->getClientOriginalName();
            $data->move(public_path() . '/upload_dokumen', $fileName);

            $data->update([
                "jenis_dokumen" => $request->jenis_dokumen,
                "user_id" => $request->user_id,
                "upload_dokumen" => $request->upload_dokumen = $fileName,
                "project_id" => $request->project_id


            ]);

            return response()->json([
                "status" => true,
                "message" => "data berhasil diubah."
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = ListProjectTech::find($id);
        $data->delete();
        return response()->json(["status" => true, "massage" => "data berhasil di dihapus"]);
    }
}
