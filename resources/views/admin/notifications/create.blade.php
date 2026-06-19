@extends('admin.layouts.app')
@section('title', 'Kirim Notifikasi Baru')
@section('breadcrumb', 'Notifikasi / Baru')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
    <div>
        <div class="page-title">Kirim Notifikasi Baru</div>
        <div class="page-sub">Buat siaran notifikasi baru ke seluruh pengguna AksaraLoka.</div>
    </div>
    <div>
        <a href="{{ route('admin.notifications.index') }}" class="btn-secondary">
            <span class="material-symbols-outlined" style="font-size:1rem;">arrow_back</span>
            Kembali
        </a>
    </div>
</div>

<div class="a-card" style="max-w-3xl;">
    <div class="a-card-header">
        <div style="font-size:0.88rem;font-weight:700;color:#1b1c1c;">Formulir Notifikasi</div>
    </div>
    
    <div class="a-card-body">
        <form method="POST" action="{{ route('admin.notifications.store') }}">
            @csrf

            <div class="a-form-group">
                <label class="a-label" for="title">Judul Notifikasi</label>
                <input type="text" name="title" id="title" class="a-input @error('title') border-red-500 @enderror" 
                       value="{{ old('title') }}" placeholder="Contoh: Bab Baru Telah Rilis!" required maxlength="255">
                @error('title')
                    <div class="a-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.1rem;">
                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="type">Tipe Notifikasi</label>
                    <select name="type" id="type" class="a-select" required>
                        <option value="info" {{ old('type') == 'info' ? 'selected' : '' }}>Info / Pengumuman</option>
                        <option value="materi" {{ old('type') == 'materi' ? 'selected' : '' }}>Materi Baru</option>
                        <option value="soal" {{ old('type') == 'soal' ? 'selected' : '' }}>Soal Baru</option>
                    </select>
                    @error('type')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="a-form-group" style="margin-bottom:0;">
                    <label class="a-label" for="icon">Ikon Notifikasi (Material Icon)</label>
                    <div style="display:flex;gap:0.5rem;">
                        <div id="iconPreviewContainer" class="badge badge-brown" style="width:2.4rem;height:2.4rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <span class="material-symbols-outlined" id="previewIcon">info</span>
                        </div>
                        <input type="text" name="icon" id="icon" class="a-input" 
                               value="{{ old('icon', 'info') }}" placeholder="info" required maxlength="100">
                    </div>
                    @error('icon')
                        <div class="a-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Presets list --}}
            <div class="a-form-group" style="margin-top:-0.5rem;margin-bottom:1.5rem;">
                <label class="a-label" style="font-size:0.68rem;color:#707973;">Rekomendasi Ikon:</label>
                <div style="display:flex;gap:0.35rem;flex-wrap:wrap;margin-top:0.25rem;" id="presetsContainer">
                    <!-- Loaded dynamically via JavaScript based on chosen type -->
                </div>
            </div>

            <div class="a-form-group">
                <label class="a-label" for="body">Isi Notifikasi</label>
                <textarea name="body" id="body" rows="4" class="a-textarea @error('body') border-red-500 @enderror" 
                          placeholder="Tulis pesan lengkap yang ingin disampaikan..." required maxlength="2000">{{ old('body') }}</textarea>
                @error('body')
                    <div class="a-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;justify-content:flex-end;gap:0.75rem;margin-top:1.5rem;border-top:1px solid #f0eded;padding-top:1.25rem;">
                <a href="{{ route('admin.notifications.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-outlined" style="font-size:1rem;">send</span>
                    Kirim Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const iconInput = document.getElementById('icon');
    const previewIcon = document.getElementById('previewIcon');
    const previewContainer = document.getElementById('iconPreviewContainer');
    const presetsContainer = document.getElementById('presetsContainer');

    const presets = {
        info: ['info', 'campaign', 'star', 'verified', 'notifications_active', 'admin_panel_settings', 'workspace_premium'],
        materi: ['auto_stories', 'menu_book', 'import_contacts', 'library_books', 'school', 'local_library', 'history_edu'],
        soal: ['quiz', 'assignment', 'border_color', 'edit_document', 'extension', 'psychology', 'fact_check']
    };

    const typeColors = {
        info: { bg: '#f4d7a1', color: '#6b3f00' },
        materi: { bg: '#a4f79233', color: '#005503' },
        soal: { bg: '#ffc64133', color: '#5c4300' }
    };

    function updatePresets() {
        const type = typeSelect.value;
        const currentPresets = presets[type] || presets.info;
        
        presetsContainer.innerHTML = '';
        currentPresets.forEach(iconName => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn-secondary';
            btn.style.padding = '0.25rem 0.5rem';
            btn.style.fontSize = '0.75rem';
            btn.style.display = 'inline-flex';
            btn.style.alignItems = 'center';
            btn.style.gap = '0.25rem';
            btn.style.borderRadius = '0.35rem';
            btn.innerHTML = `
                <span class="material-symbols-outlined" style="font-size:0.9rem;">${iconName}</span>
                ${iconName}
            `;
            btn.addEventListener('click', () => {
                iconInput.value = iconName;
                updatePreview();
            });
            presetsContainer.appendChild(btn);
        });

        // Set default icon if not customized/restored from old()
        const isDefaultOrOld = iconInput.value === '' || 
            Object.values(presets).flat().includes(iconInput.value);
            
        if (isDefaultOrOld) {
            iconInput.value = currentPresets[0];
            updatePreview();
        }
    }

    function updatePreview() {
        const iconName = iconInput.value.trim() || 'info';
        previewIcon.textContent = iconName;

        const type = typeSelect.value;
        const colors = typeColors[type] || typeColors.info;
        
        previewContainer.style.backgroundColor = colors.bg;
        previewContainer.style.color = colors.color;
        previewIcon.style.color = colors.color;
    }

    typeSelect.addEventListener('change', () => {
        updatePresets();
        updatePreview();
    });

    iconInput.addEventListener('input', updatePreview);

    // Initial render
    updatePresets();
    updatePreview();
});
</script>
@endpush

@endsection

