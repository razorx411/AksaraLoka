// ============================================================
//  AksaraLoka — Main JS Entry Point
//  Each module auto-detects its page by checking DOM elements.
// ============================================================

// ── HOME PAGE ───────────────────────────────────────────────
(function initHome() {
    const greetingText = document.getElementById('greetingText');
    const greetingTime = document.getElementById('greetingTime');
    if (!greetingText) return; // not on home page

    const storedRaw = localStorage.getItem('user');
    let user = 'User';
    let userInitial = 'U';
    if (storedRaw) {
        try {
            const userObj = JSON.parse(storedRaw);
            user = userObj.nama || 'User';
            userInitial = user.charAt(0).toUpperCase();
        } catch (e) {
            user = storedRaw;
            userInitial = user.charAt(0).toUpperCase();
        }
    }

    const avatarEl = document.getElementById('avatarInitial');
    if (avatarEl) avatarEl.textContent = userInitial;

    const hour = new Date().getHours();
    let greeting = 'Halo';
    if (hour < 12)      greeting = 'Selamat Pagi ☀️';
    else if (hour < 18) greeting = 'Selamat Siang 🌤️';
    else                greeting = 'Selamat Malam 🌙';

    greetingText.innerText = `Selamat Datang Kembali, ${user}!`;
    greetingTime.innerText = greeting;

    // XP & Level System
    const XP_CONFIG = { baseXP: 1200, increment: 200, maxLevel: 45 };

    function xpRequiredForLevel(level) {
        if (level >= XP_CONFIG.maxLevel) return Infinity;
        return XP_CONFIG.baseXP + (level - 1) * XP_CONFIG.increment;
    }

    function calculateLevel(totalXP) {
        let level = 1;
        let remaining = totalXP;
        while (level < XP_CONFIG.maxLevel) {
            const needed = xpRequiredForLevel(level);
            if (remaining < needed) break;
            remaining -= needed;
            level++;
        }
        const isMaxLevel = level >= XP_CONFIG.maxLevel;
        const xpForNext = isMaxLevel ? 0 : xpRequiredForLevel(level);
        return { level, currentXP: remaining, xpForNext, isMaxLevel };
    }

    function updateXpUI(totalXP) {
        const { level, currentXP, xpForNext, isMaxLevel } = calculateLevel(totalXP);
        const bar = document.getElementById('xp-bar');
        const label = document.getElementById('xp-label');
        const xpText = document.getElementById('xp-text');
        const levelBadge = document.getElementById('level-badge');
        const xpTitle = document.getElementById('xp-title');

        if (levelBadge) levelBadge.textContent = `Level ${level}`;
        if (xpText) xpText.textContent = `${totalXP.toLocaleString('id-ID')} XP`;

        if (isMaxLevel) {
            if (xpTitle) xpTitle.textContent = '🏆 Level Maksimum Tercapai!';
            if (label) label.textContent = 'MAX';
            if (bar) setTimeout(() => { bar.style.width = '100%'; }, 300);
        } else {
            if (xpTitle) xpTitle.textContent = `XP menuju Level ${level + 1}`;
            if (label) label.textContent = `${currentXP.toLocaleString('id-ID')} / ${xpForNext.toLocaleString('id-ID')}`;
            if (bar) {
                const percent = Math.min((currentXP / xpForNext) * 100, 100);
                setTimeout(() => { bar.style.width = percent + '%'; }, 300);
            }
        }
    }

    updateXpUI(0);
})();

// ── NAVBAR (all pages with navbar) ──────────────────────────
(function initNavbar() {
    const avatarEl = document.getElementById('avatarInitial');
    if (!avatarEl) return;
    try {
        const u = JSON.parse(localStorage.getItem('user') || '{}');
        if (u.nama) avatarEl.textContent = u.nama.charAt(0).toUpperCase();
    } catch (_) {}

    const notifBtn = document.getElementById('notifBtn');
    const notifDot = document.getElementById('notifDot');
    if (notifBtn) {
        notifBtn.addEventListener('click', () => {
            if (notifDot) notifDot.style.display = 'none';
            alert('Tidak ada notifikasi baru 😄');
        });
    }
})();

// ── LOGIN PAGE ──────────────────────────────────────────────
(function initLogin() {
    const form = document.getElementById('loginForm');
    if (!form) return;

    const emailEl = document.getElementById('email');
    const passEl = document.getElementById('password');
    const notifEl = document.getElementById('notif');
    const emailErr = document.getElementById('emailErr');
    const passErr = document.getElementById('passErr');

    document.getElementById('eyeBtn').addEventListener('click', () => {
        const isHidden = passEl.type === 'password';
        passEl.type = isHidden ? 'text' : 'password';
        document.getElementById('eyeIcon').src = isHidden
            ? '/assets/icons/icon_view.png'
            : '/assets/icons/icon_hidden.png';
    });

    function showErr(el, msg) { el.textContent = msg; el.classList.remove('hidden'); }
    function clearErr(el) { el.textContent = ''; el.classList.add('hidden'); }
    function showNotif(msg, isSuccess = true) {
        notifEl.textContent = msg;
        notifEl.className = 'notif ' + (isSuccess
            ? 'bg-green-50 text-green-700 border border-green-200'
            : 'bg-red-50 text-red-700 border border-red-200');
        notifEl.classList.remove('hidden');
    }

    function validateClient() {
        clearErr(emailErr); clearErr(passErr);
        let valid = true;
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value.trim())) {
            showErr(emailErr, 'Format email tidak valid.'); valid = false;
        }
        if (passEl.value === '') {
            showErr(passErr, 'Kata sandi wajib diisi.'); valid = false;
        }
        return valid;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        notifEl.classList.add('hidden');
        if (!validateClient()) return;

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Memproses…';

        try {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const response = await fetch('/login', {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({ email: emailEl.value.trim(), password: passEl.value }),
            });
            const data = await response.json();

            if (data.success) {
                localStorage.setItem('user', JSON.stringify(data.user));
                showNotif(data.message, true);
                setTimeout(() => { window.location.href = '/home'; }, 1500);
            } else if (data.errors) {
                if (data.errors.email) showErr(emailErr, data.errors.email);
                if (data.errors.password) showErr(passErr, data.errors.password);
            } else {
                showNotif(data.message || 'Terjadi kesalahan. Coba lagi.', false);
            }
        } catch (err) {
            console.error('LOGIN ERROR:', err);
            showNotif('Tidak dapat terhubung ke server. Periksa koneksi kamu.', false);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Masuk';
        }
    });
})();

// ── REGISTER PAGE ───────────────────────────────────────────
(function initRegister() {
    const form = document.getElementById('registrationForm');
    if (!form) return;

    const namaEl = document.getElementById('nama');
    const emailEl = document.getElementById('email');
    const passEl = document.getElementById('password');
    const confEl = document.getElementById('confirmPassword');
    const notifEl = document.getElementById('notif');
    const namaErr = document.getElementById('namaErr');
    const emailErr = document.getElementById('emailErr');
    const passErr = document.getElementById('passErr');
    const confErr = document.getElementById('confirmErr');
    const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];
    const strengthLabel = document.getElementById('strengthLabel');

    function setupEye(btnId, iconId, inputEl) {
        document.getElementById(btnId).addEventListener('click', () => {
            const isHidden = inputEl.type === 'password';
            inputEl.type = isHidden ? 'text' : 'password';
            document.getElementById(iconId).src = isHidden ? '/assets/icons/icon_view.png' : '/assets/icons/icon_hidden.png';
        });
    }
    setupEye('eyeBtn', 'eyeIcon', passEl);
    setupEye('eyeBtn2', 'eyeIcon2', confEl);

    const STRENGTH_CONFIG = [
        { label: 'Sangat Lemah', color: '#ef4444' }, { label: 'Lemah', color: '#f97316' },
        { label: 'Cukup', color: '#eab308' }, { label: 'Kuat', color: '#22c55e' },
    ];

    function calcStrength(pwd) {
        let score = 0;
        if (pwd.length >= 8) score++;
        if (/[A-Z]/.test(pwd)) score++;
        if (/[0-9]/.test(pwd)) score++;
        if (/[^A-Za-z0-9]/.test(pwd)) score++;
        return score;
    }

    passEl.addEventListener('input', () => {
        const score = calcStrength(passEl.value);
        const filled = score === 0 && passEl.value.length === 0 ? 0 : Math.max(score, 1);
        bars.forEach((bar, i) => {
            bar.style.background = i < filled ? STRENGTH_CONFIG[Math.min(score - 1, 3)]?.color ?? '#e5e7eb' : '#e5e7eb';
        });
        if (passEl.value.length > 0) {
            strengthLabel.classList.remove('hidden');
            strengthLabel.textContent = STRENGTH_CONFIG[Math.min(score - 1, 3)]?.label ?? '';
            strengthLabel.style.color = STRENGTH_CONFIG[Math.min(score - 1, 3)]?.color ?? '';
        } else {
            strengthLabel.classList.add('hidden');
        }
    });

    function showErr(el, msg) { el.textContent = msg; el.classList.remove('hidden'); }
    function clearErr(el) { el.textContent = ''; el.classList.add('hidden'); }
    function clearAllErrors() { [namaErr, emailErr, passErr, confErr].forEach(clearErr); }
    function showNotif(msg, isSuccess = true) {
        notifEl.textContent = msg;
        notifEl.className = 'notif ' + (isSuccess ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200');
        notifEl.classList.remove('hidden');
        notifEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function validateClient() {
        clearAllErrors();
        let valid = true;
        if (!namaEl.value.trim()) { showErr(namaErr, 'Nama pengguna wajib diisi.'); valid = false; }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value.trim())) { showErr(emailErr, 'Format email tidak valid.'); valid = false; }
        if (passEl.value.length < 8) { showErr(passErr, 'Kata sandi minimal 8 karakter.'); valid = false; }
        if (passEl.value !== confEl.value) { showErr(confErr, 'Konfirmasi kata sandi tidak cocok.'); valid = false; }
        return valid;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        notifEl.classList.add('hidden');
        if (!validateClient()) return;

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Memproses…';

        try {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const response = await fetch('/register', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({
                    nama: namaEl.value.trim(), email: emailEl.value.trim(),
                    password: passEl.value, confirmPassword: confEl.value,
                }),
            });
            const data = await response.json();

            if (data.success) {
                showNotif(data.message, true);
                form.reset();
                bars.forEach(b => b.style.background = '#e5e7eb');
                strengthLabel.classList.add('hidden');
                setTimeout(() => { window.location.href = '/login'; }, 2000);
            } else if (data.errors) {
                if (data.errors.nama) showErr(namaErr, data.errors.nama);
                if (data.errors.email) showErr(emailErr, data.errors.email);
                if (data.errors.password) showErr(passErr, data.errors.password);
                if (data.errors.confirmPassword) showErr(confErr, data.errors.confirmPassword);
            } else {
                showNotif(data.message || 'Terjadi kesalahan. Coba lagi.', false);
            }
        } catch (err) {
            console.error(err);
            showNotif('Tidak dapat terhubung ke server. Periksa koneksi kamu.', false);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Buat Akun';
        }
    });
})();

// ── PROFILE EDIT PAGE ───────────────────────────────────────
(function initProfileEdit() {
    const formProfil = document.getElementById('formProfil');
    if (!formProfil) return;

    window.addEventListener('DOMContentLoaded', async () => {
        try {
            const res = await fetch('/api/profil', { credentials: 'include' });
            const data = await res.json();
            if (data.success && data.user) {
                document.querySelector('[name="nama"]').value = data.user.nama || '';
                document.querySelector('[name="email"]').value = data.user.email || '';
                document.querySelector('[name="bio"]').value = data.user.bio || '';
                const initial = document.getElementById('avatarInitial');
                if (initial) initial.textContent = (data.user.nama || '?').charAt(0).toUpperCase();
            } else {
                tampilkanPesan('error', data.message || 'Gagal mengambil data profil.');
            }
        } catch (err) {
            console.error('Load profil error:', err);
            tampilkanPesan('error', 'Terjadi kesalahan saat memuat profil.');
        }
    });

    formProfil.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btnSimpan = document.getElementById('btnSimpan');
        btnSimpan.disabled = true;
        btnSimpan.textContent = 'Menyimpan...';
        bersihkanError();

        const nama = document.querySelector('[name="nama"]').value.trim();
        const email = document.querySelector('[name="email"]').value.trim();
        const bio = document.querySelector('[name="bio"]').value.trim();
        const password = document.querySelector('[name="password"]').value;

        try {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const res = await fetch('/profil/update', {
                method: 'POST', credentials: 'include',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({ nama, email, bio, password }),
            });
            const data = await res.json();

            if (data.success) {
                try {
                    const u = JSON.parse(localStorage.getItem('user') || '{}');
                    u.nama = data.user.nama; u.email = data.user.email;
                    localStorage.setItem('user', JSON.stringify(u));
                } catch (_) {}
                tampilkanPesan('success', 'Profil berhasil diperbarui!');
                const initial = document.getElementById('avatarInitial');
                if (initial) initial.textContent = (data.user.nama || '?').charAt(0).toUpperCase();
                document.querySelector('[name="password"]').value = '';
            } else {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, msg]) => tampilkanErrorField(field, msg));
                } else {
                    tampilkanPesan('error', data.message || 'Gagal memperbarui profil.');
                }
            }
        } catch (err) {
            console.error('Update profil error:', err);
            tampilkanPesan('error', 'Terjadi kesalahan jaringan. Coba lagi.');
        } finally {
            btnSimpan.disabled = false;
            btnSimpan.textContent = 'Simpan Perubahan';
        }
    });

    document.getElementById('btnHapusAkun').addEventListener('click', () => {
        document.getElementById('modalHapus').classList.remove('hidden');
    });
    document.getElementById('btnBatalHapus').addEventListener('click', () => {
        document.getElementById('modalHapus').classList.add('hidden');
        document.getElementById('inputKonfirmasiPassword').value = '';
        document.getElementById('errorKonfirmasi').textContent = '';
    });
    document.getElementById('btnKonfirmasiHapus').addEventListener('click', async () => {
        const password = document.getElementById('inputKonfirmasiPassword').value;
        const errEl = document.getElementById('errorKonfirmasi');
        const btnKonfirmasi = document.getElementById('btnKonfirmasiHapus');

        if (!password) { errEl.textContent = 'Masukkan kata sandi untuk konfirmasi.'; return; }
        btnKonfirmasi.disabled = true;
        btnKonfirmasi.textContent = 'Menghapus...';
        errEl.textContent = '';

        try {
            const token = document.querySelector('meta[name="csrf-token"]').content;
            const res = await fetch('/profil/delete', {
                method: 'POST', credentials: 'include',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify({ password }),
            });
            const data = await res.json();
            if (data.success) {
                localStorage.clear();
                alert('Akun berhasil dihapus. Sampai jumpa!');
                window.location.href = '/login';
            } else {
                errEl.textContent = data.message || 'Gagal menghapus akun.';
                btnKonfirmasi.disabled = false;
                btnKonfirmasi.textContent = 'Ya, Hapus Akun';
            }
        } catch (err) {
            console.error('Delete akun error:', err);
            errEl.textContent = 'Terjadi kesalahan jaringan. Coba lagi.';
            btnKonfirmasi.disabled = false;
            btnKonfirmasi.textContent = 'Ya, Hapus Akun';
        }
    });

    function tampilkanPesan(tipe, pesan) {
        const el = document.getElementById('pesanGlobal');
        el.textContent = pesan;
        el.className = tipe === 'success'
            ? 'mb-4 p-3 rounded-xl text-sm font-semibold bg-green-100 text-green-700 border border-green-300'
            : 'mb-4 p-3 rounded-xl text-sm font-semibold bg-red-100 text-red-700 border border-red-300';
        el.classList.remove('hidden');
        setTimeout(() => el.classList.add('hidden'), 4000);
    }
    function tampilkanErrorField(field, pesan) {
        const el = document.getElementById('error_' + field);
        if (el) { el.textContent = pesan; el.classList.remove('hidden'); }
    }
    function bersihkanError() {
        document.querySelectorAll("[id^='error_']").forEach(el => { el.textContent = ''; el.classList.add('hidden'); });
        const g = document.getElementById('pesanGlobal');
        if (g) g.classList.add('hidden');
    }
})();

// ── PROFIL VIEW PAGE ────────────────────────────────────────
(function initProfilView() {
    const profileName = document.getElementById('profileName');
    if (!profileName) return;

    window.addEventListener('DOMContentLoaded', async () => {
        try {
            const res = await fetch('/api/profil', { credentials: 'include' });
            const data = await res.json();
            if (data.success && data.user) {
                setProfile(data.user.nama);
                return;
            }
        } catch (_) {}
        try {
            const u = JSON.parse(localStorage.getItem('user') || '{}');
            if (u?.nama) setProfile(u.nama);
        } catch (_) {}
    });

    function setProfile(nama) {
        document.getElementById('profileName').textContent = nama;
        document.getElementById('profileUsername').textContent = '@' + nama.replace(/\s+/g, '').toLowerCase();
    }
})();
