<?php

namespace App\Http\Controllers\Auth\RoleAndPremission;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PremissionController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('views')) {
            abort(403, 'Unauthorized action.');
        } else {
            if ($request->ajax()) {
            
    
                $data = DB::table('permissions')
                    ->select("id", "name", "created_at")
                    ->latest('id');
    
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
        }



        // Jika request adalah Ajax, kembalikan data menggunakan DataTables
        

        // Jika bukan Ajax, tampilkan halaman dengan view
        return view('auth.role_and_premission.premission.index');
    }




    public function store(Request $request)
    {
        if (!auth()->user()->can('create')) {

            $this->validate($request, [
                'name'   => 'required',
            ]);
    
            try {
    
                Permission::create([
                    'name'  => $request->name,
                ]);
    
                return response()->json("$request->name")->setStatusCode(201);
            } catch (\Exception $e) {
                return response()->json(["error" => $e->getMessage()], $e->getCode());
            }
            
        } else {
            abort(403, 'Unauthorized action.');
        }

    }


    // UPDATE DATA
    public function edit($id)
    {
        $permissionsById =  DB::table('permissions')->where('id', $id)->first();
        return response()->json($permissionsById);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        try {
            $permission = Permission::findOrFail($id);

            $permission->update([
                'name' => $request->name,
            ]);

            return response()->json($permission)->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }
    // END UPDATE DATA


    public function show($id)
    {
        $permissions =  DB::table('permissions')
            ->where('id', $id)
            ->select(
                "name",
                "guard_name",
                "created_at"
            )
            ->first();

        if ($permissions) {
            // Format created_at ubah menjadi dibuat_pada
            $permissions->dibuat_pada = Carbon::parse($permissions->created_at)->translatedFormat('Y-m-d H:i:s');
            
            // Hapus properti created_at agar tidak terlihat di output JSON
            unset($permissions->created_at);

            return response()->json($permissions);
        } else {
            return response()->json(['message' => 'roles not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $permissions = DB::table('permissions')->where('id', $id)->first();

            if ($permissions) {
                DB::table('permissions')->where('id', $id)->delete();

                return response()->json("permissions, $permissions->name berhasil dihapus");
            } else {
                return response()->json(['message' => 'permissions not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    

}
