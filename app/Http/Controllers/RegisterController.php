<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255|min:3',
                'username' => 'required|unique:users',
                'password' => 'required|max:255',
            ]);

            $validated['password'] = Hash::make($validated['password']);

            $validated['role'] = 2;

            User::create($validated);

            return redirect('/login')->with('success', 'Akun Sudah Berhasil Dibuat! Silahkan Masuk');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', "Gagal membuat akun. Silahkan coba lagi. $e");
        }
    }
}
