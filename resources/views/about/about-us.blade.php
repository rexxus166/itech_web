@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">About Us</h1>

        <!-- Bagian Deskripsi -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Who We Are</h3>
                <p>
                    Kami adalah platform pembelajaran programming yang berfokus pada membantu siapa saja menjadi developer handal.
                    Dengan materi berkualitas dan komunitas yang supportif, kami hadir untuk menyediakan berbagai kursus dengan pengajaran yang mudah dipahami oleh semua orang.
                </p>
            </div>
            <div class="col-md-6">
                <h3>Our Mission</h3>
                <p>
                    Misi kami adalah untuk menyediakan akses pendidikan programming yang mudah diakses oleh siapa saja. Kami percaya bahwa dengan belajar programming, kamu dapat membuka banyak peluang baru dan menciptakan solusi inovatif.
                </p>
            </div>
        </div>

        <!-- Menampilkan Gambar Tim dengan Nama, Jabatan, dan Deskripsi -->
        <div class="row mt-5">
            <!-- Anggota Tim 1 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('images/Iqbal(2).jpg') }}" alt="Team Member 1" class="img-fluid rounded-circle mb-3" width="150">
                <h4>Iqbal Prasetya</h4>
                <p>Lead Developer</p>
                <p>Iqba has a years of experience in full-stack development, focusing on building scalable web applications.</p>
            </div>

            <!-- Anggota Tim 2 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('images/member2.jpg') }}" alt="Team Member 2" class="img-fluid rounded-circle mb-3" width="150">
                <h4>Erwin Indra Permana</h4>
                <p>UI/UX Designer</p>
                <p>Erwin is passionate about creating intuitive user experiences. He ensures that our platform is user-friendly and aesthetically pleasing.</p>
            </div>

            <!-- Anggota Tim 3 -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('images/Yusuf.png') }}" alt="Team Member 3" class="img-fluid rounded-circle mb-3" width="150">
                <h4>Ahmad Yusuf</h4>
                <p>Backend Developer</p>
                <p>Ahmad specializes in server-side development. He handles databases, APIs, and ensures our platform is robust and secure.</p>
            </div>
        </div>

        <!-- Tim Kami -->
        <div class="row mt-5">
            <div class="col-md-4">
                <h3>Our Team</h3>
                <p>Tim kami terdiri dari para profesional di bidang IT yang memiliki passion dalam mengajar dan berbagi pengetahuan.</p>
            </div>
            <div class="col-md-4">
                <h3>Join Us</h3>
                <p>Kami selalu mencari individu yang bersemangat untuk bergabung dan membantu kami dalam misi besar ini. Jika kamu ingin berkolaborasi, hubungi kami!</p>
            </div>
            <div class="col-md-4">
                <h3>Contact Us</h3>
                <p>Jika kamu memiliki pertanyaan atau ingin berbicara dengan kami, jangan ragu untuk menghubungi tim kami melalui email atau sosial media.</p>
            </div>
        </div>
    </div>
@endsection
