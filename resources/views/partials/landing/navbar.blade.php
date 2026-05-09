<header class="fixed top-0 left-0 right-0 z-50 glass-header bg-surface/80">
    <nav class="max-w-[1140px] mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="font-headline text-2xl font-bold text-primary">Aksaraloka</span>
        </div>
        <div class="hidden md:flex items-center gap-10">
            <a class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors" href="#tentang">Tentang Kami</a>
            <a class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors" href="#fitur">Fitur</a>
        </div>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('home') }}" class="px-6 py-2 bg-primary text-on-primary text-sm font-semibold rounded-lg tactile-button">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-primary hover:bg-primary-fixed transition-all rounded-lg">Masuk</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-primary text-on-primary text-sm font-semibold rounded-lg tactile-button">Daftar</a>
            @endauth
        </div>
    </nav>
</header>
