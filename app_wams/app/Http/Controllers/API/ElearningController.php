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
                "upload" => "mimes:doc,docx,xls,pdf,ppt",
               
            ],[
                'produk.required'=> 'Field tidak boleh kosong!',
                'principle.required'=> 'Field tidak boleh kosong!',
                'deskripsi.required'=>'Field tidak boleh kosong!',
                'implementasi.required'=>'Field tidak boleh kosong!',
                
            ]);

            if ($validate->fails()){
                return response()->json($validate->errors());
            }
      
            $file_dokumen = $request->file('upload');

            $file_dokumen_ext = $file_dokumen->getClientOriginalName();
                $file_dokumen_name = time(). $file_dokumen_ext;
                $file_dokumen_path = public_path('dokumen/');
                $file_dokumen->move($file_dokumen_path, $file_dokumen_name);
            Elearning::create([
                "produk" => $request->produk,
                "principle" => $request->principle,
                "deskripsi" => $request->deskripsi,
                "implementasi" => $request->implementasi,
                "upload" => $file_dokumen_name,
           
         ]);
         return response()->json([
            'success'=>true,
            'message'=>"Data berhasil disimpan",
            'data'=>$file_dokumen
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
                "upload" => "mimes: doc,docx,pdf,xls",
               
            ],[
                'produk.required'=> 'Field tidak boleh kosong!',
                'principle.required'=> 'Field tidak boleh kosong!',
                'deskripsi.required'=>'Field tidak boleh kosong!',
                'implementasi.required'=>'Field tidak boleh kosong!',
               
            ]);


            if ($validate->fails()){
                return response()->json($validate->errors(),422);
            }
            $ele = Elearning::find($id);
     
      
            $file_dokumen = $request->file('upload');
            
            if(!empty($file_dokumen))
            {
                // dokumen
                $file_dokumen_ext = $file_dokumen->getClientOriginalName();
                $file_dokumen_name = time(). $file_dokumen_ext;
                $file_dokumen_path = public_path('dokumen/');
                $file_dokumen->move($file_dokumen_path, $file_dokumen_name);
                if(!empty($ele->upload))
                {
                    unlink('dokumen/'.$ele->upload);
                }
            }
            else
            {
                $file_dokumen_name=$ele->upload;
            }
    
           

            $ele->update([
                "produk"=>$request->produk,
                "principle"=>$request->principle,
                "deskripsi"=>$request->deskripsi,
                "implementasi"=>$request->implementasi,
                "upload" => $file_dokumen_name,
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
