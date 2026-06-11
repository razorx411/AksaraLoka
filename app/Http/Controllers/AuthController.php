<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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

            $user        = Auth::user();
            $redirectUrl = $user->isAdmin()
                ? route('admin.dashboard')
                : route('home');

            return response()->json([
                'success'      => true,
                'message'      => 'Selamat datang, ' . $user->username . '!',
                'redirect_url' => $redirectUrl,
                'user'         => [
                    'id'       => $user->id,
                    'username' => $user->username,
                    'email'    => $user->email,
                    'role'     => $user->role,
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
            'username'        => 'required|max:100',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ], [
            'username.required'        => 'Nama pengguna wajib diisi.',
            'username.max'             => 'Nama pengguna maksimal 100 karakter.',
            'email.required'           => 'Email wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'email.unique'             => 'Email sudah terdaftar. Silakan masuk.',
            'password.required'        => 'Kata sandi wajib diisi.',
            'password.min'             => 'Kata sandi minimal 8 karakter.',
            'confirmPassword.required' => 'Konfirmasi kata sandi wajib diisi.',
            'confirmPassword.same'     => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::create([
            'username' => $request->username,
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

    /**
     * Tampilkan halaman lupa sandi.
     */
    public function showForgotPassword()
    {
        return view('pages.forgot-password');
    }

    /**
     * Kirim email dengan tautan reset kata sandi.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.exists'   => 'Email tidak terdaftar di sistem kami.',
        ]);

        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Tautan atur ulang kata sandi telah dikirim ke email Anda! Silakan periksa log/email Anda.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengirim email atur ulang kata sandi.',
        ], 500);
    }

    /**
     * Tampilkan halaman reset kata sandi.
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('pages.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Proses reset kata sandi baru.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'           => 'required',
            'email'           => 'required|email|exists:users,email',
            'password'        => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ], [
            'token.required'           => 'Token tidak valid.',
            'email.required'           => 'Email wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'email.exists'             => 'Email tidak terdaftar di sistem kami.',
            'password.required'        => 'Kata sandi baru wajib diisi.',
            'password.min'             => 'Kata sandi baru minimal 8 karakter.',
            'confirmPassword.required' => 'Konfirmasi kata sandi wajib diisi.',
            'confirmPassword.same'     => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $status = Password::broker()->reset(
            [
                'email'                 => $request->email,
                'password'              => $request->password,
                'password_confirmation' => $request->confirmPassword,
                'token'                 => $request->token,
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => 'Kata sandi Anda berhasil diperbarui! Silakan masuk kembali.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengatur ulang kata sandi. Tautan mungkin kadaluwarsa atau tidak valid.',
        ], 400);
    }
}
