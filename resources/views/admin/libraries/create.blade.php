@extends('admin.layouts.app')
@section('title', 'Tambah Materi Baru')
@section('breadcrumb', 'Perpustakaan / Tambah')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <div>
        <div class="page-title">Tambah Materi Baru</div>
        <div class="page-sub">Buat materi atau referensi perpustakaan baru untuk pengguna.</div>
    </div>
    <a href="{{ route('admin.libraries.index') }}" class="btn-secondary">
        <span class="material-symbols-outlined" style="font-size:1rem;">arrow_back</span>
        Kembali
    </a>
</div>

<div class="a-card" style="max-w-4xl;">
    <div class="a-card-header">
        <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Formulir Materi Baru</div>
    </div>

    <div class="a-card-body">
        <form method="POST" action="{{ route('admin.libraries.store') }}">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.1rem;">
                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="title">Judul Materi</label>
                    <input type="text" name="title" id="title" class="a-input @error('title') border-red-500 @enderror"
                           value="{{ old('title') }}" placeholder="Contoh: Aksara Murda" required maxlength="255">
                    @error('title')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="slug">Slug URL (Otomatis dibuat dari Judul jika dikosongkan)</label>
                    <input type="text" name="slug" id="slug" class="a-input @error('slug') border-red-500 @enderror"
                           value="{{ old('slug') }}" placeholder="Contoh: aksara-murda" required maxlength="255">
                    @error('slug')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.1rem;">
                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="category">Kategori Materi</label>
                    <select name="category" id="category" class="a-select" required>
                        <option value="aksara" {{ old('category') == 'aksara' ? 'selected' : '' }}>Aksara (Huruf & Penulisan)</option>
                        <option value="bahasa" {{ old('category') == 'bahasa' ? 'selected' : '' }}>Bahasa (Unggah-Ungguh / Tingkatan)</option>
                        <option value="kosakata" {{ old('category') == 'kosakata' ? 'selected' : '' }}>Kosakata & Kamus</option>
                        <option value="cerita" {{ old('category') == 'cerita' ? 'selected' : '' }}>Cerita & Kesusastraan</option>
                    </select>
                    @error('category')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="tag">Tag Label</label>
                    <input type="text" name="tag" id="tag" class="a-input @error('tag') border-red-500 @enderror"
                           value="{{ old('tag') }}" placeholder="Contoh: Dasar, Sopan, Penting" maxlength="50">
                    @error('tag')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="a-form-group">
                <label class="a-label" for="subtitle">Sub-Judul / Deskripsi Singkat Utama</label>
                <input type="text" name="subtitle" id="subtitle" class="a-input @error('subtitle') border-red-500 @enderror"
                       value="{{ old('subtitle') }}" placeholder="Contoh: Memahami sebutan tata bahasa formal..." maxlength="255">
                @error('subtitle')
                    <div class="a-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="a-form-group">
                <label class="a-label" for="description">Filosofi / Penjelasan Tambahan Halaman</label>
                <textarea name="description" id="description" rows="3" class="a-textarea @error('description') border-red-500 @enderror"
                          placeholder="Penjelasan filosofis atau konteks budaya materi...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="a-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="a-form-group" style="position:relative;">
                <div style="display:flex;justify-content:between;align-items:center;margin-bottom:0.35rem;">
                    <label class="a-label" for="content" style="margin-bottom:0;">Struktur Konten (Format JSON)</label>
                    <button type="button" id="btnLoadTemplate" class="btn-secondary" style="font-size:0.68rem;padding:0.2rem 0.5rem;border-radius:0.35rem;display:flex;align-items:center;gap:0.25rem;margin-left:auto;">
                        <span class="material-symbols-outlined" style="font-size:0.85rem;">restart_alt</span>
                        Reset ke Template Kategori
                    </button>
                </div>
                <textarea name="content" id="content" rows="12" class="a-textarea @error('content') border-red-500 @enderror"
                          style="font-family:monospace;font-size:0.8rem;" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="a-error">{{ $message }}</div>
                @enderror
                <p style="font-size:0.7rem;color:#707973;margin-top:0.35rem;line-height:1.4;">
                    * Pastikan format JSON valid. Setiap kategori memiliki pola skema tersendiri. Gunakan tombol template di atas untuk memulainya.
                </p>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:0.75rem;margin-top:1.5rem;border-top:1px solid #f0eded;padding-top:1.25rem;">
                <a href="{{ route('admin.libraries.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-outlined" style="font-size:1rem;">save</span>
                    Simpan Materi
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput    = document.getElementById('title');
    const slugInput     = document.getElementById('slug');
    const categorySelect= document.getElementById('category');
    const contentTextarea= document.getElementById('content');
    const btnLoadTemplate= document.getElementById('btnLoadTemplate');

    // Auto slug creation
    titleInput.addEventListener('input', function() {
        if (slugInput.value === '' || slugInput.dataset.edited !== 'true') {
            slugInput.value = generateSlug(titleInput.value);
        }
    });

    slugInput.addEventListener('input', function() {
        slugInput.dataset.edited = 'true';
    });

    function generateSlug(text) {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    // JSON templates by Category
    const jsonTemplates = {
        aksara: {
            "hanacaraka": [
                {"aksara": "ꦲ", "latin": "Ha"},
                {"aksara": "ꦤ", "latin": "Na"}
            ],
            "sandhangan": [
                {"nama": "Wulu (i)", "contoh": "ꦏꦶ = ki"}
            ],
            "contohKata": [
                {"latin": "Kula", "aksara": "ꦏꦸꦭ"}
            ]
        },
        bahasa: {
            "kosakata": [
                {"ngoko": "Aku", "indonesia": "Saya", "krama": "Kula"}
            ],
            "kalimat": [
                "Aku mangan sega."
            ],
            "percakapan": [
                {"nama": "A", "ucap": "Hei, kowe lagi apa?"},
                {"nama": "B", "ucap": "Aku lagi mangan."}
            ]
        },
        kosakata: {
            "salam": [
                {"jawa": "Sugeng enjing", "indonesia": "Selamat pagi", "konteks": "Pagi hari"}
            ],
            "keluarga": [
                {"jawa": "Bapak", "indonesia": "Ayah"}
            ],
            "aktivitas": [
                {"jawa": "Mangan", "indonesia": "Makan"}
            ],
            "dialog": [
                {"nama": "A", "ucap": "Sugeng enjing!"}
            ],
            "pola": [
                {"pola": "Subyek + Predikat", "contoh": "Aku mangan."}
            ]
        },
        cerita: {
            "jenisTeks": [
                {"nama": "Narasi", "desc": "Crita utawa kedadeyan kang urut wektune"}
            ],
            "unsurCerita": [
                {"nama": "Tema", "desc": "Gagasan utama sing dadi dhasare crita"}
            ],
            "unsurParagraf": [
                {"nama": "Gagasan utama", "desc": "Inti pikiran paragraf"}
            ]
        }
    };

    function loadTemplate() {
        const cat = categorySelect.value;
        const template = jsonTemplates[cat] || jsonTemplates.aksara;
        contentTextarea.value = JSON.stringify(template, null, 4);
    }

    // Load template on first load if textarea is empty
    if (contentTextarea.value.trim() === '') {
        loadTemplate();
    }

    categorySelect.addEventListener('change', function() {
        // Only override if textarea matches one of the templates or is empty
        const currentVal = contentTextarea.value.trim();
        let matchesAny = currentVal === '';
        
        if (!matchesAny) {
            for (const t of Object.values(jsonTemplates)) {
                if (currentVal === JSON.stringify(t, null, 4)) {
                    matchesAny = true;
                    break;
                }
            }
        }

        if (matchesAny) {
            loadTemplate();
        }
    });

    btnLoadTemplate.addEventListener('click', function() {
        if (confirm('Reset isi teks konten dengan template default kategori ini?')) {
            loadTemplate();
        }
    });
});
</script>
@endpush

@endsection
