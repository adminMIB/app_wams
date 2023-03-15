<?php

namespace App\Http\Controllers;

use App\Exports\ContohExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContohController extends Controller
{
    public function index()
	{
		$contoh = User::all();
		return view('siswa',['siswa'=>$contoh]);
	}
 
	public function export_excel()
	{
		return Excel::download(new ContohExport, 'contoh.xlsx');
	}
}


