<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangPembelian;
use App\Models\Customer;
use App\Models\Departemen;
use App\Models\Distributor;
use App\Models\Pembelian;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class PembelianController extends Controller
{
    public function index()
    {
        $data = SalesOrder::all();
        // return $data;
        return view('finance.pembelian.index',compact('data'));
    }

    public function indexPesananPembelian($id)
    {   
        $dataSO = SalesOrder::with('pembelian')->find($id);
        // return $dataSO;
        return view('finance.pembelian.indexPesananPembelian', compact('dataSO'));
    }

    public function pesanan_pembelian_pdf($id)
    {
        $shorder = Pembelian::find($id);
        $pdf = PDF::loadView('finance.pembelian.pdf.penawaran-pdf',['shorder'=>$shorder]);
	    return $pdf->stream('Pesanan_Pembelian.pdf');
        // return view('finance.penjualan.pdf.penawaran-pdf', compact('shorder'));
    }

    public function create($id)
    {
        $shorder        = SalesOrder::find($id);
        $barang         = Barang::all();
        $distributor    = Distributor::all();
        $departemen     = Departemen::all();
        $customer       = Customer::all();

        // return $departemen;

        return view('finance.pembelian.createPesananPembelian',compact('shorder', 'barang', 'distributor', 'departemen', 'customer'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_client'       => 'required',
            "tgl_penjualan"     =>'required',
            "no_penjualan"      => 'required',
            // 'kode_project'      => 'required',
            "distributor"       =>'required',
            'alamat'            => 'required',
            "tgl_pengiriman"    =>'required',
            // "syarat_pembayaran" => 'required',
            "nama_barang"       => 'required',
            "kuantitas"         => 'required',

        ]);    

        if($validator->fails()) {
            return back()->with('error', 'Silahakan Isi Data Berikut!');
        }

        try {
            $dataPembelian = Pembelian::create([
                'nama_client'          => $request->nama_client,
                'tgl_penjualan'        => $request->tgl_penjualan,
                "no_penjualan"         => $request->no_penjualan,            
                'kode_project'         => $request->kode_project,
                'nama_disti'           => $request->distributor,
                'departemen'           => $request->departemen,
                'alamat'               => $request->alamat,
                'pajak'                => $request->pajak,
                'tgl_pengiriman'       => $request->tgl_pengiriman,
                'pengiriman'           => $request->pengiriman,
                'syarat_pembayaran'    => $request->syarat_pembayaran,
                'FOB'                  => $request->FOB,
                'keterangan'           => $request->keterangan,
                'lto_id'               => $request->lto_id,
            ]) ;
    
    
            $barangPembelian= new BarangPembelian();
    
            $barangPembelian->pembelian_id  = $dataPembelian->id;
            $barangPembelian->nama_barang   = $request->nama_barang;
            $barangPembelian->kuantitas     = $request->kuantitas;
            $barangPembelian->harga         = $request->harga;
            $barangPembelian->hargakuan= $barangPembelian->kuantitas * $barangPembelian->harga;
            $barangPembelian->diskon        = $request->diskon;
            $barangPembelian->total_harga   = $request->total_harga;
            $barangPembelian->ppn           = $request->ppn;
            $barangPembelian->total_ppn=($request['ppn']/100) * $request['total_harga'];
            $barangPembelian->total = $request['total_harga'] + ($request['ppn']/100) * $request['total_harga'];
            $barangPembelian->save();
    
            // if ($request->ppn  == null) {
            // $barangPembelian->penjul_id = $time->id;
            // $barangPembelian->nama_barang=$data1['nama_barang'];
            // $barangPembelian->kuantitas=$data1['kuantitas'];
            // $barangPembelian->harga=$data1['harga'];
            // $barangPembelian->diskon=$data1['diskon'];
            // $barangPembelian->total_harga=$data1['total_harga'];
            // $barangPembelian->save();
            // } else {
            //     $barangPembelian->penjul_id = $time->id;
            //     $barangPembelian->nama_barang=$data1['nama_barang'];
            //     $barangPembelian->kuantitas=$data1['kuantitas'];
            //     $barangPembelian->harga=$data1['harga'];
            //     $barangPembelian->diskon=$data1['diskon'];
            //     $barangPembelian->total_harga=$data1['total_harga'];
            //     $barangPembelian->ppn=$data1['ppn'];
            //     $barangPembelian->total_diskon=($data1['ppn']/100) * $data1['total_harga'];
            //     $barangPembelian->total = $data1['total_harga'] + ($data1['ppn']/100) * $data1['total_harga'];
            //     $barangPembelian->save();
    
            // }

            return redirect()->to('showPembelian/'.$dataPembelian->id)->with('success', 'Data Berhasil Di Simpan');

        } catch (\Exception $error) {
            return response()->json($error->getMessage());
        }
    }

    public function addBarangPembelian(Request $request,$id)
    {
        $dataPembelian = Pembelian::with('barang')->find($id);

        $barangPembelian= new BarangPembelian();
            $barangPembelian->pembelian_id  = $dataPembelian->id;
            $barangPembelian->nama_barang   = $request->nama_barang;
            $barangPembelian->kuantitas     = $request->kuantitas;
            $barangPembelian->harga         = $request->harga;
            $barangPembelian->hargakuan= $barangPembelian->kuantitas * $barangPembelian->harga;
            $barangPembelian->diskon        = $request->diskon;
            $barangPembelian->total_harga   = $request->total_harga;
            $barangPembelian->ppn           = $request->ppn;
            $barangPembelian->total_ppn=($request['ppn']/100) * $request['total_harga'];
            $barangPembelian->total = $request['total_harga'] + ($request['ppn']/100) * $request['total_harga'];
            $barangPembelian->save();

        return redirect()->back()->with('success','Barang berhasil ditambahkan');
    }

    public function showPembelian($id)
    {
        $shorder = Pembelian::with('barang', 'fakturPembelian')->find($id);
        $barang         = Barang::all();

        return view('finance.pembelian.pembelians', compact('shorder', 'barang'));
    }

    public function edit($id)
    {
        $edt = BarangPembelian::with('pembelian')->find($id);
        $brg = Barang::all();
        $customer = Customer::all();
        $disti = Distributor::all();
        $dept = Departemen::all();
        // return $edt;
        return view('finance.pembelian.editPembelian',compact('edt','brg','customer','disti','dept'));
    }

    public function editStatus($id)
    {
        $item= Pembelian::find($id);
        return view('finance.pembelian.updateStatus',compact('item'));
    }

    public function update(Request $request, $id)
    {
        $pay = BarangPembelian::find($id);
        
        try {
            $data1=$request->all();

                $pay->nama_barang=$data1['nama_barang'];
                $pay->kuantitas=$data1['kuantitas'];
                $pay->harga=$data1['harga'];
                $pay->hargakuan= $pay->kuantitas * $pay->harga;
                $pay->diskon=$data1['diskon'];
                $pay->total_harga=$data1['total_harga'];
                $pay->update();
                

            $time = Pembelian::find($pay->pembelian_id);
            $time->update([
                'tgl_penjualan' => $data1 ['tgl_penjualan'],
                'nama_disti' => $data1 ['distributor'],
                'departemen' => $data1 ['departemen'],
                'syarat_pembayaran' => $data1 ['syarat_pembayaran'],
                'alamat' => $data1 ['alamat'],
                'pajak' => $data1 ['pajak'],
                'keterangan' => $data1 ['keterangan'],
                'pengiriman' => $data1 ['pengiriman'],
                'FOB' => $data1 ['FOB'],
                'tgl_pengiriman' => $data1 ['tgl_pengiriman'],
            ]);

            // return back()->with('success', 'Data Berhasil Di Update');
            return redirect()->to('showPembelian/'.$time->id)->with('success', 'Data Berhasil Di Update');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'status'  => 'required',
        ]);    

        if($validator->fails()) {
            return back()->with('error', 'Silahkan Pilih Isi Statu!');
        }

        $data = Pembelian::find($id);
        // return $data->lto_id;
        $data->update([
            'status' => $request->status
        ]);

        if ($request->status == "Menunggu diproses") {
            return redirect()->to('fakturPembelian/'.$data->lto_id);
        } elseif ($request->status == "Pembayaran") {
            return redirect()->to('pembayaranPembeli/'.$data->lto_id);
        } 

    }

    public function destroy($id)
    {
        $so = Pembelian::find($id);
        $am = BarangPembelian::all();
        
        foreach ($am as $key => $v) {
            $amid = $so->id; // 2 -> tabel salesorder

            if ($amid ==  $v->penjul_id) {
                BarangPembelian::find($v->id)->delete();
            }
        }

        $so->delete();
        return redirect()->back()->with('success','Data berhasil di hapus');

    }

    public function showFakturPembelians($id)
    {
        $shorder = pembelian::with('barang')->find($id);
        $brg= Barang::all();
        return view('finance.pembelian.fakturPembelians', compact('shorder','brg'));
    }
}
