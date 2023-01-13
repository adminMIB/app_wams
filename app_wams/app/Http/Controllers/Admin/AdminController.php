<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Distributor;
use App\Models\ElearnindDetail;
use App\Models\HistoryAdmin;
use App\Models\ListProjectAdmin;
use App\Models\NomerForOrderOpty;
use App\Models\NomerKodeProjectOrderOpties;
use App\Models\Principal;
use App\Models\ProgressStatus;
use App\Models\SalesOpty;
use App\Models\User;
use App\Models\UserHasAdminHashOpty;
use App\Models\UserHasListProjectAdmin;
use App\Models\Weekly;
use App\Models\Wodlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use ZipArchive;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Foreach_;

class AdminController extends Controller
{

    private $mediaCollection = 'UploadDocument';



    public function dashboard(Request $request) 
    {
        $projectSales = SalesOpty::with('userTechnikalsPipe.userTechnikal')->get();
        $projectAdmin = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userTechnikal', 'ltoproject.bast')->get();

            $dataProjectMenang = [];
            $dataProjectKalah = [];
            $dataProjectDataOven = [];
            $dataProjects = [];

            if ($request->dari_tgl || $request->sampai_tgl) {
                $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
                $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
                $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($data as $key => $value) {
                    $dataProjectMenang[] =  $value;
                }
            } else {
                foreach ($projectSales as $key => $value) {
                    $dataProjects [] = $value;
                    switch ($value->Status) {
                        case 'PO/Contract':
                                $dataProjectMenang [] = $value;                            
                            break;
                        case 'Lost':
                                $dataProjectKalah [] = $value;         
                                // return $dataProjectKalah;                          
                            break;
                        default:
                            break;
                    }
                }
            }
    

            if ($request->dari_tgl || $request->sampai_tgl) {
                $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
                $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
                $data = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($data as $key => $value) {
                    $dataProjectMenang[] =  $value;
                }
            } else {
                foreach ($projectAdmin as $key => $value) {
                    $dataProjects [] = $value;
                    switch ($value->Status) {
                        case 'PO/Contract':
                                $dataProjectMenang [] = $value;                            
                            break;
                        case 'Lost':
                                $dataProjectKalah [] = $value;  
                                // return $dataProjectKalah;                          
                            break;    
                        default:                            
                            break;
                    }

                }
            }

            // ! Contribution by Projects
            $nama = [];
            $jumlahNama = [];

            $dataContarctSales = SalesOpty::with('userTechnikalsPipe.userTechnikal')->select('id', 'name_user')->get()->groupBy(function($dataContarctSales) {
                return $dataContarctSales->name_user;
            });

            foreach ($dataContarctSales as $key => $value) {
                $nama[] = $key;
                // $nama =  array_unique($namas);
                $jumlahNama[] = count($value);
            }

            $dataContarctAdmin = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userTechnikal', 'ltoproject.bast')->select('id','name_user')->get()->groupBy(function($dataContarctAdmin) {
                return $dataContarctAdmin->name_user;
            });

            foreach ($dataContarctAdmin as $key => $value) {
                $nama[] = $key;
                $jumlahNama[] = count($value);
            }


             // ! Statistik Projects
            $namaBulan = [];
            $jumlahBulan = [];

            // $dataContarctSalesMonth = SalesOpty::with('userTechnikalsPipe.userTechnikal')->select('id', 'created_at')->get()->groupBy(function($dataContarctSales) {
            //     return Carbon::parse($dataContarctSales->created_at)->format('M');
            // });
            // foreach ($dataContarctSalesMonth as $key => $value) {
            //     $namaBulans[] = $key;
            //     $namaBulan = array_unique($namaBulans); 
            //     // $nama =  array_unique($namas);
            //     $jumlahBulan[] = count($value);
            // }

            // $dataContarctAdminMonth = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userTechnikal', 'ltoproject.bast')->select('id','created_at')->get()->groupBy(function($dataContarctAdminMonth) {
            //     return Carbon::parse($dataContarctAdminMonth->created_at)->format('M');
            // });
            // foreach ($dataContarctAdminMonth as $key => $value) {
            //     $namaBulanss[] = $key;
            //     $namaBulan = array_unique($namaBulanss); 
            //     $jumlahBulan[] = count($value);
            // }

            $woddlist =  Wodlist::select('id', 'created_at')->get()->groupBy(function($woddlist) {
                return Carbon::parse($woddlist->created_at)->format('M');
            });
            foreach ($woddlist as $key => $value) {
                $namaBulan []= $key; 
                $jumlahBulan[] = count($value);
            }

    return view('admin.dashboard', compact( 'dataProjectMenang', 'projectAdmin', 'projectSales', 'dataProjectKalah', 'nama', 'jumlahNama', 'namaBulan', 'jumlahBulan'));
    }

    public function index(Request $request)
    {   
        
        // $admin = ListProjectAdmin::with("Pm")->get();
        if ($request->dari_tgl || $request->sampai_tgl || $request->Status) {
            // dd("ok");
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $admin = ListProjectAdmin::orderBy('created_at', 'desc')->with('userTechnikals.userTechnikal','userTechnikals.userPresale','userTechnikals.AM','Pm')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'like', "%" . $request->Status . "%")->paginate(10);
        } else {
            $admin = ListProjectAdmin::orderBy('created_at', 'desc')->with('userTechnikals.userTechnikal', 'userTechnikals.userPresale', 'userTechnikals.AM', "Pm")->paginate(10);
        }
    
        $prostat = ProgressStatus::all();

        return view('admin.index', [
            'admin' => $admin,
            'prostat' => $prostat,
            // "detailss" => $detailss,
            // "jumlah" => $jumlah,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    // public function dataCustomer()
    // {
    //     // $id = $request->id;
    //     // $data = Wodlist::with('sorder.userTechnikals.AM','sorder.userTechnikals.userPM','sorder.userTechnikals.userTechnikal','sopty.userTechnikalsPipe.userTechnikal','sopty.userTechnikalsPipe.userPM')->find($id);
    //     $dataCustomer = Customer::all();

    //     return response()->json($dataCustomer);
    // }

    public function create(Request $request)
    {
        // $dataPOAdmin = ListProjectAdmin::where('Status', $request->satatus)->get();

        // buat kode project
        // AD202281001
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
            $urutCus = 1001;
            $nomer = 'MIB'. $thBulan. $urut;  
            $nomerCustomer = 'CUM'. $urut;              
        }
        $admin = ListProjectAdmin::orderBy('created_at', 'DESC')->paginate(10);
        $pmLead = Role::with('users')->where("name", "PM")->get();
        $TechnikelLead = Role::with('users')->where("name", "Technikal")->get();
        $sales = Role::with('users')->where("name", "AM/Sales")->get();
        $customer = Customer::all();
        $principal = Principal::all();
        $distributor = Distributor::all();
        $prostat = ProgressStatus::all();
        
        // dd($customer);

        return view('admin.create', compact('admin', 'principal', 'distributor', 'prostat', 'pmLead', 'TechnikelLead', 'sales', 'nomer', 'nomer', 'nomerCustomer', 'customer'));
    }

    // function dwonload document bentuk zip
    public function downZip(Request $request)
    {
        if($request->has('download')) {
            $zip      = new ZipArchive;
            $fileName = 'document.zip';
            if ($zip->open(public_path(!$fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files(public_path('/storage'));
                // return $files;
                foreach ($files as $key => $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value, $relativeName);
                    
                }
            }
            return response()->download(public_path($fileName));
        }
    }

    public function store(Request $request)
    {
        
        $s = Role::with('users')->where('name', 'AM/Sales')->get();
        $sT = Role::with('users')->where('name', 'Technikal')->get();

        $idTechnikal = $request->sign_techLead;
        $idAm = $request->sign_am;
        $idPresale = $request->sign_presale;

    
        // return $idCustomer;
        $validator = Validator::make($request->all(),[
            'namaClient' => 'required',
            "NamaProject" =>'required',
            "UploadDocument"=> 'required',
            "Date" => 'required',
            // "Angka" => 'required',
            "Status" => 'required',
            //"sign_pmLead" =>'required',
            "principal" => 'required',
            "distributor" => 'required',
        ]);    
        
        if($validator->fails()) {
            return back()->with('error', 'Please provide all value!');
        }

         // data customer ambil data id nya berdasrkan request nama client
        $detailDataCustomer = Customer::where('nama', $request->namaClient)->get();
        foreach ($detailDataCustomer as $key => $value) {
            $idCustomer = $value->id;
        }

        NomerKodeProjectOrderOpties::create([
            "arr2" => $request->arr2
        ]);

        $admin = ListProjectAdmin::create([
            "NamaClient" => $request->namaClient,
            "NamaProject" => $request->NamaProject,
            'ID_Customer' => $request->idCustomer,
            "UploadDocument"=>  implode("," , $request->UploadDocument),
            "Date" => $request->Date,
            // "Angka" => $request->Angka,
            "Status" => $request->Status,
            "Note" => $request->Note,
           // "sign_Pm_id" => $request->sign_pmLead,
            "ID_project" => $request->ID_project,
            "ID_Customer" => $idCustomer,
            "principal" => $request->principal,
            "distributor" => $request->distributor,
            "name_user" => Auth::user()->name,
        ]);

        Wodlist::create([
            "salesorder_id" => $admin->id,
        ]);

        HistoryAdmin::create([
            "NamaClient" => $request->NamaClient,
            "NamaProject" => $request->NamaProject,
            "UploadDocument"=>  implode("," , $request->UploadDocument),
            "Date" => $request->Date,
            // "Angka" => $request->Angka,
            "Status" => $request->Status,
            "Note" => $request->Note,
            //"sign_Pm_id" => $request->sign_pmLead,
            "ID_project" => $request->ID_project,
            "ID_Customer" => $idCustomer,
            "principal" => $request->principal,
            "distributor" => $request->distributor,
            "name_user" => Auth::user()->name,
        ]);

        foreach ($request->input('UploadDocument', []) as $file) {
            $admin->addMedia(public_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }

        if (count($idTechnikal) > count($idAm)) {
            foreach ($idTechnikal as $key => $value) {
                UserHasListProjectAdmin::create([
                    "user_id_technikal" => $value,
                    // "user_id_pm" => $request->sign_pmLead,
                    "user_id_am" => $idAm[$key] ?? null,
                    "ListProjectAdmin_id" => $admin->id
                ]);
            }
        } else {
            foreach ($idAm as $key => $value) {
                UserHasListProjectAdmin::create([
                    "user_id_technikal" => $idTechnikal[$key] ?? null,
                    // "user_id_pm" => $request->sign_pmLead,
                    "user_id_am" => $value,
                    "ListProjectAdmin_id" => $admin->id
                ]);
            }
        }



        return redirect('adminproject')->with('success', 'Data berhasil di dibuat');
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

    public function show($id)
    {
        $angka = ListProjectAdmin::all()->count();
        $detailId = ListProjectAdmin::with('userTechnikals.userTechnikal', 'userTechnikals.AM')->find($id);

        return view('admin.show', compact('detailId', 'angka' ));
    }


    public function edit($id)
    {
        $angka = ListProjectAdmin::all()->count();
        $detailId = ListProjectAdmin::with('userTechnikals.userTechnikal', 'userTechnikals.AM')->find($id);
        $pmLead = Role::with('users')->where("name", "PM")->get();
        $TechnikelLead = Role::with('users')->where("name", "Technikal")->get();
        $sales = Role::with('users')->where("name", "AM/Sales")->get();
        $prostat = ProgressStatus::all();
        $principal = Principal::all();
        $distributor = Distributor::all();


        return view('admin.edit', [
            'detailId' => $detailId , 'UploadDocuments' => $detailId->getMedia($this->mediaCollection),
            'angka' => $angka,
            'pmLead' => $pmLead,
            'TechnikelLead' => $TechnikelLead,
            'sales' => $sales,
            'prostat' => $prostat,
            'principal' => $principal,
            'distributor' => $distributor
        ]);
    }


    public function update(Request $request, $id)
    {
        $updateData = ListProjectAdmin::with('UploadDocuments')->find($id);
        $users = UserHasListProjectAdmin::Where("ListProjectAdmin_id", $id)->get();
        
        $idTechnikal = $request->sign_techLead;
        $idAm = $request->sign_am;
        $idPresale = $request->sign_presale;

        // $validasi = [];
        // $validasi = co
        // return $validasi;

        $validator = Validator::make($request->all(),[ 
            // 'sign_techLead' => 'required',
            "sign_am" =>'required', 
            // "sign_presale" => 'required'
        ]); 

        if($validator->fails()) { 
            return back()->with('error', 'Please New Assign!'); 
        }

        // if (count($idTechnikal) < 0) {
        //     return back()->with('error', 'Please New Assign Technikal atau Presales!'); 
        // }
        
            // kemudian hapus data yang sudah ada / agar buat data baru lagi
            if ($idTechnikal || $idAm  || $idPresale) {
                foreach ($users as $key => $value) {
                    UserHasListProjectAdmin::find($value->id)->delete();
                }
            }

            $updateData->update([
                "NamaClient" => $request->namaClient,
                "NamaProject" => $request->NamaProject,
                // "UploadDocument"=>  implode("," , $request->UploadDocument),
                "Date" => $request->Date,
                "Angka" => $request->Angka,
                "Status" => $request->Status,
                "Note" => $request->Note,
                "sign_Pm_id" => $request->sign_pmLead ?? null,
                "principal" => $request->principal,
                "distributor" => $request->distributor,
                "name_user" => Auth::user()->name,
            ]);

            HistoryAdmin::create([
                "NamaClient" => $request->namaClient,
                "NamaProject" => $request->NamaProject,
                "UploadDocument"=>  implode("," , $request->UploadDocument),
                "Date" => $request->Date,
                "Angka" => $request->Angka,
                "Status" => $request->Status,
                "Note" => $request->Note,
                "sign_Pm_id" => $request->sign_pmLead,
                "ID_project" => $request->ID_project,
                "ID_Customer" => $request->IDCustomer,
                "principal" => $request->principal,
                "distributor" => $request->distributor,
                "name_user" => Auth::user()->name,
            ]);

            if ($idTechnikal && $idAm && $idPresale) {
                if (count($idTechnikal) > count($idAm)) { 
                    if (count($idPresale) > count($idTechnikal)) {
                        foreach ($idPresale as $key => $value) {
                            UserHasListProjectAdmin::create([
                                "user_id_technikal" => $idTechnikal[$key] ?? null,
                               // "user_id_pm" => $request->sign_pmLead,
                                "user_id_presale" => $value,
                                "user_id_am" => $idAm[$key] ?? null,
                                "ListProjectAdmin_id" => $id
                            ]);
                        }
                    } else {
                        foreach ($idTechnikal as $key => $value) {
                            UserHasListProjectAdmin::create([
                                "user_id_technikal" => $value,
                               // "user_id_pm" => $request->sign_pmLead,
                                "user_id_presale" => $idPresale[$key] ?? null,
                                "user_id_am" => $idAm[$key] ?? null,
                                "ListProjectAdmin_id" => $id
                            ]);
                        }
                    }
                    
                } else {
                    if (count($idPresale) > count($idAm)) {
                        foreach ($idPresale as $key => $value) {
                            UserHasListProjectAdmin::create([
                                "user_id_technikal" => $idTechnikal[$key] ?? null,
                               // "user_id_pm" => $request->sign_pmLead,
                                "user_id_presale" => $value,
                                "user_id_am" => $idAm[$key] ?? null,
                                "ListProjectAdmin_id" => $id
                            ]);
                        }
                    } else {
                        foreach ($idAm as $key => $value) {
                            UserHasListProjectAdmin::create([
                                "user_id_technikal" => $idTechnikal[$key] ?? null,
                               // "user_id_pm" => $request->sign_pmLead,
                                "user_id_presale" => $idPresale[$key] ?? null,
                                "user_id_am" => $value,
                                "ListProjectAdmin_id" => $id
                            ]);
                        }
                    }
                    
                }
            } elseif ($idTechnikal && $idAm ) {
                if (count($idTechnikal) > count($idAm)) {
                    foreach ($idTechnikal as $key => $value) {
                        UserHasListProjectAdmin::create([
                            "user_id_technikal" => $value,
                           // "user_id_pm" => $request->sign_pmLead,
                            "user_id_am" => $idAm[$key] ?? null,
                            "ListProjectAdmin_id" => $id
                        ]);
                    }
                } else {
                    foreach ($idAm as $key => $value) {
                        UserHasListProjectAdmin::create([
                            "user_id_technikal" => $idTechnikal[$key] ?? null,
                           // "user_id_pm" => $request->sign_pmLead,
                            "user_id_am" => $value,
                            "ListProjectAdmin_id" => $id
                        ]);
                    }
                }
            } else {
                if (count($idPresale) > count($idAm)) {
                    foreach ($idPresale as $key => $value) {
                        UserHasListProjectAdmin::create([
                            "user_id_presale" => $value,
                           // "user_id_pm" => $request->sign_pmLead,
                            "user_id_am" => $idAm[$key] ?? null,
                            "ListProjectAdmin_id" => $id
                        ]);
                    }
                } else {
                    foreach ($idAm as $key => $value) {
                        UserHasListProjectAdmin::create([
                            "user_id_presale" => $idPresale[$key] ?? null,
                           // "user_id_pm" => $request->sign_pmLead,
                            "user_id_am" => $value,
                            "ListProjectAdmin_id" => $id
                        ]);
                    }
                }
            }

            
            if (count($updateData->UploadDocuments) > 0) {
                foreach ($updateData->UploadDocuments as $media) {
                    if (!in_array($media->file_name, $request->input('UploadDocument', []))) {
                        $media->delete();
                    }
                }
            }
            
            $media = $updateData->UploadDocuments->pluck('file_name')->toArray();
            
            foreach ($request->input('UploadDocument', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $updateData->addMedia(public_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
                }
            }

        return redirect('/adminproject')->with('success', 'data berhasil di edit');
    }

    public function destroy($id)
    {
        
        $so = ListProjectAdmin::find($id);
        $kp = $so->ID_project; // 2 -> tabel salesorder
        $kdp = NomerKodeProjectOrderOpties::all();
        $userHasListProjectAdmin = UserHasListProjectAdmin::all();
        $soidp = Wodlist::all();
        
        foreach ($kdp as $key => $value) {
            if ($kp ==  $value->arr2) {
                // return $value->arr2;
                ListProjectAdmin::find($id)->delete();
                NomerKodeProjectOrderOpties::find($value->id)->delete();
            }
        }

        foreach ($userHasListProjectAdmin as $key => $value) {
            if ($value->ListProjectAdmin_id == $so->id) {
                UserHasListProjectAdmin::find($value->id)->delete();
            }
        }

        foreach ($soidp as $key => $v) {
            if ($so->id ==  $v->salesorder_id) {
                // return $v->salesopty_id;
                Wodlist::find($v->id)->delete();
            }
        }

        return back()->with('success', 'data berhasil di hapus');

    }


}


// Ide baru daru update
// 1. jika am nya isi nya cuman satu, maka harus ngebuat am di table di list projectadmin;mtapi jika lebih dari satu maka masukin di tabel userhasproject admin