@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>{{ $artikel->judul }}</h2>
    <hr>
    @if($artikel->gambar)
        <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid mb-4" alt="{{ $artikel->judul }}">
    @endif
    <div>
        {!! $artikel->isi !!}
    </div>
</div>
@endsection
