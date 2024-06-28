<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class PrincipalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('principals')->select("id", "type", "name", "created_at")->latest('id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $instance->where(function ($query) use ($searchValue) {
                            $loweredSearchValue = strtolower($searchValue);
                            $query->where(DB::raw('LOWER(type)'), 'LIKE', '%' . $loweredSearchValue . '%')
                                ->orWhere(DB::raw('LOWER(name)'), 'LIKE', '%' . $loweredSearchValue . '%');
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.master-data.principals.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type_principal' => 'required',
            'name'   => 'required',
        ]);

        try {

            DB::table('principals')->insert([
                "type"        => $request->type_principal,
                "name"          => $request->name,
                "created_at"    => Carbon::now(),
                "updated_at"    => Carbon::now()
            ]);

            return response()->json("$request->name")->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function edit($id)
    {
        $principals =  DB::table('principals')->where('id', $id)->first();

        return response()->json($principals);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type_principal' => 'required',
            'name'   => 'required',
        ]);

        try {

            DB::table('principals')->where('id', $id)->update([
                "type"        => $request->type_principal,
                "name"          => $request->name,
                "updated_at"    => Carbon::now()
            ]);

            return response()->json("$request->name")->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }
    // END UPDATE DATA


    public function show($id)
    {
        $principals =  DB::table('principals')
            ->where('id', $id)
            ->select(
                "type",
                "name",
                "created_at"
            )->first();

        if ($principals) {
            // Format created_at ubah menjadi dibuat_pada
            $principals->dibuat_pada = Carbon::parse($principals->created_at)->translatedFormat('Y-m-d H:i:s');

            // Hapus properti created_at agar tidak terlihat di output JSON
            unset($principals->created_at);

            return response()->json($principals);
        } else {
            return response()->json(['message' => 'Personel Teams not found'], 404);
        }
    }


    public function destroy($id)
    {
        try {
            $principals = DB::table('principals')->where('id', $id)->first();

            if ($principals) {
                DB::table('principals')->where('id', $id)->delete();

                return response()->json("Principal, $principals->name berhasil dihapus");
            } else {
                return response()->json(['message' => 'Principal not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
