<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Opty;
use App\Models\Principal;
use App\Models\Project;
use App\Models\ProjectMaker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;


class ProjectController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('projects')
                ->whereNotNull('projects.principal_id')
                ->join('principals', 'projects.principal_id', '=', 'principals.id')
                ->leftJoin('opties', 'projects.opty_id', '=', 'opties.id')
                ->leftJoin('customers', 'opties.customer_id', '=', 'customers.id')
                ->select(
                    'projects.id',
                    'projects.id_project',
                    'opties.project_name',
                    'customers.name as customer_name',
                    'principals.name as principal_name',
                    'projects.total_final',
                    'projects.created_at'
                )
                ->latest('projects.id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->addColumn('total_final', function ($val) {
                    return "Rp " . number_format($val->total_final);
                })
                ->filter(function ($query) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($subQuery) use ($searchValue) {
                            $subQuery->where('projects.id_project', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('opties.project_name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('principals.name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('customers.name', 'LIKE', '%' . $searchValue . '%');
                        });
                    }

                    if ($request->customer && !empty($request->customer)) {
                        $query->where('opties.customer_id', $request->customer);
                    }

                    if ($request->principal && !empty($request->principal)) {
                        $query->where('projects.principal_id', $request->principal);
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        $principal = Principal::select('id', 'name')->get();
        $customer = Customer::select('id', 'name')->get();

        return view('dashboard.projects.index', compact('principal', 'customer'));
    }

    public function edit($id)
    {
        $principal = Principal::all();
        $project = DB::table('projects')
            ->join('opties', 'projects.opty_id', '=', 'opties.id')
            ->select('projects.*', 'opties.project_name', 'opties.customer_id')
            ->where('projects.id', $id)
            ->first();

        $customer = Customer::find($project->customer_id)->select('name');
        $component = ['delivery', 'end_user', 'service', 'wapu'];

        return view('dashboard.projects.edit', compact(
            'principal',
            'project',
            'customer',
            'component'
        ));
    }

    public function show($id)
    {
        $data = DB::table('projects')
            ->join('principals', 'projects.principal_id', '=', 'principals.id')
            ->leftJoin('opties', 'projects.opty_id', '=', 'opties.id')
            ->leftJoin('customers', 'opties.customer_id', '=', 'customers.id')
            ->select(
                'projects.id',
                'projects.id_project',
                'opties.project_name as project',
                'customers.name as customer',
                'principals.name as principal',
                'projects.bmt',
                'projects.component',
                'projects.end_user',
                'projects.delivery',
                'projects.wapu',
                'projects.service',
                'projects.subtotal',
                'projects.bunga_admin',
                'projects.biaya_admin',
                'projects.biaya_pengurangan',
                'projects.total_final as total_nominal_project',
                'projects.created_at as dibuat_pada',
            )
            ->where('projects.id', $id)
            ->first();

        $sum_tm = ProjectMaker::whereIn('project_id', [$data->id])->sum('nominal');
        $data_tm = ProjectMaker::whereIn('project_id', [$data->id])->orderBy('id', 'desc')->get();

        $total_usage = $data->total_nominal_project - $sum_tm;

        $data->dibuat_pada = Carbon::parse($data->dibuat_pada)->translatedFormat('Y-m-d H:i:s');
        $data->total_nominal_project = "Rp. " . number_format($data->total_nominal_project);
        $data->bmt = "Rp. " . number_format($data->bmt);
        $data->end_user = "Rp. " . number_format($data->end_user);
        $data->delivery = "Rp. " . number_format($data->delivery);
        $data->service = "Rp. " . number_format($data->service);
        $data->wapu = "Rp. " . number_format($data->wapu);
        $data->biaya_admin = "Rp. " . number_format($data->biaya_admin);
        $data->bunga_admin = $data->bunga_admin . ' %';
        $data->subtotal = "Rp. " . number_format($data->subtotal);
        $data->biaya_pengurangan = "Rp. " . number_format($data->biaya_pengurangan);
        $data->component = json_decode($data->component);

        if ($data) {
            $project = (array) $data;
        } else {
            $project = [];
        }

        $projectData = DB::table('projects')
            ->join('opties', 'projects.opty_id', '=', 'opties.id')
            ->select('projects.id', 'opties.project_name')
            ->where('projects.id', '!=', $id)
            ->get();

        $optyData = Opty::where('is_moved', false)->get(['id', 'project_name']);


        return view("dashboard.projects.show", compact(
            "project",
            "sum_tm",
            "data_tm",
            "total_usage",
            'projectData',
            'optyData'
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            $message = "";

            $project = Project::find($id);
            $opty = Opty::find($project->opty_id);

            if (empty($project->principal_id)) {
                $message = 'Berhasil menambah data project ' . $opty->project_name;
            } else {
                $message = 'Berhasil merubah data project ' . $opty->project_name;
            }

            $requestAll = $request->all();

            // cleansing data before save to db
            if (!empty($request->file)) {
                $path = public_path('uploads/projects');

                $pathFile = $path . '/' . $project->file;

                if (file_exists($pathFile)) {
                    unlink($pathFile);
                }

                $requestAll['file'] = $this->save_file($request->file('file'));
            }

            $requestAll['component']    = json_encode($request->component);
            $requestAll['bmt']          = str_replace([".", ", "], "", $request->bmt);
            $requestAll['delivery']     = str_replace([".", ", "], "", $request->delivery);
            $requestAll['end_user']     = str_replace([".", ", "], "", $request->end_user);
            $requestAll['service']      = str_replace([".", ", "], "", $request->service);
            $requestAll['wapu']         = str_replace([".", ", "], "", $request->wapu);

            $project->update($requestAll);

            return redirect('/project')->with([
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating opty: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function check_id_project(Request $request)
    {
        $project = Project::where('id_project', $request->q)->count();

        if ($project > 1) {
            return response()->json([
                "status" => false,
                "message" => "Project ID $request->q sudah ada, project id harus unique"
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Project ID tersedia"
        ]);
    }

    public function data_incomplete(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('projects')
                ->whereNull('projects.principal_id')
                ->join('opties', 'projects.opty_id', '=', 'opties.id')
                ->join('customers', 'opties.customer_id', '=', 'customers.id')
                ->select(
                    'projects.id',
                    'projects.id_project',
                    'opties.project_name',
                    'customers.name',
                    'projects.created_at'
                )
                ->latest('projects.id');

            return DataTables::of($data)
                ->addColumn('projects.created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $query->where(function ($subQuery) use ($searchValue) {
                            $subQuery->where('projects.id_project', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('opties.project_name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('customers.name', 'LIKE', '%' . $searchValue . '%');
                        });
                    }

                    if ($request->customer && !empty($request->customer)) {
                        $query->where('opties.customer_id', $request->customer);
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        $customer = DB::table('customers')->select('id', 'name')->get();

        return view('dashboard.projects.list-incomplete', compact('customer'));
    }

    private function save_file($request)
    {
        $path = public_path('uploads/projects');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $file = $request;
        $file_ext = $file->extension();
        $file_name = time() . '.' . $file_ext;
        $file->move($path, $file_name);

        return $file_name;
    }
}
