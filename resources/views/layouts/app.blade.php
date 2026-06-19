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
        <main class="ml-0 md:ml-64 min-h-screen pb-20 md:pb-6">
            @include('partials.top_app_bar')
            <div class="p-4 md:p-6">
                @yield('content')
            </div>
        </main>
        @include('partials.bottom_nav')
    @else
        @yield('content')
    @endauth

    {{-- ── Achievement Toast Container ─────────────────────────────── --}}
    <div id="achievementToastContainer"
         class="fixed bottom-6 right-6 z-[200] flex flex-col gap-3 pointer-events-none">
    </div>

    @stack('scripts')

    <script>
    /**
     * Global helper: showAchievementToast(achievement)
     * achievement = { name, description, icon, color }
     *
     * Called by pages that trigger level completion.
     */
    function showAchievementToast(achievement) {
        const container = document.getElementById('achievementToastContainer');
        if (!container) return;

        const colorMap = {
            primary:   { bg: 'bg-primary-container',   text: 'text-primary',   icon: 'text-primary' },
            secondary: { bg: 'bg-secondary-container', text: 'text-secondary', icon: 'text-secondary' },
            tertiary:  { bg: 'bg-tertiary-container',  text: 'text-tertiary',  icon: 'text-tertiary' },
        };
        const c = colorMap[achievement.color] ?? colorMap.primary;

        const toast = document.createElement('div');
        toast.className = `
            pointer-events-auto flex items-center gap-4 px-5 py-4 rounded-2xl shadow-2xl border border-white/20
            ${c.bg} max-w-xs w-full
            translate-y-8 opacity-0 transition-all duration-500 ease-out
        `.trim();

        toast.innerHTML = `
            <div class="shrink-0 w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                <span class="material-symbols-outlined ${c.icon} text-2xl" style="font-variation-settings: 'FILL' 1;">${achievement.icon}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[10px] font-bold ${c.text} uppercase tracking-widest mb-0.5">🏆 Achievement Baru!</p>
                <p class="font-headline font-bold text-on-surface text-sm">${achievement.name}</p>
                <p class="text-[11px] text-on-surface-variant truncate">${achievement.description}</p>
            </div>
        `;

        container.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-8', 'opacity-0');
            });
        });

        // Auto-dismiss after 4s
        setTimeout(() => {
            toast.classList.add('translate-y-8', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }

    /**
     * Show multiple achievement toasts sequentially with slight delay.
     */
    function showAchievementToasts(achievements) {
        if (!achievements || achievements.length === 0) return;
        achievements.forEach((a, i) => {
            setTimeout(() => showAchievementToast(a), i * 600);
        });
    }
    </script>
    
    @auth
        @include('partials.chat_widget')
    @endauth
</body>
</html>

