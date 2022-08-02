<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
        //! ini pengecekan role super
        if ( Auth::user()->hasRole('Super Admin')) {
            // jika role super admin  -> arahkan ke dashboard super admin
            return redirect()->intended('dashboardSuperAdmin');
        } 
        
        //! ini pengecekan role AM/Sales
        else if (Auth::user()->hasRole('AM/Sales')) {
            // jika role super AM/Sales'  -> arahkan ke dashboard am/sales
            return redirect()->intended('dashboardAmSales');
        } 

        //! ini pengecekan role Pm
        else if (Auth::user()->hasRole('PM')) {
            // jika role super PM  -> arahkan ke dashboard Pm
            return redirect()->intended('dashboardpm');
        } 

        //! ini pengecekan admin project
        if ( Auth::user()->hasRole('Project Admin')) {
            // jika role super admin  -> arahkan ke dashboard super admin
            return redirect()->intended('adminproject');
            // return response()->json([
            //     "status" => 'ok'
            // ]);
        } 

        //! ini pengecekan role management
        else if (Auth::user()->hasRole('Management')) {
            // jika role super Management  -> arahkan ke dashboard Management
            return redirect()->intended('um/dashboard');

        } 

        //! ini pengecekan role Technikal
        else if (Auth::user()->hasRole('Technikal')) {
            // jika role super Technikal  -> arahkan ke dashboard Technikal
            return redirect()->intended('dashboardTeknikal');
        } 

        //! ini pengecekan role Pm Lead
        else if (Auth::user()->hasRole('PM')) {
            // jika role super Pm Lead  -> arahkan ke dashboard Pm Lead
            return response()->json([
               
            ]);
        } 

        //! ini pengecekan role finance
        else if (Auth::user()->hasRole('Finance')) {
            // jika role super finance  -> arahkan ke dashboard finance
            return response()->json([
                "message " => 'ini dashboard finance'
            ]);
        } 

        else if (Auth::user()->hasRole('PM Lead')) {
            // jika role super Pm Lead  -> arahkan ke dashboard Pm Lead
            return redirect()->intended('dashboardlead');
        } 
        
                    
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
 
        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
 
        return redirect('/login');
    }
}
