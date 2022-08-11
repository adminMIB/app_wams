<?php

namespace App\Http\Controllers;

use App\Models\ElearnindDetail;
use Illuminate\Http\Request;
use App\Models\Elearning;
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
       
        
        return redirect('telearning');
    
}
    public function edit($id)
    {
        $ele = Elearning::find($id);
        $data= ElearnindDetail::all();
        return view('elearning.edite', compact('ele','data'));
    }

    public function update(Request $request, $id)
    {
       
       
        $elearning = Elearning::find($id);
        $elearning->update($request->all());
        return redirect('telearning');
     
  }

    public function destroy($id)
    {
        $ele = Elearning::find($id);    
        $ele->delete();
        return back();
    }

    public function show($id)
    {
        $ele = Elearning::find($id);
        return view('elearning.edit', compact('ele'));
    }
}
