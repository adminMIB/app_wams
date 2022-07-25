<?php

namespace App\Http\Controllers\viewControlerrSuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermisiionControlerr extends Controller
{
    public function index()
    {
        $permission = Permission::all();
        return view('superAdmin.permision.dashboardPermisiion', compact('permission'));
    }


    public function create() 
    {
        $permisions = Permission::all();

        return view('superAdmin.permision.addPermission', compact('permisions'));
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
        $role = Permission::create([
            "name" => $request->name,
            "guard_name" => "web" 
            
        ]);

        return redirect('dashboardPermision');

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function edit($id)
    {
        $getid = Permission::find($id);

        return view('superAdmin.permision.editPermission', compact('getid'));
    }

    public function update(Request $request, $id)
    {
        try {
            $getData = Permission::findOrFail($id);
            $getData->update([
                "name" => $request->name,
            ]);

            return redirect('dashboardPermision');
        } catch (\Throwable $th) {
            //throw $th;
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
        $deletData = Permission::find($id);
        $deletData->delete();

        return back();

    }

}