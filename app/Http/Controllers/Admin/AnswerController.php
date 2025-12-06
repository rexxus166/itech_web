<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index($quizId, $questionId)
    {
        $question = Question::with('answers')->findOrFail($questionId);
        return view('admin.answer.index', compact('question', 'quizId'));
    }

    public function create($quizId, $questionId)
    {
        $question = Question::findOrFail($questionId);
        return view('admin.answer.create', compact('question', 'quizId'));
    }

    public function store(Request $request, $quizId, $questionId)
    {
        $request->validate([
            'answer_text' => 'required|string',
            'is_correct' => 'nullable|boolean',
        ]);

        $question = Question::findOrFail($questionId);
        $question->answers()->create([
            'answer_text' => $request->answer_text,
            'is_correct' => $request->is_correct,
        ]);

        return redirect()->route('admin.quiz.edit', $quizId)->with('success', 'Answer added successfully.');
    }

    public function edit($quizId, $questionId, $id)
    {
        $question = Question::findOrFail($questionId);
        $answer = Answer::findOrFail($id);
        return view('admin.answer.edit', compact('question', 'answer', 'quizId'));
    }

    public function update(Request $request, $quizId, $questionId, $id)
    {
        $request->validate([
            'answer_text' => 'required|string',
            'is_correct' => 'required|boolean',
        ]);

        $answer = Answer::findOrFail($id);
        $answer->update([
            'answer_text' => $request->answer_text,
            'is_correct' => $request->is_correct,
        ]);

        return redirect()->route('admin.quiz.edit', $quizId)->with('success', 'Answer updated successfully.');
    }

    public function destroy($quizId, $questionId, $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return redirect()->route('admin.quiz.edit', $quizId)->with('success', 'Answer deleted successfully.');
    }
}
