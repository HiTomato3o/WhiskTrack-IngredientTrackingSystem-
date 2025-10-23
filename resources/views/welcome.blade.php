<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>Welcome to WhiskTrack</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded shadow text-center">
            <h1 class="text-2xl font-bold mb-4">Welcome to WhiskTrack</h1>
            <div class="space-x-2">
                @if (Route::has('/auth/login') && !Auth::check())
                    <a href="{{ route('/login') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Login</a>
                @endif
                @if (Route::has('/auth/register') && !Auth::check())
                    <a href="{{ route('/register') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Register</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>