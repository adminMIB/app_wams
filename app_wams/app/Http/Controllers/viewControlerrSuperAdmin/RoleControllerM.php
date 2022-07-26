<?php

namespace App\Http\Controllers\viewControlerrSuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleControllerM extends Controller
{
    public function index()
    {
        $role = Role::with('permissions')->orderBy('created_at', 'DESC')->paginate(10);

        // $role = Role::all();
        $permisions = Permission::all();
        return view('superAdmin.role', compact('role', 'permisions'));
    }


    public function create() 
    {
        $permisions = Permission::all();

        return view('superAdmin.addRole', compact('permisions'));
    }

    public function  store(Request $request, User $user)
    {   

        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);    
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 442);
        }


        try {
        // kita buat role nya
        $role = Role::create([
            "name" => $request->name,
            "guard_name" => "web" 
            
        ]);
        // lalu kasih permision berdasarakn user select
        $inputPermision0 = $request->input('names');
        $role->givePermissionTo($inputPermision0);

        return redirect('dashboard/role');

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function edit($id)
    {
        $getid = Role::find($id);
        $permisions = Permission::all();

        return view('superAdmin.editRole', compact('getid', 'permisions'));
    }

    public function update(Request $request, $id)
    {
        try {
            $getData = Role::findOrFail($id);

            $getData->update([
                "name" => $request->name,
            ]);

            // kita tampung permission yang dulu
            $ab = $getData->permissions;
            // lalu hapus
            $getData->revokePermissionTo($ab);


            // lalu ganti dengan yang baru dari inputan
            $inputPermision0 = $request->input('names');
            $getData->givePermissionTo($inputPermision0);

            return redirect('dashboard/role');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletData = Role::find($id);
        $deletData->delete();

        return back();

    }

}
