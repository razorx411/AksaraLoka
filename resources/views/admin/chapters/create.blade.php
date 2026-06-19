@extends('admin.layouts.app')
@section('title', 'Tambah Chapter')
@section('breadcrumb', 'Chapter / Tambah')

@section('content')
<div style="max-width:560px;">
    <div class="page-header">
        <div class="page-title">Tambah Chapter Baru</div>
        <div class="page-sub">Buat unit chapter baru dalam kurikulum AksaraLoka.</div>
    </div>

    <div class="a-card">
        <div class="a-card-body">
            <form method="POST" action="{{ route('admin.chapters.store') }}">
                @csrf

                <div class="a-form-group">
                    <label class="a-label">Judul Chapter <span style="color:#ba1a1a">*</span></label>
                    <input type="text" name="title" class="a-input" value="{{ old('title') }}"
                           placeholder="cth: Aksara Dasar Hanacaraka" required/>
                    @error('title')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div class="a-form-group">
                    <label class="a-label">Deskripsi</label>
                    <textarea name="description" class="a-textarea"
                              placeholder="Deskripsi singkat tentang chapter ini...">{{ old('description') }}</textarea>
                    @error('description')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div class="a-form-group">
                    <label class="a-label">Urutan (Order Index) <span style="color:#ba1a1a">*</span></label>
                    <input type="number" name="order_index" class="a-input" value="{{ old('order_index', 1) }}"
                           min="1" required/>
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
                            <input type="radio" name="image" value="mascot_girl_wave.png" {{ old('image', 'mascot_girl_wave.png') == 'mascot_girl_wave.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_girl_wave.png') }}" alt="Gadis Melambai" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Gadis Melambai</span>
                        </label>
                        <!-- Card 2 -->
                        <label class="mascot-option-card">
                            <input type="radio" name="image" value="mascot_boy_cross.png" {{ old('image') == 'mascot_boy_cross.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_boy_cross.png') }}" alt="Pemuda Bersedekap" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Pemuda Bersedekap</span>
                        </label>
                        <!-- Card 3 -->
                        <label class="mascot-option-card">
                            <input type="radio" name="image" value="mascot_boy_salam.png" {{ old('image') == 'mascot_boy_salam.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_boy_salam.png') }}" alt="Pemuda Salam" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Pemuda Salam</span>
                        </label>
                        <!-- Card 4 -->
                        <label class="mascot-option-card">
                            <input type="radio" name="image" value="mascot_girl_teacher.png" {{ old('image') == 'mascot_girl_teacher.png' ? 'checked' : '' }} required />
                            <img src="{{ asset('assets/images/mascot_girl_teacher.png') }}" alt="Gadis Guru" style="height:50px;width:auto;object-fit:contain;margin-bottom:0.25rem;" />
                            <span style="font-size:0.68rem;font-weight:600;color:#404943;display:block;">Gadis Guru</span>
                        </label>
                    </div>
                    @error('image')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div style="display:flex;gap:0.6rem;justify-content:flex-end;padding-top:0.5rem;border-top:1px solid #f0eded;margin-top:0.5rem;">
                    <a href="{{ route('admin.chapters.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:1rem;">save</span>
                        Simpan Chapter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

