<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Opty;
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
                    "opties.created_at"
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
            $path = public_path('uploads/opty');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $file = $request->file('file');
            $file_ext = $file->getClientOriginalName();
            $file_name = time() . '-' . str_replace(" ", "_", $file_ext);
            $file->move($path, $file_name);

            $requestAll = $request->all();
            $requestAll['file'] = $file_name;
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

            $file = $request->file('file');
            $fileName = $opty->file;

            if (!empty($file)) {
                $path = public_path('uploads/opty');
                $pathFile = $path . '/' . $opty->file;

                if (file_exists($pathFile)) {
                    unlink($pathFile);
                }

                $file_ext = $file->getClientOriginalName();
                $fileName = time() . '-' . str_replace(" ", "_", $file_ext);
                $file->move($path, $fileName);
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
                "opties.code_opty as id_opty",
                "opties.project_name as project",
                "customers.name as customer_name",
                "opties.account_manager",
                "opties.revenue_sales",
                "opties.file",
                "opties.created_at"
            )
            ->where('opties.id', $id)
            ->first();

        if ($data) {
            $opty = (array) $data;
        } else {
            $opty = [];
        }

        $opty['created_at'] = Carbon::parse($opty['created_at'])->format('Y-m-d, H:i:s');
        $opty['revenue_sales'] = "Rp. " . number_format($opty['revenue_sales']);

        return view('dashboard.opty.detail', compact('opty'));
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
}
