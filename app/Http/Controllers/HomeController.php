<?php

namespace App\Http\Controllers;

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
            ->select(DB::raw('
                SUM(CASE WHEN category = \'delivery\' THEN nominal ELSE 0 END) as total_delivery,
                SUM(CASE WHEN category = \'end_user\' THEN nominal ELSE 0 END) as total_end_user,
                SUM(CASE WHEN category = \'service\' THEN nominal ELSE 0 END) as total_service
            '));

        $query_group = DB::table('project_makers')
            ->select(DB::raw('DATE(tanggal) as tanggal'), 'nominal', 'category', 'nama_tujuan')
            ->groupBy(DB::raw('DATE(tanggal)'), 'nominal', 'category', 'nama_tujuan');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query_sum->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            $query_group->whereBetween('tanggal', [$request->start_date, $request->end_date]);
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
                        'nama_tujuan' => ucwords($item->nama_tujuan)
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
        $query_sum = DB::table('project_makers')
            ->select(DB::raw('
                SUM(CASE WHEN jenis_transaksi = \'transfer\' THEN nominal ELSE 0 END) as total_transfer,
                SUM(CASE WHEN jenis_transaksi = \'cash\' THEN nominal ELSE 0 END) as total_cash,
                SUM(CASE WHEN jenis_transaksi = \'PO\' THEN nominal ELSE 0 END) as total_po
            '));

        $query_group = DB::table('project_makers')
            ->select('jenis_transaksi', 'nominal', 'category', 'jenis_transaksi', DB::raw('DATE(tanggal) as tanggal'))
            ->groupBy('jenis_transaksi', 'nominal', 'category', DB::raw('DATE(tanggal)'));

        if ($request->has('start_date') && $request->has('end_date')) {
            $query_sum->whereBetween('tanggal', [$request->start_date, $request->end_date]);
            $query_group->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $data_sum = $query_sum->first();
        $data_sum->grand_total = $data_sum->total_transfer + $data_sum->total_cash + $data_sum->total_po;

        $data_group = $query_group->get()->groupBy('jenis_transaksi')->map(function ($items, $jenis_trx) {
            return [
                'jenis_trx' => ucwords($jenis_trx),
                'details' => $items->map(function ($item) {
                    return [
                        'nominal' => "IDR " . number_format($item->nominal),
                        'category' => ucwords(str_replace('_', ' ', $item->category)),
                        'tanggal' => Carbon::createFromFormat('Y-m-d', $item->tanggal)->isoFormat('D-MMMM-Y'),
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
}
