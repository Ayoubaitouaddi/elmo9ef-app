@extends('layouts')
@section('title', "Set Password")
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
        }
        .card {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .btn-disabled {
            background-color: #d3d3d3;
            border: none;
            color: #888;
        }
        .btn-primary {
            background-color: #007f5f;
            border: none;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #005f47;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4">
            <h2 class="text-center mb-4" style="color: #004d40; font-weight: bold;">elmoo9ef</h2>
            <h4 class="mb-3">Set Password</h4>
            <p class="text-muted">Enter your email and we'll send you instructions to set your password</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>

                <button type="submit" id="submitBtn" class="btn btn-disabled" disabled>Set password</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("email").addEventListener("input", function() {
            let email = this.value.trim();
            let submitBtn = document.getElementById("submitBtn");
            if (email.length > 0) {
                submitBtn.classList.remove("btn-disabled");
                submitBtn.classList.add("btn-primary");
                submitBtn.removeAttribute("disabled");
            } else {
                submitBtn.classList.add("btn-disabled");
                submitBtn.classList.remove("btn-primary");
                submitBtn.setAttribute("disabled", "true");
            }
        });
    </script>
</body>
</html>
@endsection
