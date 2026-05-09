<header class="flex justify-between items-center w-full px-8 py-4 sticky top-0 z-40 bg-surface/80 backdrop-blur-md border-b border-surface-container-high">
    <div class="flex flex-col">
        <h2 class="font-headline text-2xl font-bold text-primary">@yield('title', 'Dashboard')</h2>
        <p class="text-[10px] font-medium text-on-surface-variant">@yield('subtitle', 'Selamat datang di Aksaraloka')</p>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden sm:flex items-center gap-2 bg-secondary-container/50 px-3 py-1.5 rounded-full text-xs font-bold text-secondary border border-secondary/20">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
            <span>{{ Auth::user()->streak ?? 0 }} Hari</span>
        </div>
        <button id="notifBtn" class="p-2 rounded-full hover:bg-surface-container transition-colors text-primary relative">
            <span class="material-symbols-outlined">notifications</span>
            <span id="notifDot" class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
        </button>
        <a href="{{ route('profil') }}" class="flex items-center gap-2 hover:bg-surface-container p-1 rounded-full transition-all">
            <div id="avatarInitial" class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary text-xs font-bold">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>
        </a>
    </div>
</header>
