@extends('admin.layouts.app')
@section('title', 'Edit Level')
@section('breadcrumb', 'Level / Edit')

@section('content')
<div style="max-width:560px;">
    <div class="page-header">
        <div class="page-title">Edit Level</div>
        <div class="page-sub">Perbarui data level: <strong>{{ $level->title }}</strong></div>
    </div>

    <div class="a-card">
        <div class="a-card-body">
            <form method="POST" action="{{ route('admin.levels.update', $level) }}">
                @csrf @method('PUT')

                <div class="a-form-group">
                    <label class="a-label">Sub-Chapter <span style="color:#ba1a1a">*</span></label>
                    <select name="sub_chapter_id" class="a-select" required>
                        <option value="">— Pilih Sub-Chapter —</option>
                        @foreach($chapters as $chapter)
                            <optgroup label="{{ $chapter->title }}">
                                @foreach($chapter->subChapters as $sc)
                                    <option value="{{ $sc->id }}"
                                        {{ old('sub_chapter_id', $level->sub_chapter_id) == $sc->id ? 'selected' : '' }}>
                                        {{ $sc->title }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('sub_chapter_id')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div class="a-form-group">
                    <label class="a-label">Judul Level <span style="color:#ba1a1a">*</span></label>
                    <input type="text" name="title" class="a-input"
                           value="{{ old('title', $level->title) }}" required/>
                    @error('title')<div class="a-error">{{ $message }}</div>@enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                    <div class="a-form-group">
                        <label class="a-label">Urutan (Order Index) <span style="color:#ba1a1a">*</span></label>
                        <input type="number" name="order_index" class="a-input"
                               value="{{ old('order_index', $level->order_index) }}" min="1" required/>
                        @error('order_index')<div class="a-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="a-form-group">
                        <label class="a-label">XP Reward <span style="color:#ba1a1a">*</span></label>
                        <input type="number" name="xp_reward" class="a-input"
                               value="{{ old('xp_reward', $level->xp_reward) }}" min="0" step="10" required/>
                        @error('xp_reward')<div class="a-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div style="display:flex;gap:0.6rem;justify-content:flex-end;padding-top:0.5rem;border-top:1px solid #f0eded;margin-top:0.5rem;">
                    <a href="{{ route('admin.levels.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">
                        <span class="material-symbols-outlined" style="font-size:1rem;">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
