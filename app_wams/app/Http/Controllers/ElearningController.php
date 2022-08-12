<?php

namespace App\Http\Controllers;

use App\Models\ElearnindDetail;
use Illuminate\Http\Request;
use App\Models\Elearning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class ElearningController extends Controller
{
    public function index(Request $request)
    {
      
        $ele = Elearning::with('eles')->paginate();

        return view('elearning.index', compact('ele'));
    }

    public function search(Request $request){
        {
            if($request->has('cari')){
                $ele=ElearnindDetail::where('principle','LIKE','%'.$request->cari.'%')->get();
            }else{
            $ele = ElearnindDetail::paginate();
            }
            return view('elearning.search', compact('ele'));
        }
    }

    public function create()
    {
        return view('elearning.create');
    }

    public function store(Request $request)
    {
        

        $request->validate([
            "produk" => "required|string|max:50",
            "principle" => "required|string|max:50",
            "deskripsi" => "required|string|max:255",
          
            "upload" => "mimes:doc,docx,xls,pdf,ppt",

        ], [
            'produk.required' => 'Produk tidak boleh kosong!',
            'principle.required' => 'Principle tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
           
            
        ]);

        $file_dokumen = $request->file('upload');

        $file_dokumen_ext = $file_dokumen->getClientOriginalName();
            $file_dokumen_name = time(). $file_dokumen_ext;
            $file_dokumen_path = public_path('dokumen/');
            $file_dokumen->move($file_dokumen_path, $file_dokumen_name);

            $data = $request->all();
            // dd($data);
    
            $time = new ElearnindDetail;
            $time->produk=$data['produk'];
            $time->principle=$data['principle'];
            $time->deskripsi=$data['deskripsi'];
            $time->upload=$data['upload']=$file_dokumen_name;
            $time->save();
     
      
            foreach($data['implementasi'] as $item => $value) {
              $data3 = array (
                'ele_id' => $time->id,
                'implementasi' => $request['implementasi'][$item],
              );
              Elearning::create($data3);
        };
       
        
        return redirect('telearning')->with('success', 'data berhasil di buat');
    
}
    public function edit($id)
    {
        // $elearning = Elearning::where('id', $id)->first();
        // $ele = Elearning::with('eles')->where('ele_id', $id)->first();
        // return $ele;
        $ele= Elearning::with('eles')->find($id);
        // return $ele;
        // foreach ($ele as $a) {
        //     return $a->id;
        // }
        return view('elearning.edite', compact('ele'));
    }
    
    public function update(Request $request, $id)
    {
        
        
        $elearning = Elearning::with('eles')->find($id);
        // $elearning = Elearning::where('id', $id)->first();
        // $elearningDetail = ElearnindDetail::where('id', $id)->first();
        
        
        $elearning->implementasi= $request->implementasi;
        $elearning->save();

        // return $elearning->eles->id;
        // foreach ($elearning->elesas $key => $value) {
            $file_dokumen = $request->file('upload');

            $file_dokumen_ext = $file_dokumen->getClientOriginalName();
                $file_dokumen_name = time(). $file_dokumen_ext;
                $file_dokumen_path = public_path('dokumen/');
                $file_dokumen->move($file_dokumen_path, $file_dokumen_name);

            $elearningDetail= ElearnindDetail::find($elearning->eles->id);
            
            $elearningDetail->produk =  $request->produk;
            $elearningDetail->principle =  $request->principle;
            $elearningDetail->deskripsi =  $request->deskripsi;
            $elearningDetail->upload =  $request->upload=$file_dokumen_name;
            $elearningDetail->save();
        // }



    //    dd($elearning);
        // $data->update($request->all());
        // $elearning->update($request->all());
        return redirect('telearning')->with('success', 'data berhasil di update');;
     
  }

    public function destroy($id)
    {


        $elearning = Elearning::with('eles')->find($id);    
        $elearningDetail= ElearnindDetail::find($elearning->eles->id);

        return $elearning;
        //  DB::table("elearnings")->where("id", $id)->delete();

        // return $s;
        // $elearningDetail->delete();
        //  $elearning->delete();   
        //  $elearning->eles->id->delete();    
 
        return back()->with('success', 'data berhasil di hapus');;
    }

    // public function show($id)
    // {
    //     $ele = Elearning::find($id);
    //     return view('elearning.edit', compact('ele'));
    // }
}
