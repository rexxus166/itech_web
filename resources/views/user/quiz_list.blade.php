@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Kuis</h3>
    <div class="list-group">
        @forelse ($quizzes as $quiz)
            <a href="{{ route('quiz.answer', $quiz->id) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $quiz->title }}</h5>
                    <small>{{ $quiz->date ? $quiz->date : '' }}</small>
                </div>
                <p class="mb-1">{{ Str::limit($quiz->description, 100) }}</p>
            </a>
        @empty
            <p>Tidak ada kuis tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
