<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $questions = $quiz->questions()->with('answers')->get();
        return view('admin.question.index', compact('quiz', 'questions'));
    }

    public function create($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        return view('admin.question.create', compact('quiz'));
    }

    public function store(Request $request, $quizId)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answer_a' => 'required|string',
            'answer_b' => 'required|string',
            'answer_c' => 'required|string',
            'answer_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $quiz = Quiz::findOrFail($quizId);
        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
            'pembahasan' => $request->pembahasan_soal
        ]);

        $answersData = [
            'A' => $request->answer_a,
            'B' => $request->answer_b,
            'C' => $request->answer_c,
            'D' => $request->answer_d,
        ];

        foreach ($answersData as $option => $text) {
            $question->answers()->create([
                'option' => $option,
                'answer_text' => $text,
                'is_correct' => ($option === $request->correct_answer),
            ]);
        }

        return redirect()->route('admin.quiz.edit', $quizId)->with('success', 'Question added successfully.');
    }

    public function edit($quizId, $id)
    {
        $quiz = Quiz::findOrFail($quizId);
        $question = Question::findOrFail($id);
        return view('admin.question.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, $quizId, $id)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answer_a' => 'required|string',
            'answer_b' => 'required|string',
            'answer_c' => 'required|string',
            'answer_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
            'pembahasan_soal' => 'nullable|string',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'question_text' => $request->question_text,
            'pembahasan' => $request->pembahasan_soal,
        ]);

        $answersData = [
            'A' => $request->answer_a,
            'B' => $request->answer_b,
            'C' => $request->answer_c,
            'D' => $request->answer_d,
        ];

        foreach ($answersData as $option => $text) {
            $answer = $question->answers()->where('option', $option)->first();
            if ($answer) {
                $answer->update([
                    'answer_text' => $text,
                    'is_correct' => ($option === $request->correct_answer),
                ]);
            } else {
                $question->answers()->create([
                    'option' => $option,
                    'answer_text' => $text,
                    'is_correct' => ($option === $request->correct_answer),
                ]);
            }
        }

        return redirect()->route('admin.quiz.edit', $quizId)->with('success', 'Question updated successfully.');
    }

    public function destroy($quizId, $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.quiz.edit', $quizId)->with('success', 'Question deleted successfully.');
    }

    public function editJson($quizId, $id)
    {
        $question = Question::with('answers')->findOrFail($id);

        $answers = [];
        foreach ($question->answers as $answer) {
            $answers[$answer->option] = [
                'id' => $answer->id,
                'answer_text' => $answer->answer_text,
                'is_correct' => $answer->is_correct,
            ];
        }

        $correctAnswer = $question->answers->firstWhere('is_correct', true);

        return response()->json([
            'id' => $question->id,
            'question_text' => $question->question_text,
            'answers' => $answers,
            'correct_answer' => $correctAnswer ? $correctAnswer->option : null,
        ]);
    }
}
