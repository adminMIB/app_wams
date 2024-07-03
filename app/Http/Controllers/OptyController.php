<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Opty;
use App\Models\OptyMaker;
use App\Models\Project;
use App\Models\ProjectMaker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class OptyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('opties')
                ->join("customers", "opties.customer_id", "customers.id")
                ->select(
                    "opties.id",
                    "opties.code_opty",
                    "opties.project_name",
                    "customers.name",
                    "opties.account_manager",
                    "opties.revenue_sales",
                    "opties.created_at",
                    'opties.is_moved'
                )
                ->where('opties.is_moved', $request->is_moved)
                ->latest('opties.id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->addColumn('revenue_sales', function ($val) {
                    return 'Rp ' . number_format($val->revenue_sales);
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $instance->where(function ($query) use ($searchValue) {
                            $query->where('opties.project_name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('opties.code_opty', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('customers.name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('opties.account_manager', 'LIKE', '%' . $searchValue . '%');
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.opty.index');
    }

    public function create()
    {
        $customer = Customer::all();

        return view('dashboard.opty.add-edit', compact('customer'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code_opty' => 'required',
            'project_name' => 'required',
            'account_manager' => 'required',
            'customer_id' => 'required',
            'revenue_sales' => 'required',
            'file' => 'required|max:5120',
        ]);

        try {
            $requestAll = $request->all();
            $requestAll['file'] = $this->saveFile($request->file('file'));
            $requestAll['revenue_sales'] = str_replace([".", ","], "", $request->revenue_sales);

            $insert = Opty::create($requestAll);

            return redirect(route('opty.index'))->with([
                'success' => "<strong>$insert->project_name</strong> berhasil ditambahkan"
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code_opty' => 'required',
            'project_name' => 'required',
            'account_manager' => 'required',
            'customer_id' => 'required',
            'revenue_sales' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        try {
            $opty = Opty::find($id);
            if (!$opty) {
                return redirect()->back()->with('error', 'Opty not found');
            }

            $fileName = $opty->file;
            $path = public_path('uploads/opty');
            if ($request->hasFile('file')) {
                $fileLama = $opty->file;

                if (!empty($fileLama)) {
                    $pathFile = $path . '/' . $fileLama;
                    if (file_exists($pathFile)) {
                        unlink($pathFile);
                    }
                }

                $fileName = $this->saveFile($request->file('file'));
            }

            $data = $request->all();
            $data['file'] = $fileName;
            $data['revenue_sales'] = str_replace([".", ","], "", $request->revenue_sales);

            $opty->update($data);

            return redirect(route('opty.index'))->with([
                'success' => "<strong>$opty->project_name</strong> berhasil diubah"
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating opty: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit($id)
    {
        $opty = Opty::find($id);
        $customer = Customer::all();

        return view('dashboard.opty.add-edit', compact('opty', 'customer'));
    }

    public function show($id)
    {
        $data = DB::table('opties')
            ->join("customers", "opties.customer_id", "=", "customers.id")
            ->select(
                "opties.id",
                "opties.code_opty as id_opty",
                "opties.project_name as project",
                "customers.name as customer_name",
                "opties.account_manager",
                "opties.revenue_sales",
                "opties.file",
                "opties.created_at",
                "opties.is_moved"
            )
            ->where('opties.id', $id)
            ->first();

        $sum_tm = OptyMaker::whereIn('opty_id', [$data->id])->sum('nominal_trx');

        $total_usage = $data->revenue_sales - $sum_tm;

        if ($data) {
            $opty = (array) $data;
        } else {
            $opty = [];
        }

        $opty['created_at'] = Carbon::parse($opty['created_at'])->format('Y-m-d, H:i:s');
        $opty['revenue_sales'] = "Rp. " . number_format($opty['revenue_sales']);

        $optyMaker =  OptyMaker::whereIn('opty_id', [$data->id])->orderBy('id', 'desc')->get();

        return view('dashboard.opty.detail', compact('opty', 'optyMaker', 'total_usage', 'sum_tm'));
    }

    public function destroy($id)
    {
        try {
            $opty = Opty::find($id);

            $path = public_path('uploads/opty');
            $pathFile = $path . '/' . $opty->file;

            if (file_exists($pathFile)) {
                unlink($pathFile);
            }

            $opty->delete();

            return response()->json("Project Opty $opty->project_name berhasil dihapus");
        } catch (\Exception $e) {
            return response()->json($e->getMessage())->setStatusCode(500);
        }
    }

    public function move_to_project(Request $request, $opty_id)
    {
        DB::beginTransaction();
        try {
            $opty = Opty::find($opty_id);
            $project = Project::create([
                'id_project' => $request->id_project,
                'opty_id' => $opty_id
            ]);

            OptyMaker::where('opty_id', $opty_id)->chunk(1000, function ($optyMakers) use ($project) {
                $insertData = [];
                foreach ($optyMakers as $row) {
                    $insertData[] = [
                        "project_id" => $project->id,
                        "tanggal" => $row->date_trx,
                        "jenis_transaksi" => $row->jenis_trx,
                        "nama_tujuan" => $row->nama_penerima,
                        "nominal" => $row->nominal_trx,
                        "keterangan" => $row->keterangan,
                        "category" => $row->category,
                        "file" => !empty($row->file) ? $row->file : '',
                        "created_at" => $row->created_at,
                        "updated_at" => $row->updated_at
                    ];

                    // File processing
                    if (!empty($row->file)) {
                        $source_path = public_path("uploads/opty-maker/{$row->file}");
                        $destination = public_path("uploads/projects-maker/{$row->file}");

                        if (File::exists($source_path)) {
                            $destination_directory = dirname($destination);
                            if (!File::exists($destination_directory)) {
                                File::makeDirectory($destination_directory, 0755, true, true);
                            }

                            File::copy($source_path, $destination);
                        } else {
                            Log::warning("File tidak ditemukan: $source_path");
                        }
                    }
                }
                // Batch insert
                ProjectMaker::insert($insertData);
            });

            $opty->update(['is_moved' => true]);

            DB::commit();

            return redirect('/project/' . $project->id . '/edit')->with([
                'message' => "Berhasil memindah data Opty $opty->project_name ke Project",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function saveFile($request)
    {
        $path = public_path('uploads/opty');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $file = $request;
        $file_ext = $file->getClientOriginalName();
        $file_name = time() . '-' . str_replace(" ", "_", $file_ext);
        $file->move($path, $file_name);

        return $file_name;
    }

    public function getOptyByTerm(Request $request)
    {
        $q = $request->term;
        $data = Opty::where('is_moved', false)
            ->orWhere('code_opty', 'LIKE', '%' . $q . '%')
            ->orWhere('project_name', 'LIKE', '%' . $q . '%')
            ->get(['id', 'project_name']);

        return response()->json(['content' => $data]);
    }
}
