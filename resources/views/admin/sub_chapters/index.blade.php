@extends('admin.layouts.app')
@section('title', 'Manajemen Sub-Chapter')
@section('breadcrumb', 'Sub-Chapter')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div class="page-title">Sub-Chapter</div>
        <div class="page-sub">Kelola sub-chapter dalam setiap chapter materi AksaraLoka.</div>
    </div>
</div>

<div class="a-card" style="overflow:hidden;">

    @forelse($chapters as $chapter)

    {{-- ── Group header per chapter ── --}}
    <div style="display:flex;align-items:center;gap:0.6rem;
                padding:0.7rem 1.1rem;
                background:#f6f3f2;
                border-bottom:1px solid #e4e2e1;
                {{ !$loop->first ? 'border-top:2px solid #e4e2e1;' : '' }}">
        <div style="width:1.6rem;height:1.6rem;border-radius:0.3rem;
                    background:linear-gradient(135deg,#f4d7a1,#8c5a12);
                    display:flex;align-items:center;justify-content:center;
                    font-size:0.62rem;font-weight:700;color:#fff;flex-shrink:0;">
            {{ $chapter->order_index }}
        </div>
        <span style="font-size:0.82rem;font-weight:700;color:#1b1c1c;">{{ $chapter->title }}</span>
        <span class="badge badge-brown" style="font-size:0.66rem;">{{ $chapter->sub_chapters_count }} sub-chapter</span>
    </div>

    {{-- ── Tabel sub-chapter ── --}}
    @if($chapter->subChapters->count() > 0)
    <table class="a-table" style="border-radius:0;">
        <thead>
            <tr>
                <th style="width:58px;text-align:center;">Order</th>
                <th>Judul Sub-Chapter</th>
                <th style="width:68px;text-align:center;">Level</th>
                <th style="width:76px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chapter->subChapters as $sc)
            <tr>
                <td style="color:#707973;font-size:0.8rem;text-align:center;">{{ $sc->order_index }}</td>
                <td>
                    <form method="POST"
                          action="{{ route('admin.sub-chapters.update', [$chapter, $sc]) }}"
                          style="display:flex;align-items:center;gap:0.4rem;">
                        @csrf @method('PUT')
                        <input type="number" name="order_index" value="{{ $sc->order_index }}"
                               style="width:3rem;padding:0.3rem 0.4rem;background:#f6f3f2;border:1.5px solid #e4e2e1;border-radius:0.4rem;font-size:0.78rem;text-align:center;outline:none;"
                               min="1"
                               onfocus="this.style.borderColor='#6b3f00'"
                               onblur="this.style.borderColor='#e4e2e1'"/>
                        <input type="text" name="title" value="{{ $sc->title }}" required
                               style="flex:1;padding:0.35rem 0.6rem;background:#f6f3f2;border:1.5px solid #e4e2e1;border-radius:0.4rem;font-size:0.82rem;font-family:'Plus Jakarta Sans',sans-serif;outline:none;"
                               onfocus="this.style.borderColor='#6b3f00'"
                               onblur="this.style.borderColor='#e4e2e1'"/>
                        <button type="submit" class="btn-icon btn-icon-edit" title="Simpan">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">save</span>
                        </button>
                    </form>
                </td>
                <td style="text-align:center;">
                    <span class="badge badge-amber">{{ $sc->levels_count }}</span>
                </td>
                <td>
                    <form method="POST"
                          action="{{ route('admin.sub-chapters.destroy', [$chapter, $sc]) }}"
                          onsubmit="return confirm('Hapus sub-chapter \'{{ addslashes($sc->title) }}\' beserta semua levelnya?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-icon-del" title="Hapus">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div style="padding:0.9rem 1.25rem;color:#707973;font-size:0.8rem;font-style:italic;">
        Belum ada sub-chapter untuk chapter ini.
    </div>
    @endif

    {{-- ── Form tambah sub-chapter baru ── --}}
    <div style="padding:0.75rem 1.1rem;background:#fafaf9;border-bottom:1px solid #e4e2e1;">
        <form method="POST" action="{{ route('admin.sub-chapters.store', $chapter) }}"
              style="display:flex;align-items:flex-end;gap:0.6rem;flex-wrap:wrap;">
            @csrf
            <div style="display:flex;flex-direction:column;gap:0.18rem;">
                <label style="font-size:0.6rem;font-weight:700;color:#9e9e9e;letter-spacing:0.04em;">ORDER</label>
                <input type="number" name="order_index"
                       value="{{ $chapter->subChapters->count() + 1 }}" min="1" required
                       style="width:3.5rem;padding:0.42rem 0.4rem;background:#fff;border:1.5px solid #e4e2e1;border-radius:0.45rem;font-size:0.82rem;text-align:center;outline:none;"
                       onfocus="this.style.borderColor='#6b3f00'"
                       onblur="this.style.borderColor='#e4e2e1'"/>
            </div>
            <div style="flex:1;min-width:160px;display:flex;flex-direction:column;gap:0.18rem;">
                <label style="font-size:0.6rem;font-weight:700;color:#9e9e9e;letter-spacing:0.04em;">JUDUL SUB-CHAPTER BARU</label>
                <input type="text" name="title" required placeholder="cth: Pengenalan Ha, Na, Ca, Ra, Ka"
                       style="width:100%;padding:0.42rem 0.65rem;background:#fff;border:1.5px solid #e4e2e1;border-radius:0.45rem;font-size:0.82rem;font-family:'Plus Jakarta Sans',sans-serif;outline:none;"
                       onfocus="this.style.borderColor='#6b3f00'"
                       onblur="this.style.borderColor='#e4e2e1'"/>
            </div>
            <div style="display:flex;flex-direction:column;gap:0.18rem;">
                <label style="font-size:0.6rem;color:transparent;">.</label>
                <button type="submit" class="btn-primary" style="padding:0.42rem 0.85rem;font-size:0.8rem;">
                    <span class="material-symbols-outlined" style="font-size:0.85rem;">add</span>
                    Tambah
                </button>
            </div>
        </form>
    </div>

    @empty
    <div style="padding:2rem;text-align:center;color:#707973;font-size:0.85rem;">
        Belum ada chapter. <a href="{{ route('admin.chapters.create') }}" style="color:#6b3f00;font-weight:600;">Buat chapter terlebih dahulu →</a>
    </div>
    @endforelse

</div>

@endsection
