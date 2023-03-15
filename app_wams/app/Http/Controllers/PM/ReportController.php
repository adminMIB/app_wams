<?php

namespace App\Http\Controllers\PM;

use App\Http\Controllers\Controller;
use App\Models\ProgressStatus;
use App\Models\Wodlist;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Models\SalesOpty;
use App\Models\ListProjectAdmin;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prostat = ProgressStatus::all();
        $namaAm = Role::with('users')->where('name', 'AM/Sales')->get();
        $namaTechnikal = Role::with('users')->where('name', 'Technikal')->get();
        
        $dataProjects = [];
        
        if ($request->NamaClient && $request->Status && $request->nameTechnikal) {
            // dd($request->nameTechnikal);
            //! projects sales
            $data = SalesOpty::orderBy('created_at', 'desc')->with('userTechnikalsPipe.userTechnikal')->where('NamaClient', $request->NamaClient)->where('Status', $request->Status)->get();
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null ) {
                        
                    } else {
                        if ($item->userTechnikal->name == $request->nameTechnikal ) {
                                $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }
            
            // //! project admin
            $dataAdmin = ListProjectAdmin::orderBy('created_at', 'desc')->with('userTechnikals.userTechnikal','userTechnikals.AM')->where('NamaClient', $request->NamaClient)->where('Status', $request->Status)->get();
            foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ( $item->userTechnikal === null) {
                        } else {
                            if ( $item->userTechnikal->name == $request->nameTechnikal ) {
                                $dataProjects[] = $value;
                            } 
                        }
                    }
                }

            // return $dataProjects;

        }else {
            $projectAdmin = ListProjectAdmin::orderBy('created_at', 'desc')->with('userTechnikals.AM', 'userTechnikals.userPresale', 'userTechnikals.userTechnikal', 'ltoproject.bast')->get();
            $projectSales = SalesOpty::orderBy('created_at', 'desc')->with('userTechnikalsPipe.userTechnikal')->get();
            
            foreach ($projectAdmin as $key => $value) {
                $dataProjects [] = $value;
            }

            foreach ($projectSales as $key => $value) {
                $dataProjects [] = $value;
            }
            
            // return $projectSales;
            
        }
        return view('ReportPM.index',compact('dataProjects', 'prostat', 'namaAm', 'namaTechnikal'));
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
