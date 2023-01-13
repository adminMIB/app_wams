<?php
namespace App\Http\Controllers\Technical;
use App\Http\Controllers\Controller;
use App\Models\ElearnindDetail;
use Illuminate\Http\Request;
use App\Models\Elearning;
use App\Models\ListProjet;
use App\Models\Principal;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class ElearningController extends Controller
{
    public function index(Request $request)
    {

        $ele = ElearnindDetail::orderBy('created_at', 'desc')->with('elearn')->paginate(10);
        $datas = ListProjet::all()->count();
        $data = ListProjet::orderBy('created_at', 'desc')->with('detail')->get();
        
        return view('elearning.index', compact('ele', 'datas', 'data'));
    }

   

    public function create()
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::with('detail')->get();
        $principal = Principal::all();
        $produk = Produk::all();

        return view('elearning.create',  compact('datas', 'data', 'principal', 'produk'));
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
        $datas = ListProjet::all()->count();
        $data = ListProjet::with('detail')->get();
        $principal = Principal::all();
        $produk = Produk::all();

        // $elearning = Elearning::where('id', $id)->first();
        // $ele = Elearning::with('eles')->where('ele_id', $id)->first();
        // return $ele;
        $ele= ElearnindDetail::with('elearn')->find($id);
        // return $ele;
        // foreach ($ele as $a) {
        //     return $a->id;
        // }
        return view('elearning.edite', compact('ele', 'datas', 'data', 'principal', 'produk'));
    }
    
    public function update(Request $request, $id)
    {
        
        $elearningDetail = ElearnindDetail::with('elearn')->find($id);
        // $elearning = Elearning::where('id', $id)->first();
        // $elearningDetail = ElearnindDetail::where('id', $id)->first();
        

        $file_dokumen = $request->file('upload');

        if(!empty($file_dokumen))
        {
            // dokumen
            $file_dokumen_ext = $file_dokumen->getClientOriginalName();
            $file_dokumen_name = time(). $file_dokumen_ext;
            $file_dokumen_path = public_path('dokumen/');
            $file_dokumen->move($file_dokumen_path, $file_dokumen_name);
            if(!empty($elearningDetail->upload))
            {
                unlink('files/dokumen/'.$elearningDetail->upload);
            }
        }
        else
        {
            $file_dokumen_name=$elearningDetail->upload;
        }
        
        $elearningDetail->produk =  $request->produk;
        $elearningDetail->principle =  $request->principle;
        $elearningDetail->deskripsi =  $request->deskripsi;
        $elearningDetail->upload =  $request->upload=$file_dokumen_name;
        $elearningDetail->save();
        
        $data = $request->all();
        
        Elearning::where('ele_id', $id)->delete();

        foreach($data['implementasi'] as $item => $value) {
            $data3 = array (
                'ele_id' => $elearningDetail->id,
                'implementasi' => $request['implementasi'][$item],
            );
            Elearning::create($data3);
        };


    //    dd($elearning);
        // $data->update($request->all());
        // $elearning->update($request->all());
        return redirect('telearning')->with('success', 'data berhasil di update');;
     
  }

    public function destroy($id)
    {

        $ele = ElearnindDetail::find($id);
        $soidp = Elearning::all(); 
        $soid = $ele->id;
        
        foreach ($soidp as $key => $v) {
            if ($soid ==  $v->ele_id) {
                // return $v->salesopty_id;
                Elearning::find($v->id)->delete();
            }
        }

        $ele->delete();

        //$elearning = Elearning::with('eles')->find($id);    
        //$elearningDetail= ElearnindDetail::find($elearning->eles->id);


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
