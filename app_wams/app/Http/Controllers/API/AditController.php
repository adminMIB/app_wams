<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Adits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Adits::orderBy("created_at","DESC")->paginate(10);

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
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
        $adits = new Adits();
        try{
            $validate=Validator::make($request->all(),[
                "name_client" => "required|string|max:100",
                "name_project" => "required|string|max:100",
            ],[
                "name_client.required" => "Nama Institusi berhasil diubah!",
                "name_project.required" => "Nama Institusi berhasil diubah!",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            Adits::create([
                "name_client" => $request->name_client,
                "name_project" => $request->name_project,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Data '$request->name_client', berhasil ditambah."
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
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
        //
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
