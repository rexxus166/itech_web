{{-- @extends('admin.layout.main')

@section('content')
<div class="container">
    <h1>Edit Course</h1>

    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Course</label>
            <input type="text" name="judul" id="judul" value="{{ $course->judul }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="editor" class="form-control" rows="5" required>{{ $course->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail (opsional)</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
            @if($course->thumbnail)
                <p class="mt-2">Thumbnail saat ini:</p>
                <img src="{{ asset('storage/' . $course->thumbnail) }}" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>

<!-- CKEditor dan Code Snippet -->
<script src="https://cdn.ckeditor.com/4.21.0/standard-all/ckeditor.js"></script>
@section('scripts')
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('isi_artikel');
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/monokai-sublime.min.css">
@endsection --}}
