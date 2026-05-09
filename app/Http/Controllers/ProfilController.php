<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function show()
    {
        return view('pages.profil');
    }

    public function edit()
    {
        return view('pages.profiledit');
    }

    public function apiGet()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Belum login'], 401);
        }
        return response()->json([
            'success' => true,
            'user' => [
                'id'    => $user->id,
                'nama'  => $user->nama,
                'email' => $user->email,
                'bio'   => $user->bio,
            ],
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama'     => 'required|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'bio'      => 'nullable|max:500',
        ], [
            'nama.required' => 'Nama pengguna wajib diisi (maks. 100 karakter).',
            'email.email'   => 'Format email tidak valid.',
            'email.unique'  => 'Email sudah digunakan akun lain.',
            'password.min'  => 'Kata sandi minimal 8 karakter.',
            'bio.max'       => 'Bio maksimal 500 karakter.',
        ]);

        $user->nama  = $request->nama;
        $user->email = $request->email;
        $user->bio   = $request->bio;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.',
            'user'    => ['nama' => $user->nama, 'email' => $user->email],
        ]);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $password = $request->input('password', '');

        if ($password === '') {
            return response()->json(['success' => false, 'message' => 'Kata sandi wajib diisi untuk konfirmasi.'], 422);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Kata sandi salah. Akun tidak dihapus.'], 401);
        }

        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true, 'message' => 'Akun berhasil dihapus.']);
    }
}
