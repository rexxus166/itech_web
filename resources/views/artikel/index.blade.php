@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold mb-4 pb-3 border-bottom border-primary">Edukasi Terbaru</h2>

    <div class="row">
        @foreach ($artikels as $artikel)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title fw-bold text-primary mb-3">{{ $artikel->judul }}</h4>
                        <p class="card-text flex-grow-1 text-secondary mb-4">{{ Str::limit(strip_tags($artikel->isi), 150) }}</p>
                        @if(!empty($artikel->slug))
                            <a href="{{ route('artikel.show', $artikel->slug) }}" class="btn btn-primary fw-medium">Baca Selengkapnya</a>
                        @else
                            <button class="btn btn-secondary fw-medium" disabled>Artikel Tidak Tersedia</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $artikels->links() }}
    </div>
</div>
@endsection
