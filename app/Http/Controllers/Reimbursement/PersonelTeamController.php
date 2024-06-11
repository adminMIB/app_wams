<?php

namespace App\Http\Controllers\Reimbursement;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PersonelTeamController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('personel_teams')->select("id", "divisi", "name", "created_at")->latest('id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $instance->where(function ($query) use ($searchValue) {
                            $query->where('name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('no_npwp', 'LIKE', '%' . $searchValue . '%');
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('reimbursement.personelTeams.index');
    }
}
