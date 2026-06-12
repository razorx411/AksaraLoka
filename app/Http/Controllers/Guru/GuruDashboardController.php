<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GuruDashboardController extends Controller
{
    /**
     * Tampilkan dashboard Guru.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Ambil kelas milik guru ini
        $classrooms = $user->classroomsAsTeacher()->withCount('students')->get();
        
        // Hitung statistik
        $totalClasses = $classrooms->count();
        
        $studentIds = DB::table('classroom_student')
            ->join('classrooms', 'classroom_student.classroom_id', '=', 'classrooms.id')
            ->where('classrooms.teacher_id', $user->id)
            ->pluck('classroom_student.student_id')
            ->unique();
            
        $totalStudents = $studentIds->count();
        
        $averageXp = $studentIds->isNotEmpty()
            ? (int) round(User::whereIn('id', $studentIds)->avg('total_points'))
            : 0;

        return view('guru.dashboard', compact('classrooms', 'totalClasses', 'totalStudents', 'averageXp'));
    }

    /**
     * Simpan kelas baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:100',
            'description' => 'nullable|max:255',
        ], [
            'name.required' => 'Nama kelas wajib diisi.',
            'name.max'      => 'Nama kelas maksimal 100 karakter.',
            'description.max' => 'Deskripsi kelas maksimal 255 karakter.',
        ]);

        // Generate unique code (6 chars)
        do {
            $code = strtoupper(Str::random(6));
        } while (Classroom::where('code', $code)->exists());

        auth()->user()->classroomsAsTeacher()->create([
            'name'        => $request->name,
            'description' => $request->description,
            'code'        => $code,
        ]);

        return redirect()->route('guru.dashboard')->with('success', 'Kelas berhasil dibuat dengan kode: ' . $code);
    }

    /**
     * Detail kelas (Daftar Mahasiswa/Siswa & Progres).
     */
    public function show($id)
    {
        $classroom = Classroom::where('teacher_id', auth()->id())->findOrFail($id);
        
        // Ambil siswa yang tergabung
        $students = $classroom->students()
            ->orderBy('username')
            ->get();
            
        $totalLevels = \App\Models\Level::count();
        
        // Tambahkan progres ke setiap siswa
        foreach ($students as $student) {
            $student->completed_levels_count = $student->levelProgress()
                ->where('is_completed', true)
                ->count();
        }

        return view('guru.show_classroom', compact('classroom', 'students', 'totalLevels'));
    }

    /**
     * Detail progres per mahasiswa.
     */
    public function studentProgress($classId, $studentId)
    {
        $classroom = Classroom::where('teacher_id', auth()->id())->findOrFail($classId);
        $student   = $classroom->students()->findOrFail($studentId);

        // Ambil riwayat level selesai milik siswa
        $progress = $student->levelProgress()
            ->where('is_completed', true)
            ->pluck('completed_at', 'level_id')
            ->toArray();

        // Ambil alur belajar (Chapter -> SubChapter -> Level)
        $chapters = \App\Models\Chapter::with(['subChapters.levels'])->orderBy('order_index')->get();

        return view('guru.student_progress', compact('classroom', 'student', 'progress', 'chapters'));
    }

    /**
     * Hapus kelas.
     */
    public function destroy($id)
    {
        $classroom = Classroom::where('teacher_id', auth()->id())->findOrFail($id);
        $classroom->delete();

        return redirect()->route('guru.dashboard')->with('success', 'Kelas berhasil dihapus.');
    }
}
