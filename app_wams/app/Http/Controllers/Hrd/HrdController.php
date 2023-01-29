<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Hrd;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class HrdController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        CarbonInterval::setLocale('id');

        if ($request->ajax()) {
            $data = DB::table('hrds')->select(
                "id",
                "nik",
                "name",
                "joined",
                "status",
                "gender",
                "phone",
                "email",
                "created_at"
            )->latest('id');

            return DataTables::of($data)
                ->addColumn("joined", function($val) {
                    return Carbon::parse($val->created_at)->translatedFormat("d-m-Y");
                })
                ->addColumn("gender", function($val) {
                    return $val->gender == 'L' ? "Laki-Laki" : "Perempuan";
                })
                ->addColumn("created_at", function($val) {
                    return Carbon::parse($val->created_at)->translatedFormat("Y-m-d");
                })
                ->addColumn('action', function ($val) {
                    $edit_url = route('hrd.edit',$val->id);
                    $detail_url = route('hrd.show', $val->id);

                    $btn_edit = "<a href='$edit_url' class='btn btn-warning btn-sm text-white'><i class='fa fa-edit'></i></a>";
                    $btn_detail = "<a href='$detail_url' class='btn btn-info btn-sm text-white'><i class='fa fa-eye'></i></a>";
                    $btn_delete = ' <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="'.$val->id.'" title="Hapus data"><i class="fas fa-trash "></i></a>';

                    return $btn_detail . ' ' . $btn_edit . ' ' . $btn_delete . ' ';
                })

                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')) {
                        $instance->where('name', 'LIKE', '%' . request()->search . '%');
                    }

                    if ($request->get('start_date')) {

                        $instance->whereBetween('created_at', [
                            Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
                            Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
                        ]);
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('Hrd.index');
    }

    public function create()
    {
        return view("Hrd.create");
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "name" => "required|string|max:50",
                "nik" => "required|unique:hrds,nik",
                "from_institute" => "required",
                "status" => "required",
                "joined" => "required",
                "gender" => "required",
                "skills" => "required",
                "address" => "required|max:200",
                "date_birth" => "required",
                "religion" => "required",
                "phone" => "required",
                "email" => "required"
            ]);
            
            if ($validate->fails()) {
                return back()->with(['error' => $validate->errors()]);
            }

            Hrd::create([
                "name" => $request->name,
                "nik" => $request->nik,
                "from_institute" => $request->from_institute,
                "joined" => $request->joined,
                "gender" => $request->gender,
                "skills" => $request->skills,
                "status" => $request->status,
                "address" => $request->address,
                "date_birth" => $request->date_birth,
                "religion" => $request->religion,
                "phone" => $request->phone,
                "email" => $request->email
            ]);

            return redirect(route('hrd.index'))->with([
                'success' => 'Data berhasil dibuat'
            ]);

        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = Hrd::find($id);

        return view('hrd.edit', ['data' => $data]);
    }

    public function show($id)
    {
        $data = Hrd::find($id);

        return view('hrd.show', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $data = Hrd::find($id);

        $update = $data->update([
            "name" => $request->name,
            "nik" => $request->nik,
            "from_institute" => $request->from_institute,
            "joined" => $request->joined,
            "gender" => $request->gender,
            "skills" => $request->skills,
            "status" => $request->status,
            "address" => $request->address,
            "date_birth" => $request->date_birth,
            "religion" => $request->religion,
            "phone" => $request->phone,
            "email" => $request->email
        ]); 

        if (!$update) {
            return redirect()->back()->with(['error' => "data gagal ditambahkan"]);
        }

        return redirect(route('hrd.index'))->with(['success' => "Data $data->name berhasil diubah"]);
    }

    public function destroy($id)
    {
        $data = Hrd::find($id);

        $data->delete();

        return redirect(route('hrd.index'))->with(['success' => "Data $data->name berhasil dihapus"]);
    }
}
