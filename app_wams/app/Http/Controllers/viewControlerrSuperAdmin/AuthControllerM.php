<?php

namespace App\Http\Controllers\viewControlerrSuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Input\Input;

class AuthControllerM extends Controller
{
    public function index()
    {
        // $user = User::with('roles')->orderBy('created_at', 'DESC')->paginate(10);
        $user = User::with('roles')->orderBy('created_at', 'DESC')->paginate(10);
        // dd($user);
        return view('superAdmin.addUser.dashboard_Auth', compact('user'));
    }

    public function create() 
    {
        $role = Role::all();
        return view('superAdmin.addUser.addUser', compact('role'));
    }

    public function edit($id)
    {
        $allRole = Role::all();
        $getid = User::find($id);
        return view('superAdmin.addUser.editUser', compact('getid', 'allRole'));
    }

    //! post tambah data
    public function store(Request $request)
    {        
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:30',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6',
            ]);    
            
            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 442);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // kasih role nya berdasarkan request
            // tampung dulu rolenya
            $role = $request->names;
            // lalu kasihkan rolenya
            $user->assignRole($role);

            $token = $user->createToken('wams')->plainTextToken;
            DB::commit();

            return redirect('dashboard/user');

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage());
        }
    } 

    public function update(Request $request, $id)
    {
        try {
            $getData = User::findOrFail($id);

            $ceks = $getData->roles;
            foreach ($ceks as $key => $i) {
                    $roleOld =  $i->name;
                };
                
                // ini ambil input dari pilihan role
                $role = $request->names;

                $getData->update([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // hapus role yang dulu
            $getData->removeRole($roleOld);
            // lalu ganti yang baru
            $getData->assignRole($role);
            

            return redirect('dashboard/user');
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage());
        }
    }

    public function destroy($id)
    {
        $delete = User::find($id);
        $delete->delete();

        return back();

    }
}
