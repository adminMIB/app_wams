<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Barang;
use App\Models\BarangFaktur;
use App\Models\Customer;
use App\Models\Departemen;
use App\Models\Distributor;
use App\Models\FakturPenjualan;
use App\Models\PenawaranPesanan;
use App\Models\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class FakturPenjualanController extends Controller
{
    public function index($id)
    {
        $shorder = SalesOrder::with('pps')->find($id);
        return view('finance.penjualan.fakturpenjualan', compact('shorder'));
    }

    public function showfaktur($id)
    {
        $shorder = FakturPenjualan::with('barangfaktur')->find($id);
        $brg= Barang::all();
        // return $shorder;
        return view('finance.penjualan.faktur', compact('shorder','brg'));
    }

    public function detailfaktur($id)
    {
        $shorder = SalesOrder::with('pps')->find($id);
        return view('finance.penjualan.detailfakturpenjualan', compact('shorder'));
    }

    public function create($id)
    {
        $q = DB::table('faktur_penjualans')->select(DB::raw('MAX(LEFT(no_faktur,3)) as kode'));
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

        $shorder = PenawaranPesanan::with('barang')->find($id);
        $customer = Customer::all();
        $bank = Bank::all();
        $brg = Barang::all();
        return view('finance.penjualan.create-faktur', compact('shorder','brg', 'dd', 'customer', 'bank'));
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "no_faktur" => "required|string|unique:faktur_penjualans",
                "nama_client" => "required",
                "tgl_pesanan" => "required",
                "alamat" => "required",
                "pajak" => "required",
                "cabang" => "required",
                "mata_uang" => "required",
                "total" => "required",
                "syarat_pembayaran" => "required",
                "tgl_pengiriman" => "required",
                "FOB" => "required",
                "no_po" => "required",
                "jenis_dok" => "required",
                "no_faktur_pajak" => "required",
                "tgl_faktur" => "required",
                "end_user" => "required",
                "attention" => "required",
                "bank" => "required",
            ]);

            if ($validate->fails()) {
                return back()->with('error', 'Project sudah di buat atau field belum diisi!!');
            }
            $data1=$request->all();

            $brang = $request->nama_barang;

            $time = FakturPenjualan::create([
                
                'nama_client' => $data1['nama_client'],
                'tgl_pesanan' => $data1 ['tgl_pesanan'],
                'no_faktur' => $data1 ['no_faktur'],
                'no_po' => $data1 ['no_po'],
                'pajak' => $data1 ['pajak'],
                'mata_uang' => $data1 ['mata_uang'],
                'jenis_dok' => $data1 ['jenis_dok'],
                'no_faktur_pajak' => $data1 ['no_faktur_pajak'],
                'tgl_faktur' => $data1 ['tgl_faktur'],
                'alamat' => $data1 ['alamat'],
                'cabang' => $data1 ['cabang'],
                'tgl_pengiriman' => $data1 ['tgl_pengiriman'],
                'pengiriman' => $data1 ['pengiriman'],
                'syarat_pembayaran' => $data1 ['syarat_pembayaran'],
                'FOB' => $data1 ['FOB'],
                'end_user' => $data1 ['end_user'],
                // 'status' => $data1 ['status'],
                'attention' => $data1 ['attention'],
                'bank' => $data1 ['bank'],
                'keterangan' => $data1 ['keterangan'],
                'total' => $data1 ['totalfak'],
                'npwp' => $data1 ['npwp'],
                'phone' => $data1 ['phone'],
                'pesanan_id' => $data1 ['pesanan_id'],
            ]);

            if ($brang !== null) {
                foreach ($data1['kuantitas'] as $item => $value) {
                    $data2 = array(
                        'fajul_id' => $time->id,
                        'nama_barang' => $data1['nama_barang'][$item],
                        'kuantitas' => $data1['kuantitas'][$item],
                        'harga' => $data1['harga'][$item],
                        'hargakuan' => $data1['hargakuan'][$item],
                        'diskon' => $data1['diskon'][$item],
                        'ppn' => $data1['ppn'][$item],
                        'total_harga' => $data1['total_harga'][$item],
                        'total_ppn' => $data1['total_ppn'][$item],
                        'total_diskon' => $data1['total_diskon'][$item],
                        'total' => $data1['total'][$item],
                    );
                    BarangFaktur::create($data2);
                }
            }

            return redirect()->to('detailFaktur-Penjualan/'.$data1['lto_id'])->with('success', 'Data Berhasil Di Simpan');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function addbrng(Request $request,$id)
    {

        $time = FakturPenjualan::with('barangfaktur')->find($id);

        $data1=$request->all();
        // dd($data1['ppn']);
        $pay= new BarangFaktur();

            if ($request->ppn  == null) {
            $pay->fajul_id = $time->id;
            $pay->nama_barang=$data1['nama_barang'];
            $pay->kuantitas=$data1['kuantitas'];
            $pay->harga=$data1['harga'];
            $pay->hargakuan= $pay->kuantitas * $pay->harga;
            $pay->diskon=$data1['diskon'];
            $pay->total_harga=$data1['total_harga'];
            $pay->total_diskon = $data1['total_diskon'];
            $pay->save();
            } else {
                $pay->fajul_id = $time->id;
                $pay->nama_barang=$data1['nama_barang'];
                $pay->kuantitas=$data1['kuantitas'];
                $pay->harga=$data1['harga'];
                $pay->hargakuan= $pay->kuantitas * $pay->harga;
                $pay->diskon=$data1['diskon'];
                $pay->total_harga=$data1['total_harga'];
                $pay->ppn=$data1['ppn'];
                $pay->total_diskon=$data1['total_diskon'];
                $pay->total_ppn=($data1['ppn']/100) * $data1['total_harga'];
                $pay->total = $data1['total_harga'] + ($data1['ppn']/100) * $data1['total_harga'];
                $pay->save();
    
            }

        return redirect()->back()->with('success','Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $shorder = BarangFaktur::with('fp')->find($id);
        $brg = Barang::all();
        $customer = Customer::all();
        $bank = Bank::all();
        return view('finance.penjualan.edit-faktur',compact('shorder','brg','bank','customer'));
    }
        
    public function indexpenerimaan($id)
    {
        $shorder = SalesOrder::with('pps')->find($id);
        return view('finance.penjualan.penerimaanpenjualan', compact('shorder'));
    }
    
    public function showpembayaran($id)
    {
        $shorder = FakturPenjualan::with('pesanan')->find($id);
        return view('finance.penjualan.pembayaran', compact('shorder'));
    }
    
    public function addpenerimaan(Request $request, $id)
    {
        $penerimaan = FakturPenjualan::find($id);
        try {
            $validate = Validator::make($request->all(), [
                "no_bukti" => "required|string|unique:faktur_penjualans",
                "mata_uang" => "required",
                "nama_client" => "required",
                "bank" => "required",
                "metode_pembayaran" => "required",
                "nilai_pembayaran" => "required",
                "tgl_bayar" => "required",
            ]);

            if ($validate->fails()) {
                return back()->with('error', 'Project sudah di buat atau field belum diisi!!');
            }
            $data1= $request->all();

            $penerimaan->update([
                'nama_client' => $data1['nama_client'],
                'mata_uang' => $data1['mata_uang'],
                'bank' => $data1 ['bank'],
                'metode_pembayaran' => $data1 ['metode_pembayaran'],
                'nilai_pembayaran' => $data1 ['nilai_pembayaran'],
                'no_bukti' => $data1 ['no_bukti'],
                'tgl_bayar' => $data1 ['tgl_bayar'],
                'status' => "Lunas",
            ]);

            return redirect()->back()->with('success', 'Data Berhasil Di Simpan');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $pay = BarangFaktur::find($id);

        try {
            $validate = Validator::make($request->all(), [
                "nama_client" => "required",
                "tgl_pesanan" => "required",
                "alamat" => "required",
                "pajak" => "required",
                "cabang" => "required",
                "mata_uang" => "required",
                "total" => "required",
                "syarat_pembayaran" => "required",
                "tgl_pengiriman" => "required",
                "FOB" => "required",
                "no_po" => "required",
                "jenis_dok" => "required",
                "no_faktur_pajak" => "required",
                "tgl_faktur" => "required",
                "end_user" => "required",
                "attention" => "required",
                "bank" => "required",
            ]);

            if ($validate->fails()) {
                return back()->with('error', 'Project sudah di buat atau field belum diisi!!');
            }

            $data1=$request->all();

            if ($request->ppn  == null) {
                $pay->nama_barang=$data1['nama_barang'];
                $pay->kuantitas=$data1['kuantitas'];
                $pay->harga=$data1['harga'];
                $pay->hargakuan= $pay->kuantitas * $pay->harga;
                $pay->diskon=$data1['diskon'];
                $pay->total_harga=$data1['total_harga'];
                $pay->total_diskon = $data1['total_diskon'];
                $pay->update();
                } else {
                    $pay->nama_barang=$data1['nama_barang'];
                    $pay->kuantitas=$data1['kuantitas'];
                    $pay->harga=$data1['harga'];
                    $pay->hargakuan= $pay->kuantitas * $pay->harga;
                    $pay->diskon=$data1['diskon'];
                    $pay->total_harga=$data1['total_harga'];
                    $pay->ppn=$data1['ppn'];
                    $pay->total_diskon=$data1['total_diskon'];
                    $pay->total_ppn=($data1['ppn']/100) * $data1['total_harga'];
                    $pay->total = $data1['total_harga'] + ($data1['ppn']/100) * $data1['total_harga'];
                    $pay->update();
                }

            $time = FakturPenjualan::find($pay->fajul_id);

            $time->update([
                
                'nama_client' => $data1['nama_client'],
                'tgl_pesanan' => $data1 ['tgl_pesanan'],
                'no_faktur' => $data1 ['no_faktur'],
                'no_po' => $data1 ['no_po'],
                'pajak' => $data1 ['pajak'],
                'mata_uang' => $data1 ['mata_uang'],
                'jenis_dok' => $data1 ['jenis_dok'],
                'no_faktur_pajak' => $data1 ['no_faktur_pajak'],
                'tgl_faktur' => $data1 ['tgl_faktur'],
                'alamat' => $data1 ['alamat'],
                'cabang' => $data1 ['cabang'],
                'tgl_pengiriman' => $data1 ['tgl_pengiriman'],
                'pengiriman' => $data1 ['pengiriman'],
                'syarat_pembayaran' => $data1 ['syarat_pembayaran'],
                'FOB' => $data1 ['FOB'],
                'end_user' => $data1 ['end_user'],
                'attention' => $data1 ['attention'],
                'bank' => $data1 ['bank'],
                'keterangan' => $data1 ['keterangan'],
                'total' => $data1 ['total'],
                'npwp' => $data1 ['npwp'],
                'phone' => $data1 ['phone'],
            ]);
            

            return redirect()->to('Faktur/'.$pay->fajul_id)->with('success', 'Data Berhasil Di Update');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    // public function fakturpenjualan_pdf($id)
    // {
    //     $shorder = PenawaranPesanan::find($id);
    //     // $pdf = PDF::loadview('finance.faktur-penjualan-pdf',['shorder'=>$shorder]);
	//     // return $pdf->download('Faktur_Penjualan-pdf');
    //     return view('finance.faktur-penjualan-pdf', compact('shorder'));
    // }

    public function faktur_pdf($id)
    {
        $shorder = FakturPenjualan::find($id);
        $pdf = PDF::loadView('finance.penjualan.pdf.faktur-penjualan-pdf',['shorder'=>$shorder]);
	    return $pdf->download('Faktur_Penjualan.pdf');
        // return view('finance.faktur-penjualan-pdf', compact('shorder'));
    }

    
}
