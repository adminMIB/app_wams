<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\ProgressStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListPAController extends Controller
{
    public function index(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $ds = ListProjectAdmin::with('userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'like', "%" . $request->Status . "%")->get();
        } else {
            $ds = ListProjectAdmin::with('userTechnikals.AM')->get();
        }
        $prostat = ProgressStatus::all();
        return view('SALES.listpadmin', compact('ds','prostat'));
    }
}
