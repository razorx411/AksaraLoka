<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function landing()
    {
        return view('pages.landing');
    }

    public function home()
    {
        $user = auth()->user();

        if (\App\Models\Chapter::count() == 0) {
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'LearningPathSeeder']);
        }

        $chapters = \App\Models\Chapter::with(['subChapters.levels'])->orderBy('order_index')->get();

        $progress = \App\Models\UserLevelProgress::where('user_id', $user->id)
            ->pluck('is_completed', 'level_id')
            ->toArray();

        // ── Locking: chapter bebas, level dalam sub-chapter berurutan ──
        // Level pertama tiap sub-chapter selalu aktif/terbuka.
        // Level berikutnya dalam sub-chapter yang sama terkunci sampai
        // level sebelumnya selesai. Antar chapter tidak saling mengunci.
        $levelStatuses = [];
        foreach ($chapters as $chapter) {
            foreach ($chapter->subChapters as $subChapter) {
                $levels      = $subChapter->levels->sortBy('order_index')->values();
                $prevDone    = true; // level pertama selalu terbuka
                foreach ($levels as $i => $level) {
                    $isCompleted = isset($progress[$level->id]) && $progress[$level->id];
                    if ($isCompleted) {
                        $levelStatuses[$level->id] = 'completed';
                        $prevDone = true;
                    } elseif ($prevDone) {
                        $levelStatuses[$level->id] = 'active'; // berikutnya setelah yg selesai
                        $prevDone = false;
                    } else {
                        $levelStatuses[$level->id] = 'locked';
                    }
                }
            }
        }

        // Hitung progress per chapter (persen)
        $chapterProgress = [];
        foreach ($chapters as $chapter) {
            $total = 0;
            $done  = 0;
            foreach ($chapter->subChapters as $sub) {
                foreach ($sub->levels as $lvl) {
                    $total++;
                    if (($levelStatuses[$lvl->id] ?? 'locked') === 'completed') {
                        $done++;
                    }
                }
            }
            $chapterProgress[$chapter->id] = $total > 0 ? round(($done / $total) * 100) : 0;
        }

        $streak = $user->streak_count;
        $totalXp = $user->total_points;
        $userLevel = $user->getUserLevel();

        return view('pages.home', compact('chapters', 'levelStatuses', 'chapterProgress', 'streak', 'totalXp', 'userLevel'));
    }

    // ── BARU ──────────────────────────────────────────────────
    public function showChapter($id)
    {
        $user = auth()->user();

        $chapter = \App\Models\Chapter::with(['subChapters.levels'])->findOrFail($id);

        // Progress semua level user
        $progress = \App\Models\UserLevelProgress::where('user_id', $user->id)
            ->pluck('is_completed', 'level_id')
            ->toArray();

        // ── Locking: chapter bebas, level dalam sub-chapter berurutan ──
        $levelStatuses = [];
        foreach ($chapter->subChapters as $subChapter) {
            $levels   = $subChapter->levels->sortBy('order_index')->values();
            $prevDone = true;
            foreach ($levels as $level) {
                $isCompleted = isset($progress[$level->id]) && $progress[$level->id];
                if ($isCompleted) {
                    $levelStatuses[$level->id] = 'completed';
                    $prevDone = true;
                } elseif ($prevDone) {
                    $levelStatuses[$level->id] = 'active';
                    $prevDone = false;
                } else {
                    $levelStatuses[$level->id] = 'locked';
                }
            }
        }

        // Statistik sidebar
        $totalCount       = 0;
        $completedCount   = 0;
        $totalXpAvailable = 0;
        foreach ($chapter->subChapters as $sub) {
            foreach ($sub->levels as $level) {
                $totalCount++;
                $totalXpAvailable += $level->xp_reward ?? 10;
                if (($levelStatuses[$level->id] ?? 'locked') === 'completed') {
                    $completedCount++;
                }
            }
        }

        return view('pages.subchapter', compact(
            'chapter',
            'levelStatuses',
            'totalCount',
            'completedCount',
            'totalXpAvailable'
        ));
    }
    // ──────────────────────────────────────────────────────────

    public function showLevel($id)
    {
        $level = \App\Models\Level::with(['questions.options', 'subChapter.chapter'])->findOrFail($id);
        return view('pages.level', compact('level'));
    }

    public function completeLevel($id)
    {
        $user  = auth()->user();
        $level = \App\Models\Level::findOrFail($id);
        $today = now()->toDateString();

        // ── Cek apakah sudah pernah selesai (anti-cheat: tidak dapat XP lagi) ──
        $existing = \App\Models\UserLevelProgress::where('user_id', $user->id)
            ->where('level_id', $level->id)
            ->first();

        $alreadyCompleted = $existing && $existing->is_completed;

        // Simpan/update progress
        \App\Models\UserLevelProgress::updateOrCreate(
            ['user_id' => $user->id, 'level_id' => $level->id],
            ['is_completed' => true, 'completed_at' => now()]
        );

        // ── Hitung XP (hanya kalau belum pernah selesai) ──────────────────────
        $xpBase     = 0;
        $multiplier = 1.0;
        $xpEarned   = 0;

        if (! $alreadyCompleted) {
            $xpBase     = $level->xp_reward ?? 50;
            $multiplier = $user->streakMultiplier();
            $xpEarned   = (int) round($xpBase * $multiplier);
            $user->total_points += $xpEarned;
        }

        // ── Update streak harian ───────────────────────────────────────────────
        $streakChanged  = false;
        $streakBroken   = false;
        $lastDate       = $user->last_activity_date;
        $lastDateString = null;
        if ($lastDate) {
            if ($lastDate instanceof \Carbon\Carbon || $lastDate instanceof \Illuminate\Support\Carbon) {
                $lastDateString = $lastDate->toDateString();
            } else {
                $lastDateString = date('Y-m-d', strtotime($lastDate));
            }
        }

        if (is_null($lastDateString)) {
            $user->streak_count      = 1;
            $user->last_activity_date = $today;
            $streakChanged = true;
        } elseif ($lastDateString === $today) {
            // sudah aktif hari ini
        } elseif ($lastDateString === now()->subDay()->toDateString()) {
            $user->streak_count      += 1;
            $user->last_activity_date = $today;
            $streakChanged = true;
        } else {
            $user->streak_count      = 1;
            $user->last_activity_date = $today;
            $streakChanged = true;
            $streakBroken  = true;
        }

        $user->save();

        // ── Cek & berikan achievement baru ────────────────────────────────────
        $newAchievements = \App\Models\Achievement::checkAndAward($user);
        $achievementData = array_map(fn ($a) => [
            'name'        => $a->name,
            'description' => $a->description,
            'icon'        => $a->icon,
            'color'       => $a->color,
        ], $newAchievements);

        return response()->json([
            'success'          => true,
            'message'          => 'Level selesai!',
            'already_done'     => $alreadyCompleted,
            'xp_earned'        => $xpEarned,
            'xp_base'          => $xpBase,
            'multiplier'       => $multiplier,
            'new_xp'           => $user->total_points,
            'new_streak'       => $user->streak_count,
            'streak_changed'   => $streakChanged,
            'streak_broken'    => $streakBroken,
            'new_achievements' => $achievementData,
        ]);
    }


    public function materi()
    {
        $materiList = \App\Models\Library::all()->map(function ($lib) {
            return [
                'href'  => route('materi.show', $lib->slug),
                'judul' => $lib->title,
                'tag'   => $lib->tag,
                'desc'  => $lib->description,
                'cat'   => $lib->category,
            ];
        });
        return view('pages.materi', compact('materiList'));
    }

    public function materiShow($slug)
    {
        $library = \App\Models\Library::where('slug', $slug)->firstOrFail();
        return view('pages.materi-detail', compact('library'));
    }

    public function peringkat()
    {
        $users = \App\Models\User::where('role', 'user')
            ->orderByDesc('total_points')
            ->get();

        $leaderboard = [];
        foreach ($users as $index => $u) {
            $rank = $index + 1;
            $badge = '';
            if ($rank === 1) $badge = '🥇';
            elseif ($rank === 2) $badge = '🥈';
            elseif ($rank === 3) $badge = '🥉';

            $leaderboard[] = [
                'rank'  => $rank,
                'nama'  => $u->username,
                'xp'    => $u->total_points,
                'level' => $u->getUserLevel(),
                'badge' => $badge,
            ];
        }

        $topThree    = array_slice($leaderboard, 0, 3);
        $sisaRanking = array_slice($leaderboard, 3);
        return view('pages.peringkat', compact('topThree', 'sisaRanking', 'leaderboard'));
    }

    public function dokumentasi()
    {
        return response()->file(public_path('dokumentasi.html'));
    }

    public function privasi()
    {
        $pasal = [
            ['judul' => '1. Pengumpulan Informasi', 'isi' => 'AksaraLoka dapat mengumpulkan informasi pribadi pengguna, seperti nama dan alamat email, serta data penggunaan yang berkaitan dengan aktivitas pembelajaran di dalam platform.'],
            ['judul' => '2. Penggunaan Informasi',  'isi' => 'Informasi yang dikumpulkan digunakan untuk meningkatkan kualitas layanan, mengembangkan fitur, serta memberikan pengalaman belajar yang lebih optimal kepada pengguna.'],
            ['judul' => '3. Perlindungan Data',     'isi' => 'AksaraLoka berkomitmen untuk menjaga keamanan data pengguna dengan menerapkan langkah-langkah perlindungan yang wajar guna mencegah akses, perubahan, atau penyalahgunaan data tanpa izin.'],
            ['judul' => '4. Penggunaan Cookies',    'isi' => 'Platform ini dapat menggunakan cookies untuk menyimpan preferensi pengguna dan meningkatkan efisiensi serta kenyamanan dalam penggunaan layanan.'],
            ['judul' => '5. Perubahan Kebijakan',   'isi' => 'Kebijakan Privasi ini dapat diperbarui sewaktu-waktu. Setiap perubahan akan ditampilkan pada halaman ini dan berlaku sejak tanggal pembaruan.'],
            ['judul' => '6. Kontak',                'isi' => 'Apabila terdapat pertanyaan atau permintaan terkait kebijakan ini, pengguna dapat menghubungi tim AksaraLoka melalui halaman kontak yang tersedia.'],
        ];
        return view('pages.privasi', compact('pasal'));
    }

    public function tentangKami()
    {
        return view('pages.tentang-kami');
    }

    public function fitur()
    {
        return view('pages.fitur');
    }
}
