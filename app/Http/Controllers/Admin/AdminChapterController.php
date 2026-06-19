<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\SubChapter;
use Illuminate\Http\Request;

class AdminChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::withCount('subChapters')->orderBy('order_index')->get();
        return view('admin.chapters.index', compact('chapters'));
    }

    public function create()
    {
        return view('admin.chapters.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_index' => 'required|integer|min:1',
            'image'       => 'required|string|in:mascot_girl_wave.png,mascot_boy_cross.png,mascot_boy_salam.png,mascot_girl_teacher.png',
        ]);

        Chapter::create($data);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter berhasil ditambahkan!');
    }

    public function edit(Chapter $chapter)
    {
        $chapter->load('subChapters');
        return view('admin.chapters.edit', compact('chapter'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_index' => 'required|integer|min:1',
            'image'       => 'required|string|in:mascot_girl_wave.png,mascot_boy_cross.png,mascot_boy_salam.png,mascot_girl_teacher.png',
        ]);

        $chapter->update($data);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter berhasil diperbarui!');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter berhasil dihapus.');
    }
}

