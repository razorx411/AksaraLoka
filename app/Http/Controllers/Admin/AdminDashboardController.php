<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Level;
use App\Models\Question;
use App\Models\User;
use App\Models\UserLevelProgress;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ── Stat cards ────────────────────────────────────────
        $totalUsers    = User::where('role', 'user')->count();
        $newUsersMonth = User::where('role', 'user')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        $totalChapters  = Chapter::count();
        $totalLevels    = Level::count();
        $totalQuestions = Question::count();

        // ── Registrasi per hari (14 hari terakhir) ────────────
        $registrations = User::where('role', 'user')
            ->where('created_at', '>=', now()->subDays(13))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $regLabels = [];
        $regData   = [];
        for ($i = 13; $i >= 0; $i--) {
            $date        = now()->subDays($i)->format('Y-m-d');
            $label       = now()->subDays($i)->format('d M');
            $regLabels[] = $label;
            $regData[]   = $registrations[$date] ?? 0;
        }

        // ── Level completions per hari (14 hari terakhir) ─────
        $completions = UserLevelProgress::where('is_completed', true)
            ->where('updated_at', '>=', now()->subDays(13))
            ->selectRaw('DATE(updated_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $compLabels = $regLabels; // same date range
        $compData   = [];
        for ($i = 13; $i >= 0; $i--) {
            $date      = now()->subDays($i)->format('Y-m-d');
            $compData[] = $completions[$date] ?? 0;
        }

        // ── Top 5 users by XP ─────────────────────────────────
        $topUsers = User::where('role', 'user')
            ->orderByDesc('total_points')
            ->limit(5)
            ->get(['id', 'username', 'email', 'total_points', 'streak_count']);

        // ── Recent users ──────────────────────────────────────
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->limit(8)
            ->get(['id', 'username', 'email', 'created_at', 'total_points']);

        return view('admin.dashboard', compact(
            'totalUsers', 'newUsersMonth', 'totalChapters', 'totalLevels', 'totalQuestions',
            'regLabels', 'regData',
            'compLabels', 'compData',
            'topUsers', 'recentUsers'
        ));
    }
}

