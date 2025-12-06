@extends('admin.layout.main')

@section('title', 'Daftar Postingan Pengguna')

@section('content')
<div class="container mt-4">
    <h2>Data Postingan</h2>
    <!-- Daftar Postingan Pengguna -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.postingan.create') }}" class="btn btn-primary mb-3">Tambah Postingan</a>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Konten</th>
                                <th>Pengguna</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($postingans as $postingan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $postingan->judul }}</td>
                                    <td>{{ Str::limit($postingan->konten, 50) }}</td>
                                    <td>{{ $postingan->user ? $postingan->user->name : 'Tidak Ditemukan' }}</td>
                                    <td>{{ $postingan->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.postingan.edit', $postingan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.postingan.destroy', $postingan->id) }}" method="POST" style="display:inline;">
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
        </div>
    </div>
@endsection
