<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return redirect('/owner');
            } else {
                return redirect('/products');
            }  
        }

        return redirect('login');
    }
}
