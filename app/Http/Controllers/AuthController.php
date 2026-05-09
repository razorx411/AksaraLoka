<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('pages.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Selamat datang, ' . Auth::user()->nama . '!',
                'user'    => [
                    'id'    => Auth::id(),
                    'nama'  => Auth::user()->nama,
                    'email' => Auth::user()->email,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'errors'  => ['email' => 'Email atau kata sandi salah.'],
        ], 401);
    }

    /**
     * Tampilkan halaman register.
     */
    public function showRegister()
    {
        return view('pages.register');
    }

    /**
     * Proses registrasi.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama'            => 'required|max:100',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ], [
            'nama.required'            => 'Nama pengguna wajib diisi.',
            'nama.max'                 => 'Nama pengguna maksimal 100 karakter.',
            'email.required'           => 'Email wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'email.unique'             => 'Email sudah terdaftar. Silakan masuk.',
            'password.required'        => 'Kata sandi wajib diisi.',
            'password.min'             => 'Kata sandi minimal 8 karakter.',
            'confirmPassword.required' => 'Konfirmasi kata sandi wajib diisi.',
            'confirmPassword.same'     => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil dibuat! Selamat belajar Aksara Nusantara >_<',
        ], 201);
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
