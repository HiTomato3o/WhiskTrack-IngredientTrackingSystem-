<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'WhiskTrack') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('layouts.navigation')
        <div class="flex-1">
            <header class="bg-white shadow px-6 py-4">
                {{ $header ?? '' }}
            </header>
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>