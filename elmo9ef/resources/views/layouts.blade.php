<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tasker.css') }}">
        <link rel="stylesheet" href="{{ asset('css/services.css') }}">
        <link rel="stylesheet" href="{{ asset('css/category.css') }}">
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/book.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profeil.css') }}">
</head>
    
<body style="background-image: url('{{ asset('images/bg-elmo9ef.png') }}'); background-size: cover; background-position: center center; background-attachment: fixed;" >
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-success" href="/">elmoo9ef</a>
    
            <!-- Bouton pour menu mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Liens du menu -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <strong><a class="nav-link text-dark" href="/services">Services</a></strong>
                    </li>
                    <li class="nav-item">
                        <strong><a class="nav-link text-dark" href="{{ route('auth') }}">Sign Up / Log in</a></strong>
                    </li>
                </ul>

                <!-- Bouton "كن موظفًا" -->
                @if(Auth::check() && Auth::user()->tasker)
                    <a href="{{ route('profeil.index', Auth::user()->tasker->id) }}" class="btn btn-custom ms-3">Profil</a>
                @else
                    <a href="{{ route('taskers.create') }}" class="btn btn-custom ms-3">Become a Tasker</a>
                @endif
            </div>
        </div>
    </nav>    
@yield('content')
@yield('search')
@yield('categories')
@yield('form')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
