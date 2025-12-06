<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | itech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        .btn-google {
            background-color: #db4437;
            color: white;
            font-weight: bold;
        }
        .social-login-btn {
            width: 100%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3 class="text-center mb-4">Login</h3>

    <!-- Form Login -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('login.post') }}" enctype="application/x-www-form-urlencoded" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <!-- Tautan untuk registrasi -->
    <div class="mt-3 text-center">
        <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
    </div>

    <!-- Login with Google -->
    <div class="mt-3">
        <p class="text-center">OR</p>
        <a href="{{ route('auth.google') }}" class="btn btn-google social-login-btn">
            <i class="fab fa-google"></i> Log in with Google
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
