@extends('admin.layout.main')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container mt-4">
    <h2>Tambah Edukasi</h2>

    <!-- Menampilkan pesan kesalahan umum -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.artikel.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required value="{{ old('judul') }}">
            @error('judul')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Isi Edukasi</label>
            <textarea name="isi" id="isi_artikel" class="form-control" rows="6" required>{{ old('isi') }}</textarea>
            @error('isi')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" required value="{{ old('author') }}">
            @error('author')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection

{{-- Letakkan script CKEditor di section terpisah --}}
@section('scripts')
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('isi_artikel');
</script>
@endsection
