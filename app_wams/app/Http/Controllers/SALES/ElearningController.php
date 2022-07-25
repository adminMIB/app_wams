<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElearningController extends Controller
{
    public function index()
    {
        return view('SALES.elearning');
    }
}
