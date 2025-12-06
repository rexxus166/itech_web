<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\UserAnswer;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QuizAttempt; // <--- PENTING: Import model riwayat/attempt
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ==========================================
    // BAGIAN WEB (Browser)
    // ==========================================

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

        // NOTE: Untuk Web, kamu belum menyimpan ke QuizAttempt di sini.
        // Jika nanti API History kosong, berarti kamu harus menambahkan logic
        // QuizAttempt::create([...]) di sini juga.

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


    // ==========================================
    // BAGIAN API (Mobile Flutter)
    // ==========================================

    public function apiListQuizzes()
    {
        // Mengambil semua data kuis dari terbaru
        $quizzes = Quiz::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Kuis Tersedia',
            'data'    => $quizzes
        ], 200);
    }

    public function apiQuizHistory(Request $request)
    {
        // Mengambil riwayat skor user
        // Pastikan tabel/model QuizAttempt sudah ada datanya
        $history = QuizAttempt::where('user_id', $request->user()->id)
            ->with('quiz') // Load data kuis terkait
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat Kuis User',
            'data'    => $history
        ], 200);
    }

    // ==========================================
    // API START & SUBMIT QUIZ
    // ==========================================

    // 3. MULAI KUIS (Ambil Soal)
    // Sesuai error: api/quizzes/{id}/start
    public function apiStartQuiz($id)
    {
        // Ambil quiz beserta pertanyaan dan jawabannya
        // Pastikan relasi 'questions' dan 'answers' ada di Model Quiz
        $quiz = Quiz::with(['questions.answers'])->find($id);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Kuis tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Mulai Mengerjakan Kuis',
            'data'    => $quiz
        ], 200);
    }

    // 4. SUBMIT JAWABAN
    // Sesuai rute: api/quizzes/{id}/submit
    public function apiSubmitQuiz(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'answers' => 'required|array', // Format: [question_id => answer_id]
        ]);

        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        $userId = $request->user()->id;

        $score = 0;
        $correctCount = 0;
        $incorrectCount = 0;
        $totalQuestions = $quiz->questions->count();

        // Loop pertanyaan kuis
        foreach ($quiz->questions as $question) {
            // Cek apakah user menjawab pertanyaan ini
            if (isset($request->answers[$question->id])) {
                $answerId = $request->answers[$question->id];
                $answer = Answer::find($answerId);

                // Cek jawaban benar
                if ($answer && $answer->is_correct) {
                    $score++;
                    $correctCount++;
                } else {
                    $incorrectCount++;
                }

                // Simpan detail jawaban per soal (UserAnswer)
                UserAnswer::create([
                    'user_id' => $userId,
                    'question_id' => $question->id,
                    'answer_id' => $answerId,
                ]);
            } else {
                // Jika tidak dijawab, dianggap salah
                $incorrectCount++;
            }
        }

        // Hitung nilai persentase (0-100)
        $percentage = $totalQuestions > 0 ? ($score / $totalQuestions) * 100 : 0;

        // Simpan ke Tabel quiz_attempts
        // SESUAI STRUKTUR TABEL KAMU: 
        // id, user_id, quiz_id, score, correct_answers_count, incorrect_answers_count
        QuizAttempt::create([
            'user_id' => $userId,
            'quiz_id' => $id,
            'score'   => $percentage,
            'correct_answers_count'   => $correctCount,
            'incorrect_answers_count' => $incorrectCount,
            'completed_at' => now(), // Tambahan timestamp selesai
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kuis Selesai',
            'data'    => [
                'score' => $percentage,
                'correct' => $correctCount,
                'incorrect' => $incorrectCount,
                'total' => $totalQuestions
            ]
        ], 200);
    }
}
