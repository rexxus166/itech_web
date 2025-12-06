@extends('admin.layout.main')

@section('title', 'Edit Postingan')

@section('content')
<div class="container mt-4">
    <h2>Edit Postingan</h2>

    <form action="{{ route('admin.postingan.update', $postingan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $postingan->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Konten</label>
            <textarea name="konten" class="form-control" required>{{ $postingan->konten }}</textarea>
        </div>
        <div class="mb-3">
            <label>Pengguna</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $postingan->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
