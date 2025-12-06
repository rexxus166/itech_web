@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Jawab Kuis</h3>

    <div class="card mb-4">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" class="form-control" value="{{ $quiz->title }}" readonly>
                </div>
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" value="{{ $quiz->date ? $quiz->date : '' }}" readonly>
                </div>
                <div class="mb-3">
                    <label>Deskripsi Kuis</label>
                    <textarea class="form-control" rows="5" readonly>{{ $quiz->description }}</textarea>
                </div>
            </form>
        </div>
    </div>

    <form method="POST" action="{{ route('quiz.submit', $quiz->id) }}">
        @csrf
        @foreach ($quiz->questions as $index => $question)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>{{ $index + 1 }}. {!! $question->question_text !!}</strong></p>
                    @foreach ($question->answers as $answer)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer_{{ $answer->id }}" value="{{ $answer->id }}" required>
                            <label class="form-check-label" for="answer_{{ $answer->id }}">
                                {{ $answer->option }}. {{ $answer->answer_text }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengsubmit jawaban? Jawaban yang telah di submit tidak dapat dirubah kembali')">Simpan</button>
    </form>
</div>
@endsection
