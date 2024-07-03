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
            'totalDataLastyear' => $totalLastYear,
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
            'totalLastYear' => $totalLastYear,
            'percentageThisYear' => $percentageChange,
            'percentageLastYear' => $percentageLastYear,
            'status' => $status
        ]);
    }

    public function statisticCard()
    {
        $querySummary = DB::table('project_makers')
            ->select(DB::raw('
                SUM(CASE WHEN category = \'delivery\' THEN nominal ELSE 0 END) as total_delivery,
                SUM(CASE WHEN category = \'end_user\' THEN nominal ELSE 0 END) as total_end_user,
                SUM(CASE WHEN category = \'service\' THEN nominal ELSE 0 END) as total_service,
                CAST(SUM(CASE WHEN jenis_transaksi = \'transfer\' THEN nominal ELSE 0 END) AS INTEGER) as total_transfer,
                CAST(SUM(CASE WHEN jenis_transaksi = \'cash\' THEN nominal ELSE 0 END) AS INTEGER) as total_cash,
                CAST(SUM(CASE WHEN jenis_transaksi = \'PO\' THEN nominal ELSE 0 END) AS INTEGER) as total_po
            '))
            ->first();

        // Query untuk nama penerima
        $queryByNamaPenerima = DB::table('project_makers')
            ->select('nama_tujuan as title', DB::raw('SUM(nominal) as total'))
            ->groupBy('title')
            ->get()
            ->map(function ($row) {
                $row->icon = 'ti ti-arrows-transfer-up ti-sm';
                return $row;
            });

        // Query untuk project
        $queryByProject = DB::table('project_makers')
            ->join('projects', 'project_makers.project_id', '=', 'projects.id')
            ->join('opties', 'projects.opty_id', '=', 'opties.id')
            ->select('opties.project_name as title', DB::raw('SUM(project_makers.nominal) as total'))
            ->groupBy('opties.project_name')
            ->get()
            ->map(function ($row) {
                $row->icon = 'ti ti-arrows-transfer-up ti-sm';
                return $row;
            });

        // Data component
        $dataComponent = [
            [
                'icon' => 'ti ti-arrows-transfer-up ti-sm',
                'title' => 'Delivery',
                'total' => $querySummary->total_delivery,
            ],
            [
                'icon' => 'ti ti-arrows-transfer-up ti-sm',
                'title' => 'End User',
                'total' => $querySummary->total_end_user,
            ],
            [
                'icon' => 'ti ti-arrows-transfer-up ti-sm',
                'title' => 'Services',
                'total' => $querySummary->total_service,
            ],
        ];

        // Data jenis transaksi
        $dataJenisTransaction = [
            [
                'icon' => 'ti ti-arrows-transfer-up ti-sm',
                'title' => 'Cash',
                'total' => $querySummary->total_cash,
            ],
            [
                'icon' => 'ti ti-arrows-transfer-up ti-sm',
                'title' => 'Transfer',
                'total' => $querySummary->total_transfer,
            ],
            [
                'icon' => 'ti ti-arrows-transfer-up ti-sm',
                'title' => 'PO',
                'total' => $querySummary->total_po,
            ],
        ];

        // Mengembalikan data sebagai JSON response
        return response()->json([
            'component' => $dataComponent,
            'jenis_transaction' => $dataJenisTransaction,
            'nama_penerima' => $queryByNamaPenerima,
            'projects' => $queryByProject
        ]);
    }

    public function getProjectMakerByQuarter(Request $request)
    {
        try {
            $query = DB::table('project_makers')
                ->join('projects', 'project_makers.project_id', '=', 'projects.id')
                ->join('opties', 'projects.opty_id', '=', 'opties.id')
                ->select(
                    'project_makers.tanggal',
                    'project_makers.jenis_transaksi',
                    'project_makers.category',
                    'opties.project_name',
                    'project_makers.nama_tujuan',
                    'project_makers.nominal'
                );

            // Filtering berdasarkan quarter dan year
            if ($request->has('quarter') && $request->has('year')) {
                $quarter = $request->quarter;
                $year = $request->year;

                // Validasi parameter year
                if (!is_numeric($year) || strlen($year) != 4) {
                    throw new \Exception('Invalid year format');
                }

                // Validasi parameter quarter
                if (!in_array($quarter, [1, 2, 3, 4])) {
                    throw new \Exception('Invalid quarter');
                }

                switch ($quarter) {
                    case 1:
                        $start_date = "$year-01-01";
                        $end_date = "$year-03-31";
                        break;
                    case 2:
                        $start_date = "$year-04-01";
                        $end_date = "$year-06-30";
                        break;
                    case 3:
                        $start_date = "$year-07-01";
                        $end_date = "$year-09-30";
                        break;
                    case 4:
                        $start_date = "$year-10-01";
                        $end_date = "$year-12-31";
                        break;
                }

                // Log nilai tanggal untuk debugging
                \Log::info("Filtering by date range: $start_date to $end_date");

                $query->whereBetween('project_makers.tanggal', [$start_date, $end_date]);
            }

            $results = $query->paginate(15);

            return response()->json([
                'content' => [
                    'data' => $results->items(),
                    'current_page' => $results->currentPage(),
                    'per_page' => $results->perPage(),
                    'total' => $results->total(),
                ]
            ]);
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error fetching project makers by quarter: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
