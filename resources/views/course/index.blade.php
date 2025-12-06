@extends('layouts.app')

@section('content')
    <h1>Daftar Course</h1>
    <ul>
        @foreach ($courses as $course)
            <li>
                <a href="{{ route('course.show', $course->id) }}">{{ $course->judul }}</a>
            </li>
        @endforeach
    </ul>
@endsection
