@extends('layouts.app')

@section('title', 'Edit Profil')
@section('subtitle', 'Perbarui informasi akun dan preferensi belajarmu')

@section('content')
<main class="max-w-4xl mx-auto w-full flex flex-col gap-8">
    <div class="bg-surface-container-lowest p-8 rounded-xl tactile-card border border-outline-variant shadow-sm">
        <div id="pesanGlobal" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

        <form id="formProfil" class="flex flex-col gap-8">
            <!-- Avatar Section -->
            <div class="flex flex-col items-center gap-4 py-4 border-b border-outline-variant">
                <div class="relative">
                    <div class="w-32 h-32 rounded-full border-4 border-primary-container p-1 bg-surface flex items-center justify-center text-4xl font-headline font-bold text-primary" id="avatarInitial">
                        ?
                    </div>
                    <label for="avatarUpload" class="absolute bottom-1 right-1 bg-primary text-on-primary w-10 h-10 rounded-full flex items-center justify-center border-2 border-surface shadow-md cursor-pointer hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                    </label>
                    <input type="file" id="avatarUpload" class="hidden" accept="image/*" />
                </div>
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Klik ikon untuk ganti foto</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Info -->
                <div class="flex flex-col gap-4">
                    <h3 class="font-headline text-lg font-bold text-on-surface border-l-4 border-primary pl-3">Informasi Dasar</h3>
                    
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Nama Pengguna</label>
                        <input name="username" class="w-full px-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" placeholder="Nama Lengkap" type="text" required/>
                        <p id="error_username" class="hidden text-[10px] text-error font-bold ml-1"></p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Alamat Email</label>
                        <input name="email" class="w-full px-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" placeholder="email@contoh.com" type="email" required/>
                        <p id="error_email" class="hidden text-[10px] text-error font-bold ml-1"></p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Bio Singkat</label>
                        <textarea name="bio" rows="3" class="w-full px-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium resize-none" placeholder="Ceritakan sedikit tentang dirimu..."></textarea>
                        <p id="error_bio" class="hidden text-[10px] text-error font-bold ml-1"></p>
                    </div>
                </div>

                <!-- Security & More -->
                <div class="flex flex-col gap-4">
                    <h3 class="font-headline text-lg font-bold text-on-surface border-l-4 border-secondary pl-3">Keamanan</h3>
                    
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Kata Sandi Baru (Opsional)</label>
                        <input name="password" class="w-full px-4 py-3 bg-surface-container-low border-2 border-transparent focus:border-primary rounded-xl transition-all outline-none text-sm font-medium" placeholder="Biarkan kosong jika tidak ingin ganti" type="password"/>
                        <p id="error_password" class="hidden text-[10px] text-error font-bold ml-1"></p>
                    </div>

                    <div class="p-4 bg-tertiary-container/20 rounded-xl border border-tertiary/20">
                        <p class="text-[10px] font-bold text-tertiary uppercase mb-2">Tips Keamanan</p>
                        <p class="text-xs text-on-surface-variant">Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol untuk keamanan maksimal.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-6 mt-4">
                <button type="submit" id="btnSimpan" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl tactile-button flex items-center justify-center gap-2">
                    Simpan Perubahan
                    <span class="material-symbols-outlined">save</span>
                </button>
                
                <div class="flex items-center gap-4">
                    <div class="h-[1px] flex-grow bg-outline-variant"></div>
                    <span class="text-[10px] font-bold text-on-surface-variant uppercase">Zona Berbahaya</span>
                    <div class="h-[1px] flex-grow bg-outline-variant"></div>
                </div>

                <button type="button" id="btnHapusAkun" class="w-full py-4 border-2 border-error/20 text-error font-bold rounded-xl hover:bg-error/5 transition-colors flex items-center justify-center gap-2">
                    Hapus Akun Permanen
                    <span class="material-symbols-outlined">delete_forever</span>
                </button>
            </div>
        </form>
    </div>
</main>

<!-- Modal Hapus Akun -->
<div id="modalHapus" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-6 bg-black/50 backdrop-blur-sm">
    <div class="bg-surface-container-lowest max-w-md w-full p-8 rounded-3xl shadow-2xl border border-outline-variant">
        <div class="w-16 h-16 bg-error/10 text-error rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="material-symbols-outlined text-[32px]">warning</span>
        </div>
        <h3 class="font-headline text-xl text-center font-bold text-on-surface mb-2">Konfirmasi Hapus Akun</h3>
        <p class="text-sm text-on-surface-variant text-center mb-8">Tindakan ini tidak bisa dibatalkan. Semua progres belajar dan XP kamu akan dihapus selamanya.</p>
        
        <div class="space-y-4">
            <div class="space-y-2">
                <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider ml-1">Konfirmasi Kata Sandi</label>
                <input id="inputKonfirmasiPassword" class="w-full px-4 py-3 bg-surface-container-low border-2 border-error/20 focus:border-error rounded-xl transition-all outline-none text-sm font-medium" placeholder="Masukkan kata sandi kamu" type="password"/>
                <p id="errorKonfirmasi" class="text-[10px] text-error font-bold ml-1"></p>
            </div>
            
            <div class="flex gap-4">
                <button id="btnBatalHapus" class="flex-1 py-3 bg-surface-container-high text-on-surface font-bold rounded-xl hover:bg-surface-container-highest transition-colors">Batal</button>
                <button id="btnKonfirmasiHapus" class="flex-1 py-3 bg-error text-white font-bold rounded-xl hover:bg-error-container transition-colors">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const avatarInitial = document.getElementById('avatarInitial');
    const avatarUpload = document.getElementById('avatarUpload');
    const formProfil = document.getElementById('formProfil');
    const pesanGlobal = document.getElementById('pesanGlobal');
    
    const modalHapus = document.getElementById('modalHapus');
    const btnHapusAkun = document.getElementById('btnHapusAkun');
    const btnBatalHapus = document.getElementById('btnBatalHapus');
    const btnKonfirmasiHapus = document.getElementById('btnKonfirmasiHapus');
    const inputKonfirmasiPassword = document.getElementById('inputKonfirmasiPassword');
    const errorKonfirmasi = document.getElementById('errorKonfirmasi');

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Load user profile
    fetch("{{ route('api.profil') }}")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const user = data.user;
                formProfil.elements['username'].value = user.username || '';
                formProfil.elements['email'].value = user.email || '';
                formProfil.elements['bio'].value = user.bio || '';
                
                updateAvatarDisplay(user.avatar_url, user.username);
            }
        })
        .catch(err => console.error('Gagal mengambil data profil:', err));

    function updateAvatarDisplay(url, username) {
        if (url) {
            avatarInitial.innerHTML = `<img src="${url}" class="w-full h-full rounded-full object-cover" alt="Avatar">`;
        } else {
            const initial = username ? username.charAt(0).toUpperCase() : '?';
            avatarInitial.innerHTML = initial;
        }
    }

    function showPesan(text, isError = false) {
        pesanGlobal.textContent = text;
        pesanGlobal.className = `p-4 rounded-xl text-sm font-bold mb-6 ${
            isError ? 'bg-error-container text-error border border-error/20' : 'bg-primary-container text-primary border border-primary/20'
        }`;
        pesanGlobal.classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function clearErrors() {
        document.querySelectorAll('[id^="error_"]').forEach(el => {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

    // Handle profile update
    formProfil.addEventListener('submit', function(e) {
        e.preventDefault();
        clearErrors();
        
        const formData = new FormData(formProfil);
        const data = {};
        formData.forEach((value, key) => data[key] = value);

        fetch("{{ route('profil.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(async response => {
            const res = await response.json();
            if (response.ok) {
                return res;
            } else {
                throw res;
            }
        })
        .then(res => {
            showPesan(res.message || 'Profil berhasil diperbarui.', false);
            formProfil.elements['password'].value = '';
            
            // If username changed, update avatar initial if no image
            const avatarImg = avatarInitial.querySelector('img');
            if (!avatarImg) {
                updateAvatarDisplay(null, data.username);
            }
        })
        .catch(err => {
            console.error('Error updating profile:', err);
            if (err.errors) {
                for (const [key, msgs] of Object.entries(err.errors)) {
                    const errorEl = document.getElementById(`error_${key}`);
                    if (errorEl) {
                        errorEl.textContent = msgs[0];
                        errorEl.classList.remove('hidden');
                    }
                }
            }
            showPesan(err.message || 'Gagal menyimpan profil.', true);
        });
    });

    // Handle avatar upload
    avatarUpload.addEventListener('change', function() {
        if (!avatarUpload.files || avatarUpload.files.length === 0) return;
        
        const file = avatarUpload.files[0];
        const formData = new FormData();
        formData.append('avatar', file);

        showPesan('Mengunggah foto profil...', false);

        fetch("{{ route('profil.avatar') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            const res = await response.json();
            if (response.ok) {
                return res;
            } else {
                throw res;
            }
        })
        .then(res => {
            showPesan(res.message || 'Foto profil berhasil diperbarui.', false);
            updateAvatarDisplay(res.avatar_url, formProfil.elements['username'].value);
        })
        .catch(err => {
            console.error('Error uploading avatar:', err);
            showPesan(err.message || 'Gagal mengunggah foto profil.', true);
        });
    });

    // Modal controls
    btnHapusAkun.addEventListener('click', () => {
        modalHapus.classList.remove('hidden');
        inputKonfirmasiPassword.value = '';
        errorKonfirmasi.textContent = '';
        errorKonfirmasi.classList.add('hidden');
    });

    btnBatalHapus.addEventListener('click', () => {
        modalHapus.classList.add('hidden');
    });

    btnKonfirmasiHapus.addEventListener('click', () => {
        const password = inputKonfirmasiPassword.value;
        errorKonfirmasi.textContent = '';
        errorKonfirmasi.classList.add('hidden');

        if (!password) {
            errorKonfirmasi.textContent = 'Kata sandi konfirmasi wajib diisi.';
            errorKonfirmasi.classList.remove('hidden');
            return;
        }

        fetch("{{ route('profil.delete') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ password: password })
        })
        .then(async response => {
            const res = await response.json();
            if (response.ok) {
                return res;
            } else {
                throw res;
            }
        })
        .then(res => {
            // Success - redirect to landing page
            window.location.href = "{{ route('landing') }}";
        })
        .catch(err => {
            console.error('Error deleting account:', err);
            errorKonfirmasi.textContent = err.message || 'Gagal menghapus akun. Pastikan kata sandi benar.';
            errorKonfirmasi.classList.remove('hidden');
        });
    });
});
</script>
@endpush

