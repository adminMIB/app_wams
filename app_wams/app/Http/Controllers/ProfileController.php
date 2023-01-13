<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('profile-all',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'password' =>'confirmed',
            'avatar' => 'nullable|image|max:5120'
        ]);

        try{

            if ($request->hasFile('avatar')) {
                if($request->file('avatar')->isValid()) {
                    $file = $request->file('avatar');
                    $image = base64_encode($file);
                    $name =  $file->getClientOriginalName();
                    $file->storeAs('public/users',$name);
                }
            }
    
            $user = User::where('id', Auth::user()->id)->first();
            if(!empty($request->password))
            {
                $user->password= Hash::make($request->password);
            }
            !empty($request->avatar) ? $user->avatar=$name : $user->avatar; 
            
            $user->update();
    
            return response()->json([
                'message' => 'Update successfully',
            ], 200);

        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json($th->getMessage());
        }

        // return redirect('profile-all')->with('success', 'Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
