<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = DB::table('roles')->select('id', 'name')->latest('id')->get();
        $permissions = DB::table('permissions')->select('id', 'name')->latest('id')->get();


        if ($request->ajax()) {
            $data = DB::table('users')
                        ->join('roles', 'users.roles_id', '=', 'roles.id') // Lakukan join dengan menggunakan nama_project dari reimbursements dan id dari opties
                        ->select("users.id", "users.name", "users.email", "roles.name as roles", "users.created_at")
                        ->latest('users.id');

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
                                ->orWhere(DB::raw('LOWER(email)'), 'LIKE', '%' . $loweredSearchValue . '%');
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        // D:\app\mib-2024\acdc\wams-acdc\resources\views\auth\users\index.blade.php
        return view('auth.users.index', compact('roles', 'permissions'));
    }


    public function store(Request $request)
    {
        if (!auth()->user()->can('create')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required',
            'roles'      => 'required',
        ]);

        
        $roleName = DB::table('roles')->where('id', $request->roles)->first();
    
        try {
            $user = \App\Models\User::factory()->create([
                "name"          => $request->name,
                "email"         => $request->email,
                "roles_id"      => $request->roles,
                "password"      => bcrypt($request->password),
                "created_at"    => Carbon::now(),
                "updated_at"    => Carbon::now()
            ]);
    
            $user->assignRole($roleName->name);
    
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
    


    // UPDATE DATA
    public function edit($id)
    {
        $userById =  DB::table('users')
        ->where('users.id', $id)
        ->join('roles', 'users.roles_id', '=', 'roles.id')
        ->select("users.id", "users.name", "users.email", "roles.name as role", "users.created_at")
        ->first();


    return response()->json($userById);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'roles' => 'required',
        ]);
    
        try {
            // Temukan role berdasarkan id
            $roleName = DB::table('roles')->where('id', $request->roles)->first();

            // Ambil kembali model user setelah update
            $user = \App\Models\User::findOrFail($id);

            if (!$roleName) {
                return response()->json(["error" => "Role not found"], 404);
            }
    
            // Update data user menggunakan query builder
            DB::table('users')->where('id', $id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "roles_id" => $request->roles,
                "password" => bcrypt($request->password),
                "updated_at" => Carbon::now(),
            ]);
    
            // Menetapkan peran baru untuk pengguna
            $user->syncRoles($roleName->name);
    
            return response()->json($user->name)->setStatusCode(200);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() >= 100 && $e->getCode() < 600 ? $e->getCode() : 500;
            return response()->json(["error" => $e->getMessage()], $statusCode);
        }
    }
    
    
    // END UPDATE DATA


    public function show($id)
    {
        if (!auth()->user()->can('views')) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $users = DB::table('users')
        ->where('users.id', $id)
        ->join('roles', 'users.roles_id', '=', 'roles.id')
        ->select("users.id", "users.name", "users.email", "roles.name as role", "users.created_at")
        ->first();

        if ($users) {
            // Format created_at ubah menjadi dibuat_pada
            $users->dibuat_pada = Carbon::parse($users->created_at)->translatedFormat('Y-m-d H:i:s');
            
            // Hapus properti created_at agar tidak terlihat di output JSON
            unset($users->created_at);

            return response()->json($users);
        } else {
            return response()->json(['message' => 'users not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $users = DB::table('users')->where('id', $id)->first();

            if ($users) {
                DB::table('users')->where('id', $id)->delete();

                return response()->json("users, $users->name berhasil dihapus");
            } else {
                return response()->json(['message' => 'users not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    

}