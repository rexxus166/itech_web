@extends('admin.layout.main')

@section('title', 'Kelola Artikel')

@section('content')
<div class="container mt-4">
    <h2>Kelola Edukasi</h2>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary mb-3">+ Tambah Edukasi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Author</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artikels as $artikel)
            <tr>
                <td>{{ $artikel->judul }}</td>
                <td>{{ $artikel->author }}</td>
                <td>
                    <a href="{{ route('admin.artikel.edit', $artikel) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.artikel.destroy', $artikel) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
