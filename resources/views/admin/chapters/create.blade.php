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
