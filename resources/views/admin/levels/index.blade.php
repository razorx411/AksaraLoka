@extends('admin.layouts.app')
@section('title', 'Manajemen Level')
@section('breadcrumb', 'Level')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div class="page-title">Manajemen Level</div>
        <div class="page-sub">{{ $levels->total() }} level tersedia dalam sistem.</div>
    </div>
    <a href="{{ route('admin.levels.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:1rem;">add</span>
        Tambah Level
    </a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Level</th>
                <th>Sub-Chapter</th>
                <th>Chapter</th>
                <th>Order</th>
                <th>XP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($levels as $level)
            <tr>
                <td style="color:#707973;font-size:0.75rem;">#{{ $level->id }}</td>
                <td style="font-weight:500;max-width:200px;">{{ $level->title }}</td>
                <td style="font-size:0.8rem;color:#404943;">{{ $level->subChapter?->title ?? '—' }}</td>
                <td>
                    @if($level->subChapter?->chapter)
                    <span class="badge badge-brown">{{ Str::limit($level->subChapter->chapter->title, 20) }}</span>
                    @else <span style="color:#707973;">—</span>
                    @endif
                </td>
                <td style="text-align:center;font-size:0.8rem;color:#707973;">{{ $level->order_index }}</td>
                <td><span class="badge badge-amber">{{ $level->xp_reward }} XP</span></td>
                <td>
                    <div style="display:flex;gap:0.3rem;">
                        <a href="{{ route('admin.levels.edit', $level) }}" class="btn-icon btn-icon-edit" title="Edit">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.levels.destroy', $level) }}"
                              onsubmit="return confirm('Hapus level ini beserta semua soalnya?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon-del" title="Hapus">
                                <span class="material-symbols-outlined" style="font-size:0.85rem;">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:#707973;padding:2rem;">Belum ada level. <a href="{{ route('admin.levels.create') }}" style="color:#6b3f00;font-weight:600;">Tambah sekarang →</a></td></tr>
            @endforelse
        </tbody>
    </table>

    @if($levels->hasPages())
    <div style="padding:0.75rem 1rem;border-top:1px solid #f0eded;" class="pagination-admin">
        {{ $levels->links() }}
    </div>
    @endif
</div>
@endsection
