<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\SubChapter;
use Illuminate\Http\Request;

class AdminSubChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with(['subChapters' => function ($q) {
            $q->orderBy('order_index')->withCount('levels');
        }])->withCount('subChapters')->orderBy('order_index')->get();

        return view('admin.sub_chapters.index', compact('chapters'));
    }

    public function store(Request $request, Chapter $chapter)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'order_index' => 'required|integer|min:1',
        ]);

        $chapter->subChapters()->create($data);

        $back = url()->previous();
        $editRoute = route('admin.chapters.edit', $chapter);

        return redirect($back ?: $editRoute)
            ->with('success', "Sub-chapter \"{$data['title']}\" berhasil ditambahkan!");
    }

    public function update(Request $request, Chapter $chapter, SubChapter $sc)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'order_index' => 'required|integer|min:1',
        ]);

        $sc->update($data);

        $back = url()->previous();
        $editRoute = route('admin.chapters.edit', $chapter);

        return redirect($back ?: $editRoute)
            ->with('success', "Sub-chapter \"{$data['title']}\" berhasil diperbarui!");
    }

    public function destroy(Chapter $chapter, SubChapter $sc)
    {
        $sc->delete();

        $back = url()->previous();
        $editRoute = route('admin.chapters.edit', $chapter);

        return redirect($back ?: $editRoute)
            ->with('success', 'Sub-chapter berhasil dihapus.');
    }
}
