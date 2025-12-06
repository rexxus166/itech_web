@extends('admin.layout.main')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Jawaban Pengguna</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="{{ route('admin.quiz.respondents', $quiz->id) }}">Kuis</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Jawaban Pengguna</li>
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
            <h6 class="section-title bg-white text-center text-primary px-3">Jawaban</h6>
            <h1 class="mb-5">Jawaban Pengguna pada Kuis: {{ $quiz->title }}</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="userAnswersTable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Benar/Salah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($userAnswers as $answer)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $answer->question_text }}</td>
                                            <td>{{ $answer->answer_text }}</td>
                                            <td>
                                                @if($answer->is_correct)
                                                    <span class="badge bg-success">Benar</span>
                                                @else
                                                    <span class="badge bg-danger">Salah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @php $no++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.quiz.respondents', $quiz->id) }}" class="btn btn-secondary mt-3">Kembali ke Data Penjawab</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
