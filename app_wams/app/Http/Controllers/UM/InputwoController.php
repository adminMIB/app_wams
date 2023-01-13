<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\ListProjectPm;
use App\Models\SalesOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class InputwoController extends Controller
{
    public function index(Request $request)
    {
        $namaAm = Role::with('users')->where('name', 'AM/Sales')->get();
        $dataReject  = [];
        $dataFilter = [];
        // $data = [];
        if ($request->dari_tgl && $request->sampai_tgl && $request->status && $request->name) {
            // dd('ok');
            // return $request->status;
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOrder::orderBy('created_at', 'desc')->whereBetween('created_at', [$dari_tgl,$sampai_tgl])->where('status', $request->status)->where('name_user', $request->name)->paginate(10);
            foreach ($data as $key => $value) {
                // $data [] = $value;
                $dataFilter [] = $value;
            }            
        } elseif($request->dari_tgl && $request->sampai_tgl && $request->status) {          
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOrder::orderBy('created_at', 'desc')->whereBetween('created_at', [$dari_tgl,$sampai_tgl])->where('status', $request->status)->paginate(10);
            foreach ($data as $key => $value) {
                $dataFilter [] = $value;
            }
            
        } elseif($request->dari_tgl && $request->sampai_tgl ) {          
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOrder::orderBy('created_at', 'desc')->whereBetween('created_at', [$dari_tgl,$sampai_tgl])->paginate(10);
            foreach ($data as $key => $value) {
                $dataFilter [] = $value;
            }
        }  elseif($request->status) {          
            $data = SalesOrder::orderBy('created_at', 'desc')->where('status', $request->status)->paginate(10);
            foreach ($data as $key => $value) {
                $dataFilter [] = $value;
            }
        } elseif($request->name) {          
            $data = SalesOrder::orderBy('created_at', 'desc')->where('name_user', $request->name)->paginate(10);
            foreach ($data as $key => $value) {
                $dataFilter [] = $value;
            }
        } else {
            $data = SalesOrder::orderBy('created_at', 'desc')->paginate(10);
            foreach ($data as $key => $value) {
                if ($value->status == 'Reject') {
                    $dataReject [] = $value;
                } 
            }
        }

        $datas = SalesOrder::all()->count();
        $detailId =  SalesOrder::all();
        $user = Role::with('users')->where("name", "PM Lead")->get();
        $listPm = ListProjectPm::all();


        // return $data;
        return view('UM.inputwo', compact('data', 'datas', 'user', 'listPm', 'dataReject', 'dataFilter', 'namaAm'));
    }

    // public function show($id)
    // {
    //     $detailId = SalesOrder::find($id);
    //     $datas = SalesOrder::all()->count();
    //     $user = Role::with('users')->where("name", "PM Lead")->get();

    //     return view('UM.inputwo', compact('detailId', 'datas', 'user'));
    // }

    public function  store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sign_pm_lead' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 442);
        }



        try {
            // kita buat role nya
            ListProjectPm::create([
                "no_sales" => $request->no_sales,
                "tgl_sales" => $request->tgl_sales,
                "kode_project" => $request->kode_project,
                "nama_sales" => $request->nama_sales,
                "nama_institusi" => $request->nama_institusi,
                "nama_project" => $request->nama_project,
                "hps" => $request->hps,
                "sign_pm_lead" => $request->sign_pm_lead,
            ]);
            // lalu kasih permision berdasarakn user select

            return redirect('/approval');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function iwo(Request $request)
    {
        $id = $request->id;
        $data = SalesOrder::find($id);
        return response()->json($data);
    }

   
}
