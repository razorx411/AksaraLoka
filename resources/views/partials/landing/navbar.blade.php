<header class="fixed top-0 left-0 right-0 z-50 glass-header bg-surface/80 backdrop-blur-md border-b border-outline-variant/30">
    <nav class="max-w-[1140px] mx-auto px-5 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-2 group">
            <img src="{{ asset('assets/icons/logo_aksaraloka.png') }}" alt="Logo" class="w-9 h-9 object-contain transition-transform duration-200 group-hover:scale-105">
            <span class="font-headline text-xl font-extrabold text-primary tracking-tight">Aksaraloka</span>
        </a>

        {{-- Desktop Nav Links --}}
        <div class="hidden md:flex items-center gap-8">
            <a class="text-sm font-semibold {{ request()->routeIs('tentang-kami') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('tentang-kami') }}">Tentang Kami</a>
            <a class="text-sm font-semibold {{ request()->routeIs('fitur') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('fitur') }}">Fitur</a>
        </div>

        {{-- Desktop CTA --}}
        <div class="hidden md:flex items-center gap-3">
            @auth
                <a href="{{ route('home') }}" class="px-5 py-2 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-primary hover:bg-primary/10 transition-all rounded-xl">Masuk</a>
                <a href="{{ route('register') }}" class="px-5 py-2 bg-primary text-on-primary text-sm font-semibold rounded-xl tactile-button">Daftar</a>
            @endauth
        </div>

        {{-- Mobile: CTA + Hamburger --}}
        <div class="flex md:hidden items-center gap-2">
            @auth
                <a href="{{ route('home') }}" class="px-4 py-1.5 bg-primary text-on-primary text-xs font-semibold rounded-lg">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-3 py-1.5 text-xs font-semibold text-primary border border-primary/30 rounded-lg">Masuk</a>
                <a href="{{ route('register') }}" class="px-3 py-1.5 bg-primary text-on-primary text-xs font-semibold rounded-lg">Daftar</a>
            @endauth
            <button id="mobileMenuBtn" class="w-9 h-9 flex items-center justify-center rounded-xl hover:bg-surface-container-high transition-colors ml-1" aria-label="Menu">
                <span class="material-symbols-outlined text-on-surface text-xl" id="mobileMenuIcon">menu</span>
            </button>
        </div>
    </nav>

    {{-- Mobile Dropdown Menu --}}
    <div id="mobileMenu" class="hidden md:hidden bg-surface/95 backdrop-blur-md border-t border-outline-variant/30 px-5 py-4 flex flex-col gap-1">
        <a href="{{ route('tentang-kami') }}" class="px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('tentang-kami') ? 'bg-primary-container/20 text-primary' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }} transition-all">Tentang Kami</a>
        <a href="{{ route('fitur') }}" class="px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('fitur') ? 'bg-primary-container/20 text-primary' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-primary' }} transition-all">Fitur</a>
    </div>
</header>

@push('scripts')
<script>
    const btn = document.getElementById('mobileMenuBtn');
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('mobileMenuIcon');
    btn?.addEventListener('click', () => {
        const open = !menu.classList.contains('hidden');
        menu.classList.toggle('hidden', open);
        icon.textContent = open ? 'menu' : 'close';
    });
</script>
@endpush
