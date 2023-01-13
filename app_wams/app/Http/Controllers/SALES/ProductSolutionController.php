<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use App\Models\ListToPm;
use App\Models\ProductSolution;
use App\Models\SalesOrder;
use App\Models\Weekly;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductSolutionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $datas = Weekly::with('timelines.lists')->whereBetween('created_at', [$dari_tgl,$sampai_tgl])->where('status', 'like', "%" . $request->status . "%")->get();
        } else {
            $datas = Weekly::with('timelines.lists')->get();
        }
        return view('SALES.reportPTech', compact('datas'));
    }

    // public function create()
    // {
    //     $sod = SalesOrder::all();
    //     return view('SALES.PScreate', compact('sod'));
    // }

    // public function store(Request $request)
    // {
    //     try {
    //         // $validate = Validator::make($request->all(), [
    //         //     "principal" => "required|string|unique:product_solutions",
    //         //     "distributor" => "required|string|max:30",
    //         // ]);

    //     // if ($validate->fails()) {
    //     //     return response()->json($validate->errors());
    //     // }
    //     // $so_id = $request->so_id;
    //     $tes = $request->tes;
    //     $amount= $request->amount;

    //     dd($tes);
    //     for ($i=0; $i < count($tes); $i++) {
    //         $datasave = [
    //             // 'so_id' => $time->id,
    //             'tes' => $tes[$i],
    //             'amount' => $amount[$i]
    //         ];
    //         dd($datasave);
    //         DB::table('amounts')->insert($datasave);                    
    //     }

    //     // ProductSolution::create([
    //     //     'principal' => $request->principal,
    //     //     'distributor' => $request->distributor
    //     // ]);

        
    //     // return redirect('produksolusi')->with('success', 'data berhasil di tambah');

    //     } catch (\Exception $e) {
    //         return response()->json($e->getMessage());
    //     }
    // }

    // public function edit($id)
    // {
    //     $data_prosol = ProductSolution::findOrFail($id);
    //     return view('SALES.PSedit', compact('data_prosol'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $data_prosol = ProductSolution::findOrFail($id);
    //     try {
    //         $validate = Validator::make($request->all(), [
    //             "principal" => "required|string|unique:product_solutions",
    //             "distributor" => "required|string|max:30",
    //         ]);

    //     if ($validate->fails()) {
    //         return response()->json($validate->errors());
    //     }

    //     $data_prosol->update([
    //         'principal' => $request->principal,
    //         'distributor' => $request->distributor
    //     ]);

    //     return redirect('produksolusi')->with('success', 'data berhasil di update');

    //     } catch (\Exception $e) {
    //         return response()->json($e->getMessage());
    //     }
    // }

    // public function destroy($id)
    // {
    //     ProductSolution::find($id)->delete();
 
    //     return back()->with('success', 'data berhasil di hapus');
    // }
}
