@extends('layouts.app')

@section('content')
<h2>{{ $course->judul }}</h2>
<p>{!! nl2br(e($course->deskripsi)) !!}</p>

<!-- Jika deskripsi mengandung tag <pre><code> -->
<div class="mt-4">
    <pre><code class="language-html">
{!! htmlentities($course->kode) !!}
    </code></pre>
</div>

@endsection
