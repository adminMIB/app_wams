<?php

namespace App\Http\Controllers\Auth\RoleAndPremission;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('roles')->select("id", "name", "guard_name", "created_at")->latest('id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $instance->where(function ($query) use ($searchValue) {
                            $loweredSearchValue = strtolower($searchValue); 
                            $query->where(DB::raw('LOWER(name)'), 'LIKE', '%' . $loweredSearchValue . '%')
                                ->orWhere(DB::raw('LOWER(guard_name)'), 'LIKE', '%' . $loweredSearchValue . '%');
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('auth.role_and_premission.role.index');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
        ]);

        try {

            DB::table('roles')->insert([
                "name"          => $request->name,
                "guard_name"    => $request->guard_name ?? '-',
                "created_at"    => Carbon::now(),
                "updated_at"    => Carbon::now()
            ]);

            return response()->json("$request->name")->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    // UPDATE DATA
    public function edit($id)
    {
        $rolesById =  DB::table('roles')->where('id', $id)->first();
        return response()->json($rolesById);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'required',
        ]);

        try {

            DB::table('roles')->where('id', $id)->update([
                "name"          => $request->name,
                "guard_name"    => $request->guard_name ?? '-',
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
        $roles =  DB::table('roles')
            ->where('id', $id)
            ->select(
                "name",
                "guard_name",
                "created_at"
            )
            ->first();

        if ($roles) {
            // Format created_at ubah menjadi dibuat_pada
            $roles->dibuat_pada = Carbon::parse($roles->created_at)->translatedFormat('Y-m-d H:i:s');
            
            // Hapus properti created_at agar tidak terlihat di output JSON
            unset($roles->created_at);

            return response()->json($roles);
        } else {
            return response()->json(['message' => 'roles not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $roles = DB::table('roles')->where('id', $id)->first();

            if ($roles) {
                DB::table('roles')->where('id', $id)->delete();

                return response()->json("Roles, $roles->name berhasil dihapus");
            } else {
                return response()->json(['message' => 'Roles not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    

}
