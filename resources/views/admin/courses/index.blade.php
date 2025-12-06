{{-- @extends('admin.layout.main')

@section('content')
<h1>Daftar Course</h1>
<a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Tambah Course</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Thumbnail</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
        <tr>
            <td>{{ $course->judul }}</td>
            <td>{{ Str::limit($course->deskripsi, 50) }}</td>
            <td>
                @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection --}}
