<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrameworkController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/quiz/{id}/answer', [UserController::class, 'showQuiz'])->name('quiz.answer');
    Route::post('/quiz/{id}/answer', [UserController::class, 'submitQuiz'])->name('quiz.submit');
    Route::get('/quiz/{id}/result', [UserController::class, 'showResult'])->name('quiz.result');
    Route::get('/quizzes', [UserController::class, 'listQuizzes'])->name('user.quiz.list');
});

Route::post('/logintest', [AuthController::class, 'loginTest'])->name('tesLogin');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/loginuser', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registeruser', [AuthController::class, 'registerUser'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/quiz/{quizId}/questions/{questionId}/edit-json', [QuestionController::class, 'editJson'])->name('admin.quiz.questions.edit-json');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);

// Artikel
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');

// Course / Programming Edukasi
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.show');

// Feedback
Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Postingan User
Route::get('/postingan', [PostController::class, 'index'])->name('postingan.index');
Route::get('/postingan/create', [PostController::class, 'create'])->name('postingan.create');
Route::post('/postingan', [PostController::class, 'store'])->name('postingan.store');

// Profil User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');

Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// ==================== ADMIN ROUTES - FIXED ====================
Route::prefix('admin')->name('admin.')->group(function() {
    // Auth Routes
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function() {
        // Dashboard
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Artikel
        Route::resource('artikel', App\Http\Controllers\Admin\ArtikelController::class);

        // Gambar Edukasi
        Route::resource('gambar', App\Http\Controllers\Admin\GambarController::class);

        // Programming Edukasi (Courses)
        Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);

        // FEEDBACK - INI YANG DIPERBAIKI
        Route::get('feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
        Route::delete('feedback/{id}', [App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('feedback.destroy');

        // Postingan User
        Route::resource('postingan', App\Http\Controllers\Admin\PostinganController::class);

        // Quiz
        Route::resource('quiz', App\Http\Controllers\Admin\QuizController::class);
        Route::get('quiz/{quiz}/respondents', [App\Http\Controllers\Admin\QuizController::class, 'showRespondents'])->name('quiz.respondents');
        Route::get('quiz/{quiz}/answers/{user}', [App\Http\Controllers\Admin\QuizController::class, 'showUserAnswers'])->name('quiz.answers.show');
        Route::delete('quiz/{quiz}/answers/{user}', [App\Http\Controllers\Admin\QuizController::class, 'destroyUserAnswers'])->name('quiz.answers.destroy');

        // Questions nested under quiz
        Route::resource('quiz.questions', App\Http\Controllers\Admin\QuestionController::class);

        // Answers nested under questions
        Route::resource('quiz.questions.answers', App\Http\Controllers\Admin\AnswerController::class);

        // User Management
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });
});
