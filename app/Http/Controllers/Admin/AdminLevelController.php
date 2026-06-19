<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Level;
use App\Models\SubChapter;
use Illuminate\Http\Request;

class AdminLevelController extends Controller
{
    public function index()
    {
        $levels = Level::with('subChapter.chapter')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        $chapters = Chapter::with('subChapters')->orderBy('order_index')->get();
        return view('admin.levels.create', compact('chapters'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sub_chapter_id' => 'required|exists:sub_chapters,id',
            'title'          => 'required|string|max:255',
            'order_index'    => 'required|integer|min:1',
            'xp_reward'      => 'required|integer|min:0',
        ]);

        Level::create($data);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Level berhasil ditambahkan!');
    }

    public function edit(Level $level)
    {
        $chapters = Chapter::with('subChapters')->orderBy('order_index')->get();
        return view('admin.levels.edit', compact('level', 'chapters'));
    }

    public function update(Request $request, Level $level)
    {
        $data = $request->validate([
            'sub_chapter_id' => 'required|exists:sub_chapters,id',
            'title'          => 'required|string|max:255',
            'order_index'    => 'required|integer|min:1',
            'xp_reward'      => 'required|integer|min:0',
        ]);

        $level->update($data);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Level berhasil diperbarui!');
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('admin.levels.index')
            ->with('success', 'Level berhasil dihapus.');
    }
}

