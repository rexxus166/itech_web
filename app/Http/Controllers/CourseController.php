<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Menampilkan daftar semua course
    public function index()
    {
        $courses = Course::latest()->get();
        return view('course.index', compact('courses'));
    }

    // Menampilkan detail dari satu course berdasarkan id
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('course.show', compact('course'));
    }
}
