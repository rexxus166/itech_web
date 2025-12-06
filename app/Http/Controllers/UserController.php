<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\UserAnswer;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showQuiz($id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        $userId = Auth::id();

        // Check if user already answered this quiz
        $answered = UserAnswer::where('user_id', $userId)
            ->whereHas('question', function ($query) use ($id) {
                $query->where('quiz_id', $id);
            })->exists();

        if ($answered) {
            return redirect()->route('quiz.result', ['id' => $id]);
        }

        return view('user.quiz_answer', compact('quiz'));
    }

    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        $userId = Auth::id();

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:answers,id',
        ]);

        // Prevent multiple submissions
        $alreadyAnswered = UserAnswer::where('user_id', $userId)
            ->whereHas('question', function ($query) use ($id) {
                $query->where('quiz_id', $id);
            })->exists();

        if ($alreadyAnswered) {
            return redirect()->route('quiz.result', ['id' => $id]);
        }

        $score = 0;
        $total = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $answerId = $request->input('answers.' . $question->id);
            $answer = Answer::find($answerId);

            if ($answer && $answer->is_correct) {
                $score++;
            }

            UserAnswer::create([
                'user_id' => $userId,
                'question_id' => $question->id,
                'answer_id' => $answerId,
            ]);
        }

        $percentage = $total > 0 ? ($score / $total) * 100 : 0;

        // You can save the score in a quiz_attempts table or similar if needed

        return redirect()->route('quiz.result', ['id' => $id])->with('score', $percentage);
    }

    public function showResult($id)
    {
        $quiz = Quiz::findOrFail($id);
        $userId = Auth::id();

        $userAnswers = UserAnswer::where('user_id', $userId)
            ->whereHas('question', function ($query) use ($id) {
                $query->where('quiz_id', $id);
            })->with('question', 'answer')->get();

        // Get last submission time from user answers
        $lastSubmissionTime = UserAnswer::where('user_id', $userId)
            ->whereHas('question', function ($query) use ($id) {
                $query->where('quiz_id', $id);
            })->max('created_at');

        return view('user.quiz_result', compact('quiz', 'userAnswers', 'lastSubmissionTime'));
    }

    public function listQuizzes()
    {
        $quizzes = Quiz::orderBy('date', 'desc')->get();
        return view('user.quiz_list', compact('quizzes'));
    }
}
