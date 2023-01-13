<?php

namespace App\Http\Controllers\SALES;

use App\Exports\SalesOptyExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Distributor;
use App\Models\ElearnindDetail;
use App\Models\NomerForOrderOpty;
use App\Models\NomerKodeProjectOrderOpties;
use App\Models\Principal;
use App\Models\ProgressStatus;
use Carbon\Carbon;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use App\Models\Sbu;
use App\Models\UserHasSalesOpties;
use App\Models\Wodlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class SalesOptyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $sales = SalesOpty::orderBy('created_at', 'desc')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'like', "%" . $request->Status . "%")->where('name_user', 'like', "%" . $request->name_user . "%")->get();
        } else {
            $sales = SalesOpty::orderBy('created_at', 'desc')->where('Status', 'like', "%" . $request->Status . "%")->where('name_user', 'like', "%" . $request->name_user . "%")->get();
        }
        $prostat = ProgressStatus::all();
        $user = Role::with('users')->where("name", "AM/Sales")->get();
        return view('SALES.index', compact('sales', 'prostat','user'));
    }

    //public function salesoptyexport(){
        //return Excel::download(new SalesOptyExport, 'salesopty.xlsx'());
    //}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $q = DB::table('nomer_for_order_opties')->select(DB::raw('MAX(RIGHT(arr,3)) as kode'));
        $dd = "";
        if ($q->count() > 0)
        {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $dd = sprintf("%03s", $tmp);
            }
        }   else
        {
            $dd = "001";
        }

        $pm = Role::with('users')->where("name", "PM")->get();
        $Technikel = Role::with('users')->where("name", "Technikal")->get();
        $principal = Principal::all();
        $customer = Customer::all();
        $distributor = Distributor::all();
        $prostat = ProgressStatus::all();
        $sbu = Sbu::all();
        
        return view('SALES.inputsales',compact('principal', 'distributor', 'dd', 'prostat', 'sbu', 'pm', 'Technikel','customer'));
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $validator = Validator::make($request->all(),[
                "NamaClient" => "required|string",
                "NamaProject" => "required|string",
                "Timeline" => "required|string",
                "Date" => "required|string",
                "Status" => "required|string",
                "elearning_id" => "required"
            ]);  
            if($validator->fails()) {
                return back()->with('error', 'Please provide all value!');
            }

            // data customer ambil data id nya berdasrkan request nama client
            $detailDataCustomer = Customer::where('nama', $request->NamaClient)->get();
            foreach ($detailDataCustomer as $key => $value) {
                $idCustomer = $value->id;
            }
        //    NomerForOrderOpty::create([
        //     'arr' => $request->arr
        //     ]);

            SalesOpty::create([
                "no_opty" => $request->no_opty,
                "name_user" => Auth::user()->name,
                "NamaClient" => $request->NamaClient,
                "NamaProject" => $request->NamaProject,
                "Timeline" => $request->Timeline,
                "no_customer" => $idCustomer,
                "Date" => $request->Date,
                "Status" => $request->Status,
                "Note" => $request->Note,
                "distributor" => $request->distributor,
                "presales" => $request->presales,
                "pmo" => $request->pmo,
                "sbu" => $request->sbu,
                "estimated_amount" => $request->estimated_amount,
                "confidence_level" => $request->confidence_level,
                "contract_amount" => $request->contract_amount,
                "elearning_id" => $request->elearning_id
            ]);

            return redirect('index-sales')->with('success', 'Berhasil Menambah Data');

     
    }

    public function filter(Request $request)
    {
        try {
            if ($request->timeline == 'Q1') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(01)->startOfMonth(), Carbon::now()->month(03)->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } elseif ($request->timeline == 'Q2') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(04)->startOfMonth(), Carbon::now()->month(06)->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } elseif ($request->timeline == 'Q3') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(07)->startOfMonth(), Carbon::now()->month('09')->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } elseif ($request->timeline == 'Q4') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(10)->startOfMonth(), Carbon::now()->month(12)->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $sales =  SalesOpty::orderBy('created_at', 'desc')->paginate(10);
            }

            return view('SALES.index', compact('sales'));
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => "Gagal"
            ]);
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
        $detail = SalesOpty::with('elearnings')->find($id);
        return view('SALES.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pm = Role::with('users')->where("name", "PM")->get();
        $Technikel = Role::with('users')->where("name", "Technikal")->get();
        $principal = Principal::all();
        $distributor = Distributor::all();
        $prostat = ProgressStatus::all();
        $sbu = Sbu::all();
        $edit = SalesOpty::find($id);
        return view('SALES.edit', compact('edit','principal','distributor','sbu','prostat','Technikel','pm'));
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
        $sales = SalesOpty::find($id);

        $sales->update([
            "NamaClient" => $request->NamaClient,
            "NamaProject" => $request->NamaProject,
            "Timeline" => $request->Timeline,
            "Date" => $request->Date,
            "Status" => $request->Status,
            "Note" => $request->Note,
            "elearning_id" => $request->elearning_id,
            "distributor" => $request->distributor,
            "presales" => $request->presales,
            "pmo" => $request->pmo,
            "sbu" => $request->sbu,
            "estimated_amount" => $request->estimated_amount,
            "confidence_level" => $request->confidence_level,
            "contract_amount" => $request->contract_amount,
        ]);

        return redirect('index-sales')->with('success', 'Berhasil Update Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $so = SalesOpty::find($id);
        $k = $so->no_opty; // 2 -> tabel salesorder
        $kp = $so->ID_project; // 2 -> tabel salesorder
        $soid = $so->id; // 2 -> tabel salesorder
        $kdpo = NomerForOrderOpty::all();
        $kdp = NomerKodeProjectOrderOpties::all();
        $soidp = Wodlist::all();
        // $userHasSalesOpty = UserHasSalesOpties::with("projectSalesOpties", "userTechnikal", "userPM")->get();
        $userHasSalesOpty = UserHasSalesOpties::all();
        // return $userHasSalesOpty;

        
        
        foreach ($kdpo as $key => $value) {
            if ($k ==  $value->arr) {
                SalesOpty::find($id)->delete();
                NomerForOrderOpty::find($value->id)->delete();
            }
        }

        foreach ($kdp as $key => $val) {
            if ($kp ==  $val->arr2) {
                // return $val->arr2;
                NomerKodeProjectOrderOpties::find($val->id)->delete();
            }
        }

        foreach ($soidp as $key => $v) {
            if ($soid ==  $v->salesopty_id) {
                // return $v->salesopty_id;
                Wodlist::find($v->id)->delete();
            }
        }

        foreach ($userHasSalesOpty as $key => $value) {
            if ($value->sales_opties_id == $soid) {
                UserHasSalesOpties::find($value->id)->delete();
            }
        }

        $so->delete();
        

        // $sales = SalesOpty::find($id);
        // $sales -> delete();
        return back()->with('success', 'Berhasil Menghapus Data');
    }

    public function export() 
    {
        // return Excel::download(new SalesOptyExport, 'salesopty.xlsx');
    }

    public function cetak()
    {
        $sales = SalesOpty::all();
        return view('SALES.cetak', compact('sales'));
    }


}
