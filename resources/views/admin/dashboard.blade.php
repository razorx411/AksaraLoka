@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

{{-- ── Greeting + Stats row ─────────────────────────────── --}}
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div class="page-title">Selamat datang, {{ auth()->user()->username }} 👋</div>
        <div class="page-sub">Berikut ringkasan aktivitas AksaraLoka hari ini.</div>
    </div>
    <div style="font-size:0.78rem;color:#707973;background:#fff;border:1px solid #e4e2e1;padding:0.4rem 0.75rem;border-radius:0.5rem;">
        <span class="material-symbols-outlined" style="font-size:0.9rem;vertical-align:middle;margin-right:0.2rem;">calendar_today</span>
        {{ now()->locale('id')->isoFormat('D MMMM YYYY') }}
    </div>
</div>

{{-- ── Stat Cards ────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:0.875rem;margin-bottom:1.25rem;">
    <div class="stat-card">
        <div class="stat-icon brown">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">group</span>
        </div>
        <div>
            <div class="stat-value">{{ number_format($totalUsers) }}</div>
            <div class="stat-label">Total Pengguna</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">person_add</span>
        </div>
        <div>
            <div class="stat-value">{{ $newUsersMonth }}</div>
            <div class="stat-label">User Baru (30 hari)</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon brown">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">layers</span>
        </div>
        <div>
            <div class="stat-value">{{ $totalChapters }}</div>
            <div class="stat-label">Total Chapter</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">format_list_numbered</span>
        </div>
        <div>
            <div class="stat-value">{{ $totalLevels }}</div>
            <div class="stat-label">Total Level</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">quiz</span>
        </div>
        <div>
            <div class="stat-value">{{ $totalQuestions }}</div>
            <div class="stat-label">Total Soal</div>
        </div>
    </div>
</div>

{{-- ── Charts Row ────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:1.6fr 1fr;gap:0.875rem;margin-bottom:1.25rem;">

    {{-- Registrasi chart --}}
    <div class="a-card">
        <div class="a-card-header">
            <div>
                <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Registrasi Pengguna</div>
                <div style="font-size:0.72rem;color:#707973;">14 hari terakhir</div>
            </div>
            <div style="display:flex;align-items:center;gap:0.35rem;font-size:0.72rem;color:#005503;background:#a4f79233;padding:0.25rem 0.6rem;border-radius:99px;font-weight:600;">
                <span class="material-symbols-outlined" style="font-size:0.85rem;">trending_up</span>
                Aktif
            </div>
        </div>
        <div class="a-card-body" style="padding:1rem 1.25rem 1rem;">
            <canvas id="chartReg" height="130"></canvas>
        </div>
    </div>

    {{-- Level completions chart --}}
    <div class="a-card">
        <div class="a-card-header">
            <div>
                <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Level Diselesaikan</div>
                <div style="font-size:0.72rem;color:#707973;">14 hari terakhir</div>
            </div>
        </div>
        <div class="a-card-body" style="padding:1rem 1.25rem 1rem;">
            <canvas id="chartComp" height="130"></canvas>
        </div>
    </div>
</div>

{{-- ── Bottom Row: Top Users + Recent Users ─────────────── --}}
<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:0.875rem;">

    {{-- Top Users --}}
    <div class="a-card">
        <div class="a-card-header">
            <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">🏆 Top Pengguna</div>
            <a href="{{ route('admin.users.index') }}" style="font-size:0.72rem;color:#6b3f00;font-weight:600;text-decoration:none;">Lihat semua →</a>
        </div>
        <div style="padding:0.5rem 0;">
            @foreach($topUsers as $i => $u)
            <div style="display:flex;align-items:center;gap:0.7rem;padding:0.55rem 1.1rem;border-bottom:1px solid #f0eded;">
                <span style="font-size:0.75rem;font-weight:700;color:#707973;width:1.2rem;text-align:center;">{{ $i + 1 }}</span>
                <div class="a-avatar">{{ strtoupper(substr($u->username, 0, 1)) }}</div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:0.8rem;font-weight:600;color:#1b1c1c;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $u->username }}</div>
                    <div style="font-size:0.68rem;color:#707973;">{{ number_format($u->streak_count) }} hari streak</div>
                </div>
                <div style="font-size:0.8rem;font-weight:700;color:#6b3f00;">{{ number_format($u->total_points) }} XP</div>
            </div>
            @endforeach
            @if($topUsers->isEmpty())
            <div style="padding:1.5rem;text-align:center;font-size:0.8rem;color:#707973;">Belum ada data pengguna.</div>
            @endif
        </div>
    </div>

    {{-- Recent Users table --}}
    <div class="a-card">
        <div class="a-card-header">
            <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Pengguna Terbaru</div>
            <a href="{{ route('admin.users.index') }}" style="font-size:0.72rem;color:#6b3f00;font-weight:600;text-decoration:none;">Lihat semua →</a>
        </div>
        <table class="a-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>XP</th>
                    <th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $u)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <div class="a-avatar" style="width:1.6rem;height:1.6rem;font-size:0.65rem;">{{ strtoupper(substr($u->username, 0, 1)) }}</div>
                            <span style="font-weight:500;">{{ $u->username }}</span>
                        </div>
                    </td>
                    <td style="color:#707973;font-size:0.78rem;">{{ $u->email }}</td>
                    <td><span class="badge badge-brown">{{ number_format($u->total_points) }} XP</span></td>
                    <td style="color:#707973;font-size:0.75rem;">{{ $u->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:#707973;padding:1.5rem;">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
const regLabels = @json($regLabels);
const regData   = @json($regData);
const compData  = @json($compData);

// Registrasi chart
new Chart(document.getElementById('chartReg'), {
    type: 'line',
    data: {
        labels: regLabels,
        datasets: [{
            label: 'Registrasi',
            data: regData,
            borderColor: '#6b3f00',
            backgroundColor: 'rgba(107,63,0,0.08)',
            borderWidth: 2,
            pointRadius: 3,
            pointBackgroundColor: '#6b3f00',
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 10 }, color: '#707973' } },
            y: { grid: { color: '#f0eded' }, ticks: { font: { size: 10 }, color: '#707973', stepSize: 1 }, beginAtZero: true }
        }
    }
});

// Completions chart
new Chart(document.getElementById('chartComp'), {
    type: 'bar',
    data: {
        labels: regLabels,
        datasets: [{
            label: 'Level Selesai',
            data: compData,
            backgroundColor: 'rgba(244,215,161,0.7)',
            borderColor: '#8c5a12',
            borderWidth: 1.5,
            borderRadius: 4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 10 }, color: '#707973' } },
            y: { grid: { color: '#f0eded' }, ticks: { font: { size: 10 }, color: '#707973', stepSize: 1 }, beginAtZero: true }
        }
    }
});
</script>
@endpush
