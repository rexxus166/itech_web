@extends('admin.layout.main')

@section('title', 'Edit Artikel')

@section('content')
<div class="container mt-4">
    <h2>Edit Edukasi</h2>

    <form action="{{ route('admin.artikel.update', $artikel) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $artikel->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Isi Artikel</label>
            <textarea name="isi" class="form-control" rows="6" id="ckeditor" required>{{ $artikel->isi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ $artikel->author }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('isi_artikel');
</script>
@endsection
