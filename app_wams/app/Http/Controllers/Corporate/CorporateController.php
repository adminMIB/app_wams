<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\CreateProject;
use App\Models\TransactionMakerACDC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CorporateController extends Controller
{
    public function index() {

        // ambil nama principal
        $principal = DB::table('create_principals')->select('id', 'principal_name')->get();
        $namaProject = DB::table('opty_acdcs')->select('id', 'project_name')->get();

        


        return view("corporate.dashboard", compact('principal', 'namaProject'));
    }


    public function filterData(Request $request) {

        try {
            $validate = Validator::make($request->all(), [
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }
                // jika filter ALL
                if ($request->name_principal == 'all') {
                    $gatData =  CreateProject::get();

                    // DATA CHART PIE
                    // data princple Total BMT dan Service
                    $name_principle = 'ALL';
                    $totalBmt = $gatData->sum('bmt');
                    $totalService = $gatData->sum('services');

                    // data project
                    $getDataMakerAdc = TransactionMakerACDC::get();

                    $total_final = $gatData->sum('total_final'); // ini di ambil dari table createProject

                    if (!$getDataMakerAdc) {
                        $total_advance = 0;
                        $sisa_saldo = 0;
                    } else {
                        $total_advance = $getDataMakerAdc->sum('nominal');
                        $sisa_saldo = $total_final - $total_advance;
                    }

                    // DATA CHART BHART CHART , BAWWAH WKK
                    // Ambil semua prinsipal dari tabel CreateProject
                    // $principals = CreateProject::select('principal_name')->distinct()->get();
                    $principals = DB::table('create_projects')->select('id', 'principal_id')->distinct()->get();

                    $formattedData = [];

                    // V1
                    // // Loop melalui setiap prinsipal
                    // foreach ($principals as $principal) {
                    //     $totalProjects = CreateProject::where('principal_id', $principal->principal_id)->count();
                    //     $dataProject = DB::table('create_projects')->where('principal_id', $principals->principal_id)->first();
                    //     $namaPinciple = DB::table('create_principals')->where('id', $dataProject->principal_id)->first();



                    //     // Format data sesuai dengan struktur yang diinginkan
                    //     $formattedData[] = [
                    //         'name' => $namaPinciple->principal_name,
                    //         'y' => $totalProjects,
                    //         'drilldown' => $namaPinciple->principal_name, 
                    //     ];
                    // }

                    // V2
                    foreach ($principals as $principal) {
                        if ($principal->principal_id !== null) {
                            $totalProjects = CreateProject::where('principal_id', $principal->principal_id)->count();
                            $dataProject = DB::table('create_projects')->where('principal_id', $principal->principal_id)->first();
                            if ($dataProject) {
                                $namaPinciple = DB::table('create_principals')->where('id', $dataProject->principal_id)->first();
                                if ($namaPinciple) {
                                    // Format data sesuai dengan struktur yang diinginkan
                                    $formattedData[] = [
                                        'name' => $namaPinciple->principal_name,
                                        'y' => $totalProjects,
                                        'drilldown' => $namaPinciple->principal_name, 
                                    ];
                                }
                            }
                        }
                    }


                    return response()->json([$name_principle, $totalBmt, $totalService, $total_advance, $total_final, $sisa_saldo, $formattedData]);
                
                } else {


                    // DATA CHART PIE
                        $getDataPrincpal =  CreateProject::where('opty_acdc_id', $request->nama_project)->where('principal_id', $request->name_principal)->first();

                        $principal = DB::table('create_principals')->where('id', $request->name_principal)->first();

                        // Periksa apakah data ditemukan
                        if (!$getDataPrincpal) {
                            return response()->json(['status'=> false,'message' => 'Data tidak ditemukan'], 404);
                        }

                        // data chart Principal 
                        $name_principle = $principal->principal_name;
                        $bmt = $getDataPrincpal->bmt;
                        $services = $getDataPrincpal->services;
                        $getByIdProject =  $getDataPrincpal->id;

                        // ambil data nominal, di table berbeda
                        $getDataProjects = TransactionMakerACDC::where('cpt_id', $getDataPrincpal->id)->first();

                        // data chart Project
                        $total_advance = $getDataProjects->nominal ?? 0;
                        $total_final = $getDataPrincpal->total_final; // ini di ambil dari table createProject
                        // cek apakah data total advance / nominal ada?
                        if (!$getDataProjects) {
                            $sisa_saldo = 0;
                        } else {
                            $sisa_saldo = $total_final - $total_advance;
                        }
                        
                    
                        // // DATA CHART BHART CHART , BAWWAH WKK
                        $dataProjects = CreateProject::where('principal_id', $request->name_principal)->get();
                        $namaProject = DB::table('opty_acdcs')->where('id', $getDataPrincpal->opty_acdc_id)->first();
                        // dd($dataProjects);
                        $formattedData = [];
                
                        // Loop melalui setiap prinsipal
                        foreach ($dataProjects as $dataProject) {
                            // Ambil jumlah total proyek untuk prinsipal saat ini
                            // $totalProjects = CreateProject::where('project_name', $dataProject->project_name)->count();
                            $totalProjects = DB::table('opty_acdcs')->where('id', $dataProject->opty_acdc_id)->count();
                            
                            // Format data sesuai dengan struktur yang diinginkan
                            $formattedData[] = [
                                'name' => $namaProject->project_name,
                                'y' => $totalProjects,
                                'drilldown' => $namaProject->project_name, // Anda dapat menyesuaikan drilldown sesuai kebutuhan Anda
                            ];
                        }


                    // penting v2, gabung data // no di hapus. takut di butuhkan kembali jika request data berubah

                    // //  DATA CHART PIE
                    //     $getDataPrincpal =  CreateProject::where('principal_id', $request->name_principal)->get();

                    //     $principal = DB::table('create_principals')->where('id', $request->name_principal)->first();
                        
                    //     // Periksa apakah data ditemukan
                    //     if ($getDataPrincpal->isEmpty()) {
                    //         return response()->json(['status'=> false,'message' => 'Data tidak ditemukan'], 404);
                    //     }
                        
                    //     // data chart Principal 
                    //     $name_principle = $principal->principal_name;
                    //     $bmt = $getDataPrincpal->sum('bmt');
                    //     $services = $getDataPrincpal->sum('services');
                    //     // Jika ada lebih dari satu, kita tidak bisa langsung mengakses id, kita harus loop atau mengambil id yang diperlukan.
                    //     $getByIdProject = $getDataPrincpal->pluck('id'); 
                        
                    //     // ambil data nominal, di table berbeda
                    //     $getDataProjects = TransactionMakerACDC::whereIn('cpt_id', $getByIdProject)->get();
                        
                    //     // Hitung total_advance dari semua hasil yang ditemukan
                    //     $total_advance = $getDataProjects->sum('nominal');
                        
                    //     // Ambil total_final dari table createProject (Anda mungkin perlu menyesuaikan ini)
                    //     $total_final = $getDataPrincpal->sum('total_final');
                        
                    //     // cek apakah data total advance / nominal ada?
                    //     $sisa_saldo = $total_final - $total_advance;
                        
                    //     // // DATA CHART BHART CHART , BAWAH WKK
                    //     $dataProjects = CreateProject::where('principal_id', $request->name_principal)->get();
                    //     $formattedData = [];
                        
                    //     // Loop melalui setiap prinsipal
                    //     foreach ($dataProjects as $dataProject) {
                    //         $namaProject = DB::table('opty_acdcs')->where('id', $dataProject->opty_acdc_id)->first();
                    //         // Ambil jumlah total proyek untuk prinsipal saat ini
                    //         $totalProjects = DB::table('opty_acdcs')->where('id', $dataProject->opty_acdc_id)->count();
                            
                    //         // Format data sesuai dengan struktur yang diinginkan
                    //         $formattedData[] = [
                    //             'name' => $namaProject->project_name,
                    //             'y' => $totalProjects,
                    //             'drilldown' => $namaProject->project_name, // Anda dapat menyesuaikan drilldown sesuai kebutuhan Anda
                    //         ];
                    //     }



                    return response()->json([$name_principle, $bmt, $services, $total_advance, $total_final, $sisa_saldo, $getByIdProject, $formattedData]);

                }

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    
    }
}
