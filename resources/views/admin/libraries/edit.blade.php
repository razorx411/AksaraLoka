@extends('admin.layouts.app')
@section('title', 'Edit Materi')
@section('breadcrumb', 'Perpustakaan / Edit')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <div>
        <div class="page-title">Edit Materi: {{ $library->title }}</div>
        <div class="page-sub">Perbarui detail, kategori, atau konten JSON materi perpustakaan.</div>
    </div>
    <a href="{{ route('admin.libraries.index') }}" class="btn-secondary">
        <span class="material-symbols-outlined" style="font-size:1rem;">arrow_back</span>
        Kembali
    </a>
</div>

<div class="a-card" style="max-w-4xl;">
    <div class="a-card-header">
        <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Formulir Perubahan Materi</div>
    </div>

    <div class="a-card-body">
        <form method="POST" action="{{ route('admin.libraries.update', $library) }}">
            @csrf
            @method('PUT')

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.1rem;">
                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="title">Judul Materi</label>
                    <input type="text" name="title" id="title" class="a-input @error('title') border-red-500 @enderror"
                           value="{{ old('title', $library->title) }}" placeholder="Contoh: Aksara Murda" required maxlength="255">
                    @error('title')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="slug">Slug URL</label>
                    <input type="text" name="slug" id="slug" class="a-input @error('slug') border-red-500 @enderror"
                           value="{{ old('slug', $library->slug) }}" placeholder="Contoh: aksara-murda" required maxlength="255">
                    @error('slug')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.1rem;">
                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="category">Kategori Materi</label>
                    <select name="category" id="category" class="a-select" required>
                        <option value="aksara" {{ old('category', $library->category) == 'aksara' ? 'selected' : '' }}>Aksara (Huruf & Penulisan)</option>
                        <option value="bahasa" {{ old('category', $library->category) == 'bahasa' ? 'selected' : '' }}>Bahasa (Unggah-Ungguh / Tingkatan)</option>
                        <option value="kosakata" {{ old('category', $library->category) == 'kosakata' ? 'selected' : '' }}>Kosakata & Kamus</option>
                        <option value="cerita" {{ old('category', $library->category) == 'cerita' ? 'selected' : '' }}>Cerita & Kesusastraan</option>
                    </select>
                    @error('category')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="tag">Tag Label</label>
                    <input type="text" name="tag" id="tag" class="a-input @error('tag') border-red-500 @enderror"
                           value="{{ old('tag', $library->tag) }}" placeholder="Contoh: Dasar, Sopan, Penting" maxlength="50">
                    @error('tag')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="a-form-group">
                <label class="a-label" for="subtitle">Sub-Judul / Deskripsi Singkat Utama</label>
                <input type="text" name="subtitle" id="subtitle" class="a-input @error('subtitle') border-red-500 @enderror"
                       value="{{ old('subtitle', $library->subtitle) }}" placeholder="Contoh: Memahami sebutan tata bahasa formal..." maxlength="255">
                @error('subtitle')
                    <div class="a-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="a-form-group">
                <label class="a-label" for="description">Filosofi / Penjelasan Tambahan Halaman</label>
                <textarea name="description" id="description" rows="3" class="a-textarea @error('description') border-red-500 @enderror"
                          placeholder="Penjelasan filosofis atau konteks budaya materi...">{{ old('description', $library->description) }}</textarea>
                @error('description')
                    <div class="a-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="a-form-group">
                <div style="display:flex;justify-content:between;align-items:center;margin-bottom:0.35rem;">
                    <label class="a-label" for="content" style="margin-bottom:0;">Struktur Konten (Format JSON)</label>
                    <button type="button" id="btnBeautify" class="btn-secondary" style="font-size:0.68rem;padding:0.2rem 0.5rem;border-radius:0.35rem;display:flex;align-items:center;gap:0.25rem;margin-left:auto;">
                        <span class="material-symbols-outlined" style="font-size:0.85rem;">auto_fix</span>
                        Rapikan Format JSON
                    </button>
                </div>
                <textarea name="content" id="content" rows="12" class="a-textarea @error('content') border-red-500 @enderror"
                          style="font-family:monospace;font-size:0.8rem;" required>{{ old('content', json_encode($library->content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
                @error('content')
                    <div class="a-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;justify-content:flex-end;gap:0.75rem;margin-top:1.5rem;border-top:1px solid #f0eded;padding-top:1.25rem;">
                <a href="{{ route('admin.libraries.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-outlined" style="font-size:1rem;">save</span>
                    Simpan Perubahan
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
    const contentTextarea= document.getElementById('content');
    const btnBeautify   = document.getElementById('btnBeautify');

    // Auto slug creation (only if it matches initial slug translation or is edited)
    titleInput.addEventListener('input', function() {
        if (slugInput.value === '') {
            slugInput.value = generateSlug(titleInput.value);
        }
    });

    function generateSlug(text) {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\--+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    btnBeautify.addEventListener('click', function() {
        try {
            const raw = contentTextarea.value;
            const parsed = JSON.parse(raw);
            contentTextarea.value = JSON.stringify(parsed, null, 4);
        } catch (e) {
            alert('Format JSON tidak valid! Silakan koreksi sebelum merapikan.');
        }
    });
});
</script>
@endpush

@endsection

