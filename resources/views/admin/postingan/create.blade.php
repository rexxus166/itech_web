@extends('admin.layout.main')

@section('title', 'Tambah Postingan')

@section('content')
<div class="container mt-4">
    <h2>Tambah Postingan</h2>

    <form action="{{ route('admin.postingan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Konten</label>
            <textarea name="konten" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Pengguna</label>
            <select name="user_id" class="form-control" required>
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
