<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminLibraryController extends Controller
{
    public function index()
    {
        $libraries = Library::orderBy('category')->orderBy('title')->get();
        return view('admin.libraries.index', compact('libraries'));
    }

    public function create()
    {
        return view('admin.libraries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:libraries,slug',
            'subtitle'    => 'nullable|string|max:255',
            'category'    => 'required|in:aksara,bahasa,kosakata,cerita',
            'tag'         => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'content'     => 'required|json',
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'slug.required'     => 'Slug wajib diisi.',
            'slug.unique'       => 'Slug sudah digunakan oleh materi lain.',
            'category.required' => 'Kategori wajib diisi.',
            'content.required'  => 'Konten JSON wajib diisi.',
            'content.json'      => 'Konten harus berupa format JSON yang valid.',
        ]);

        Library::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->slug),
            'subtitle'    => $request->subtitle,
            'category'    => $request->category,
            'tag'         => $request->tag,
            'description' => $request->description,
            'content'     => json_decode($request->content, true),
        ]);

        return redirect()
            ->route('admin.libraries.index')
            ->with('success', 'Materi perpustakaan berhasil ditambahkan!');
    }

    public function edit(Library $library)
    {
        return view('admin.libraries.edit', compact('library'));
    }

    public function update(Request $request, Library $library)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:libraries,slug,' . $library->id,
            'subtitle'    => 'nullable|string|max:255',
            'category'    => 'required|in:aksara,bahasa,kosakata,cerita',
            'tag'         => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'content'     => 'required|json',
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'slug.required'     => 'Slug wajib diisi.',
            'slug.unique'       => 'Slug sudah digunakan oleh materi lain.',
            'category.required' => 'Kategori wajib diisi.',
            'content.required'  => 'Konten JSON wajib diisi.',
            'content.json'      => 'Konten harus berupa format JSON yang valid.',
        ]);

        $library->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->slug),
            'subtitle'    => $request->subtitle,
            'category'    => $request->category,
            'tag'         => $request->tag,
            'description' => $request->description,
            'content'     => json_decode($request->content, true),
        ]);

        return redirect()
            ->route('admin.libraries.index')
            ->with('success', 'Materi perpustakaan berhasil diperbarui!');
    }

    public function destroy(Library $library)
    {
        $library->delete();
        return redirect()
            ->route('admin.libraries.index')
            ->with('success', 'Materi perpustakaan berhasil dihapus.');
    }
}

