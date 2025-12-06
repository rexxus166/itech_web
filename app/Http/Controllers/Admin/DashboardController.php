<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\PostinganUser;
use App\Models\User;
use App\Models\Gambar;

class DashboardController extends Controller
{
    public function index()
    {
        $artikelCount = Artikel::count();
        $courseCount = Course::count();
        $gambarCount = Gambar::count();
        $feedbackCount = Feedback::count();
        $userCount = User::count();
        $postinganCount = PostinganUser::count();

        return view('admin.dashboard.index', compact(
            'artikelCount', 'courseCount', 'gambarCount', 'feedbackCount', 'userCount', 'postinganCount'
        ));
    }
}
