<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $data = SalesOrder::all();
        return view('UM.approval', compact('data'));
    }

    public function show($id)
    {
        $detailId = SalesOrder::find($id);

        return view('UM.detailapproval', compact('detailId'));
    }
}
