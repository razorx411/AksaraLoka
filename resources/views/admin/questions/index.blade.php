@extends('admin.layouts.app')
@section('title', 'Manajemen Soal')
@section('breadcrumb', 'Soal')

@section('content')

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <div class="page-title">Manajemen Soal</div>
        <div class="page-sub">{{ $questions->total() }} soal tersedia dalam sistem.</div>
    </div>
    <a href="{{ route('admin.questions.create') }}" class="btn-primary">
        <span class="material-symbols-outlined" style="font-size:1rem;">add</span>
        Tambah Soal
    </a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Soal</th>
                <th>Tipe</th>
                <th>Level</th>
                <th>Opsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($questions as $q)
            <tr>
                <td style="color:#707973;font-size:0.75rem;">#{{ $q->id }}</td>
                <td style="max-width:250px;">
                    @if($q->instruction)
                    <div style="font-size:0.68rem;color:#707973;margin-bottom:0.15rem;">{{ Str::limit($q->instruction, 40) }}</div>
                    @endif
                    <div style="font-weight:500;font-size:0.82rem;">{{ Str::limit($q->question_text, 60) }}</div>
                </td>
                <td>
                    <span class="badge {{ $q->question_type === 'multiple_choice' ? 'badge-brown' : 'badge-amber' }}">
                        {{ $q->question_type === 'multiple_choice' ? 'Pilihan Ganda' : 'Isian' }}
                    </span>
                </td>
                <td style="font-size:0.78rem;color:#404943;">{{ $q->level?->title ?? '—' }}</td>
                <td style="text-align:center;">
                    <span style="font-size:0.75rem;color:#707973;">{{ $q->options->count() }} opsi</span>
                </td>
                <td>
                    <div style="display:flex;gap:0.3rem;">
                        <a href="{{ route('admin.questions.edit', $q) }}" class="btn-icon btn-icon-edit" title="Edit">
                            <span class="material-symbols-outlined" style="font-size:0.85rem;">edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.questions.destroy', $q) }}"
                              onsubmit="return confirm('Hapus soal ini beserta semua opsinya?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon-del" title="Hapus">
                                <span class="material-symbols-outlined" style="font-size:0.85rem;">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#707973;padding:2rem;">Belum ada soal.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($questions->hasPages())
    <div style="padding:0.75rem 1rem;border-top:1px solid #f0eded;" class="pagination-admin">
        {{ $questions->links() }}
    </div>
    @endif
</div>
@endsection

