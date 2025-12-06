<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Api\GeminiChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ==========================================
// 1. ROUTE PUBLIC (Bisa diakses tanpa token)
// ==========================================

// Auth
Route::post('/login', [AuthController::class, 'loginApi']);
Route::post('/register', [AuthController::class, 'registerApi']);

// Artikel (Mobile App)
Route::get('/artikel', [ArtikelController::class, 'apiIndex']);
Route::get('/artikel/{slug}', [ArtikelController::class, 'apiShow']);


// ==========================================
// 2. ROUTE PRIVATE (Harus Login / Punya Token)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // === USER & PROFILE ===

    // [FIX AUTO LOGIN]
    // Kita bungkus data user supaya Flutter membacanya sebagai "Success"
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'Data User Berhasil Diambil',
            'data'    => $request->user()
        ]);
    });

    // Profil User
    Route::get('/profile', [ProfileController::class, 'apiIndex']);


    // === QUIZ SYSTEM ===

    // List Semua Kuis
    Route::get('/quizzes', [UserController::class, 'apiListQuizzes']);

    // [FIX START QUIZ] 
    // Mengambil detail soal untuk memulai kuis
    Route::get('/quizzes/{id}/start', [UserController::class, 'apiStartQuiz']);

    // Submit Jawaban Kuis
    Route::post('/quizzes/{id}/submit', [UserController::class, 'apiSubmitQuiz']);

    // Riwayat Kuis User
    Route::get('/quiz-history', [UserController::class, 'apiQuizHistory']);


    // === FITUR LAIN ===

    // Chat AI (Gemini)
    Route::post('/chat', [GeminiChatController::class, 'chat']);
});
