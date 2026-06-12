<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class StudentClassroomController extends Controller
{
    /**
     * Tampilkan daftar kelas yang diikuti siswa.
     */
    public function index()
    {
        $user = auth()->user();
        $classrooms = $user->classroomsAsStudent()->with('teacher')->withCount('students')->get();
        return view('student.classrooms_index', compact('classrooms'));
    }

    /**
     * Bergabung ke kelas menggunakan kode kelas.
     */
    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'Kode kelas wajib diisi.',
        ]);

        $code = strtoupper(trim($request->code));
        $classroom = Classroom::where('code', $code)->first();

        if (!$classroom) {
            return redirect()->back()->with('error', 'Kode kelas tidak ditemukan. Silakan periksa kembali.');
        }

        $user = auth()->user();

        // Cek jika sudah bergabung
        if ($user->classroomsAsStudent()->where('classroom_id', $classroom->id)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah bergabung di kelas ' . $classroom->name . '.');
        }

        // Gabung kelas
        $user->classroomsAsStudent()->attach($classroom->id);

        return redirect()->route('student.classrooms.show', $classroom->id)
            ->with('success', 'Berhasil bergabung ke kelas ' . $classroom->name . '!');
    }

    /**
     * Detail kelas untuk siswa (Menampilkan daftar teman kelas & papan peringkat kelas).
     */
    public function show($id)
    {
        $user = auth()->user();
        
        // Cari kelas yang diikuti siswa ini
        $classroom = $user->classroomsAsStudent()->with('teacher')->findOrFail($id);
        
        // Urutkan siswa berdasarkan poin terbanyak (Papan Peringkat Kelas)
        $classmates = $classroom->students()
            ->orderByDesc('total_points')
            ->get();

        return view('student.show_classroom', compact('classroom', 'classmates'));
    }

    /**
     * Keluar dari kelas.
     */
    public function leave($id)
    {
        $user = auth()->user();
        $classroom = $user->classroomsAsStudent()->findOrFail($id);
        
        // Detach
        $user->classroomsAsStudent()->detach($classroom->id);

        return redirect()->route('student.classrooms.index')
            ->with('success', 'Anda telah keluar dari kelas ' . $classroom->name . '.');
    }
}
