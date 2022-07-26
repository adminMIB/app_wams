<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elearning;
use Illuminate\Support\Facades\File;
class ElearningController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $ele=Elearning::where('principle','LIKE','%'.$request->cari.'%')->get();
        }else{
        $ele = Elearning::paginate();
        }
        return view('elearning.index', compact('ele'));
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
            "implementasi" => "required|string|max:255",
            "upload" => "mimes:doc,docx,xls,pdf,ppt",

        ], [
            'produk.required' => 'Produk tidak boleh kosong!',
            'principle.required' => 'Principle tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'implementasi.required' => 'Implementasi tidak boleh kosong!',
            
        ]);

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
        return redirect('telearning');
    }

    public function edit($id)
    {
        $ele = Elearning::find($id);
        return view('elearning.edit', compact('ele'));
    }

    public function update(Request $request, $id)
    {
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
            "produk" => $request->produk,
            "principle" => $request->principle,
            "deskripsi" => $request->deskripsi,
            "implementasi" => $request->implementasi,
            "upload" => $file_dokumen_name,
        ]);

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
