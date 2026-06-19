<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('level.subChapter.chapter')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $levels = Level::with('subChapter.chapter')->orderBy('id')->get();
        return view('admin.questions.create', compact('levels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'level_id'      => 'required|exists:levels,id',
            'instruction'   => 'nullable|string',
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,fill_blank',
            'options'       => 'required_if:question_type,multiple_choice|array|min:2',
            'options.*.text'       => 'required|string',
            'options.*.is_correct' => 'required|boolean',
        ]);

        $question = Question::create([
            'level_id'      => $data['level_id'],
            'instruction'   => $data['instruction'] ?? null,
            'question_text' => $data['question_text'],
            'question_type' => $data['question_type'],
        ]);

        if (!empty($data['options'])) {
            foreach ($data['options'] as $opt) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $opt['text'],
                    'is_correct'  => $opt['is_correct'],
                ]);
            }
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    public function edit(Question $question)
    {
        $question->load('options');
        $levels = Level::with('subChapter.chapter')->orderBy('id')->get();
        return view('admin.questions.edit', compact('question', 'levels'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'level_id'      => 'required|exists:levels,id',
            'instruction'   => 'nullable|string',
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,fill_blank',
            'options'       => 'array',
            'options.*.id'         => 'nullable|exists:question_options,id',
            'options.*.text'       => 'required|string',
            'options.*.is_correct' => 'required|boolean',
        ]);

        $question->update([
            'level_id'      => $data['level_id'],
            'instruction'   => $data['instruction'] ?? null,
            'question_text' => $data['question_text'],
            'question_type' => $data['question_type'],
        ]);

        // Replace options
        $question->options()->delete();
        if (!empty($data['options'])) {
            foreach ($data['options'] as $opt) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $opt['text'],
                    'is_correct'  => $opt['is_correct'],
                ]);
            }
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroy(Question $question)
    {
        $question->options()->delete();
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil dihapus.');
    }
}

