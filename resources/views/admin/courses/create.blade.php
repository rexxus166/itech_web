{{-- @extends('admin.layout.main')

@section('content')
<div class="container">
    <h1>Tambah Course Baru</h1>

    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Course</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="editor" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail (opsional)</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Course</button>
    </form>
</div>

<!-- CKEditor dan Code Snippet -->
<script src="https://cdn.ckeditor.com/4.21.0/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        extraPlugins: 'codesnippet',
        codeSnippet_theme: 'monokai_sublime',
        height: 300
    });
</script>

<!-- Optional: Highlight.js styling preview -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/monokai-sublime.min.css">
@endsection --}}
