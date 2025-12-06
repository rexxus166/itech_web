@extends('layouts.app')

@section('content')
<style>
    input[type="radio"]:disabled {
        -webkit-appearance: none;
        display: inline-block;
        width: 12px;
        height: 12px;
        padding: 0px;
        background-clip: content-box;
        border: 2px solid #bbbbbb;
        background-color: white;
        border-radius: 50%;
    }

    input[type="radio"]:checked {
        background-color: black;
    }
</style>

<div class="container mt-4">
    <h3>Hasil Jawaban Kuis</h3>

    <div class="card mt-3">
        <div class="card-body">
            <form>
                <div class="form-group mb-3">
                    <label>Judul</label>
                    <input type="text" class="form-control" value="{{ $quiz->title }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" value="{{ $quiz->date ? $quiz->date : '' }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label>Deskripsi Kuis</label>
                    <textarea class="form-control" rows="5" readonly>{{ $quiz->description }}</textarea>
                </div>
                {{-- Removed pembahasan textarea for whole quiz --}}
            </form>
        </div>
    </div>

    @php
        $userAnswersGrouped = $userAnswers->groupBy('question_id');
        $questions = $quiz->questions;
        $totalQuestions = $questions->count();
        $correctCount = 0;
        $incorrectCount = 0;
        foreach ($questions as $question) {
            $userAnswer = $userAnswersGrouped->get($question->id)->first() ?? null;
            if ($userAnswer) {
                $answer = $question->answers->where('id', $userAnswer->answer_id)->first();
                if ($answer && ($answer->is_correct ?? false)) {
                    $correctCount++;
                } else {
                    $incorrectCount++;
                }
            } else {
                $incorrectCount++;
            }
        }
        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : 0;
    @endphp

    <div class="card mt-4">
        <div class="card-body">
            <h4>Ringkasan Hasil</h4>
            <p>Jumlah Benar: {{ $correctCount }}</p>
            <p>Jumlah Salah: {{ $incorrectCount }}</p>
            <p>Skor: {{ $score }} / 100</p>
            {{-- waktu submit ambil dari user_answers untuk mengetahui waktu submit --}}
            @if(!empty($lastSubmissionTime))
                <p>Waktu Submit: {{ \Carbon\Carbon::parse($lastSubmissionTime)->locale('id')->isoFormat('D MMMM YYYY, HH:mm:ss') }}</p>
            @else
                <p>Waktu Submit: Tidak tersedia</p>
            @endif
        </div>
    </div>

    {{-- <div class="card mt-4">
        <div class="card-body">
            <h4>Hasil Jawaban Kuis</h4>
            <br>
            @foreach ($questions as $index => $question)
                @php
                    $answers = $question->answers;
                    $userAnswer = $userAnswersGrouped->get($question->id)->first() ?? null;
                @endphp
                <div class="mb-3">
                    <strong>{{ $index + 1 }}. {!! $question->question_text ?? $question->soal ?? '' !!}</strong>
                </div>
                <table class="table table-striped">
                    <tbody>
                        @foreach ($answers as $answer)
                        <tr>
                            <td>
                                <input type="radio" name="answer_{{ $question->id }}" value="{{ $answer->id }}"
                                    @if ($userAnswer && $userAnswer->answer_id == $answer->id) checked @endif disabled>
                                {{ $answer->answer_text ?? $answer->jawaban ?? '' }}
                            </td>
                            <td>
                                @if ($answer->is_correct ?? false)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}
                {{-- Add pembahasan display per question --}}
                {{-- @if(!empty($question->pembahasan))
                <div class="mb-4">
                    <label><strong>Pembahasan:</strong></label>
                    <div class="border p-3 bg-light">{!! ($question->pembahasan) !!}</div>
                </div>
                @endif
            @endforeach
        </div>
    </div> --}}
</div>
@endsection
