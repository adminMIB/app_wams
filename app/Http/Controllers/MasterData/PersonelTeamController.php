<?php

namespace App\Http\Controllers\MasterData;

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
                            $loweredSearchValue = strtolower($searchValue); 
                            $query->where(DB::raw('LOWER(divisi)'), 'LIKE', '%' . $loweredSearchValue . '%')
                                ->orWhere(DB::raw('LOWER(name)'), 'LIKE', '%' . $loweredSearchValue . '%');
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.master-data.personelTeams.index');
    }

    // D:\app\mib-2024\acdc\wams-acdc\resources\views\dashboard\master-data\personelTeams


    public function store(Request $request)
    {
        $this->validate($request, [
            'divisi' => 'required',
            'name'   => 'required',
        ]);

        try {

            DB::table('personel_teams')->insert([
                "divisi"        => $request->divisi,
                "name"          => $request->name,
                "created_at"    => Carbon::now(),
                "updated_at"    => Carbon::now()
            ]);

            return response()->json("$request->divisi")->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    // UPDATE DATA
    public function edit($id)
    {
        $personelTeamsById =  DB::table('personel_teams')->where('id', $id)->first();
        return response()->json($personelTeamsById);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'divisi' => 'required',
            'name'   => 'required',
        ]);

        try {

            DB::table('personel_teams')->where('id', $id)->update([
                "divisi"        => $request->divisi,
                "name"          => $request->name,
                "updated_at"    => Carbon::now()
            ]);    

            return response()->json("$request->divisi")->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }
    // END UPDATE DATA


    public function show($id)
    {
        $personelTeams =  DB::table('personel_teams')
            ->where('id', $id)
            ->select(
                "divisi as divisi",
                "name as name",
                "created_at"
            )
            ->first();

        if ($personelTeams) {
            // Format created_at ubah menjadi dibuat_pada
            $personelTeams->dibuat_pada = Carbon::parse($personelTeams->created_at)->translatedFormat('Y-m-d H:i:s');
            
            // Hapus properti created_at agar tidak terlihat di output JSON
            unset($personelTeams->created_at);

            return response()->json($personelTeams);
        } else {
            return response()->json(['message' => 'Personel Teams not found'], 404);
        }
    }


    public function destroy($id)
    {
        try {
            $personelTeams = DB::table('personel_teams')->where('id', $id)->first();

            if ($personelTeams) {
                DB::table('personel_teams')->where('id', $id)->delete();

                return response()->json("Personel Teams, $personelTeams->name berhasil dihapus");
            } else {
                return response()->json(['message' => 'Personel Teams not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
