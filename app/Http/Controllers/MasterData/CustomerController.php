<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('customers')->select("id", "name", "no_npwp", "created_at")->latest('id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return $val->created_at ? Carbon::parse($val->created_at)->translatedFormat("Y-m-d") : '';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')['value']) {
                        $searchValue = $request->get('search')['value'];
                        $instance->where(function ($query) use ($searchValue) {
                            $query->where('name', 'LIKE', '%' . $searchValue . '%')
                                ->orWhere('no_npwp', 'LIKE', '%' . $searchValue . '%');
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.master-data.customers.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'no_npwp' => 'required',
            'address' => 'required',
            'pic_name' => 'required',
            'phone_pic' => 'required',
            'email_pic' => 'required',
        ]);

        try {
            Customer::create($request->all());

            return response()->json("$request->name")->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'no_npwp' => 'required',
            'address' => 'required',
            'pic_name' => 'required',
            'phone_pic' => 'required',
            'email_pic' => 'required',
        ]);

        try {
            $customer = Customer::find($id);

            $customer->update($request->all());
            
            return response()->json("$request->name")->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function show($id)
    {
        $customer = Customer::select(
            "name as nama_perusahaan",
            "no_npwp as no_npwp_perusahaan",
            "address as alamat_perusahaan",
            "pic_name as nama_pic",
            "phone_pic as no_telepon_pic",
            "email_pic as email_pic",
            "created_at as dibuat_pada",
        )->find($id);

        if ($customer) {
            $customer->dibuat_pada = Carbon::parse($customer->created_at)->translatedFormat('Y-m-d H:i:s');
            
            return response()->json($customer);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }

    public function edit($id)
    {
        return response()->json(Customer::find($id));
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);

            $customer->delete();

            return response()->json("Customer $customer->name berhasil dihapus");
        } catch (\Exception $e) {
            return response()->json($e->getMessage())->setStatusCode($e->getCode());
        }
    }
}
