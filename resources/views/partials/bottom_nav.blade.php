<nav class="fixed bottom-0 left-0 right-0 z-50 md:hidden bg-surface-container-low border-t border-surface-container-high px-4 py-2 flex justify-around items-center shadow-lg">
    @if(auth()->user()->isGuru())
        <!-- Dashboard Guru -->
        <a href="{{ route('guru.dashboard') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('guru.dashboard') || request()->routeIs('guru.classrooms*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[22px]" style="{{ request()->routeIs('guru.dashboard') || request()->routeIs('guru.classrooms*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
            <span class="text-[9px] font-bold tracking-wider">Dashboard</span>
        </a>
        
        <!-- Profil -->
        <a href="{{ route('profil') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('profil*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[22px]" style="{{ request()->routeIs('profil*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">person</span>
            <span class="text-[9px] font-bold tracking-wider">Profil</span>
        </a>
    @else
        <!-- Home / Alur Belajar -->
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[22px]" style="{{ request()->routeIs('home') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">map</span>
            <span class="text-[9px] font-bold tracking-wider">Belajar</span>
        </a>
        
        <!-- Kelas Saya -->
        <a href="{{ route('student.classrooms.index') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('student.classrooms*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[22px]" style="{{ request()->routeIs('student.classrooms*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">school</span>
            <span class="text-[9px] font-bold tracking-wider">Kelas</span>
        </a>

        <!-- Perpustakaan -->
        <a href="{{ route('materi') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('materi*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[22px]" style="{{ request()->routeIs('materi*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">menu_book</span>
            <span class="text-[9px] font-bold tracking-wider">Perpus</span>
        </a>
        
        <!-- Papan Peringkat -->
        <a href="{{ route('peringkat') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('peringkat') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[22px]" style="{{ request()->routeIs('peringkat') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">leaderboard</span>
            <span class="text-[9px] font-bold tracking-wider">Peringkat</span>
        </a>
        
        <!-- Profil -->
        <a href="{{ route('profil') }}" class="flex flex-col items-center gap-0.5 {{ request()->routeIs('profil*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[22px]" style="{{ request()->routeIs('profil*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">person</span>
            <span class="text-[9px] font-bold tracking-wider">Profil</span>
        </a>
    @endif
</nav>

