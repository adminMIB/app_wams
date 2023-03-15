<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\FakturPembelian;
use App\Models\Pembelian;
use App\Models\PenawaranPesanan;
use App\Models\Barang;
use App\Models\BarangFaktur;
use App\Models\BarangFakturPembelian;
use App\Models\Customer;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class FakturPembelianController extends Controller
{

    public function index($id)
    {
        $shorder = SalesOrder::with('pembelian')->find($id);
        return view('finance.pembelian.fakturPemblian', compact('shorder'));
    }

    public function faktur_pdf($id)
    {
        $shorder = FakturPembelian::find($id);
        $pdf = PDF::loadView('finance.pembelian.pdf.faktur-penjualan-pdf',['shorder'=>$shorder]);
	    return $pdf->stream('Faktur_Pembelian.pdf');
        // return view('finance.faktur-penjualan-pdf', compact('shorder'));
    }

    public function create($id)
    {
        $q = DB::table('faktur_pembelians')->select(DB::raw('MAX(LEFT(no_faktur,3)) as kode'));
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

        $shorder = Pembelian::with('barang')->find($id);
        $customer = Customer::all();
        $bank = Bank::all();
        $brg = Barang::all();
    // return $shorder;
        return view('finance.pembelian.createFaktur', compact('shorder', 'dd','customer','bank','brg'));
    }

    public function store(Request $request)
    {
        // return $request->total;
        $data1=$request->all();
        $validator = Validator::make($request->all(),[
            'tanggal_faktur'  => 'required',
            'tgl_pengiriman'  => 'required',
            'alamat'          => 'required', 
        ]);  

        if($validator->fails()) {
            return back()->with('error', 'Pelase Provei all value');
        }

        $brang = $request->nama_barang;

        try {

            $time= FakturPembelian::create([
                'nama_client'           => $data1['nama_client'],
                'tanggal_faktur'        => $data1 ['tanggal_faktur'],
                'no_form'               => $data1 ['no_form'],
                'no_faktur'             => $data1 ['no_faktur'],
                'pajak'                 => $data1 ['pajak'],
                'mata_uang'             => $data1 ['mata_uang'],
                'status'                => "Belum Lunas",
                'alamat'                => $data1 ['alamat'],
                'tgl_pengiriman'        => $data1 ['tgl_pengiriman'],
                'pengiriman'            => $data1 ['pengiriman'],
                'syarat_pembayaran'     => $data1 ['syarat_pembayaran'],
                'FOB'                   => $data1 ['FOB'],
                'total'                 => $data1 ['totalfak'],
                'keterangan'            => $data1 ['keterangan'],
                'pembelian_id'          => $data1 ['pembelian_id'],
            ]);

            if ($brang !== null) {
                foreach ($data1['kuantitas'] as $item => $value) {
                    $data2 = array(
                        'fapem_id' => $time->id,
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
                    BarangFakturPembelian::create($data2);
                }
            }

            // update status pembelian -> terporoses
            $data = Pembelian::find($data1 ['pembelian_id']);
            $data->update([
                'status' => "Terproses"
            ]);

           
        
            return redirect()->to('detailFaktur/'.$data1['lto_id'])->with('success', 'Data Berhasil Di Simpan');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        $shorder = SalesOrder::with('pembelian')->find($id);
        // return $shorder;
        return view('finance.pembelian.detailFaktur', compact('shorder'));
    }

    public function showFakturPembelianSyarat($id)
    {
        // $shorder = Pembelian::with('barang', 'fakturPembelian')->find($id);
        $shorder = FakturPembelian::with('pembelian')->find($id);
        // return $shorder;
        return view('finance.pembelian.detailFakturPembelianSyarat', compact('shorder'));
    }

    public function update(Request $request, $id)
    {
        $shorder = FakturPembelian::with('pembelian')->find($id);
        
        $data1=$request->all();
        $shorder->update([
                'nama_client'           => $data1['nama_client'],
                'tanggal_faktur'        => $data1 ['tanggal_faktur'],
                'pajak'                 => $data1 ['pajak'],
                'mata_uang'             => $data1 ['mata_uang'],
                'status'                => "Belum Lunas",
                'alamat'                => $data1 ['alamat'],
                'tgl_pengiriman'        => $data1 ['tgl_pengiriman'],
                'pengiriman'            => $data1 ['pengiriman'],
                'syarat_pembayaran'     => $data1 ['syarat_pembayaran'],
                'FOB'                   => $data1 ['FOB'],
                'keterangan'            => $data1 ['keterangan'],
        ]);

        return redirect()->to('detailSyaratFaktur/'.$shorder->id)->with('success', 'Data Berhasil Di Update');
    }


    public function destroy($id)
    {
        //
    }


    //! pembayaran
    public function indexPembayaran($id)
    {
        $shorder = SalesOrder::with('pembelian')->find($id);
        // return $shorder;
        return view('finance.pembelian.pembayaranPembelian', compact('shorder'));
    }

    public function showPembayaranPembelian($id)
    {
        $shorder = FakturPembelian::with('pembelian')->find($id);
        $bank    = Bank::all();
        // return $bank;
        // return $shorder;
        // return $shorder;
        return view('finance.pembelian.showPembayaranPembelian', compact('shorder', 'bank'));
    }


    public function addPembayaranPembelian(Request $request, $id)
    {
        // return 'ok';
        $penerimaan = FakturPembelian::find($id);
        $validate = Validator::make($request->all(), [
            "bank"               => "required",
            "tgl_bayar"      => "required",
            "metode_pembayaran"  => "required",
            "nilai_pembayaran"   => "required",
            
        ]);

        if ($validate->fails()) {
            return back()->with('error', 'Please Provide All Values!');
        }

        $data1= $request->all();

        if ($penerimaan->total == $data1['nilai_pembayaran']) {
            try {
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
                // return redirect()->to('detaileFaktur/'.$data1['lto_id'])->with('success', 'Data Berhasil Di Simpan');
    
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
        } 

        if ($data1['nilai_pembayaran'] > $penerimaan->tota) {
            try {
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
                // return redirect()->to('detaileFaktur/'.$data1['lto_id'])->with('success', 'Data Berhasil Di Simpan');
    
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
        } 

        // jika belum lunas bayaarnya
        try {
                $penerimaan->update([
                    'nama_client' => $data1['nama_client'],
                    'mata_uang' => $data1['mata_uang'],
                    'bank' => $data1 ['bank'],
                    'metode_pembayaran' => $data1 ['metode_pembayaran'],
                    'nilai_pembayaran' => $data1 ['nilai_pembayaran'],
                    'no_bukti' => $data1 ['no_bukti'],
                    'tgl_bayar' => $data1 ['tgl_bayar'],
                    'status' => "Belum Lunas",
                ]);
                return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
                // return redirect()->to('detaileFaktur/'.$data1['lto_id'])->with('success', 'Data Berhasil Di Simpan');
    
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
    }

    // public function fakturPembelian_pdf($id)
    // {
    //     $shorder = Pembelian::find($id);
    //     $tanggal = date('l, m-Y');
    //     // $pdf = PDF::loadView('finance.pembelian.fakturPembelianPdf',[
    //     //     'shorder'=>$shorder,
    //     //     'tanggal'=>$tanggal
    //     // ]);

    //     return $shorder;

    //     // return $pdf->download('invoice.pdf');
    //     return view('finance.pembelian.fakturPembelianPdf', compact('shorder'));
    // }
    public function fakturPembelian_pdf()
    {
        // $shorder = Pembelian::find();
        // $tanggal = date('l, m-Y');
        // $pdf = PDF::loadView('finance.pembelian.fakturPembelianPdf');

        // return $pdf->download('invoice.pdf');
        return view('finance.pembelian.fakturPembelianPdf');

        
    }

    public function showfakturPembelian($id)
    {
        $shorder = FakturPembelian::with('fakturpembelian')->find($id);
        $brg= Barang::all();
        // return $shorder;
        return view('finance.pembelian.showFakturPembelian', compact('shorder','brg'));
    }

    public function edit($id)
    {
        $shorder = BarangFakturPembelian::with('fpn')->find($id);
        $brg = Barang::all();
        $customer = Customer::all();
        $bank = Bank::all();
        return view('finance.pembelian.edit-fakturP',compact('shorder','brg','bank','customer'));
    }

    // public function fakturPembelian_pdf()
    // {
    //     // $shorder = Pembelian::find();
    //     // $tanggal = date('l, m-Y');
    //     $pdf = PDF::loadView('finance.pembelian.fakturPembelianPdf');

    //     return $pdf->download('invoice.pdf');
    // }

    
    public function updateFP(Request $request, $id)
    {
        $pay = BarangFakturPembelian::find($id);

        try {
            $validate = Validator::make($request->all(), [
                "nama_client" => "required",
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

            $time = FakturPembelian::find($pay->fapem_id);

            $time->update([
                
                'nama_client' => $data1['nama_client'],
                'tanggal_faktur' => $data1 ['tanggal_faktur'],
                'no_form' => $data1 ['no_form'],
                'mata_uang' => $data1 ['mata_uang'],
                'tgl_pengiriman' => $data1 ['tgl_pengiriman'],
                'no_faktur' => $data1 ['no_faktur'],
                'pengiriman' => $data1 ['pengiriman'],
                'pajak' => $data1 ['pajak'],
                'alamat' => $data1 ['alamat'],
                'syarat_pembayaran' => $data1 ['syarat_pembayaran'],
                'FOB' => $data1 ['FOB'],
                'keterangan' => $data1 ['keterangan'],
                'total' => $data1 ['total'],
            ]);
            

            return redirect()->to('PembelianFaktur/'.$pay->fapem_id)->with('success', 'Data Berhasil Di Update');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function addbrngFP(Request $request,$id)
    {

        $time = FakturPembelian::with('fakturpembelian')->find($id);

        $data1=$request->all();
        // dd($data1['ppn']);
        $pay= new BarangFakturPembelian();

            if ($request->ppn  == null) {
            $pay->fapem_id = $time->id;
            $pay->nama_barang=$data1['nama_barang'];
            $pay->kuantitas=$data1['kuantitas'];
            $pay->harga=$data1['harga'];
            $pay->hargakuan= $pay->kuantitas * $pay->harga;
            $pay->diskon=$data1['diskon'];
            $pay->total_harga=$data1['total_harga'];
            $pay->total_diskon = $data1['total_diskon'];
            $pay->save();
            } else {
                $pay->fapem_id = $time->id;
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
}
