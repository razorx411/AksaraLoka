@extends('admin.layouts.app')
@section('title', 'Manajemen Perpustakaan')
@section('breadcrumb', 'Perpustakaan')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <div>
        <div class="page-title">Manajemen Perpustakaan</div>
        <div class="page-sub">Kelola materi pembelajaran dan referensi bahasa untuk pengguna.</div>
    </div>
    <a href="{{ route('admin.libraries.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:1rem;">add</span>
        Tambah Materi Baru
    </a>
</div>

<div class="a-card">
    <div class="a-card-header">
        <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Daftar Materi Perpustakaan</div>
    </div>

    <table class="a-table">
        <thead>
            <tr>
                <th>Judul & Kategori</th>
                <th>Slug</th>
                <th>Tag</th>
                <th>Deskripsi</th>
                <th style="width:120px; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($libraries as $lib)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:0.6rem;">
                        @php
                            $catColors = [
                                'aksara'   => 'badge-brown',
                                'bahasa'   => 'badge-active',
                                'kosakata' => 'badge-amber',
                                'cerita'   => 'badge-brown',
                            ];
                            $catIcons = [
                                'aksara'   => 'history_edu',
                                'bahasa'   => 'translate',
                                'kosakata' => 'chat',
                                'cerita'   => 'auto_stories',
                            ];
                            $colorClass = $catColors[$lib->category] ?? 'badge-brown';
                            $iconName   = $catIcons[$lib->category] ?? 'menu_book';
                        @endphp
                        <div class="badge {{ $colorClass }}" style="width:2rem;height:2rem;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <span class="material-symbols-outlined" style="font-size:1rem;">{{ $iconName }}</span>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:0.82rem;">{{ $lib->title }}</div>
                            <div style="font-size:0.68rem;color:#707973;" class="uppercase">{{ $lib->category }}</div>
                        </div>
                    </div>
                </td>
                <td style="font-size:0.75rem;color:#707973;font-family:monospace;">{{ $lib->slug }}</td>
                <td>
                    <span class="badge {{ $colorClass }}" style="font-size:0.68rem;">{{ $lib->tag ?? '—' }}</span>
                </td>
                <td style="font-size:0.75rem;color:#404943;max-width:300px;">{{ Str::limit($lib->description, 100) }}</td>
                <td>
                    <div style="display:flex;justify-content:center;gap:0.3rem;">
                        <a href="{{ route('materi.show', $lib->slug) }}" class="btn-icon btn-icon-edit" style="background:#f0eded;color:#1b1c1c;" target="_blank" title="Lihat Tampilan">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">visibility</span>
                        </a>
                        <a href="{{ route('admin.libraries.edit', $lib) }}" class="btn-icon btn-icon-edit" title="Edit Materi">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.libraries.destroy', $lib) }}"
                              onsubmit="return confirm('Hapus materi perpustakaan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon-del" title="Hapus">
                                <span class="material-symbols-outlined" style="font-size:0.85rem;">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:#707973;padding:2rem;">Belum ada materi di perpustakaan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

