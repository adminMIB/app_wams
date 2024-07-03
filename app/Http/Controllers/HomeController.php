<?php

namespace App\Http\Controllers;

use App\Models\ProjectMaker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getProjectsMakerDataPie(Request $request)
    {
        $query_sum = DB::table('project_makers')
            ->join('projects', 'project_makers.project_id', '=', 'projects.id')
            ->select(DB::raw('
                SUM(CASE WHEN project_makers.category = \'delivery\' THEN nominal ELSE 0 END) as total_delivery,
                SUM(CASE WHEN project_makers.category = \'end_user\' THEN nominal ELSE 0 END) as total_end_user,
                SUM(CASE WHEN project_makers.category = \'service\' THEN nominal ELSE 0 END) as total_service
            '));

        $query_group = DB::table('project_makers')
            ->join('projects', 'project_makers.project_id', '=', 'projects.id')
            ->join('opties', 'projects.opty_id', '=', 'opties.id')
            ->select(
                DB::raw('DATE(tanggal) as tanggal'),
                'project_makers.nominal',
                'project_makers.category',
                'project_makers.nama_tujuan',
                'opties.project_name',
                'projects.id_project'
            )->groupBy(
                DB::raw('DATE(tanggal)'),
                'project_makers.nominal',
                'project_makers.category',
                'project_makers.nama_tujuan',
                'opties.project_name',
                'projects.id_project'
            );

        if ($request->has('start_date') && $request->has('end_date')) {
            $query_sum->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            $query_group->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->has('projectId')) {
            $query_sum->where('projects.id', $request->projectId);
            $query_group->where('projects.id', $request->projectId);
        }

        $data_sum = $query_sum->first();
        $data_sum->grand_total = $data_sum->total_delivery + $data_sum->total_end_user + $data_sum->total_service;

        $data_group = $query_group->get()->groupBy('tanggal')->map(function ($items, $tanggal) {
            return [
                'tanggal_transaksi' => Carbon::createFromFormat('Y-m-d', $tanggal)->isoFormat('D-MMMM-Y'),
                'details' => $items->map(function ($item) {
                    return [
                        'nominal' => "IDR " . number_format($item->nominal),
                        'category' => ucwords(str_replace('_', ' ', $item->category)),
                        'nama_tujuan' => ucwords($item->nama_tujuan),
                        'project' => $item->project_name,
                        'id_project' => $item->id_project
                    ];
                }),
                'total_nominal' => "IDR " .  number_format($items->sum('nominal')),
            ];
        })->values();

        return response()->json([
            "content" => [
                'data_sum' => $data_sum,
                'data_group' => $data_group
            ]
        ]);
    }

    public function getProjectMakerDataBar(Request $request)
    {
        // Build the base query for summing nominal values
        $query_sum = DB::table('project_makers')
            ->join('projects', 'project_makers.project_id', '=', 'projects.id')
            ->select(DB::raw('
                CAST(SUM(CASE WHEN project_makers.jenis_transaksi = \'transfer\' THEN nominal ELSE 0 END) AS INTEGER) as total_transfer,
                CAST(SUM(CASE WHEN project_makers.jenis_transaksi = \'cash\' THEN nominal ELSE 0 END) AS INTEGER) as total_cash,
                CAST(SUM(CASE WHEN project_makers.jenis_transaksi = \'PO\' THEN nominal ELSE 0 END) AS INTEGER) as total_po
        '));

        // Build the base query for grouping data
        $query_group = DB::table('project_makers')
            ->join('projects', 'project_makers.project_id', '=', 'projects.id')
            ->join('opties', 'projects.opty_id', '=', 'opties.id')
            ->select(
                'project_makers.jenis_transaksi',
                'project_makers.nominal',
                'project_makers.category',
                'opties.project_name',
                'projects.id_project',
                DB::raw('DATE(tanggal) as tanggal')
            )->groupBy(
                'project_makers.jenis_transaksi',
                'project_makers.nominal',
                'project_makers.category',
                'opties.project_name',
                'projects.id_project',
                DB::raw('DATE(tanggal)')
            );

        // Apply filters if present
        if ($request->has('start_date') && $request->has('end_date')) {
            $query_sum->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            $query_group->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->has('projectId')) {
            $query_sum->where('projects.id', $request->projectId);
            $query_group->where('projects.id', $request->projectId);
        }

        // Fetch and process summed data
        $data_sum = $query_sum->first();
        $data_sum->grand_total = $data_sum->total_transfer + $data_sum->total_cash + $data_sum->total_po;

        // Fetch and process grouped data
        $data_group = $query_group->get()->groupBy('jenis_transaksi')->map(function ($items, $jenis_trx) {
            return [
                'jenis_trx' => ucwords($jenis_trx),
                'details' => $items->map(function ($item) {
                    return [
                        'nominal' => "IDR " . number_format($item->nominal),
                        'project' => $item->project_name,
                        'category' => ucwords(str_replace('_', ' ', $item->category)),
                        'tanggal' => Carbon::createFromFormat('Y-m-d', $item->tanggal)->isoFormat('D-MMMM-Y'),
                        'id_project' => $item->id_project
                    ];
                }),
                'total_nominal' => "IDR " . number_format($items->sum('nominal')),
            ];
        })->values();

        // Return the response
        return response()->json([
            'content' => [
                'data_sum' => $data_sum,
                'data_group' => $data_group
            ]
        ]);
    }

    public function getAllProject()
    {
        $project = DB::table('projects')
            ->join('opties', 'projects.opty_id', '=', 'opties.id')
            ->select(
                'projects.id',
                'projects.id_project as code',
                'opties.project_name as name',
            )
            ->orderBy('projects.created_at', 'DESC')->get();

        return response()->json($project);
    }

    public function percentageTotalDataProjectMaker()
    {
        $currentYear = Carbon::now()->year;
        $lastYear = Carbon::now()->subYear()->year;
        
        $totalThisYear = ProjectMaker::whereYear('tanggal', $currentYear)->count();
        $totalLastYear = ProjectMaker::whereYear('tanggal', $lastYear)->count();
        
        if ($totalLastYear > 0) {
            $percentageChange = (($totalThisYear - $totalLastYear) / $totalLastYear) * 100;
        } else {
            $percentageChange = $totalThisYear > 0 ? 100 : 0;
        }
        
        $percentageLastYear = $totalLastYear > 0 ? ($totalLastYear / $totalThisYear) * 100 : 0;
        
        $status = $percentageChange >= 0 ? 'positif' : 'negatif';
        
        return response()->json([
            'totalDataThisYear' => $totalThisYear,
            'percentageThisYear' => $percentageChange,
            'percentageLastYear' => $percentageLastYear,
            'status' => $status
        ]);
        
    }

    public function percentageTotalNominalProjectMaker()
    {
        $currentYear = Carbon::now()->year;
        $lastYear = Carbon::now()->subYear()->year;

        $totalThisYear = ProjectMaker::whereYear('tanggal', $currentYear)->sum('nominal');
        $totalLastYear = ProjectMaker::whereYear('tanggal', $lastYear)->sum('nominal');
        
        if ($totalLastYear > 0) {
            $percentageChange = (($totalThisYear - $totalLastYear) / $totalLastYear) * 100;
        } else {
            $percentageChange = $totalThisYear > 0 ? 100 : 0;
        }
        
        $percentageLastYear = $totalLastYear > 0 ? ($totalLastYear / $totalThisYear) * 100 : 0;
        
        $status = $percentageChange >= 0 ? 'positif' : 'negatif';

        return response()->json([
            'totalNominalThisYear' => $totalThisYear,
            'percentageThisYear' => $percentageChange,
            'percentageLastYear' => $percentageLastYear,
            'status' => $status
        ]);
    }
}
