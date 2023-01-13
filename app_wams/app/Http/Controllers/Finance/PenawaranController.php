<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Amount;
use App\Models\Barang;
use App\Models\BarangPenawaran;
use App\Models\Customer;
use App\Models\Departemen;
use App\Models\Distributor;
use App\Models\FakturPenjualan;
use App\Models\PenawaranPesanan;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDF;

class PenawaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SalesOrder::all();
        return view('finance.penjualan.penjualan', compact('data'));
        
    }

    public function indexpenawaran($id)
    {
        $shorder = SalesOrder::with('pps')->find($id);
        $brg = Barang::all();
        return view('finance.penjualan.penawaranpenjualan', compact('shorder','brg'));
    }

    public function pesanan_penjualan_pdf($id)
    {
        $shorder = PenawaranPesanan::find($id);
        $pdf = PDF::loadView('finance.penjualan.pdf.penawaran-pdf',['shorder'=>$shorder]);
	    return $pdf->stream('Pesanan_Penjualan.pdf');
        // return view('finance.penjualan.pdf.penawaran-pdf', compact('shorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showpenawaran($id)
    {
        $shorder = PenawaranPesanan::with('barang')->find($id);
        $brg= Barang::all();
        return view('finance.penjualan.penawaran', compact('shorder','brg'));
    }
   
    public function showpenawaranpesanan($id)
    {
        $shorder = PenawaranPesanan::with('barang')->find($id);
        $brg= Barang::all();
        return view('finance.penjualan.pesanan', compact('shorder','brg'));
    }
    
    public function showpesanan($id)
    {
        $shorder = SalesOrder::with('pps')->find($id);
        return view('finance.penjualan.pesananpenjualan', compact('shorder'));
    }

    public function create($id)
    {
        $shorder = SalesOrder::find($id);
        $brg = Barang::all();
        $customer = Customer::all();
        $disti = Distributor::all();
        $dept = Departemen::all();
        return view('finance.penjualan.create-penawaran',compact('shorder','brg', 'customer', 'disti', 'dept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "no_penjualan" => "required|string|unique:penawaran_pesanans",
                "nama_client" => "required",
                "kode_project" => "required",
                "nama_disti" => "required",
                "departemen" => "required",
                "proyek" => "required",
                "tgl_penjualan" => "required",
                "alamat" => "required",
                "pajak" => "required",
                "cabang" => "required",
                "mata_uang" => "required",
                "nama_barang" => "required",
                "kuantitas" => "required",
                "harga" => "required",
                "total_harga" => "required",
            ]);

            if ($validate->fails()) {
                return back()->with('error', 'nomor penawaran sudah di buat atau field belum diisi!!');
            }

            $data1=$request->all();

            $time = PenawaranPesanan::create([
                
                'nama_client' => $data1['nama_client'],
                'tgl_penjualan' => $data1 ['tgl_penjualan'],
                'no_penjualan' => $data1 ['no_penjualan'],
                'kode_project' => $data1 ['kode_project'],
                'nama_disti' => $data1 ['nama_disti'],
                'departemen' => $data1 ['departemen'],
                'proyek' => $data1 ['proyek'],
                // 'syarat_pembayaran' => $data1 ['syarat_pembayaran'],
                'alamat' => $data1 ['alamat'],
                'pajak' => $data1 ['pajak'],
                'cabang' => $data1 ['cabang'],
                'keterangan' => $data1 ['keterangan'],
                // 'pengiriman' => $data1 ['pengiriman'],
                // 'FOB' => $data1 ['FOB'],
                'mata_uang' => $data1 ['mata_uang'],
                // 'status' => $data1 ['status'],
                // 'nopo' => $data1 ['nopo'],
                // 'tgl_pengiriman' => $data1 ['tgl_pengiriman'],
                // 'tutup_pesanan' => $data1 ['tutup_pesanan'],
                'lto_id' => $data1 ['lto_id'],
            ]);

            $pay= new BarangPenawaran;

            if ($request->ppn  == null) {
            $pay->penjul_id = $time->id;
            $pay->nama_barang=$data1['nama_barang'];
            $pay->kuantitas=$data1['kuantitas'];
            $pay->harga=$data1['harga'];
            $pay->hargakuan= $pay->kuantitas * $pay->harga;
            $pay->diskon=$data1['diskon'];
            $pay->total_harga=$data1['total_harga'];
            $pay->total_diskon = $data1['total_diskon'];
            $pay->save();
            } else {
                $pay->penjul_id = $time->id;
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

            
            // $barang = BarangPenawaran::create([
            //     'penjul_id' => $time->id,
            //     'nama_barang' => $data1['nama_barang'],
            //     'kuantitas' => $data1['kuantitas'],
            //     'harga' => $data1['harga'],
            //     'diskon' => $data1['diskon'],
            //     'ppn' => $data1['ppn'],
            //     'total_harga' => $data1['total_harga'],
            //     'total_diskon' => $data1['total_diskon'],
            // ]);

            return redirect()->to('Penawaran/'.$time->id)->with('success', 'Data Berhasil Di Simpan');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function addbrng(Request $request,$id)
    {

        $time = PenawaranPesanan::with('barang')->find($id);

        $data1=$request->all();
        // dd($data1['ppn']);
        $pay= new BarangPenawaran;

            if ($request->ppn  == null) {
            $pay->penjul_id = $time->id;
            $pay->nama_barang=$data1['nama_barang'];
            $pay->kuantitas=$data1['kuantitas'];
            $pay->harga=$data1['harga'];
            $pay->hargakuan= $pay->kuantitas * $pay->harga;
            $pay->diskon=$data1['diskon'];
            $pay->total_harga=$data1['total_harga'];
            $pay->total_diskon = $data1['total_diskon'];
            $pay->save();
            } else {
                $pay->penjul_id = $time->id;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edt = BarangPenawaran::with('pp')->find($id);
        $brg = Barang::all();
        $customer = Customer::all();
        $disti = Distributor::all();
        $dept = Departemen::all();
        return view('finance.penjualan.edit-penawaran',compact('edt','brg','customer','disti','dept'));
    }
    
    public function editpesanan($id)
    {
        $edt = BarangPenawaran::with('pp')->find($id);
        $brg = Barang::all();
        $customer = Customer::all();
        $disti = Distributor::all();
        $dept = Departemen::all();
        return view('finance.penjualan.edit-pesanan',compact('edt','brg','customer','disti','dept'));
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
        $pay = BarangPenawaran::find($id);

        try {
            $validate = Validator::make($request->all(), [
                "no_penjualan" => "required",
                "nama_client" => "required",
                "nama_disti" => "required",
                "departemen" => "required",
                "tgl_penjualan" => "required",
                "alamat" => "required",
                "pajak" => "required",
                "cabang" => "required",
                "mata_uang" => "required",
                "nama_barang" => "required",
                "kuantitas" => "required",
                "harga" => "required",
                "total_harga" => "required",
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

            $time = PenawaranPesanan::find($pay->penjul_id);

            $time->update([
                
                'nama_client' => $data1['nama_client'],
                'no_penjualan' => $data1 ['no_penjualan'],
                'tgl_penjualan' => $data1 ['tgl_penjualan'],
                'mata_uang' => $data1 ['mata_uang'],
                'nama_disti' => $data1 ['nama_disti'],
                'departemen' => $data1 ['departemen'],
                'alamat' => $data1 ['alamat'],
                'pajak' => $data1 ['pajak'],
                'cabang' => $data1 ['cabang'],
                'keterangan' => $data1 ['keterangan'],
            ]);
            

            return redirect()->to('Penawaran/'.$pay->penjul_id)->with('success', 'Data Berhasil Di Update');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
    public function updatepesanan(Request $request, $id)
    {
        $pay = BarangPenawaran::find($id);

        
        try {
            $validate = Validator::make($request->all(), [
                "no_pesanan" => "required",
                "nama_client" => "required",
                "nama_disti" => "required",
                "departemen" => "required",
                "tgl_penjualan" => "required",
                "alamat" => "required",
                "pajak" => "required",
                "cabang" => "required",
                "mata_uang" => "required",
                "nama_barang" => "required",
                "kuantitas" => "required",
                "harga" => "required",
                "total_harga" => "required",
                "syarat_pembayaran" => "required",
                "tgl_pengiriman" => "required",
                "FOB" => "required",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }
            $data1=$request->all();

            // dd($data1 ['no_pesanan']);

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

            $time = PenawaranPesanan::find($pay->penjul_id);

            if ($request->tutup_pesanan) {
                $time->update([
                
                    'no_pesanan' => $data1 ['no_pesanan'],
                    'tgl_penjualan' => $data1 ['tgl_penjualan'],
                    'nama_disti' => $data1 ['nama_disti'],
                    'departemen' => $data1 ['departemen'],
                    'proyek' => $data1 ['proyek'],
                    'syarat_pembayaran' => $data1 ['syarat_pembayaran'],
                    'alamat' => $data1 ['alamat'],
                    'pajak' => $data1 ['pajak'],
                    'cabang' => $data1 ['cabang'],
                    'keterangan' => $data1 ['keterangan'],
                    'pengiriman' => $data1 ['pengiriman'],
                    'FOB' => $data1 ['FOB'],
                    'mata_uang' => $data1 ['mata_uang'],
                    // 'status' => $data1 ['status'],
                    'nopo' => $data1 ['nopo'],
                    'tgl_pengiriman' => $data1 ['tgl_pengiriman'],
                    'tutup_pesanan' => $data1 ['tutup_pesanan'],
                ]);
            } else {
                $time->update([
                
                    'no_pesanan' => $data1 ['no_pesanan'],
                    'tgl_penjualan' => $data1 ['tgl_penjualan'],
                    'nama_disti' => $data1 ['nama_disti'],
                    'departemen' => $data1 ['departemen'],
                    'proyek' => $data1 ['proyek'],
                    'syarat_pembayaran' => $data1 ['syarat_pembayaran'],
                    'alamat' => $data1 ['alamat'],
                    'pajak' => $data1 ['pajak'],
                    'cabang' => $data1 ['cabang'],
                    'keterangan' => $data1 ['keterangan'],
                    'pengiriman' => $data1 ['pengiriman'],
                    'FOB' => $data1 ['FOB'],
                    'mata_uang' => $data1 ['mata_uang'],
                    // 'status' => $data1 ['status'],
                    'nopo' => $data1 ['nopo'],
                    'tgl_pengiriman' => $data1 ['tgl_pengiriman'],
                    'tutup_pesanan' => null,
                ]);
            }
            

            return redirect()->to('Pesanan/'.$pay->penjul_id)->with('success', 'Data Berhasil Di Update');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function updateST(Request $request, $id)
    {
        $st = PenawaranPesanan::find($id);

        $st->update([
            'status' => $request->status
        ]);

        if ($request->status == "menunggu pesanan") {
            return redirect()->to('Pesanan-Penjualan/'.$st->lto_id);
        } elseif ($request->status == "Terproses") {
            return redirect()->to('Faktur-Penjualan/'.$st->lto_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $so = PenawaranPesanan::find($id);
        // $soidp = Wodlist::all();
        $am = BarangPenawaran::all();
        $ftr = FakturPenjualan::all();

        foreach ($ftr as $key => $val) {
            if ($id == $val->pesanan_id) {
                return back()->with('error', 'Faktur already exists!!');
            }          
        }
        
        foreach ($am as $key => $v) {
            $amid = $so->id; // 2 -> tabel salesorder

            if ($amid ==  $v->penjul_id) {
                // return $v->id;
                BarangPenawaran::find($v->id)->delete();
            }
        }

        $so->delete();

        return redirect()->back()->with('success','Data berhasil di hapus');
    }

    public function editST($id)
    {
        $item= PenawaranPesanan::find($id);
        return view('finance.penjualan.update-status',compact('item'));
    }

    
}
