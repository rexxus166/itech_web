<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable',
            // 'pembahasan' => 'nullable|string',
        ]);

        Quiz::create($request->only('title', 'description','date', 'pembahasan'));

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz created successfully.');
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->only('title', 'description', 'date'));

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Quiz deleted successfully.');
    }

    public function showRespondents($id)
    {
        $quiz = Quiz::findOrFail($id);

        // Fetch respondents data with user info, score, correct/wrong counts, and submission time
        $respondents = \DB::table('user_answers')
            ->join('users', 'user_answers.user_id', '=', 'users.id')
            ->join('questions', 'user_answers.question_id', '=', 'questions.id')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                \DB::raw('COUNT(user_answers.id) as total_answers'),
                \DB::raw('SUM(CASE WHEN user_answers.answer_id IN (SELECT id FROM answers WHERE is_correct = 1) THEN 1 ELSE 0 END) as correct_answers'),
                \DB::raw('MAX(user_answers.created_at) as last_submit'),
                \DB::raw('MIN(user_answers.created_at) as first_submit')
            )
            ->where('questions.quiz_id', $id)
            ->groupBy('users.id', 'users.name', 'users.email')
            ->get();

        // Calculate wrong answers count and score percentage for each respondent
        $respondents = $respondents->map(function ($respondent) use ($quiz) {
            $respondent->wrong_answers = $respondent->total_answers - $respondent->correct_answers;
            $respondent->score = $respondent->total_answers > 0 ? round(($respondent->correct_answers / $quiz->questions()->count()) * 100, 2) : 0;
            return $respondent;
        });

        return view('admin.quiz.respondents', compact('quiz', 'respondents'));
    }

    public function showUserAnswers($quizId, $userId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $userAnswers = \DB::table('user_answers')
            ->join('questions', 'user_answers.question_id', '=', 'questions.id')
            ->join('answers', 'user_answers.answer_id', '=', 'answers.id')
            ->where('questions.quiz_id', $quizId)
            ->where('user_answers.user_id', $userId)
            ->select('questions.question_text', 'answers.answer_text', 'answers.is_correct')
            ->get();

        return view('admin.quiz.user_answers', compact('quiz', 'userAnswers'));
    }

    public function destroyUserAnswers($quizId, $userId)
    {
        \DB::table('user_answers')
            ->whereIn('question_id', function ($query) use ($quizId) {
                $query->select('id')->from('questions')->where('quiz_id', $quizId);
            })
            ->where('user_id', $userId)
            ->delete();

        return redirect()->route('admin.quiz.respondents', $quizId)->with('success', 'User answers deleted successfully.');
    }
}
