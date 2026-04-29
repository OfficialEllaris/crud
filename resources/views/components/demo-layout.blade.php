<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Page title with fallback --}}
    <title>{{ $title ?? 'Page Title' }}</title>

    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="flex flex-col items-center min-h-screen">

    {{-- Centered content wrapper --}}
    <div class="w-full md:w-80 px-4 md:px-0 py-5 space-y-4">

        {{-- Page heading --}}
        <h1 class="text-2xl font-bold cus--text-primary text-start">Your To Do</h1>

        {{-- Main slot content --}}
        <main>
            {{ $slot }}
        </main>

    </div>

</body>

</html>