{{-- partials/navbar.blade.php --}}
@php
    $navLinks = [
        ['route' => 'home',      'label' => 'Beranda',   'match' => 'home'],
        ['route' => 'materi',    'label' => 'Materi',    'match' => 'materi*'],
        ['route' => '#',         'label' => 'Latihan',   'match' => 'latihan'],
        ['route' => 'peringkat', 'label' => 'Peringkat', 'match' => 'peringkat'],
        ['route' => '#',         'label' => 'Komunitas', 'match' => 'komunitas'],
    ];
@endphp
<nav class="bg-white border-b border-brand-border sticky top-0 z-50">
  <div class="max-w-5xl mx-auto px-5 h-14 flex items-center justify-between">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="font-nunito font-black text-brand-theme text-lg">
      AksaraLoka
    </a>

    {{-- Nav links --}}
    <div class="hidden md:flex items-center gap-1 text-sm">
      @foreach($navLinks as $link)
        @php
          $href = $link['route'] === '#' ? '#' : route($link['route']);
          $isActive = $link['route'] !== '#' && request()->routeIs($link['match']);
          $cls = $isActive
              ? 'px-3 py-1.5 rounded-lg bg-brand-soft text-brand-theme font-black'
              : 'px-3 py-1.5 rounded-lg text-gray-500 hover:bg-gray-50 font-bold';
        @endphp
        <a href="{{ $href }}" class="{{ $cls }}">{{ $link['label'] }}</a>
      @endforeach
    </div>

    {{-- Right: streak + notif + avatar --}}
    <div class="flex items-center gap-2">
      <div class="hidden sm:flex items-center gap-1 bg-orange-50 border border-orange-200 px-2.5 py-1 rounded-full text-xs font-bold text-orange-500">
        🔥 <span id="streakCount">12</span>
      </div>
      <button id="notifBtn" class="relative w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100">
        🔔
        <span id="notifDot" class="absolute top-1 right-1 w-1.5 h-1.5 bg-red-500 rounded-full"></span>
      </button>
      <a href="{{ route('profil') }}">
        <div id="avatarInitial" class="w-8 h-8 rounded-lg bg-brand flex items-center justify-center text-white text-xs font-black">
          {{ Auth::check() ? strtoupper(substr(Auth::user()->nama, 0, 1)) : '?' }}
        </div>
      </a>
    </div>

  </div>
</nav>
