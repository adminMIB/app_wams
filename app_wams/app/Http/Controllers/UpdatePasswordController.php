<?php

namespace App\Http\Controllers;

use App\Models\ListProjet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdatePasswordController extends Controller
{

    public function index(){
        $datas = ListProjet::all()->count();
        $data = ListProjet::with('detail')->get();
        return view("ResetPasswword", compact("datas", "data"));
    }

    public function updatePassword(Request $request) {

        // dd(auth()->user()->);
        // dd(Hash::check($request->password, auth()->user()->password));

         $request->validate([
            'konfirmasiPassword' => 'required',
            'password' => 'required',
            'cek_password' => 'required', 'min:14', 'confirmed'
        ]);

        // cek sama tidak new_password == dengan isi new passwordnya
        if (Hash::check($request->konfirmasiPassword, auth()->user()->password)) {
            // dd("tidak saam");
                if ($request->password == $request->cek_password) {
                auth()->user()->update(['password' => Hash::make($request->cek_password)]);
                return back()->with('message', 'Your passsword has ben updated');    
            }
        }

        // jika password konfirmasi tidak sama, tampilkan pesan
        dd("Konfirmasi password anda salah!");

        throw ValidationException::withMessages([
            "konfirmasiPassword" => "your password doest not match out rescord"
        ]);
        

    }
}
