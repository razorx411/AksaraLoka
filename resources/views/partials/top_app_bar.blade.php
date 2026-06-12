<header class="flex justify-between items-center w-full px-4 md:px-8 py-4 sticky top-0 z-40 bg-surface/80 backdrop-blur-md border-b border-surface-container-high">
    <div class="flex flex-col">
        <h2 class="font-headline text-2xl font-bold text-primary">@yield('title', 'Dashboard')</h2>
        <p class="text-[10px] font-medium text-on-surface-variant">@yield('subtitle', 'Selamat datang di Aksaraloka')</p>
    </div>
    <div class="flex items-center gap-4">
        {{-- Streak badge --}}
        @if(!Auth::user()->isAdmin() && !Auth::user()->isGuru())
        <div class="hidden sm:flex items-center gap-2 bg-secondary-container/50 px-3 py-1.5 rounded-full text-xs font-bold text-secondary border border-secondary/20">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
            <span>{{ Auth::user()->streak ?? 0 }} Hari</span>
        </div>
        @endif

        {{-- Notification Bell --}}
        <div class="relative" id="notifWrapper">
            <button id="notifBtn" class="p-2 rounded-full hover:bg-surface-container transition-colors text-primary relative">
                <span class="material-symbols-outlined">notifications</span>
                <span id="notifDot" class="hidden absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-error rounded-full border-2 border-surface animate-pulse"></span>
            </button>

            {{-- Dropdown --}}
            <div id="notifDropdown"
                 class="hidden absolute right-0 top-full mt-2 w-80 bg-surface-container-lowest rounded-2xl shadow-2xl border border-outline-variant z-50 overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b border-outline-variant">
                    <span class="font-headline font-bold text-on-surface text-sm">Notifikasi</span>
                    <button id="markAllReadBtn"
                            class="text-[10px] font-bold text-primary hover:underline">
                        Tandai Semua Dibaca
                    </button>
                </div>
                <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-outline-variant/50">
                    <div class="flex flex-col items-center justify-center py-10 gap-2 text-on-surface-variant">
                        <span class="material-symbols-outlined text-3xl">notifications_none</span>
                        <p class="text-xs font-medium">Memuat notifikasi...</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Avatar link --}}
        <a href="{{ route('profil') }}" class="flex items-center gap-2 hover:bg-surface-container p-1 rounded-full transition-all">
            @if(Auth::user()->avatar_url)
                <img src="{{ Auth::user()->avatar_url }}"
                     alt="Avatar"
                     class="w-9 h-9 rounded-full object-cover border-2 border-primary-container" />
            @else
                <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-on-primary text-xs font-bold">
                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                </div>
            @endif
        </a>
    </div>
</header>

@push('scripts')
<script>
(function () {
    const btn      = document.getElementById('notifBtn');
    const dropdown = document.getElementById('notifDropdown');
    const dot      = document.getElementById('notifDot');
    const list     = document.getElementById('notifList');
    const markAllBtn = document.getElementById('markAllReadBtn');

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    let loaded = false;

    // ── Toggle dropdown ───────────────────────────────────────────
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
        if (!dropdown.classList.contains('hidden') && !loaded) {
            loadNotifications();
        }
    });

    document.addEventListener('click', (e) => {
        if (!document.getElementById('notifWrapper').contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // ── Load notifications ────────────────────────────────────────
    async function loadNotifications() {
        loaded = true;
        try {
            const res  = await fetch('/api/notifications', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const data = await res.json();

            if (data.unread_count > 0) {
                dot.classList.remove('hidden');
            } else {
                dot.classList.add('hidden');
            }

            renderNotifications(data.notifications);
        } catch {
            list.innerHTML = `<p class="text-center text-xs text-on-surface-variant py-6">Gagal memuat notifikasi.</p>`;
        }
    }

    // ── Render list ───────────────────────────────────────────────
    function renderNotifications(notifications) {
        if (!notifications || notifications.length === 0) {
            list.innerHTML = `
                <div class="flex flex-col items-center justify-center py-10 gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-3xl">notifications_none</span>
                    <p class="text-xs font-medium">Belum ada notifikasi</p>
                </div>`;
            return;
        }

        const typeColors = { info: 'text-primary', materi: 'text-tertiary', soal: 'text-secondary' };

        list.innerHTML = notifications.map(n => `
            <div class="flex gap-3 px-4 py-3.5 hover:bg-surface-container-low transition-colors cursor-pointer notif-item ${n.is_read ? 'opacity-60' : ''}"
                 data-id="${n.id}" data-read="${n.is_read}">
                <div class="shrink-0 w-9 h-9 rounded-full bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-[18px]" style="font-variation-settings: 'FILL' 1;">${n.icon}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-1">
                        <p class="text-xs font-bold text-on-surface truncate">${n.title}</p>
                        ${!n.is_read ? '<span class="shrink-0 w-2 h-2 bg-primary rounded-full mt-1"></span>' : ''}
                    </div>
                    <p class="text-[11px] text-on-surface-variant line-clamp-2 mt-0.5">${n.body}</p>
                    <p class="text-[10px] font-bold ${typeColors[n.type] ?? 'text-primary'} mt-1 uppercase">${n.type} · ${n.created_at}</p>
                </div>
            </div>`).join('');

        // Mark individual as read on click
        list.querySelectorAll('.notif-item').forEach(el => {
            el.addEventListener('click', async () => {
                const id   = el.dataset.id;
                const read = el.dataset.read === 'true';
                if (read) return;

                await fetch(`/api/notifications/${id}/read`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
                });
                el.classList.add('opacity-60');
                el.dataset.read = 'true';
                el.querySelector('.shrink-0.w-2')?.remove();

                // Recount
                const unread = list.querySelectorAll('[data-read="false"]').length;
                unread > 0 ? dot.classList.remove('hidden') : dot.classList.add('hidden');
            });
        });
    }

    // ── Mark all read ─────────────────────────────────────────────
    markAllBtn.addEventListener('click', async () => {
        await fetch('/api/notifications/read-all', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        });
        dot.classList.add('hidden');
        loaded = false;
        loadNotifications();
    });

    // ── Initial unread check (without opening dropdown) ──────────
    fetch('/api/notifications', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(d => { if (d.unread_count > 0) dot.classList.remove('hidden'); })
        .catch(() => {});
})();
</script>
@endpush
