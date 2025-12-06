@extends('admin.layout.main')

@section('title', 'Edit Kuis')

@section('content')
<div class="container mt-4">
    <h2>Edit Kuis</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Kuis</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $quiz->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $quiz->date ) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $quiz->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="pembahasan" class="form-label">Pembahasan</label>
            <textarea class="form-control" id="pembahasan" name="pembahasan" rows="3">{{ old('pembahasan', $quiz->pembahasan) }}</textarea>
        </div>

        <hr>

        <h3>Daftar Soal</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($quiz->questions->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quiz->questions as $index => $question)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $index + 1 }}">Edit</button>
                                <!-- Optionally add delete button here -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada soal untuk kuis ini.</p>
        @endif
