<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AksaraLoka') — AksaraLoka</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Noto+Sans+Javanese:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-surface text-on-surface font-sans selection:bg-primary-fixed">

    @auth
        @include('partials.sidebar')
        <main class="ml-64 min-h-screen">
            @include('partials.top_app_bar')
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    @else
        @yield('content')
    @endauth

    @stack('scripts')
</body>
</html>
