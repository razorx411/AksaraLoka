<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Materi') — AksaraLoka</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/icons/icon_aksaraloka.png') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-bg text-gray-800 min-h-screen font-sans">

{{-- Mini Navbar --}}
<nav class="bg-white border-b border-brand-border sticky top-0 z-50">
  <div class="max-w-5xl mx-auto px-5 h-14 flex justify-between items-center">
    <a href="{{ route('home') }}" class="font-nunito font-black text-brand-theme text-lg">AksaraLoka</a>
    <a href="{{ route('materi') }}" class="text-sm font-bold text-brand-theme hover:underline">← Kembali ke Materi</a>
  </div>
</nav>

@yield('content')

@include('partials.footer')

@yield('scripts')
</body>
</html>
