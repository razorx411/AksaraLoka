@extends('admin.layouts.app')
@section('title', 'Notifikasi Siaran')
@section('breadcrumb', 'Notifikasi')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div class="page-title">Notifikasi Siaran</div>
        <div class="page-sub">Kirim dan kelola notifikasi broadcast ke semua pengguna AksaraLoka.</div>
    </div>
    <div>
        <a href="{{ route('admin.notifications.create') }}" class="btn-primary">
            <span class="material-symbols-outlined" style="font-size:1rem;">add_alert</span>
            Kirim Notifikasi Baru
        </a>
    </div>
</div>

<div class="a-card">
    <div class="a-card-header">
        <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Daftar Riwayat Notifikasi</div>
    </div>

    <table class="a-table">
        <thead>
            <tr>
                <th>Ikon & Judul</th>
                <th>Konten</th>
                <th>Tipe</th>
                <th>Tanggal Kirim</th>
                <th style="width: 80px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notif)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:0.6rem;">
                        @php
                            $badgeColor = 'badge-brown';
                            if ($notif->type === 'materi') $badgeColor = 'badge-active';
                            if ($notif->type === 'soal') $badgeColor = 'badge-amber';
                        @endphp
                        <div class="badge {{ $badgeColor }}" style="width:2.2rem;height:2.2rem;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                            <span class="material-symbols-outlined" style="font-size:1.1rem;">{{ $notif->icon }}</span>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:0.82rem;color:#1b1c1c;">{{ $notif->title }}</div>
                        </div>
                    </div>
                </td>
                <td style="font-size:0.78rem;color:#404943;max-width:350px;">{{ $notif->body }}</td>
                <td>
                    <span class="badge {{ $badgeColor }} uppercase" style="font-size:0.6rem;">
                        {{ $notif->type }}
                    </span>
                </td>
                <td style="font-size:0.75rem;color:#707973;">{{ $notif->created_at->format('d M Y, H:i') }}</td>
                <td style="text-align: center;">
                    <form method="POST" action="{{ route('admin.notifications.destroy', $notif) }}"
                          onsubmit="return confirm('Hapus notifikasi ini? Ini juga akan menghapusnya dari kotak masuk semua pengguna.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-icon-del" title="Hapus Notifikasi">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:#707973;padding:2.5rem;">
                    Belum ada notifikasi yang pernah dikirim.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:1rem;padding:0.75rem 1rem;background:#f4d7a133;border:1px solid #f4d7a1;border-radius:0.75rem;display:flex;align-items:center;gap:0.6rem;">
    <span class="material-symbols-outlined" style="font-size:1rem;color:#6b3f00;font-variation-settings:'FILL' 1">info</span>
    <span style="font-size:0.78rem;color:#6b3f00;font-weight:500;">
        Notifikasi siaran secara otomatis ditambahkan ke kotak masuk semua pengguna aktif yang terdaftar saat ini.
    </span>
</div>

@endsection
