<?php

namespace App\Http\Controllers;
use App\Models\User;

class AdminController extends Controller
{
    protected function approve($id) {
        try {
            User::find($id)->assignRole('owner');
            toast('Status berhasil diubah', 'success');
        } catch (\Throwable $th) {
            toast('Status gagal diubah', 'error');    
        }

        return redirect('/dashboard');
    }
}
