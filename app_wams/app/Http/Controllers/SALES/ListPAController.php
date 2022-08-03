<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use Illuminate\Http\Request;

class ListPAController extends Controller
{
    public function index()
    {

        $ds = ListProjectAdmin::all();
        return view('SALES.listpadmin', compact('ds'));
    }
}
