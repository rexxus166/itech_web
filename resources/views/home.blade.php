@extends('layouts.app')

@section('content')

<style>
    .hero-container {
        position: relative;
        height: 50vh;
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset('images/bag.jpg') }}');
        background-size: cover;
        background-position: center;
        filter: brightness(50%); /* Only affects the background */
        z-index: 1;
    }

    .hero-content {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        z-index: 2; /* Above the background */
    }

    /* Stroke Text Styles */
    .stroke-title {
        color: white;
        text-shadow:
            -2px -2px 0 #000,
             2px -2px 0 #000,
            -2px  2px 0 #000,
             2px  2px 0 #000;
        font-size: 3rem;
        font-weight: bold;
    }

    .stroke-highlight {
        color: #00f2ff;
        text-shadow:
            -2px -2px 0 #000,
             2px -2px 0 #000,
            -2px  2px 0 #000,
             2px  2px 0 #000;
    }

    .stroke-subtitle {
        color: #ff6b6b;
        text-shadow:
            -1px -1px 0 #000,
             1px -1px 0 #000,
            -1px  1px 0 #000,
             1px  1px 0 #000;
        font-weight: bold;
        font-size: 1.2rem;
        margin-top: 1rem;
    }

    /* Dark Blue Background for Hero Section */
    .dark-blue-bg {
        background-color: #001a33 !important; /* Same dark blue as navbar */
    }
</style>

<!-- Hero Section with Dark Blue Background -->
<div class="dark-blue-bg text-white py-5">
    <div class="hero-container">
        <!-- Background with filter -->
        <div class="hero-background"></div>

        <!-- Content without filter -->
        <div class="hero-content">
            <h1 class="stroke-title">LEARN PROGRAMMING <span class="stroke-highlight">IS EASY</span></h1>
            <p class="stroke-subtitle">Dengan mempelajari programming kamu dapat menciptakan banyak hal yang luar biasa</p>
        </div>
    </div>
</div>

<!-- Rest of your content -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-laptop-code fa-3x text-primary mb-3"></i>
                        <h4>Belajar Sesuai Level</h4>
                        <p>Materi disusun dari pemula hingga mahir, sesuai dengan kemampuan Anda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-project-diagram fa-3x text-primary mb-3"></i>
                        <h4>Project-Based Learning</h4>
                        <p>Belajar langsung dengan membuat proyek nyata untuk portofolio Anda</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h4>Komunitas Supportif</h4>
                        <p>Bergabung dengan komunitas untuk diskusi dan berbagi pengalaman</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
