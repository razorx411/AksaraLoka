@extends('admin.layouts.app')
@section('title', 'Tambah Soal')
@section('breadcrumb', 'Soal / Tambah')

@section('content')
<div style="max-width:680px;">
    <div class="page-header">
        <div class="page-title">Tambah Soal Baru</div>
        <div class="page-sub">Buat soal baru untuk level tertentu.</div>
    </div>

    <div class="a-card">
        <div class="a-card-body">
            <form method="POST" action="{{ route('admin.questions.store') }}" id="questionForm">
                @csrf

                <div class="a-form-group">
                    <label class="a-label">Level <span style="color:#ba1a1a">*</span></label>
                    <select name="level_id" class="a-select" required>
                        <option value="">— Pilih Level —</option>
                        @foreach($levels as $level)
                        <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                            {{ $level->title }} ({{ $level->subChapter?->chapter?->title }})
                        </option>
                        @endforeach
                    </select>
                    @error('level_id')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div class="a-form-group">
                    <label class="a-label">Instruksi (opsional)</label>
                    <input type="text" name="instruction" class="a-input" value="{{ old('instruction') }}"
                           placeholder="cth: Pilih aksara yang benar untuk kata berikut"/>
                </div>

                <div class="a-form-group">
                    <label class="a-label">Teks Soal <span style="color:#ba1a1a">*</span></label>
                    <textarea name="question_text" class="a-textarea" required
                              placeholder="Tulis pertanyaan di sini...">{{ old('question_text') }}</textarea>
                    @error('question_text')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div class="a-form-group">
                    <label class="a-label">Tipe Soal <span style="color:#ba1a1a">*</span></label>
                    <select name="question_type" id="questionType" class="a-select" required>
                        <option value="multiple_choice" {{ old('question_type') == 'multiple_choice' ? 'selected' : '' }}>Pilihan Ganda</option>
                        <option value="fill_blank" {{ old('question_type') == 'fill_blank' ? 'selected' : '' }}>Isian Singkat</option>
                    </select>
                </div>

                {{-- Options section (multiple choice) --}}
                <div id="optionsSection">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.6rem;">
                        <label class="a-label" style="margin-bottom:0;">Pilihan Jawaban <span style="color:#ba1a1a">*</span></label>
                        <button type="button" id="addOption" class="btn-secondary" style="padding:0.3rem 0.65rem;font-size:0.75rem;">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">add</span> Tambah Opsi
                        </button>
                    </div>
                    <div id="optionsList" style="display:flex;flex-direction:column;gap:0.5rem;"></div>
                    <div style="font-size:0.72rem;color:#707973;margin-top:0.35rem;">Centang opsi yang merupakan jawaban benar.</div>
                </div>

                <div style="display:flex;gap:0.6rem;justify-content:flex-end;padding-top:0.75rem;border-top:1px solid #f0eded;margin-top:0.75rem;">
                    <a href="{{ route('admin.questions.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:1rem;">save</span>
                        Simpan Soal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let optionCount = 0;

function createOptionRow(index, text = '', isCorrect = false) {
    const row = document.createElement('div');
    row.style.cssText = 'display:flex;align-items:center;gap:0.5rem;background:#f6f3f2;border:1.5px solid #e4e2e1;border-radius:0.6rem;padding:0.5rem 0.75rem;';
    row.innerHTML = `
        <input type="checkbox" name="options[${index}][is_correct]" value="1"
               ${isCorrect ? 'checked' : ''}
               style="width:1rem;height:1rem;accent-color:#6b3f00;flex-shrink:0;"
               onchange="this.value = this.checked ? 1 : 0;">
        <input type="hidden" name="options[${index}][is_correct]" value="0" id="hidden_${index}">
        <input type="text" name="options[${index}][text]" value="${text}" required
               placeholder="Teks pilihan jawaban..."
               style="flex:1;background:transparent;border:none;outline:none;font-size:0.82rem;font-family:'Plus Jakarta Sans',sans-serif;color:#1b1c1c;">
        <button type="button" onclick="this.closest('div').remove()"
                style="background:none;border:none;cursor:pointer;color:#ba1a1a;display:flex;align-items:center;">
            <span class="material-symbols-outlined" style="font-size:1rem;">close</span>
        </button>
    `;
    // Fix checkbox + hidden field
    const cb = row.querySelector('input[type="checkbox"]');
    const hid = row.querySelector(`#hidden_${index}`);
    cb.addEventListener('change', () => { hid.value = cb.checked ? 1 : 0; });
    if (isCorrect) hid.value = 1;
    return row;
}

document.getElementById('addOption').addEventListener('click', () => {
    document.getElementById('optionsList').appendChild(createOptionRow(optionCount++));
});

document.getElementById('questionType').addEventListener('change', function() {
    document.getElementById('optionsSection').style.display =
        this.value === 'multiple_choice' ? 'block' : 'none';
});

// Init with 4 options
for (let i = 0; i < 4; i++) {
    document.getElementById('optionsList').appendChild(createOptionRow(optionCount++));
}
</script>
@endpush

