@extends('admin.layouts.app')
@section('title', 'Detail Pengguna')
@section('breadcrumb', 'Pengguna / Detail')

@section('content')

<div style="display:grid;grid-template-columns:280px 1fr;gap:1rem;max-width:900px;">

    {{-- ── Profile Card ─────────────────────────────────── --}}
    <div>
        <div class="a-card" style="text-align:center;padding:1.5rem 1rem;">
            <div style="width:4rem;height:4rem;border-radius:50%;background:linear-gradient(135deg,#f4d7a1,#6b3f00);display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;color:#fff;margin:0 auto 0.75rem;">
                {{ strtoupper(substr($user->username, 0, 1)) }}
            </div>
            <div style="font-size:1rem;font-weight:700;color:#1b1c1c;">{{ $user->username }}</div>
            <div style="font-size:0.78rem;color:#707973;margin-bottom:1rem;">{{ $user->email }}</div>

            @if($user->deleted_at)
                <span class="badge badge-inactive" style="padding:0.3rem 0.8rem;">Nonaktif</span>
            @else
                <span class="badge badge-active" style="padding:0.3rem 0.8rem;">Aktif</span>
            @endif

            @if($user->bio)
            <div style="margin-top:1rem;padding:0.75rem;background:#f6f3f2;border-radius:0.6rem;font-size:0.78rem;color:#404943;text-align:left;line-height:1.5;">
                {{ $user->bio }}
            </div>
            @endif

            <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid #f0eded;display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;text-align:center;">
                <div>
                    <div style="font-size:1.1rem;font-weight:700;color:#6b3f00;">{{ number_format($user->total_points) }}</div>
                    <div style="font-size:0.68rem;color:#707973;font-weight:500;">Total XP</div>
                </div>
                <div>
                    <div style="font-size:1.1rem;font-weight:700;color:#6b3f00;">🔥 {{ $user->streak_count }}</div>
                    <div style="font-size:0.68rem;color:#707973;font-weight:500;">Streak</div>
                </div>
            </div>
        </div>

        <div style="margin-top:0.75rem;display:flex;flex-direction:column;gap:0.4rem;">
            <a href="{{ route('admin.users.index') }}" class="btn-secondary" style="justify-content:center;">
                ← Kembali
            </a>
            <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}"
                  onsubmit="return confirm('{{ $user->deleted_at ? 'Pulihkan' : 'Nonaktifkan' }} akun ini?')">
                @csrf @method('PATCH')
                <button type="submit" class="{{ $user->deleted_at ? 'btn-primary' : 'btn-danger' }}" style="width:100%;justify-content:center;">
                    <span class="material-symbols-outlined" style="font-size:1rem;">{{ $user->deleted_at ? 'person_add' : 'person_off' }}</span>
                    {{ $user->deleted_at ? 'Pulihkan Akun' : 'Nonaktifkan' }}
                </button>
            </form>
        </div>
    </div>

    {{-- ── Progress Table ───────────────────────────────── --}}
    <div>
        <div class="a-card" style="margin-bottom:0.875rem;">
            <div class="a-card-header">
                <div style="font-size:0.88rem;font-weight:700;">Statistik Belajar</div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:0;border-bottom:1px solid #f0eded;">
                <div style="padding:1rem;text-align:center;border-right:1px solid #f0eded;">
                    <div style="font-size:1.3rem;font-weight:700;color:#6b3f00;">{{ $completedLevels }}</div>
                    <div style="font-size:0.72rem;color:#707973;font-weight:500;margin-top:0.1rem;">Level Selesai</div>
                </div>
                <div style="padding:1rem;text-align:center;border-right:1px solid #f0eded;">
                    <div style="font-size:1.3rem;font-weight:700;color:#6b3f00;">{{ $totalLevels }}</div>
                    <div style="font-size:0.72rem;color:#707973;font-weight:500;margin-top:0.1rem;">Total Level</div>
                </div>
                <div style="padding:1rem;text-align:center;">
                    <div style="font-size:1.3rem;font-weight:700;color:#6b3f00;">
                        {{ $totalLevels > 0 ? round(($completedLevels / $totalLevels) * 100) : 0 }}%
                    </div>
                    <div style="font-size:0.72rem;color:#707973;font-weight:500;margin-top:0.1rem;">Progres</div>
                </div>
            </div>
            {{-- Progress bar --}}
            @php $pct = $totalLevels > 0 ? ($completedLevels / $totalLevels) * 100 : 0; @endphp
            <div style="padding:0.75rem 1rem 0.5rem;">
                <div style="background:#f0eded;border-radius:99px;height:6px;overflow:hidden;">
                    <div style="width:{{ $pct }}%;background:linear-gradient(90deg,#f4d7a1,#6b3f00);height:100%;border-radius:99px;transition:width 0.8s ease;"></div>
                </div>
            </div>
        </div>

        <div class="a-card">
            <div class="a-card-header">
                <div style="font-size:0.88rem;font-weight:700;">Riwayat Progress Level</div>
            </div>
            <table class="a-table">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Sub-Chapter</th>
                        <th>Chapter</th>
                        <th>Status</th>
                        <th>Terakhir Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user->levelProgress as $progress)
                    <tr>
                        <td style="font-weight:500;font-size:0.82rem;">{{ $progress->level?->title ?? '—' }}</td>
                        <td style="font-size:0.78rem;color:#404943;">{{ $progress->level?->subChapter?->title ?? '—' }}</td>
                        <td style="font-size:0.78rem;">
                            @if($progress->level?->subChapter?->chapter)
                            <span class="badge badge-brown" style="font-size:0.65rem;">{{ $progress->level->subChapter->chapter->title }}</span>
                            @else —
                            @endif
                        </td>
                        <td>
                            @if($progress->is_completed)
                                <span class="badge badge-active">✓ Selesai</span>
                            @else
                                <span class="badge badge-amber">Dalam Proses</span>
                            @endif
                        </td>
                        <td style="font-size:0.75rem;color:#707973;">{{ $progress->updated_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;color:#707973;padding:1.5rem;">Belum ada aktivitas belajar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
