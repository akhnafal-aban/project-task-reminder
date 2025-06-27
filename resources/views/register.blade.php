<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
</head>
<body class="min-h-screen d-flex justify-content-center align-items-center bg-dark" style="min-height: 100vh;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row w-100 justify-content-center">
            <div class="col-md-4">
                <div class="card bg-dark text-light border-0 shadow-lg">
                    <div class="card-header bg-dark text-light border-0">Register</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ url('/register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label text-light">Name</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-light">Email</label>
                                <input type="email" class="form-control bg-dark text-light border-secondary" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-light">Password</label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-light">Confirm Password</label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
