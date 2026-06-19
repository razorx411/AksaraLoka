@extends('admin.layouts.app')
@section('title', 'Manajemen Pengguna')
@section('breadcrumb', 'Pengguna')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div class="page-title">Manajemen Pengguna</div>
        <div class="page-sub">Pantau dan kelola akun pengguna AksaraLoka.</div>
    </div>
    <div style="display:flex;gap:0.5rem;">
        {{-- Export (placeholder) --}}
        <button class="btn-secondary" title="Export data">
            <span class="material-symbols-outlined" style="font-size:1rem;">download</span>
            Export
        </button>
    </div>
</div>

{{-- ── Stat Cards ─────────────────────────────────────────── --}}
@php
    $totalAll      = \App\Models\User::withTrashed()->where('role','user')->count();
    $activeCount   = \App\Models\User::where('role','user')->whereNull('deleted_at')->count();
    $inactiveCount = \App\Models\User::withTrashed()->where('role','user')->whereNotNull('deleted_at')->count();
    $newMonth      = \App\Models\User::withTrashed()->where('role','user')->where('created_at','>=',now()->subDays(30))->count();
@endphp
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.875rem;margin-bottom:1.25rem;">
    <div class="stat-card">
        <div class="stat-icon brown">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">group</span>
        </div>
        <div>
            <div class="stat-value">{{ number_format($totalAll) }}</div>
            <div class="stat-label">Total Pengguna</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">verified_user</span>
        </div>
        <div>
            <div class="stat-value">{{ number_format($activeCount) }}</div>
            <div class="stat-label">Aktif</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">person_off</span>
        </div>
        <div>
            <div class="stat-value">{{ number_format($inactiveCount) }}</div>
            <div class="stat-label">Nonaktif</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber">
            <span class="material-symbols-outlined" style="font-size:1.2rem;font-variation-settings:'FILL' 1">person_add</span>
        </div>
        <div>
            <div class="stat-value">{{ number_format($newMonth) }}</div>
            <div class="stat-label">Baru (30 hari)</div>
        </div>
    </div>
</div>

{{-- ── Users Table ──────────────────────────────────────────── --}}
<div class="a-card">
    <div class="a-card-header">
        <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Daftar Pengguna</div>
        <div style="display:flex;align-items:center;gap:0.6rem;">
            <form method="GET" action="{{ route('admin.users.index') }}" style="display:flex;gap:0.5rem;align-items:center;">
                {{-- Filter tab status --}}
                <div style="display:flex;gap:0.25rem;background:#f6f3f2;border-radius:0.5rem;padding:0.2rem;">
                    @foreach(['all' => 'Semua', 'active' => 'Aktif', 'inactive' => 'Nonaktif'] as $val => $label)
                    <button type="submit" name="status" value="{{ $val }}"
                            style="padding:0.3rem 0.65rem;border-radius:0.35rem;font-size:0.72rem;font-weight:600;border:none;cursor:pointer;
                                   background:{{ $status === $val ? '#fff' : 'transparent' }};
                                   color:{{ $status === $val ? '#1b1c1c' : '#707973' }};
                                   box-shadow:{{ $status === $val ? '0 1px 3px #0000000f' : 'none' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                    <input type="hidden" name="search" value="{{ $search }}">
                </div>
                <div class="search-bar">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Cari nama atau email..." />
                    <input type="hidden" name="status" value="{{ $status }}">
                </div>
                <button type="submit" class="btn-primary" style="padding:0.45rem 0.8rem;">
                    <span class="material-symbols-outlined" style="font-size:0.9rem;">search</span>
                </button>
                @if($search)
                <a href="{{ route('admin.users.index', ['status' => $status]) }}" class="btn-secondary" style="padding:0.45rem 0.8rem;">
                    <span class="material-symbols-outlined" style="font-size:0.9rem;">close</span>
                </a>
                @endif
            </form>
        </div>
    </div>

    <table class="a-table">
        <thead>
            <tr>
                <th>Pengguna</th>
                <th>Email</th>
                <th>XP</th>
                <th>Streak</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Bergabung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr style="{{ $user->deleted_at ? 'background:#fff8f7;' : '' }}">
                <td>
                    <div style="display:flex;align-items:center;gap:0.6rem;">
                        <div class="a-avatar" style="{{ $user->deleted_at ? 'opacity:0.5;' : '' }}">{{ strtoupper(substr($user->username, 0, 1)) }}</div>
                        <div>
                            <div style="font-weight:600;font-size:0.82rem;{{ $user->deleted_at ? 'color:#707973;text-decoration:line-through;' : '' }}">{{ $user->username }}</div>
                            @if($user->deleted_at)
                            <div style="font-size:0.68rem;color:#ba1a1a;margin-top:0.05rem;">Dinonaktifkan {{ $user->deleted_at->format('d M Y') }}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td style="font-size:0.78rem;color:#707973;">{{ $user->email }}</td>
                <td>
                    <span class="badge badge-brown">{{ number_format($user->total_points) }}</span>
                </td>
                <td style="text-align:center;">
                    <span style="font-size:0.78rem;color:#404943;">
                        🔥 {{ $user->streak_count }}
                    </span>
                </td>
                <td style="text-align:center;">
                    <span class="badge badge-amber">{{ $user->level_progress_count }} lvl</span>
                </td>
                <td>
                    @if($user->deleted_at)
                        <span class="badge badge-inactive">Nonaktif</span>
                    @else
                        <span class="badge badge-active">Aktif</span>
                    @endif
                </td>
                <td style="font-size:0.75rem;color:#707973;">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <div style="display:flex;gap:0.3rem;">
                        <a href="{{ route('admin.users.show', $user) }}" class="btn-icon btn-icon-edit" title="Lihat detail"
                           style="background:#f0eded;color:#1b1c1c;">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">visibility</span>
                        </a>
                        <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}"
                              onsubmit="return confirm('{{ $user->deleted_at ? 'Pulihkan' : 'Nonaktifkan' }} akun ini?')">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="btn-icon {{ $user->deleted_at ? 'btn-icon-edit' : 'btn-icon-del' }}"
                                    title="{{ $user->deleted_at ? 'Pulihkan' : 'Nonaktifkan' }}">
                                <span class="material-symbols-outlined" style="font-size:0.85rem;">
                                    {{ $user->deleted_at ? 'person_add' : 'person_off' }}
                                </span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;color:#707973;padding:2rem;">
                    @if($search) Tidak ada pengguna dengan kata kunci "{{ $search }}". @else Belum ada pengguna. @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($users->hasPages())
    <div style="padding:0.75rem 1rem;border-top:1px solid #f0eded;" class="pagination-admin">
        {{ $users->links() }}
    </div>
    @endif
</div>

{{-- ── Tip card ─────────────────────────────────────────────── --}}
<div style="margin-top:1rem;padding:0.75rem 1rem;background:#f4d7a133;border:1px solid #f4d7a1;border-radius:0.75rem;display:flex;align-items:center;gap:0.6rem;">
    <span class="material-symbols-outlined" style="font-size:1rem;color:#6b3f00;font-variation-settings:'FILL' 1">info</span>
    <span style="font-size:0.78rem;color:#6b3f00;font-weight:500;">
        Akun yang dinonaktifkan tidak dapat login. Data mereka tetap tersimpan dan bisa dipulihkan kapan saja.
    </span>
</div>

@endsection

