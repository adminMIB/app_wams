<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\FakturPenjualan;
use App\Models\Pembelian;
use App\Models\PenawaranPesanan;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class FinanceController extends Controller
{
    
    public function index()
    {
        return view('finance.Dashboard');
    }

    public function indexproject()
    {
        $data = SalesOrder::all();
        return view('finance.projectdeal', compact('data'));
    }
    

    public function Projectdetail($id){

        $shorder = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies','bast.so','dokumen_projects.lto')->find($id);
        $user = Role::with('users')->where('name', 'Technikal')->get();
        return view('finance.projectview',compact('shorder','user'));
    }
    
    public function penjualandetail($id){

        $shorder = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies','bast.so','dokumen_projects.lto')->find($id);
        $user = Role::with('users')->where('name', 'Technikal')->get();
        return view('finance.penjualan.penjualandetail',compact('shorder','user'));
    }

    
    public function datapenjualan()
    {
        $penawaran = PenawaranPesanan::all();

        return view('finance.penjualan.data-penjualan', compact('penawaran'));
    }
    public function datapesanan()
    {
        $penawaran = PenawaranPesanan::all();

        return view('finance.penjualan.data-pesanan', compact('penawaran'));
    }
    public function datafaktur()
    {
        $faktur = PenawaranPesanan::all();

        return view('finance.penjualan.data-faktur', compact('faktur'));
    }

    public function datapembelian()
    {
        $pembelian = Pembelian::all();

        return view('finance.pembelian.data-pembelian', compact('pembelian'));
    }
    public function datapesananpembelian()
    {
        $pembelian = Pembelian::all();

        return view('finance.pembelian.data-pesananP', compact('pembelian'));
    }
    public function datafakturpembelian()
    {
        $fakturpembelian = Pembelian::all();

        return view('finance.pembelian.data-fakturP', compact('fakturpembelian'));
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
