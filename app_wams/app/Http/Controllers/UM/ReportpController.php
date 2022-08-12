<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use App\Models\WeeklyReport;
use Illuminate\Http\Request;

class ReportpController extends Controller
{
    public function index()
    {
        $datas = WeeklyReport::with('listp')->orderBy('created_at', 'ASC')->paginate();
        return view('UM.reportp', compact('datas'));
    }
}
