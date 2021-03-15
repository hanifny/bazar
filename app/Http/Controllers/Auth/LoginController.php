<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Retrive Input
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(auth()->user()->hasRole('admin')) {
                return redirect('/dashboard');
            } elseif(auth()->user()->hasRole('owner')) {
                return redirect('/orders');
            } elseif(auth()->user()->hasRole('customer')) {
                return redirect('/');
            } else {
                Auth::logout();
                Alert::info('Maaf', 'Akun Anda belum diaktivasi oleh Admin');
                return redirect('/');
            }  
        }

        return redirect('login');
    }
}
