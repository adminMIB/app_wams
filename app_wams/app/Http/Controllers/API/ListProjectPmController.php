<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ListProjectPm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ListProjectPmController extends Controller
{
    public function index()
    {
        $data = ListProjectPm::orderBy("created_at", "DESC")
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

            "no_sales" => "required",
            "tgl_sales" => "required",
            "nama_sales" => "required",
            "nama_institusi" => "required",
            "nama_project" => "required",
            "hps" => "required",
            "sign_pm_lead" => "required"

        ],[
            "no_sales.required" => "Field tidak boleh kosong",
            "tgl_sales.required" => "Field tidak boleh kosong",
            "nama_sales.required" => "Field tidak boleh kosong",
            "nama_institusi.required" => "Field tidak boleh kosong",
            "nama_project.required" => "Field tidak boleh kosong",
            "hps.required" => "Field tidak boleh kosong",
            "sign_pm_lead.required" => "Field tidak boleh kosong"


            ]);

            if ($validate->fails()){
             return response()->json($validate->errors());
            }

           /*  $data = $request->upload_dokumen;
            $upload_dokumen = time().$data->getClientOriginalName();
            $data->move(public_path().'/upload_dokumen', $upload_dokumen); */


           ListProjectPm::create([

            "no_sales"  => $request->no_sales,
            "tgl_sales"  => $request->tgl_sales,
            "nama_sales"  => $request->nama_sales,
            "nama_institusi"  => $request->nama_institusi,
            "nama_project"  => $request->nama_project,
            "hps"  => $request->hps,
            "sign_pm_lead" => $request-> sign_pm_lead
/* 
            "nama_client" => $request->nama_client,
            "mama_project" => $request->nama_project,
            "hps" => $request->hps,
            "nama_sales" => $request->nama_sales,
            "jenis_dokumen" => $request->jenis_dokumen,
            "upload_dokumen" => $request->upload = $upload_dokumen,
            "sign_tec" => $request->sign_tec
 */


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
        $getOneById = ListProjectPm::find($id);
        return response()->json(["status" => true, "data" => $getOneById]);
    }

    public function update(Request $request, $id)
    {
        $data =ListProjectPm::findOrFail($id);
        try {
            $validate = Validator::make($request->all(), [
                "no_sales" => "required",
                "tgl_sales" => "required",
                "nama_sales" => "required",
                "nama_institusi" => "required",
                "nama_project" => "required",
                "hps" => "required",
                "sign_tec" => "required"

            ]);

            if ($validate->fails()){
                return response()->json($validate->errors());
               }
             /*   $data = $request->upload_dokumen;
               $upload_dokumen = time().$data->getClientOriginalName();
               $data->move(public_path().'/upload_dokumen', $upload_dokumen);
 */
            $data->update([
                "no_sales"  => $request->no_sales,
                "tgl_sales"  => $request->tgl_sales,
                "nama_sales"  => $request->nama_sales,
                "nama_institusi"  => $request->nama_institusi,
                "nama_project"  => $request->nama_project,
                "hps"  => $request->hps,
                "sign_pm_lead" => $request-> sign_pm_lead
    
    
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
        $data = ListProjectPm::find($id);
        $data->delete();
        return response()->json(["status" => true, "massage" => "data berhas di dihapus"]);
    }
}
