<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <nav class="navbar shadow mb-6 py-4 px-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">
                @yield('title', 'Dashboard')
            </div>
            <div class="flex items-center gap-2">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-sm text-white">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <main class="container mx-auto my-8">
        @yield('content')
    </main>
</body>
</html>
