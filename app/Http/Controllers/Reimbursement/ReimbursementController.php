<?php

namespace App\Http\Controllers\Reimbursement;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Controllers\Reimbursement\export\Excel;



class ReimbursementController extends Controller
{
    use Excel;


    public function index(Request $request)
    {
        // Ambil data projects dari tabel opties
        $projects = DB::table('opties')->select('id', 'project_name')->latest('id')->get();

        // Query data reimbursements dengan menggunakan join ke opties
        if ($request->ajax()) {
            $data = DB::table('reimbursements')
                ->join('opties', 'reimbursements.nama_project', '=', 'opties.id') // Lakukan join dengan menggunakan nama_project dari reimbursements dan id dari opties
                ->join('customers', 'reimbursements.customer', '=', 'customers.id') 
                ->select(
                    'reimbursements.id',
                    'reimbursements.id_reimbursement',
                    'opties.project_name as nama_project', // Aliaskan 'project_name' dari 'opties' menjadi 'nama_project'
                    'reimbursements.pic_bussiness_channel',
                    'customers.name as customer', // Aliaskan 'project_name' dari 'opties' menjadi 'nama_project'
                    'reimbursements.keterangan',
                    'reimbursements.file',
                    'reimbursements.created_at'
                )
                ->latest('reimbursements.id');

            // Implementasikan DataTables untuk mengelola response
            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = strtolower($request->get('search')['value']);
                        $query->whereRaw('LOWER(opties.project_name) LIKE ?', ["%{$searchValue}%"])
                            ->orWhereRaw('LOWER(reimbursements.client) LIKE ?', ["%{$searchValue}%"]);
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('reimbursement.index', compact('projects'));
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'id_reimbursement'      => 'required',
            'nama_project'          => 'required',
            'pic_businees_channels' => 'required',
            'keterangan'            => 'required',
            'file'                  => 'required|file'
        ]);

        // ambil customer berdasarkan nama project
        $customer = DB::table('opties')->where('id', $request->nama_project)->first();

        try {
            $path = public_path('uploads/reimbursements');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $file = $request->file('file');
            $file_ext = $file->getClientOriginalName();
            $file_name = time() . '-' . str_replace(" ", "_", $file_ext);
            $file->move($path, $file_name);

            DB::table('reimbursements')->insert([
                "id_reimbursement"      => $request->id_reimbursement,
                "nama_project"          => $request->nama_project,
                "pic_bussiness_channel" => $request->pic_businees_channels,
                "customer"              => $customer->customer_id,
                "keterangan"            => $request->keterangan,
                "file"                  => $file_name,
                "created_at"            => Carbon::now(),
                "updated_at"            => Carbon::now()
            ]);

            return response()->json("Reimbursement created successfully")->setStatusCode(201);
        } catch (\Exception $e) {
            Log::error('Error creating reimbursement: '.$e->getMessage());
            return response()->json(["error" => "There was an error creating the reimbursement"], 500);
        }
    }
    

    // UPDATE DATA
    public function edit($id)
    {    
        $reimbursement = DB::table('reimbursements')
            ->where('reimbursements.id', $id)
            ->join('opties', 'reimbursements.nama_project', '=', 'opties.id')
            ->select(
                'reimbursements.id',
                'reimbursements.id_reimbursement',
                'opties.id as nama_project',
                'reimbursements.pic_bussiness_channel',
                'reimbursements.keterangan',
                'reimbursements.file',
                'reimbursements.created_at'
            )
            ->first();
    
        // Jika data tidak ditemukan, return response kosong atau response dengan pesan error
        if (!$reimbursement) {
            return response()->json(['error' => 'Reimbursement not found'], 404);
        }
    
        // Masukkan data projects dan reimbursement ke dalam satu array
        $data = [
            'reimbursement' => $reimbursement,
            'editMode' => true // Tambahkan informasi editMode true
        ];
    
        // Return data dalam format JSON
        return response()->json($data);
    }
    

    public function update(Request $request, $id)
    {

        $dataDefault = DB::table('reimbursements')->where('id', $id)->first();
    
        try {

            $file = $request->file('file');
            $fileName = $dataDefault->file;
            
            if (!empty($file)) {

                $path = public_path('uploads/reimbursements');
                $pathFile = $path . '/' . $dataDefault->file;
    
                if (file_exists($pathFile)) {
                    unlink($pathFile);
                }
    
                $file_ext = $file->getClientOriginalName();
                $fileName = time() . '-' . str_replace(" ", "_", $file_ext);
                $file->move($path, $fileName);
            }


            DB::table('reimbursements')->where('id', $id)->update([
                "id_reimbursement"      => $request->id_reimbursement,
                "nama_project"          => $request->nama_project,
                "pic_bussiness_channel" => $request->pic_businees_channels, // perbaikan typo
                "client"                => $request->client,
                "keterangan"            => $request->keterangan,
                "file"                  => $fileName ?? $dataDefault,
                "created_at"            => Carbon::now(),
                "updated_at"            => Carbon::now()
            ]);

            // Mengembalikan respons JSON sukses dengan data yang diperbarui
            return response()->json(['message' => 'Data berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            // Mengembalikan respons JSON dengan pesan error dan kode status HTTP yang sesuai
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // END UPDATE DATA

    public function show($id)
    {
        $projects = DB::table('opties')->select('id', 'project_name', 'customer_id' )->latest('id')->get();

        $personelTeams = DB::table('personel_teams')->select('id', 'name')->latest('id')->get();


        $dataIDReimbursements = DB::table('reimbursements')->select('id_reimbursement')->get();

        $reimbursement = DB::table('reimbursements')
                        ->where('reimbursements.id', $id)
                        ->join('opties', 'reimbursements.nama_project', '=', 'opties.id')
                        ->join('customers', 'reimbursements.customer', '=', 'customers.id') 
                        ->select(
                            'reimbursements.id',
                            'reimbursements.id_reimbursement',
                            'opties.project_name as nama_project',
                            'reimbursements.pic_bussiness_channel',
                            'customers.name as customer', // Aliaskan 'project_name' dari 'opties' menjadi 'nama_project'
                            'reimbursements.keterangan',
                            'reimbursements.file',
                            'reimbursements.created_at'
                        )
                        ->first();
        
        if ($reimbursement) {
            $reimbursement = (array) $reimbursement;
            $reimbursement['created_at'] = Carbon::parse($reimbursement['created_at'])->format('Y-m-d, H:i:s');
        } else {
            $reimbursement = [];
        }

        // Render view add-edit sebagai string HTML
        $addEditView = view('reimbursement.modalMaker.add-edit', compact('reimbursement', 'personelTeams'))->render();

        // Kirim view detail dengan view add-edit sebagai bagian dari data
        return view('reimbursement.detail', compact('reimbursement', 'addEditView', "projects", "dataIDReimbursements", "personelTeams"));
    }   



    public function destroy($id)
    {
        try {
            $personelTeams = DB::table('reimbursements')->where('id', $id)->first();

            if ($personelTeams) {
                DB::table('reimbursements')->where('id', $id)->delete();

                return response()->json("Reimbursements, berhasil dihapus");
            } else {
                return response()->json(['message' => 'Personel Teams not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    public function export($id)
    {
        // Ambil data project_internal berdasarkan ID
        $cpt = DB::table('reimbursements')
            ->where('reimbursements.id', $id)
            ->join('opties', 'reimbursements.nama_project', '=', 'opties.id')
            ->join('customers', 'reimbursements.customer', '=', 'customers.id')
            ->select(
                'reimbursements.id',
                'reimbursements.id_reimbursement',
                'opties.project_name as nama_project',
                'reimbursements.pic_bussiness_channel',
                'customers.name as customer',
                'reimbursements.keterangan',
                'reimbursements.file',
                'reimbursements.created_at'
            )
            ->first();

        if (!$cpt) {
            return response()->json(['error' => 'Reimbursment not found'], 404);
        }

        // Ambil data transactions_maker_internal berdasarkan id_project_internal
        $ctm = DB::table('transaction_maker_reimbursements')
            ->where('reimbursements_id', $id)
            ->join('personel_teams', 'transaction_maker_reimbursements.nama_pic_reimbursement', '=', 'personel_teams.id')
            ->select(
                'transaction_maker_reimbursements.id',
                'transaction_maker_reimbursements.tanggal_reimbursement as tanggal',
                'personel_teams.name as nama_pic',
                'transaction_maker_reimbursements.nominal_reimbursement as nominal',
                'transaction_maker_reimbursements.keterangan',

            )
            ->latest('transaction_maker_reimbursements.id')
            ->get();

        @unlink(public_path("/export/file-reimbursment.xlsx"));
        $headers = [
            'Content-Type' => 'application/xlsx',
        ];

        // Panggil fungsi doExportInternal dari trait Excel
        $export = self::doExportReimbursement($cpt, $ctm);

        return response()->download(public_path($export), 'file-reimbursmeent.xlsx', $headers)->deleteFileAfterSend(false);
    }


}
