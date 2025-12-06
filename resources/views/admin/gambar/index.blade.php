@extends('admin.layout.main')

@section('content')
<h1>Daftar Gambar Edukasi</h1>
<a href="{{ route('admin.gambar.create') }}" class="btn btn-primary">Tambah Gambar</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gambars as $gambar)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $gambar->judul }}</td>
            <td><img src="{{ asset('storage/'.$gambar->gambar) }}" width="100"></td>
            <td>
                <form action="{{ route('admin.gambar.destroy', $gambar->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
