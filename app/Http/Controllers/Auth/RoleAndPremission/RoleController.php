<?php

namespace App\Http\Controllers\Auth\RoleAndPremission;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $permissions = DB::table('permissions')->select('id', 'name')->latest('id')->get();

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

        return view('auth.role_and_premission.role.index', compact('permissions'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
        ]);


        try {
            // create role
            $role =  Role::create([
                'name' => $request->name
            ]);

            // give me premission to roles
            foreach ($request->permissions as $permissionId) {
                $role->givePermissionTo($permissionId);
            }

            return response()->json("$request->name")->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    // UPDATE DATA
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();

        return response()->json([
            'role' => $role,
            'permissions' => $role->permissions, // Permissions terkait dengan role
            'all_permissions' => $permissions, // Semua permissions
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
        ]);

        // Ambil role berdasarkan ID
        $role = Role::findOrFail($id);

        // Update nama role
        $role->name = $request->input('name');
        $role->save();

        // Update permissions yang terkait dengan role
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $role->syncPermissions($permissions);
        } else {
            // Jika tidak ada permissions yang dikirim, kosongkan semua permissions terkait dengan role
            $role->syncPermissions([]);
        }
        return response()->json("$request->name")->setStatusCode(201);

    }
    // END UPDATE DATA


    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = $role->permissions;

        // Mengubah format created_at pada role menggunakan Carbon
        $role->dibuat_pada = Carbon::parse($role->created_at)->translatedFormat('Y-m-d H:i:s');
        unset($role->created_at); // Menghapus properti created_at agar tidak terlihat di output JSON

        // // Mengubah format created_at pada permissions menggunakan Carbon
        // foreach ($permissions as $permission) {
        //     $permission->dibuat_pada = Carbon::parse($permission->created_at)->translatedFormat('Y-m-d H:i:s');
        //     unset($permission->created_at); // Menghapus properti created_at agar tidak terlihat di output JSON
        // }

        return response()->json([
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    


    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Hapus semua permissions terkait
        $role->permissions()->detach();

        // Hapus role itu sendiri
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully.']);
    }

    

}
