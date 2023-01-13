<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CorporateController extends Controller
{
    public function index() {
        return view("corporate.dashboard");
    }
}
