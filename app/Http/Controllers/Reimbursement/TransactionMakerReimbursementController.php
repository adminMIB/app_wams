<?php

namespace App\Http\Controllers\Reimbursement;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class TransactionMakerReimbursementController extends Controller
{

    public function showDetails(Request $request, $id)
    {
        if (!auth()->user()->can('views')) {
            abort(403, 'Dont have access');
        } else {

            if ($request->ajax()) {
                $data = DB::table('transaction_maker_reimbursements')
                    ->where('reimbursements_id', $id)
                    ->join('personel_teams', 'transaction_maker_reimbursements.nama_pic_reimbursement', '=', 'personel_teams.id')
                    ->select(
                        'transaction_maker_reimbursements.id',
                        'transaction_maker_reimbursements.tanggal_reimbursement as tanggal',
                        'personel_teams.name as nama_pic',
                        'transaction_maker_reimbursements.nominal_reimbursement as nominal',
                    )

                    ->latest('transaction_maker_reimbursements.id')
                    ->get();


                // Format data untuk DataTables
                $dataTable = DataTables::of($data)
                    ->editColumn('tanggal', function ($val) {
                        return $val->tanggal ? Carbon::parse($val->tanggal)->translatedFormat("Y-m-d") : '';
                    })
                    ->editColumn('nominal', function ($val) {
                        return "Rp. " . number_format($val->nominal, 0, ',', '.');
                    })
                    ->filter(function ($query) use ($request) {
                        if ($request->get('search')['value']) {
                            $searchValue = strtolower($request->get('search')['value']);
                            $query->whereRaw('LOWER(personel_teams.name) LIKE ?', ["%{$searchValue}%"]);
                        }
                    })
                    ->addIndexColumn()
                    ->make(true);

                return $dataTable;
            }

            return view('reimbursement.detail');
        }
    }



    public function store(Request $request)
    {

        if (!auth()->user()->can('create')) {
            return response()->json(['error' => 'Dont have access!'], 403);
        } else {

            $request->validate([
                'tanggal_reimbursement' => 'required',
                'nominal_reimbursement' => 'required',
            ]);


            try {
                $path = public_path('uploads/reimbursements-maker');

                if (!File::exists($path)) {
                    File::makeDirectory($path, 0755, true, true);
                }

                // Upload file_kwitansi
                $file_kwitansi = $request->file('file_kwitansi');
                $file_name_kwitansi = time() . '-' . str_replace(" ", "_", $file_kwitansi->getClientOriginalName());
                $file_kwitansi->move($path, $file_name_kwitansi);

                // Upload file_mom
                $file_mom = $request->file('file_mom');
                $file_name_mom = time() . '-' . str_replace(" ", "_", $file_mom->getClientOriginalName());
                $file_mom->move($path, $file_name_mom);

                // Remove dots from nominal_reimbursement and convert to integer
                $nominal_reimbursement = str_replace('.', '', $request->nominal_reimbursement);
                $nominal_reimbursement = (int) $nominal_reimbursement;

                // Simpan ke basis data
                DB::table('transaction_maker_reimbursements')->insert([
                    "tanggal_reimbursement"     => $request->tanggal_reimbursement,
                    "nominal_reimbursement"     => $nominal_reimbursement,
                    "nama_pic_reimbursement"    => $request->nama_pic,
                    "client"                    => $request->client,
                    "pic_business_channel"      => $request->client ?? '-',
                    "pic_client"                => '-',
                    "file_kwitansi"             => $file_name_kwitansi,
                    "file_MoM"                  => $file_name_mom,
                    "keterangan"                => $request->keterangan ?? '-',
                    "reimbursements_id"         => $request->rembursement_id,
                    "created_at"                => Carbon::now(),
                    "updated_at"                => Carbon::now()
                ]);

                return response()->json("Transaction Maker created successfully")->setStatusCode(201);
            } catch (\Exception $e) {
                Log::error('Error creating reimbursement: ' . $e->getMessage());
                return response()->json(["error" => "There was an error creating the reimbursement"], 500);
            }
        }
    }

    // UPDATE DATA
    public function edit($id)
    {
        if (!auth()->user()->can('views')) {

            return response()->json(['error' => 'Dont have access!'], 403);
        } else {

            $reimbursementTransactionMaker = DB::table('transaction_maker_reimbursements')
                ->where('id', $id)
                // ->join('opties', 'reimbursements.nama_project', '=', 'opties.id')
                ->select("id", "tanggal_reimbursement as tanggal", "nama_pic_reimbursement as nama_pic", "nominal_reimbursement as nominal", "keterangan", "created_at")
                ->first();

            // Jika data tidak ditemukan, return response kosong atau response dengan pesan error
            if (!$reimbursementTransactionMaker) {
                return response()->json(['error' => 'Reimbursement not found'], 404);
            }

            // Masukkan data projects dan reimbursement ke dalam satu array
            $data = [
                'reimbursementMaker' => $reimbursementTransactionMaker,
                'editMode' => true // Tambahkan informasi editMode true
            ];

            // Return data dalam format JSON
            return response()->json($data);
        }
    }

    public function update(Request $request, $id)
    {

        if (!auth()->user()->can('update')) {
            return response()->json(['error' => 'Dont have access!'], 403);
        } else {

            try {
                // Ambil data default dari database berdasarkan ID
                $dataDefault = DB::table('transaction_maker_reimbursements')
                    ->select(
                        'id',
                        'tanggal_reimbursement',
                        'nominal_reimbursement',
                        'nama_pic_reimbursement',
                        'client',
                        'pic_business_channel',
                        'pic_client',
                        'file_kwitansi',
                        'file_MoM',
                        'keterangan',
                        'reimbursements_id',
                        'created_at',
                        'updated_at'
                    )
                    ->where('id', $request->id)
                    ->first();


                if (!$dataDefault) {
                    return response()->json(['error' => 'Data transaction_maker_reimbursements not found for ID ' .  $request->id], 404);
                }

                // Pastikan path untuk menyimpan file sudah ada
                $path = public_path('uploads/reimbursements-maker');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0755, true, true);
                }

                // Upload file_kwitansi
                $file_kwitansi = $request->file('file_kwitansi');
                $file_name_kwitansi = $file_kwitansi ? time() . '-' . str_replace(" ", "_", $file_kwitansi->getClientOriginalName()) : $dataDefault->file_kwitansi;
                if ($file_kwitansi) {
                    $file_kwitansi->move($path, $file_name_kwitansi);
                }

                // Upload file_mom
                $file_mom = $request->file('file_mom');
                $file_name_mom = $file_mom ? time() . '-' . str_replace(" ", "_", $file_mom->getClientOriginalName()) : $dataDefault->file_MoM;
                if ($file_mom) {
                    $file_mom->move($path, $file_name_mom);
                }

                // Remove dots from nominal_reimbursement and convert to integer
                $nominal_reimbursement = str_replace('.', '', $request->nominal_reimbursement);
                $nominal_reimbursement = (int) $nominal_reimbursement;

                // Simpan ke basis data
                DB::table('transaction_maker_reimbursements')
                    ->where('id',  $request->id)
                    ->update([
                        "tanggal_reimbursement"     => $request->tanggal_reimbursement ?? $dataDefault->tanggal_reimbursement,
                        "nominal_reimbursement"     => $nominal_reimbursement ?? $dataDefault->nominal_reimbursement,
                        "nama_pic_reimbursement"    => $request->nama_pic ?? $dataDefault->nama_pic_reimbursement,
                        "client"                    => $request->client ?? $dataDefault->client,
                        "pic_business_channel"      => $request->client ?? $dataDefault->client ?? '-',
                        "pic_client"                => '-',
                        "file_kwitansi"             => $file_name_kwitansi,
                        "file_MoM"                  => $file_name_mom,
                        "keterangan"                => $request->keterangan ?? $dataDefault->keterangan ?? '-',
                        "reimbursements_id"         => $dataDefault->reimbursements_id ?? $request->rembursement_id,
                        "updated_at"                => Carbon::now()
                    ]);

                return response()->json("Transaction Maker updated successfully")->setStatusCode(200);
            } catch (\Exception $e) {
                Log::error('Error updating reimbursement: ' . $e->getMessage()); // Log error untuk memeriksa detailnya
                return response()->json(["error" => "There was an error updating the reimbursement ||" . $e->getMessage()], 500);
            }
        }
    }


    public function destroy($id)
    {
        if (!auth()->user()->can('delete')) {
            return response()->json(['error' => 'Dont have access!'], 403);
        } else {

            try {
                $personelTeams = DB::table('transaction_maker_reimbursements')->where('id', $id)->first();

                if ($personelTeams) {
                    DB::table('transaction_maker_reimbursements')->where('id', $id)->delete();

                    return response()->json("Transaction Maker, berhasil dihapus");
                } else {
                    return response()->json(['message' => '"Transaction Maker'], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }


    public function moveTransactionMakerReimbursmenet(Request $request, $id)
    {
        if (!auth()->user()->can('update')) {
            abort(403, 'Dont have access');
        } else {

            try {
                $dataReimbursmentsById = DB::table('reimbursements')->where('id_reimbursement', $request->id_project_reimbursement)->first();

                DB::table('transaction_maker_reimbursements')->where('id', $request->id_maker)->update([
                    // "nama_pic_reimbursement"   => $dataReimbursmentsById->pic_bussiness_channel,
                    // "pic_business_channel"     => $dataReimbursmentsById->pic_bussiness_channel,
                    "reimbursements_id"        => $dataReimbursmentsById->id,
                ]);

                return redirect("/reimbursement/{$request->rembursement_id}")->with([
                    'success' => 'Move Transaction Maker berhasil'
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}
