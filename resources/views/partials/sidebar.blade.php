<nav class="hidden md:flex flex-col h-screen py-6 px-4 gap-4 w-64 fixed left-0 top-0 bg-surface-container-low border-r border-surface-container-high z-50">
    {{-- Brand Logo --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3 px-2 mb-6 group">
        <img src="{{ asset('assets/icons/logo_aksaraloka.png') }}"
             alt="AksaraLoka Logo"
             class="w-12 h-12 object-contain drop-shadow-sm transition-transform duration-200 group-hover:scale-105">
        <div class="flex flex-col">
            <span class="font-headline text-[22px] font-extrabold text-primary leading-none tracking-tight">Aksaraloka</span>
            <span class="text-[10px] font-semibold text-on-surface-variant tracking-widest uppercase mt-0.5">Nguri-uri Budaya</span>
        </div>
    </a>
    <div class="h-px bg-outline-variant/40 mx-2 mb-4"></div>
    <div class="flex flex-col gap-1 flex-grow">
        @if(auth()->user()->isGuru())
            <!-- Nav Item: Dashboard Guru -->
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('guru.dashboard') || request()->routeIs('guru.classrooms*') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('guru.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-semibold">Dashboard Guru</span>
            </a>
            <!-- Nav Item: Profil -->
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('profil*') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('profil') }}">
                <span class="material-symbols-outlined">person</span>
                <span class="text-sm font-semibold">Profil</span>
            </a>
        @else
            <!-- Nav Item: Alur Belajar -->
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('home') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('home') }}">
                <span class="material-symbols-outlined">map</span>
                <span class="text-sm font-semibold">Alur Belajar</span>
            </a>
            <!-- Nav Item: Kelas Saya -->
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('student.classrooms*') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('student.classrooms.index') }}">
                <span class="material-symbols-outlined">school</span>
                <span class="text-sm font-semibold">Kelas Saya</span>
            </a>
            <!-- Nav Item: Perpustakaan -->
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('materi*') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('materi') }}">
                <span class="material-symbols-outlined">menu_book</span>
                <span class="text-sm font-semibold">Perpustakaan</span>
            </a>
            <!-- Nav Item: Papan Peringkat -->
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('peringkat') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('peringkat') }}">
                <span class="material-symbols-outlined">leaderboard</span>
                <span class="text-sm font-semibold">Papan Peringkat</span>
            </a>
            <!-- Nav Item: Profil -->
            <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('profil*') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('profil') }}">
                <span class="material-symbols-outlined">person</span>
                <span class="text-sm font-semibold">Profil</span>
            </a>
        @endif
    </div>
    
    <div class="mt-auto flex flex-col gap-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-3 text-sm font-semibold text-error hover:bg-error/5 rounded-xl flex items-center gap-4 transition-all">
                <span class="material-symbols-outlined">logout</span>
                Keluar
            </button>
        </form>
    </div>
</nav>

