<?php

namespace App\Http\Controllers\Admin\sales;

use App\Exports\ExportExcelSales;
use App\Http\Controllers\Controller;
use App\Models\ElearnindDetail;
use App\Models\Elearning;
use App\Models\ListProjectAdmin;
use App\Models\NomerKodeProjectOrderOpties;
use App\Models\ProgressStatus;
use App\Models\SalesOpty;
use App\Models\User;
use App\Models\UserHasSalesOpties;
use App\Models\Wodlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class AmSalesController extends Controller
{

    private $mediaCollection = 'UploadDocument';

    public function index(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $sales = SalesOpty::orderBy('created_at', 'desc')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'like', "%" . $request->Status . "%")->paginate(7);
        } else {
            $sales = SalesOpty::orderBy('created_at', 'desc')->with('userTechnikalsPipe.userTechnikal')->paginate(7);
        }
        $prostat = ProgressStatus::all();
        $detailss = UserHasSalesOpties::with("userTechnikal","projectSalesOpties", "userPM")->get();

        $jumlah = count($detailss);   
        // $detail = SalesOpty::with('elearnings', 'pmLead', 'technikelLead')->get();

    // dd($sales);
    // return $sales;    


    return view('admin.sales.index', [
        'sales' => $sales,
        'detailss' => $detailss,
        "jumlah" => $jumlah,
        "prostat" => $prostat,
        // "jumlah" => $jumlah,
        'mediaCollection' => $this->mediaCollection
    ]);
        // return view('admin.sales.index', compact('sales', 'detailss', 'jumlah'));
    }

    public function edit($id)
    {    
        $technikalLead = Role::with('users')->where("name", "Technikal")->get();
        $detail = SalesOpty::with('elearnings', 'pmLead', 'technikelLead', 'userTechnikalsPipe.userPresale', 'userTechnikalsPipe.userTechnikal')->find($id);
        // return $detail;
        $detailss = UserHasSalesOpties::with("userTechnikal","projectSalesOpties", "userPM", 'userPresale')->Where("sales_opties_id", $id)->get();
        $jumlah = count($detailss); 
        $prostat = ProgressStatus::all();

        return view('admin.sales.edit', [
            'detail' => $detail , 'UploadDocuments' => $detail->getMedia($this->mediaCollection),
            'technikalLead' => $technikalLead,
            'jumlah' => $jumlah,
            'detailss' => $detailss,
            'prostat' => $prostat,
        ]);
    }

    public function updateDatas(Request $request, $id) {
        $sales = SalesOpty::with('UploadDocuments')->find($id);
        $users = UserHasSalesOpties::Where("sales_opties_id", $id)->get();
        $validator = Validator::make($request->all(),[ 
            // 'sign_techLead' => 'required',
            // "sign_am" =>'required', 
        ]); 

        $technikal = $request->sign_techLead;
        $idPresale = $request->sign_presale;



        if($validator->fails()) { 
            return back()->with('error', 'Please New Assign!'); 
        }
        
            // kemudian hapus data yang sudah ada / agar buat data baru lagi
            if ($technikal || $idPresale) {
                foreach ($users as $key => $value) {
                    UserHasSalesOpties::find($value->id)->delete();
                }
            }

            $sales->update([
                // "ID_project" => $request->ID_project,
                "Status" => $request->Status,
                "UploadDocument"=>  implode("," , $request->UploadDocument),
                // "sign_techLead" => $value
            ]);    

            if (count($sales->UploadDocuments) > 0) {
                foreach ($sales->UploadDocuments as $media) {
                    if (!in_array($media->file_name, $request->input('UploadDocument', []))) {
                        $media->delete();
                    }
                }
            }
            
            $media = $sales->UploadDocuments->pluck('file_name')->toArray();
            
            foreach ($request->input('UploadDocument', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $sales->addMedia(public_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
                }
            }
 
                if (count($technikal) > count($idPresale)) {
                    foreach ($technikal as $key => $value) {
                        UserHasSalesOpties::create([
                            "user_id_technikal" => $value,
                            "user_id_presales" => $idPresale[$key] ?? null,
                            "sales_opties_id" => $id
                        ]);
                    }
                } else {
                    foreach ($idPresale as $key => $value) {
                        UserHasSalesOpties::create([
                            "user_id_technikal" => $technikal[$key] ?? null,
                            "user_id_presales" => $value,
                            "sales_opties_id" => $id
                        ]);
                    }
                }

        return redirect('adminproject/sales')->with('success', 'data berhasil di Assign');


    }

    public function show($id)
    {
        // buat kode project
        // MIB20228101001
        $now =  Carbon::now();
        $tanggal = date('d');
        $thBulan = $now->year . $now->month . $tanggal;

        $tabelListProjectAdmin = NomerKodeProjectOrderOpties::count();
        if ($tabelListProjectAdmin == 0) {
            $urut = 1001;
            $nomer = 'MIB'. $thBulan. $urut;  
            $nomerCustomer = 'CUM'. $urut;                        
        }  else {
            $ambilLast = NomerKodeProjectOrderOpties::all()->last();
            $urut = (int)substr($ambilLast->arr2, -4) + 1;
            $nomer = 'MIB'. $thBulan. $urut; 
            $nomerCustomer = 'CUM'. $urut;                         
        }
        // return $ambilLast;

        $pmLead = Role::with('users')->where("name", "PM")->get();
        $technikalLead = Role::with('users')->where("name", "Technikal")->get();

        $detail = SalesOpty::with('elearnings', 'pmLead', 'technikelLead')->find($id);
        $detailss = UserHasSalesOpties::with("userTechnikal","userPresale","projectSalesOpties", "userPM")->Where("sales_opties_id", $id)->get();
        $jumlah = count($detailss);   

        return view('admin.sales.show', compact('detailss', "jumlah", 'detail', 'pmLead', 'technikalLead', 'nomer', 'nomerCustomer'));   
    }


    public function update(Request $request, $id)
    {
        $sales = SalesOpty::find($id);
        // $technikalLead = User::all();  
        $idPresale = $request->sign_presale;
        $technikalLead = $request->sign_techLead;
        

        $validator = Validator::make($request->all(),[
            // "sign_pmLead" => 'required',
            "sign_techLead" => 'required',
            'UploadDocument' => 'required'
        ]);    
        
        if($validator->fails()) {
            return back()->with('error', 'Please Assign user!');
        }

    $sales->update([
        "ID_project" => $request->ID_project,
        // "sign_pmLead" => $request->sign_pmLead,
        "UploadDocument"=>  implode("," , $request->UploadDocument),
        // "sign_techLead" => $value
    ]);

    foreach ($request->input('UploadDocument', []) as $file) {
        $sales->addMedia(public_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
    }


    if (count($technikalLead)) {
        foreach ($technikalLead as $key => $value) {
            UserHasSalesOpties::create([
                "user_id_technikal" => $value,
                // "user_id_presales" => $idPresale[$key] ?? null,
                "sales_opties_id" => $id
            ]);
        }
    }
    
    NomerKodeProjectOrderOpties::create([
        "arr2" => $request->arr2
    ]);

    Wodlist::create([
        "salesopty_id" => $sales->id,
    ]);

    // if (count($datas) == 1) {
    //     foreach ($datas as $key => $value) {   
    //             UserHasSalesOpties::create([
    //                 "user_id_technikal" => $value,
    //                 // "user_id_pm" => $request->sign_pmLead,
    //                 "sales_opties_id" => $sales->id
    //             ]);
    //     }
        
    //         NomerKodeProjectOrderOpties::create([
    //             "arr2" => $request->arr2
    //         ]);
    //         
        
    // }

    // if (count($datas) > 1) {
    //     foreach ($datas as $key => $value) {   
    //         UserHasSalesOpties::create([
    //             "user_id_technikal" => $value,
    //             // "user_id_pm" => $request->sign_pmLead,
    //             "sales_opties_id" => $sales->id
    //         ]);
    //     }
    //     NomerKodeProjectOrderOpties::create([
    //         "arr2" => $request->arr2
    //     ]);
    //     Wodlist::create([
    //         "salesopty_id" => $request->salesopty_id,
    //     ]);
    // }
        return redirect('adminproject/sales')->with('success', 'data berhasil di Assign');
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function export_excelAmSales()
	{
		return Excel::download(new ExportExcelSales, 'contoh.xlsx');
	}

}
