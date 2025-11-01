@extends('layouts')
@section('title', "Connexion")
@section('content')
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4">
            <h2 class="text-center mb-4" style="color: #004d40; font-weight: bold;">elmoo9ef</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4"> <!-- Increased margin-bottom -->
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="mb-4"> <!-- Increased margin-bottom -->
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Log in</button> <!-- Added padding to button -->
            </form>

            <div class="text-center mt-4"> <!-- Increased margin-top -->
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>

            <div class="text-center mt-3"> <!-- Increased margin-top -->
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection