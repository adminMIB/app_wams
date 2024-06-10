<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\CreateProject;
use App\Models\MasterCustomer;
use App\Models\OptyAcdc;
use App\Models\OptyAcdcMaker;
use App\Models\TransactionMakerACDC;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Svg\Tag\Rect;

class OptyAcdcController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        CarbonInterval::setlocale('id');

        if ($request->ajax()) {
            $data = DB::table('opty_acdcs')->select(
                'id',
                'code_opty',
                'project_name',
                'account_manager',
                'nominal',
                'no_penawaran',
                'created_at'
            )->where('is_moved', false)->latest('id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return Carbon::parse($val->created_at)->translatedFormat("Y-m-d");
                })
                ->addColumn('nominal', function ($val) {
                    return "Rp. " . number_format($val->nominal, 2, ",", ".");
                })
                ->addColumn('action', function ($val) {
                    $edit_url = route('project-opty-acdc.edit', $val->id);
                    $detail_url = route('project-opty-acdc.show', $val->id);

                    $btn_edit = "<a href='" . $edit_url . "' class='btn btn-warning btn-sm text-white'><i class='fa fa-edit'></i></a>";
                    $btn_delete = ' <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="' . $val->id . '" title="Hapus data"><i class="fas fa-trash "></i></a>';
                    $btn_move = ' <a href="javascript:void(0)" class="btn btn-primary btn-sm move" data-id="' . $val->id . '">Pindah Ke Project</a>';
                    $btn_detail = ' <a href="' . $detail_url  . '" class="btn btn-primary btn-sm detail" data-id="' . $val->id . '"><i class="fa fa-eye"></i></a>';

                    if (auth()->user()->name !== 'Bona Napitupulu') {
                        return  $btn_edit . ' ' . $btn_detail . ' ' . $btn_delete . ' ' . $btn_move;
                    }

                    return null;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')) {
                        $instance->where('master_customers.company_name', 'LIKE', '%' . request()->search . '%');
                    }

                    if ($request->get('start_date')) {

                        $instance->whereBetween('master_customersq.created_at', [
                            Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
                            Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
                        ]);
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('corporate.ACDC.opty.index');
    }

    public function create()
    {
        $mdc = MasterCustomer::all();

        return view('corporate.ACDC.opty.create', ['mdc' => $mdc]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'project_name' => 'required',
            'account_manager' => 'required',
            'mdc_id' => 'required',
            'nominal' => 'required',
            'no_penawaran' => 'required',
            'file' => 'required|max:5120',
        ]);

        DB::beginTransaction();

        try {

            $file = $request->file('file');
            $file_ext = $file->getClientOriginalName();
            $file_name = time() . '-' . str_replace(" ", "_", $file_ext);
            $file_path = public_path('file_hitungan/');
            $file->move($file_path, $file_name);

            $insert = OptyAcdc::create([
                'code_opty' => $request->code_opty,
                'project_name' => $request->project_name,
                'account_manager' => $request->account_manager,
                'mdc_id' => $request->mdc_id,
                'nominal' => str_replace(".", "", $request->nominal),
                'no_penawaran' => $request->no_penawaran,
                'file' => $file_name,
            ]);

            foreach ($request->date_trx as $index => $date_trx) {
                $data = [
                    'date_trx' => $request->date_trx[$index],
                    'jenis_trx' => $request->jenis_trx[$index],
                    'nama_penerima' => $request->nama_penerima[$index],
                    'nominal_trx' => str_replace(".", "", $request->nominal_trx[$index]),
                    'keterangan' => $request->keterangan[$index],
                    'opty_acdc_id' => $insert->id,
                ];

                OptyAcdcMaker::create($data);
            }

            DB::commit();

            return redirect(route('project-opty-acdc.index'))->with([
                'success' => '<strong>' . $insert->project_name . '</strong> berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error',  $e->getMessage());
        }
    }

    public function edit($id)
    {
        $mdc = MasterCustomer::get();
        $data = OptyAcdc::find($id);

        return view('corporate.ACDC.opty.edit', [
            "data" => $data,
            "mdc" => $mdc
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $opty = OptyAcdc::find($id);
            $requestAll = $request->all();

            if (!empty($requestAll['file'])) {
                unlink("/file_hitungan/$opty->file");
                $extention = $request->file('file')->getClientOriginalExtension();
                $name = base64_encode(random_bytes(18)) . time();
                $request->file->move(public_path('file_hitungan'), $name . '.' . $extention);
                $fileName = $name . '.' . $extention;

                $requestAll['file'] = $fileName;
            }

            $opty->update($requestAll);

            return redirect('/project-opty-acdc')->with([
                'success' => 'Project (ACDC) - ' . $opty->project_name . ' berhasil diubah'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',  $e->getMessage());
        }
    }

    public function show($id)
    {
        $data = DB::table('opty_acdcs')
            ->join('master_customers', 'opty_acdcs.mdc_id', 'master_customers.id')
            ->select(
                'opty_acdcs.*',
                'master_customers.company_name',
                'master_customers.no_npwp',
                'master_customers.address',
                'master_customers.pic_name',
                'master_customers.phone_pic',
                'master_customers.email_pic',
            )
            ->where('opty_acdcs.id', $id)
            ->first();

        $transMaker = OptyAcdcMaker::where('opty_acdc_id', $data->id)->get();

        $data->nominal = "Rp. " . number_format($data->nominal);

        return view('corporate.ACDC.opty.show', [
            'data' => $data,
            'opty_trx' => $transMaker
        ]);
    }

    public function destroy($id)
    {
        $opty = OptyAcdc::find($id);
        unlink("/file_hitungan/$opty->file");

        OptyAcdcMaker::where('opty_acdc_id', $opty->id)->delete();

        $opty->delete();

        if (empty($opty)) {
            return redirect()->back()->with('error',  'Opty tidak ditemukan');
        }

        return response()->json("Data $opty->project_name berhasil dihapus");
    }

    public function updateOptyMaker(Request $request, $id)
    {
        try {
            $optyMaker = OptyAcdcMaker::find($id);
            $requestAll = $request->all();
            $requestAll['nominal_trx'] = str_replace(['.', ','], "", $requestAll['nominal_trx']);

            $optyMaker->update($requestAll);

            return redirect()->back()->with([
                'success' => 'Opty Maker - berhasil diubah'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',  $e->getMessage());
        }
    }

    public function deteailOptyMaker($id)
    {
        $optyMaker = OptyAcdcMaker::find($id);
        $optyMaker->date_trx = Carbon::parse($optyMaker->date_trx)->format('Y-m-d');
        $optyMaker->nominal_trx = number_format($optyMaker->nominal_trx);

        return response()->json($optyMaker);
    }

    public function addOptyMaker(Request $request, $id)
    {
        try {
            $requestAll = $request->all();
            $requestAll['opty_acdc_id'] = $id;
            $requestAll['nominal_trx'] = str_replace(['.', ','], "", $requestAll['nominal_trx']);

            OptyAcdcMaker::create($requestAll);

            return redirect()->back()->with([
                'success' => 'Berhasil menambah data'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',  $e->getMessage());
        }
    }

    public function moveOptyToProject(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $opty = OptyAcdc::find($id);
            $optyMaker = OptyAcdcMaker::where('opty_acdc_id', $id)->get();
            $insertData = [];

            if ($request->type == "exist") {
                $project = CreateProject::where('id', $request->project_id)->first();
                $project->update([
                    "bmt" => $project->bmt + $opty
                ]);

                if (count($optyMaker) > 0) {
                    foreach ($optyMaker as $item) {
                        $insertData[] = [
                            "cpt_id" => $project->id,
                            "tanggal" => Carbon::parse($item->date_trx)->format('Y-m-d'),
                            "jenis_transaksi" => $item->jenis_trx,
                            "nama_tujuan" => $item->nama_penerima,
                            "nominal" => $item->nominal_trx,
                            "keterangan" => $item->keterangan
                        ];
                    }

                    TransactionMakerACDC::insert($insertData);

                    // foreach ($optyMaker as $item) {
                    //     $item->delete();
                    // }

                    $opty->update(['is_moved' => true]);

                    DB::commit();

                    return redirect()->back()->with([
                        'success' => "Berhasil memindah data Opty $opty->project_name ke Project"
                    ]);
                }
            } else {
                $project = CreateProject::create([
                    "id_project" => $request->id_project,
                    "opty_acdc_id" => $id,
                    "bmt" => $opty->nominal,
                    "file" => $opty->file
                ]);

                if (count($optyMaker) > 0) {
                    foreach ($optyMaker as $item) {
                        $insertData[] = [
                            "cpt_id" => $project->id,
                            "tanggal" => Carbon::parse($item->date_trx)->format('Y-m-d'),
                            "jenis_transaksi" => $item->jenis_trx,
                            "nama_tujuan" => $item->nama_penerima,
                            "nominal" => $item->nominal_trx,
                            "keterangan" => $item->keterangan
                        ];
                    }

                    TransactionMakerACDC::insert($insertData);
                    // foreach ($optyMaker as $item) {
                    //     $item->delete();
                    // }

                    $opty->update(['is_moved' => true]);

                    DB::commit();

                    return redirect()->route('editcp', ['id' => $project->id])->with([
                        'success' => "Berhasil memindah data Opty $opty->project_name ke Project"
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error',  $e->getMessage());
        }
    }
}
