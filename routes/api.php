<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Api\GeminiChatController;
// Tambahkan Import Controller ini
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

// === ROUTE PUBLIC (Tanpa Login) ===
Route::post('/login', [AuthController::class, 'loginApi']);
Route::post('/register', [AuthController::class, 'registerApi']);

// Route Artikel (Mobile App)
Route::get('/artikel', [ArtikelController::class, 'apiIndex']);
Route::get('/artikel/{slug}', [ArtikelController::class, 'apiShow']);


// === ROUTE PRIVATE (Harus Login / Punya Token) ===
Route::middleware('auth:sanctum')->group(function () {

    // 1. User & Profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Ini memperbaiki error: api/profile
    Route::get('/profile', [ProfileController::class, 'apiIndex']);

    // 2. Chat AI
    Route::post('/chat', [GeminiChatController::class, 'chat']);

    // 3. Quiz (Mobile App)
    // Ini memperbaiki error: api/quizzes
    Route::get('/quizzes', [UserController::class, 'apiListQuizzes']);

    // Ini memperbaiki error: api/quiz-history
    Route::get('/quiz-history', [UserController::class, 'apiQuizHistory']);
});
