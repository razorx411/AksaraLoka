@extends('admin.layouts.app')
@section('title', 'Edit Chapter')
@section('breadcrumb', 'Chapter / Edit')

@section('content')
<div style="max-width:700px;">

    {{-- ── Header ───────────────────────────────────────────── --}}
    <div class="page-header">
        <div class="page-title">Edit Chapter</div>
        <div class="page-sub">Perbarui chapter dan kelola sub-chapter di dalamnya.</div>
    </div>

    {{-- ── 1. Form edit chapter ─────────────────────────────── --}}
    <div class="a-card" style="margin-bottom:1rem;">
        <div class="a-card-header">
            <div style="font-size:0.88rem;font-weight:700;display:flex;align-items:center;gap:0.5rem;">
                <span class="material-symbols-outlined" style="font-size:1rem;color:#6b3f00;">layers</span>
                Data Chapter
            </div>
        </div>
        <div class="a-card-body">
            <form method="POST" action="{{ route('admin.chapters.update', $chapter) }}">
                @csrf @method('PUT')

                <div class="a-form-group">
                    <label class="a-label">Judul Chapter <span style="color:#ba1a1a">*</span></label>
                    <input type="text" name="title" class="a-input" value="{{ old('title', $chapter->title) }}" required/>
                    @error('title')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div class="a-form-group">
                    <label class="a-label">Deskripsi</label>
                    <textarea name="description" class="a-textarea">{{ old('description', $chapter->description) }}</textarea>
                    @error('description')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div class="a-form-group">
                    <label class="a-label">Urutan (Order Index) <span style="color:#ba1a1a">*</span></label>
                    <input type="number" name="order_index" class="a-input"
                           value="{{ old('order_index', $chapter->order_index) }}" min="1" required/>
                    @error('order_index')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <style>
                    .mascot-grid {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 0.75rem;
                        margin-top: 0.5rem;
                    }
                    @media(min-width: 480px) {
                        .mascot-grid {
                            grid-template-columns: repeat(4, 1fr);
                        }
                    }
                    .mascot-option-card {
                        border: 2px solid #e4e2e1;
                        border-radius: 0.75rem;
                        padding: 0.75rem 0.5rem;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        text-align: center;
                        background: #f6f3f2;
                        position: relative;
                    }
                    .mascot-option-card:hover {
                        border-color: #bfc9c1;
                        background: #fff;
                    }
                    .mascot-option-card:has(input[type="radio"]:checked) {
                        border-color: #6b3f00;
                        background: #f4d7a120;
                        box-shadow: 0 0 0 1px #6b3f00;
                    }
                    .mascot-option-card input[type="radio"] {
                        margin-bottom: 0.5rem;
                        accent-color: #6b3f00;
                    }
                </style>

                <div class="a-form-group">
                    <label class="a-label">Maskot Chapter <span style="color:#ba1a1a">*</span></label>
                    <div class="mascot-grid">
                        <!-- Card 1 -->
                        <label class="mascot-option-card">
                            <input type="radio" name="image" value="mascot_girl_wave.png" {{ old('image', $chapter->image) == 'mascot_girl_wave.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_girl_wave.png') }}" alt="Gadis Melambai" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Gadis Melambai</span>
                        </label>
                        <!-- Card 2 -->
                        <label class="mascot-option-card">
                            <input type="radio" name="image" value="mascot_boy_cross.png" {{ old('image', $chapter->image) == 'mascot_boy_cross.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_boy_cross.png') }}" alt="Pemuda Bersedekap" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Pemuda Bersedekap</span>
                        </label>
                        <!-- Card 3 -->
                        <label class="mascot-option-card">
                            <input type="radio" name="image" value="mascot_boy_salam.png" {{ old('image', $chapter->image) == 'mascot_boy_salam.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_boy_salam.png') }}" alt="Pemuda Salam" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Pemuda Salam</span>
                        </label>
                        <!-- Card 4 -->
                        <label class="mascot-option-card">
                            <input type="radio" name="image" value="mascot_girl_teacher.png" {{ old('image', $chapter->image) == 'mascot_girl_teacher.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_girl_teacher.png') }}" alt="Gadis Guru" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Gadis Guru</span>
                        </label>
                    </div>
                    @error('image')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div style="display:flex;gap:0.6rem;justify-content:space-between;align-items:center;padding-top:0.5rem;border-top:1px solid #f0eded;margin-top:0.5rem;">
                    <a href="{{ route('admin.chapters.index') }}" class="btn-secondary">← Kembali</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:1rem;">save</span>
                        Simpan Chapter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── 2. Sub-chapter manager ────────────────────────────── --}}
    <div class="a-card">
        <div class="a-card-header">
            <div style="font-size:0.88rem;font-weight:700;display:flex;align-items:center;gap:0.5rem;">
                <span class="material-symbols-outlined" style="font-size:1rem;color:#6b3f00;">format_list_bulleted</span>
                Sub-Chapter
                <span class="badge badge-brown" style="font-size:0.68rem;">{{ $chapter->subChapters->count() }}</span>
            </div>
        </div>

        {{-- List sub-chapters yang sudah ada --}}
        @if($chapter->subChapters->count() > 0)
        <table class="a-table">
            <thead>
                <tr>
                    <th style="width:60px;">Order</th>
                    <th>Judul Sub-Chapter</th>
                    <th style="width:80px;text-align:center;">Level</th>
                    <th style="width:90px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chapter->subChapters->sortBy('order_index') as $sc)
                <tr>
                    <td style="color:#707973;font-size:0.8rem;text-align:center;">{{ $sc->order_index }}</td>
                    <td>
                        {{-- Inline edit form --}}
                        <form method="POST"
                              action="{{ route('admin.sub-chapters.update', [$chapter, $sc]) }}"
                              style="display:flex;align-items:center;gap:0.4rem;">
                            @csrf @method('PUT')
                            <input type="number" name="order_index" value="{{ $sc->order_index }}"
                                   style="width:3rem;padding:0.3rem 0.4rem;background:#f6f3f2;border:1.5px solid #e4e2e1;border-radius:0.4rem;font-size:0.78rem;text-align:center;outline:none;"
                                   min="1"/>
                            <input type="text" name="title" value="{{ $sc->title }}" required
                                   style="flex:1;padding:0.35rem 0.6rem;background:#f6f3f2;border:1.5px solid #e4e2e1;border-radius:0.4rem;font-size:0.82rem;font-family:'Plus Jakarta Sans',sans-serif;outline:none;"
                                   onfocus="this.style.borderColor='#6b3f00'" onblur="this.style.borderColor='#e4e2e1'"/>
                            <button type="submit" class="btn-icon btn-icon-edit" title="Simpan">
                                <span class="material-symbols-outlined" style="font-size:0.85rem;">save</span>
                            </button>
                        </form>
                    </td>
                    <td style="text-align:center;">
                        <span class="badge badge-amber">{{ $sc->levels->count() }}</span>
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
        <div style="padding:1.25rem;text-align:center;color:#707973;font-size:0.82rem;">
            Belum ada sub-chapter. Tambahkan di bawah 👇
        </div>
        @endif

        {{-- Form tambah sub-chapter baru --}}
        <div style="padding:1rem 1.25rem;background:#f6f3f2;border-top:1px solid #e4e2e1;">
            <div style="font-size:0.75rem;font-weight:700;color:#404943;margin-bottom:0.65rem;display:flex;align-items:center;gap:0.35rem;">
                <span class="material-symbols-outlined" style="font-size:0.9rem;">add_circle</span>
                Tambah Sub-Chapter Baru
            </div>
            <form method="POST" action="{{ route('admin.sub-chapters.store', $chapter) }}"
                  style="display:flex;align-items:flex-start;gap:0.6rem;">
                @csrf

                <div style="display:flex;flex-direction:column;gap:0.2rem;">
                    <label style="font-size:0.65rem;font-weight:600;color:#707973;">ORDER</label>
                    <input type="number" name="order_index"
                           value="{{ $chapter->subChapters->count() + 1 }}" min="1" required
                           style="width:3.5rem;padding:0.5rem 0.4rem;background:#fff;border:1.5px solid #e4e2e1;border-radius:0.5rem;font-size:0.82rem;text-align:center;outline:none;"
                           onfocus="this.style.borderColor='#6b3f00'" onblur="this.style.borderColor='#e4e2e1'"/>
                </div>

                <div style="flex:1;display:flex;flex-direction:column;gap:0.2rem;">
                    <label style="font-size:0.65rem;font-weight:600;color:#707973;">JUDUL SUB-CHAPTER</label>
                    <input type="text" name="title" required placeholder="cth: Pengenalan Ha, Na, Ca, Ra, Ka"
                           style="width:100%;padding:0.5rem 0.75rem;background:#fff;border:1.5px solid #e4e2e1;border-radius:0.5rem;font-size:0.82rem;font-family:'Plus Jakarta Sans',sans-serif;outline:none;"
                           onfocus="this.style.borderColor='#6b3f00'" onblur="this.style.borderColor='#e4e2e1'"/>
                    @error('title')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div style="display:flex;flex-direction:column;gap:0.2rem;">
                    <label style="font-size:0.65rem;font-weight:600;color:#707973;">&nbsp;</label>
                    <button type="submit" class="btn-primary" style="padding:0.5rem 0.9rem;">
                        <span class="material-symbols-outlined" style="font-size:0.9rem;">add</span>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
