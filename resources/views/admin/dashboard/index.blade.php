@extends('admin.layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h2>Selamat Datang di Dashboard Admin</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>📖 Edukasi</h5>
                <p>{{ $artikelCount }} Edukasi</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>🖼️ Gambar Edukasi</h5>
                <p>{{ $gambarCount }} Gambar</p>
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>📚 Course</h5>
                <p>{{ $courseCount }} Course</p>
            </div>
        </div> --}}
        <div class="col-md-4 mt-3">
            <div class="card p-3 shadow-sm">
                <h5>📩 Feedback</h5>
                <p>{{ $feedbackCount }} Feedback</p>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card p-3 shadow-sm">
                <h5>📰 Postingan User</h5>
                <p>{{ $postinganCount }} Postingan</p>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card p-3 shadow-sm">
                <h5>👥 Pengguna</h5>
                <p>{{ $userCount }} User</p>
            </div>
        </div>
    </div>
</div>
@endsection
