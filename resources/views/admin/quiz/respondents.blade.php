@extends('admin.layout.main')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Kuis</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Kuis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Data Penjawab</h6>
            <h1 class="mb-5">Data Penjawab</h1>
        </div>
        <div class="row g-4">

            <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="mb-2">Judul</label>
                                        <input type="text" name="judul" placeholder="Judul Kuis" value="{{ $quiz->title }}" readonly class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row g-4">
            <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tabel">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nilai (%)</th>
                                        <th>Benar</th>
                                        <th>Salah</th>
                                        <th>Waktu Submit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $nomor = 1; @endphp
                                    @foreach ($respondents as $respondent)
                                        <tr>
                                            <td>{{ $nomor }}</td>
                                            <td>{{ $respondent->name }}</td>
                                            <td>{{ $respondent->email }}</td>
                                            <td>{{ $respondent->score }}</td>
                                            <td>{{ $respondent->correct_answers }}</td>
                                            <td>{{ $respondent->wrong_answers }}</td>
                                            <td>{{ \Carbon\Carbon::parse($respondent->last_submit)->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.quiz.answers.show', ['quiz' => $quiz->id, 'user' => $respondent->user_id]) }}" class="btn btn-success btn-sm m-1">Jawaban</a>
                                                <form action="{{ route('admin.quiz.answers.destroy', ['quiz' => $quiz->id, 'user' => $respondent->user_id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm m-1">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php $nomor++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
@endsection
