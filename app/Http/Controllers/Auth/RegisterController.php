<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register', [
            'kodePelanggan' => generate_kode_pelanggan(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'kode_pelanggan' => ['required', 'string', 'max:255', 'unique:pelanggan,kode_pelanggan'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'alamat' => ['required', 'string'],
            'kota' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'pelanggan',
            ]);

            Pelanggan::create([
                'kode_pelanggan' => $validated['kode_pelanggan'],
                'user_id' => $user->id,
                'nama' => $validated['name'],
                'alamat' => $validated['alamat'],
                'kota' => $validated['kota'],
                'telepon' => $validated['telepon'],
            ]);

            return $user;
        });

        Auth::guard('web')->login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }
}