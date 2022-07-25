<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListdController extends Controller
{
    public function index()
    {
        return view('UM.listd');
    }
}
