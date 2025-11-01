@extends('layouts')
@section('content')
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1>Create your account</h1>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
            <div class="mb-3">
                <input type="tel" class="form-control" name="phone" placeholder="Phone Number">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="code_postal" placeholder="Code Postal">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Create account</button>
        </form>
        <div class="auth-footer">
            <p class="text-center mt-3 text-muted">
                By clicking below and creating an account, I agree to Elmoo9ef’s <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
            </p>
        </div>
    </div>
</body>
</html>
@endsection