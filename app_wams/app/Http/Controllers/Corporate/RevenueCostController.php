<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\SaldoAwal;
use App\Models\TransactionMakerRevCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RevenueCostController extends Controller
{
    public function createSaldo()
    {
        return view("corporate.revcost.create-saldo");
    }

    public function storeSaldo(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "jumlah_saldo" => "required|string|max:30",
                // "institusi" => "required|string",
                // "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $sld = new SaldoAwal;

            $sld->jumlah_saldo=$request->jumlah_saldo;
            $sld->tanggal_saldo=$request->tanggal_saldo;
            $sld->save();

            return redirect()->back()->with('success', 'Berhasil Create Saldo');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function indexTmaker()
    {
        $tmaker = TransactionMakerRevCost::all();

        return view("corporate.revcost.index-tmaker", compact('tmaker'));
    }

    public function createTmaker()
    {
        return view("corporate.revcost.transaction-maker");
    }

    public function storeTmaker(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                // "no_so" => "required|string",
                // "institusi" => "required|string",
                // "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $trx = new TransactionMakerRevCost;

            if (!$request->penerimaan_project) {
                $trx->project_id=$request->project_id;
                $trx->nama_project=$request->nama_project;
                $trx->nama_client=$request->nama_client;
                $trx->pic_sales=$request->pic_sales;
                $trx->pic_business_channel=$request->pic_business_channel;
                $trx->pengeluaran_project=$request->pengeluaran_project;
                $trx->tanggal_pengeluaran=$request->tanggal_pengeluaran;
                $trx->keterangan=$request->keterangan;
                $trx->save();
            }

            if (!$request->pengeluaran_project) {
                $trx->project_id=$request->project_id;
                $trx->nama_project=$request->nama_project;
                $trx->nama_client=$request->nama_client;
                $trx->pic_sales=$request->pic_sales;
                $trx->pic_business_channel=$request->pic_business_channel;
                $trx->penerimaan_project=$request->penerimaan_project;
                $trx->tanggal_penerimaan=$request->tanggal_penerimaan;
                $trx->keterangan=$request->keterangan;
                $trx->save();
            }

            return redirect()->back()->with('success', 'Berhasil Create Transaction Maker');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function index()
    {
        $tmaker = TransactionMakerRevCost::all();
        $sawal = SaldoAwal::all();

        return view("corporate.revcost.index", compact('tmaker', 'sawal'));
    }

    public function deleteAll()
    {
        DB::table('transaction_maker_rev_costs')->delete();
        DB::table('saldo_awals')->delete();

        return redirect()->back();
    }
}
