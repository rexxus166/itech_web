@extends('admin.layout.main')

@section('title', 'Daftar Kuis')

@section('content')
<div class="container mt-4">
    <h2>Data Kuis</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.quiz.create') }}" class="btn btn-primary mb-3">Tambah Kuis</a>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $quiz)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ Str::limit($quiz->description, 50) }}</td>
                        <td>{{ $quiz->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.quiz.edit', $quiz->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('admin.quiz.respondents', $quiz->id) }}" class="btn btn-info btn-sm">Lihat Penjawab</a>
                                <form action="{{ route('admin.quiz.destroy', $quiz->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
