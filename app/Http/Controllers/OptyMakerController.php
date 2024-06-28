<?php

namespace App\Http\Controllers;

use App\Models\OptyMaker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OptyMakerController extends Controller
{
    public function store(Request $request, $opty_id)
    {
        try {
            $now = Carbon::now()->format('Y-m-d');

            if ($request->date_trx > $now) {
                return redirect()->back()->with('error', 'Tanggal transaksi tidak boleh lebih dari hari ini.');
            }

            $requestAll = $request->all();
            $requestAll['file'] = $this->save_file($request->file('file'));
            $requestAll['nominal_trx'] = str_replace([".", ","], "", $request->nominal_trx);
            $requestAll['opty_id'] = $opty_id;

            OptyMaker::create($requestAll);

            return redirect()->back()->with([
                'success' => "Opty Maker berhasil dibuat"
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $optyMaker = OptyMaker::find($id);

        $optyMaker->nominal_trx = number_format($optyMaker->nominal_trx);
        $optyMaker->date_trx = Carbon::parse($optyMaker->date_trx)->format('Y-m-d');

        return response()->json($optyMaker);
    }

    public function update(Request $request, $id)
    {
        try {
            $optyMaker = OptyMaker::find($id);
            $requestAll = $request->all();

            if (!empty($request->file)) {
                $requestAll['file'] = $this->save_file($request->file('file'));
            }

            $requestAll['nominal_trx'] = str_replace([".", ","], "", $request->nominal_trx);

            $optyMaker->update($requestAll);

            return redirect()->back()->with([
                'success' => "Data berhasil diubah"
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function save_file($request)
    {
        $path = public_path('uploads/opty-maker');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $file = $request;
        $file_ext = $file->extension();
        $file_name = time() . '.' . $file_ext;
        $file->move($path, $file_name);

        return $file_name;
    }
}
