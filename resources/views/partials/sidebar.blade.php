<nav class="flex flex-col h-screen py-6 px-4 gap-4 w-64 fixed left-0 top-0 bg-surface-container-low border-r border-surface-container-high z-50">
    <div class="flex items-center gap-2 px-2 mb-8">
        <span class="material-symbols-outlined text-primary text-[32px]">menu_book</span>
        <div>
            <h1 class="font-headline text-2xl font-bold text-primary leading-none">Aksaraloka</h1>
            <p class="text-[10px] font-medium text-on-surface-variant">Nguri-uri Budaya</p>
        </div>
    </div>
    <div class="flex flex-col gap-1 flex-grow">
        <!-- Nav Item: Alur Belajar -->
        <a class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:text-primary hover:bg-surface-container-high transition-all duration-200 group {{ request()->routeIs('home') ? 'bg-primary-container/10 text-primary font-bold border-r-4 border-primary translate-x-1' : '' }}" href="{{ route('home') }}">
            <span class="material-symbols-outlined">map</span>
            <span class="text-sm font-semibold">Alur Belajar</span>
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
    </div>
    
    <div class="mt-auto flex flex-col gap-2">
        <button class="w-full bg-primary text-on-primary py-3 rounded-xl font-bold border-b-[3px] border-primary-container active:translate-y-[1px] active:border-b-0 transition-all text-sm">
            Misi Harian
        </button>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-3 text-sm font-semibold text-error hover:bg-error/5 rounded-xl flex items-center gap-4 transition-all">
                <span class="material-symbols-outlined">logout</span>
                Keluar
            </button>
        </form>
    </div>
</nav>
