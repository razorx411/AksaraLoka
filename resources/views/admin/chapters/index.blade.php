@extends('admin.layouts.app')
@section('title', 'Manajemen Chapter')
@section('breadcrumb', 'Chapter')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div class="page-title">Chapter</div>
        <div class="page-sub">Kelola chapter dan struktur materi pembelajaran AksaraLoka.</div>
    </div>
    <a href="{{ route('admin.chapters.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:1rem;">add</span>
        Buat Chapter Baru
    </a>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:0.875rem;">
    @foreach($chapters as $chapter)
    <div class="chapter-card">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:0.6rem;">
            <div style="display:flex;align-items:center;gap:0.5rem;">
                <div style="width:2rem;height:2rem;border-radius:0.4rem;background:linear-gradient(135deg,#f4d7a1,#8c5a12);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:#fff;">
                    {{ $chapter->order_index }}
                </div>
                <div>
                    <div style="font-size:0.78rem;color:#707973;font-weight:500;">Unit {{ $chapter->order_index }}</div>
                </div>
            </div>
            <div style="display:flex;gap:0.3rem;">
                <a href="{{ route('admin.chapters.edit', $chapter) }}" class="btn-icon btn-icon-edit">
                    <span class="material-symbols-outlined" style="font-size:0.9rem;">edit</span>
                </a>
                <form method="POST" action="{{ route('admin.chapters.destroy', $chapter) }}"
                      onsubmit="return confirm('Hapus chapter ini beserta semua sub-chapter & levelnya?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-icon btn-icon-del">
                        <span class="material-symbols-outlined" style="font-size:0.9rem;">delete</span>
                    </button>
                </form>
            </div>
        </div>
        <div style="font-size:0.9rem;font-weight:700;color:#1b1c1c;margin-bottom:0.25rem;line-height:1.3;">{{ $chapter->title }}</div>
        @if($chapter->description)
        <div style="font-size:0.75rem;color:#707973;line-height:1.4;margin-bottom:0.5rem;">{{ Str::limit($chapter->description, 60) }}</div>
        @endif
        <div style="display:flex;align-items:center;gap:0.4rem;margin-top:0.6rem;padding-top:0.6rem;border-top:1px solid #f0eded;">
            <span class="material-symbols-outlined" style="font-size:0.9rem;color:#707973;">format_list_bulleted</span>
            <span style="font-size:0.75rem;color:#707973;font-weight:500;">{{ $chapter->sub_chapters_count }} sub-chapter</span>
        </div>
    </div>
    @endforeach

    {{-- Add chapter card --}}
    <a href="{{ route('admin.chapters.create') }}" class="chapter-card-add">
        <div style="width:2.5rem;height:2.5rem;border-radius:50%;background:#f0eded;display:flex;align-items:center;justify-content:center;">
            <span class="material-symbols-outlined" style="font-size:1.3rem;color:#707973;">add</span>
        </div>
        <div style="font-size:0.8rem;font-weight:600;color:#707973;">Buat Unit Baru</div>
    </a>
</div>

@endsection

