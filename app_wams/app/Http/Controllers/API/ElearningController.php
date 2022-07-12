<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Elearning;
use Illuminate\Support\Facades\Validator;
class ElearningController extends Controller
{
    public function index()
    {
        $data = Elearning::orderBy("created_at", "ASC")->paginate(10);

        return response()->json([
            "status" => true,
            "data"=> $data
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(),[
                "produk"=>"required|string|max:50",
                "principle"=>"required|string|max:50",
                "deskripsi"=>"required|string|max:255",
                "implementasi"=>"required|string|max:255",
                "upload"=>"required",
               
            ],[
                'produk.required'=> 'Field tidak boleh kosong!',
                'principle.required'=> 'Field tidak boleh kosong!',
                'deskripsi.required'=>'Field tidak boleh kosong!',
                'implementasi.required'=>'Field tidak boleh kosong!',
                'upload.required'=> 'Field tidak boleh kosong'
            ]);

            if ($validate->fails()){
                return response()->json($validate->errors());
            }
      
         $nm= $request->upload;
         $fileName = $nm->getClientOriginalName();
         $nm->move(public_path().'/dokumen',$fileName);
        
          $response= Elearning::create([
            "produk"=>$request->produk,
            "principle"=>$request->principle,
            "deskripsi"=>$request->deskripsi,
            "implementasi"=>$request->implementasi,
            "upload"=>$request->upload= $fileName,
           
         ]);
         return response()->json([
            'success'=>true,
            'message'=>"Data berhasil disimpan",
            'data'=>$response
         ]);
        }catch (\Exception $e){
            return response()->json(
               $validate->errors()
            );
        }
    }

    public function edit($id)
    {
        $getOneById = Elearning::find($id); 
        return response()->json(["status"=> true, "data"=>$getOneById]);

    }

    public function update(Request $request,$id)
    {
        $ele = Elearning::findOrFail($id);

        try{
            $validate = Validator::make($request->all(),[
                "produk"=>"required|string|max:50",
                "principle"=>"required|string|max:50",
                "deskripsi"=>"required|string|max:255",
                "implementasi"=>"required|string|max:255",
                "upload"=>"required",
               
            ],[
                'produk.required'=> 'Field tidak boleh kosong!',
                'principle.required'=> 'Field tidak boleh kosong!',
                'deskripsi.required'=>'Field tidak boleh kosong!',
                'implementasi.required'=>'Field tidak boleh kosong!',
                'upload.required'=> 'Field tidak boleh kosong'
            ]);


            if ($validate->fails()){
                return response()->json($validate->errors(),422);
            }
            $nm= $request->upload;
            $fileName = $nm->getClientOriginalName();
            $nm->move(public_path().'/docnew',$fileName);
           

            $ele->update([
                "produk"=>$request->produk,
                "principle"=>$request->principle,
                "deskripsi"=>$request->deskripsi,
                "implementasi"=>$request->implementasi,
                "upload"=>$request->upload= $fileName,
            ]);

            return response()->json([
                "status"=>true,
                "message"=>"data $ele->produk,berhasil diubah."
            ]);
    
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

    public function destroy($id)
    {
        $ele= Elearning::find($id);
        $ele->delete();
        return response()->json(["status"=>true, "mesaage"=>"data berhasil dihapus"]);

    }
}
