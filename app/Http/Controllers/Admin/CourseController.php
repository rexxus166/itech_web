<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('thumbnail')?->store('thumbnails', 'public');

        Course::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $path,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            Storage::disk('public')->delete($course->thumbnail);
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $course->thumbnail = $path;
        }

        $course->judul = $request->judul;
        $course->deskripsi = $request->deskripsi;
        $course->save();

        return redirect()->route('admin.courses.index')->with('success', 'Course berhasil diupdate.');
    }

    public function destroy(Course $course)
{
    if ($course->thumbnail) {
        Storage::disk('public')->delete($course->thumbnail);
    }

    $course->delete();

    return back()->with('success', 'Course berhasil dihapus.');
}

}
