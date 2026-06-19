{{-- ── FLOATING CHAT WIDGET ── --}}
<div id="chatWidget" class="fixed bottom-20 right-4 sm:bottom-6 sm:right-6 z-50 flex flex-col items-end pointer-events-none select-none font-sans">
    
    {{-- Main Chat Panel --}}
    <div id="chatPanel" class="fixed z-50 bg-surface flex flex-col overflow-hidden transition-all duration-300 pointer-events-auto shadow-2xl border-outline-variant rounded-t-3xl sm:rounded-2xl sm:border max-sm:inset-x-0 max-sm:bottom-0 max-sm:h-[82vh] sm:bottom-24 sm:right-6 sm:w-88 sm:h-[480px] sm:mb-4 opacity-0 pointer-events-none translate-y-full sm:translate-y-4 sm:scale-95">
        
        {{-- PANEL HEADER --}}
        <div class="bg-[#6B3A00] text-white px-4 py-3 flex flex-col shadow-sm shrink-0 rounded-t-3xl sm:rounded-t-2xl">
            {{-- Mobile Handle Bar --}}
            <div class="w-12 h-1 bg-white/30 rounded-full mx-auto mb-2.5 sm:hidden shrink-0"></div>
            
            <div class="flex items-center justify-between w-full">
                <div id="panelHeaderMain" class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">forum</span>
                    <span class="text-xs font-bold uppercase tracking-wider">Hubungan &amp; Obrolan</span>
                </div>
                
                {{-- Chat room header (Hidden by default) --}}
                <div id="panelHeaderChat" class="hidden flex items-center gap-2.5 w-full mr-4">
                    <button onclick="closeChat()" class="hover:bg-white/10 p-1 rounded-lg transition-colors flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-white text-lg">arrow_back</span>
                    </button>
                    <img id="chatFriendAvatar" src="" onclick="openProfilePreview(activeFriendId, event)" class="w-7 h-7 rounded-full object-cover border border-white/20 shrink-0 cursor-pointer hover:scale-105 active:scale-95 transition-all" alt="" onerror="this.src='https://ui-avatars.com/api/?name=User&background=8B6914&color=fff'" title="Lihat Profil" />
                    <div class="min-w-0 cursor-pointer" onclick="openProfilePreview(activeFriendId, event)" title="Lihat Profil">
                        <h5 id="chatFriendName" class="text-xs font-bold text-white truncate leading-tight hover:underline text-left">Teman</h5>
                        <p class="text-[9px] text-white/70 font-medium text-left">Aktif</p>
                    </div>
                </div>

                <button onclick="toggleChatPanel()" class="text-white/80 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/10 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        </div>

        {{-- VIEW 1: FRIEND LIST & SEARCH --}}
        <div id="viewFriendList" class="flex-grow flex flex-col overflow-hidden bg-surface-container-lowest">
            {{-- Search & Add Friend --}}
            <div class="p-3 border-b border-outline-variant/50 bg-surface shrink-0">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
                    <input type="text" id="searchFriendInput" placeholder="Cari & tambah teman baru..." 
                           class="w-full pl-9 pr-8 py-1.5 bg-surface-container border border-outline-variant focus:border-primary focus:outline-none rounded-xl text-xs font-medium" />
                    <button id="clearSearchBtn" class="hidden absolute right-2.5 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface">
                        <span class="material-symbols-outlined text-xs">close</span>
                    </button>
                </div>
            </div>

            {{-- Tab Contents --}}
            <div class="flex-grow overflow-y-auto px-3 py-2 space-y-4" id="friendListContainer">
                
                {{-- Search Results Section (Shown only during search) --}}
                <div id="searchResultsSection" class="hidden space-y-2">
                    <h6 class="text-[9px] font-bold text-outline uppercase tracking-wider px-1">Hasil Pencarian</h6>
                    <div id="searchResultsList" class="space-y-1.5"></div>
                </div>

                {{-- Pending Incoming Requests Section --}}
                <div id="pendingRequestsSection" class="hidden space-y-2">
                    <h6 class="text-[9px] font-bold text-error uppercase tracking-wider px-1">Permintaan Pertemanan</h6>
                    <div id="pendingRequestsList" class="space-y-1.5"></div>
                </div>

                {{-- Friends List Section --}}
                <div id="friendsListSection" class="space-y-2">
                    <h6 class="text-[9px] font-bold text-outline uppercase tracking-wider px-1">Teman Saya</h6>
                    <div id="friendsList" class="space-y-1.5"></div>
                    <div id="friendsEmptyState" class="hidden text-center py-8 px-4">
                        <span class="material-symbols-outlined text-3xl text-outline-variant">person_add</span>
                        <p class="text-[11px] text-on-surface-variant font-medium mt-1">Belum ada teman.<br>Cari nama pengguna di atas untuk menambahkan!</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- VIEW 2: CHAT CONVERSATION --}}
        <div id="viewChatRoom" class="hidden flex-grow flex flex-col overflow-hidden bg-surface-container-low">
            {{-- Messages Area --}}
            <div id="chatMessages" class="flex-grow overflow-y-auto p-4 space-y-3 flex flex-col"></div>

            {{-- Input Area --}}
            <div class="p-3 max-sm:pb-6 bg-surface border-t border-outline-variant/60 flex items-center gap-2 shrink-0">
                <input type="text" id="chatInput" placeholder="Tulis pesan..." 
                       class="flex-grow px-3.5 py-2 bg-surface-container border border-outline-variant focus:border-primary focus:outline-none rounded-xl text-xs font-medium" 
                       onkeydown="if(event.key === 'Enter') sendChatMessage()"/>
                <button onclick="sendChatMessage()" class="w-8 h-8 rounded-xl bg-[#6B3A00] text-white flex items-center justify-center shadow hover:bg-[#8B5200] active:scale-95 transition-all shrink-0">
                    <span class="material-symbols-outlined text-sm">send</span>
                </button>
            </div>
        </div>

        {{-- VIEW 3: PROFILE PREVIEW (FLEX ZONE) --}}
        <div id="viewProfilePreview" class="hidden flex-grow flex flex-col overflow-hidden bg-surface-container-lowest">
            {{-- Glowing Premium Header Banner --}}
            <div class="relative pt-7 pb-4 px-4 bg-gradient-to-br from-[#5C3200] via-[#85510E] to-[#A87422] text-white flex flex-col items-center shadow-lg shrink-0 overflow-hidden">
                {{-- Decorative background glow pattern --}}
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(253,224,71,0.15)_0%,transparent_70%)] pointer-events-none"></div>
                <div class="absolute -top-10 -left-10 w-24 h-24 rounded-full bg-yellow-500/10 blur-xl"></div>
                <div class="absolute -bottom-10 -right-10 w-24 h-24 rounded-full bg-amber-500/10 blur-xl"></div>
                
                {{-- Back button --}}
                <button onclick="closeProfilePreview()" class="absolute left-3 top-3 bg-black/25 hover:bg-black/45 text-white p-1 rounded-xl transition-all flex items-center justify-center border border-white/10 active:scale-90 shadow-inner">
                    <span class="material-symbols-outlined text-sm font-bold">arrow_back</span>
                </button>
                
                {{-- Premium Avatar Frame --}}
                <div class="relative group mt-2">
                    <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-yellow-400 via-amber-500 to-yellow-600 blur opacity-60 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-pulse"></div>
                    <img id="previewAvatar" src="" class="relative w-20 h-20 rounded-full object-cover border-4 border-yellow-500/90 shadow-[0_0_15px_rgba(245,158,11,0.5)] bg-surface" alt="Foto Profil" onerror="this.src='https://ui-avatars.com/api/?name=User&background=8B6914&color=fff'" />
                    <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-gradient-to-r from-yellow-500 to-amber-600 text-black text-[9px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full border border-yellow-400 shadow flex items-center gap-0.5 whitespace-nowrap">
                        <span class="material-symbols-outlined text-[9px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                        Lvl <span id="previewLevel">1</span>
                    </div>
                </div>
                
                <h4 id="previewUsername" class="font-headline text-xs font-bold mt-4 tracking-wide drop-shadow-md leading-none text-white">Nama Pengguna</h4>
                <p id="previewBio" class="text-[10px] text-yellow-100/80 max-w-[220px] text-center mt-2 font-medium italic min-h-[30px] overflow-hidden line-clamp-2">
                    "Melestarikan keanggunan Hanacaraka..."
                </p>
            </div>
            
            {{-- Stats row --}}
            <div class="grid grid-cols-2 gap-2 p-3 bg-surface border-b border-outline-variant/40 shrink-0">
                <div class="bg-gradient-to-br from-amber-500/5 to-amber-600/10 border border-amber-500/20 rounded-xl p-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-amber-600 text-xl animate-pulse" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                    <div class="min-w-0">
                        <p class="text-[8px] font-bold text-on-surface-variant uppercase tracking-wider leading-none">Streak Beruntun</p>
                        <p class="text-xs font-black text-on-surface mt-0.5"><span id="previewStreak">0</span> Hari</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-yellow-500/5 to-yellow-600/10 border border-yellow-500/20 rounded-xl p-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-yellow-600 text-xl" style="font-variation-settings: 'FILL' 1;">stars</span>
                    <div class="min-w-0">
                        <p class="text-[8px] font-bold text-on-surface-variant uppercase tracking-wider leading-none">Total Nilai XP</p>
                        <p class="text-xs font-black text-on-surface mt-0.5"><span id="previewXp">0</span> XP</p>
                    </div>
                </div>
            </div>
            
            {{-- Achievements Area --}}
            <div class="flex-grow overflow-y-auto px-4 py-3 flex flex-col" id="previewAchievementsContainer">
                <div class="flex items-center justify-between mb-2 shrink-0">
                    <span class="text-[9px] font-bold text-outline uppercase tracking-wider">Galeri Pencapaian Agung</span>
                    <span class="text-[9px] font-bold text-amber-600 bg-amber-500/10 px-2 py-0.5 rounded-full"><span id="previewEarnedCount">0</span>/<span id="previewTotalCount">0</span> Diraih</span>
                </div>
                
                {{-- Badges Shelf / Grid --}}
                <div id="previewBadgeGrid" class="grid grid-cols-4 gap-2.5 py-1">
                    {{-- Populated dynamically via JS --}}
                </div>
                
                {{-- Interactive Tooltip/Detail board inside the panel --}}
                <div id="previewDetailBoard" class="mt-auto pt-3 border-t border-outline-variant/40 shrink-0">
                    <div class="bg-surface-container rounded-xl p-2.5 border border-outline-variant/30 flex gap-2.5 min-h-[56px] items-center transition-all duration-200">
                        <div id="detailBoardIconContainer" class="w-9 h-9 rounded-full bg-outline-variant/20 flex items-center justify-center text-on-surface-variant shrink-0">
                            <span class="material-symbols-outlined text-lg">info</span>
                        </div>
                        <div class="min-w-0 flex-grow">
                            <p id="detailBoardTitle" class="text-[10px] font-bold text-on-surface truncate">Sentuh lencana pencapaian</p>
                            <p id="detailBoardDesc" class="text-[9px] text-on-surface-variant mt-0.5 leading-snug line-clamp-2">Arahkan kursor atau sentuh ikon pencapaian di atas untuk melihat detail &amp; tanggal perolehan.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Bottom CTA Button --}}
            <div id="previewActions" class="p-3 max-sm:pb-6 bg-surface border-t border-outline-variant/60 shrink-0 flex gap-2">
                {{-- Rendered dynamically --}}
            </div>
        </div>
    </div>

    {{-- Floating Action Button (FAB) --}}
    <button id="chatFab" onclick="toggleChatPanel()" class="pointer-events-auto w-14 h-14 rounded-full bg-[#6B3A00] text-white flex items-center justify-center shadow-2xl hover:bg-[#8B5200] hover:scale-105 active:scale-95 transition-all relative shrink-0">
        <span class="material-symbols-outlined text-2xl">forum</span>
        {{-- Global Unread Badge --}}
        <div id="globalChatBadge" class="hidden absolute -top-1 -right-1 bg-error text-white text-[9px] font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-surface animate-bounce">
            0
        </div>
    </button>
</div>

<style>
    /* Styling scrollbar chat agar sleek */
    #chatMessages::-webkit-scrollbar,
    #friendListContainer::-webkit-scrollbar,
    #previewAchievementsContainer::-webkit-scrollbar {
        width: 4px;
    }
    #chatMessages::-webkit-scrollbar-thumb,
    #friendListContainer::-webkit-scrollbar-thumb,
    #previewAchievementsContainer::-webkit-scrollbar-thumb {
        background-color: var(--md-sys-color-outline-variant, #ccc);
        border-radius: 4px;
    }
    .chat-bubble-sent {
        background: linear-gradient(135deg, #6B3A00 0%, #8B5200 100%);
        color: white;
    }
    .chat-bubble-received {
        background-color: var(--md-sys-color-surface-container-high, #f0f0f0);
        color: var(--md-sys-color-on-surface, #333);
        border: 1px border-outline-variant/30;
    }
    .achievement-shine {
        position: relative;
        overflow: hidden;
    }
    .achievement-shine::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to bottom right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0) 40%,
            rgba(255, 255, 255, 0.35) 50%,
            rgba(255, 255, 255, 0) 60%,
            rgba(255, 255, 255, 0) 100%
        );
        transform: rotate(30deg);
        transition: transform 0.6s ease;
        pointer-events: none;
    }
    .achievement-shine:hover::after {
        transform: translate(50%, 50%) rotate(30deg);
    }
</style>

<script>
    let chatPanelOpen = false;
    let activeFriendId = null;
    let activeFriendName = "";
    let activeFriendAvatar = "";
    let pollingIntervalId = null;
    let searchTimeout = null;
    let previousWidgetView = null; // 'friendList' or 'chatRoom'

    // Elements
    const chatPanel = document.getElementById('chatPanel');
    const chatFab = document.getElementById('chatFab');
    const globalChatBadge = document.getElementById('globalChatBadge');
    const panelHeaderMain = document.getElementById('panelHeaderMain');
    const panelHeaderChat = document.getElementById('panelHeaderChat');
    const chatFriendAvatar = document.getElementById('chatFriendAvatar');
    const chatFriendName = document.getElementById('chatFriendName');
    
    const viewFriendList = document.getElementById('viewFriendList');
    const viewChatRoom = document.getElementById('viewChatRoom');
    const viewProfilePreview = document.getElementById('viewProfilePreview');
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const searchFriendInput = document.getElementById('searchFriendInput');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    
    const searchResultsSection = document.getElementById('searchResultsSection');
    const searchResultsList = document.getElementById('searchResultsList');
    const pendingRequestsSection = document.getElementById('pendingRequestsSection');
    const pendingRequestsList = document.getElementById('pendingRequestsList');
    const friendsListSection = document.getElementById('friendsListSection');
    const friendsList = document.getElementById('friendsList');
    const friendsEmptyState = document.getElementById('friendsEmptyState');

    // Profile Preview elements
    const previewAvatar = document.getElementById('previewAvatar');
    const previewLevel = document.getElementById('previewLevel');
    const previewUsername = document.getElementById('previewUsername');
    const previewBio = document.getElementById('previewBio');
    const previewStreak = document.getElementById('previewStreak');
    const previewXp = document.getElementById('previewXp');
    const previewEarnedCount = document.getElementById('previewEarnedCount');
    const previewTotalCount = document.getElementById('previewTotalCount');
    const previewBadgeGrid = document.getElementById('previewBadgeGrid');
    const previewActions = document.getElementById('previewActions');

    // Detail Board elements
    const detailBoardTitle = document.getElementById('detailBoardTitle');
    const detailBoardDesc = document.getElementById('detailBoardDesc');
    const detailBoardIconContainer = document.getElementById('detailBoardIconContainer');

    // Open Friend's Profile Preview
    function openProfilePreview(userId, event) {
        if (event) {
            event.stopPropagation();
        }

        // Record previous view
        if (!viewChatRoom.classList.contains('hidden')) {
            previousWidgetView = 'chatRoom';
        } else {
            previousWidgetView = 'friendList';
        }

        // Hide views & headers
        viewFriendList.classList.add('hidden');
        viewChatRoom.classList.add('hidden');
        panelHeaderMain.classList.add('hidden');
        panelHeaderChat.classList.add('hidden');

        // Show preview container
        viewProfilePreview.classList.remove('hidden');

        // Loading states
        previewUsername.textContent = "Memuat...";
        previewBio.textContent = "Mengambil data prasasti pencapaian...";
        previewStreak.textContent = "-";
        previewXp.textContent = "-";
        previewEarnedCount.textContent = "-";
        previewTotalCount.textContent = "-";
        previewBadgeGrid.innerHTML = `
            <div class="col-span-4 text-center py-6 text-[10px] text-outline">
                Memuat lencana...
            </div>
        `;
        detailBoardTitle.textContent = "Menghubungi server...";
        detailBoardDesc.textContent = "Mengunduh sejarah pencapaian ksatria...";
        detailBoardIconContainer.innerHTML = `<span class="material-symbols-outlined text-lg animate-spin text-primary">sync</span>`;
        detailBoardIconContainer.className = "w-9 h-9 rounded-full bg-outline-variant/10 flex items-center justify-center shrink-0";
        previewActions.innerHTML = "";

        // Fetch user data
        fetch(`/api/users/${userId}/preview`)
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    detailBoardTitle.textContent = "Kesalahan";
                    detailBoardDesc.textContent = data.message || "Gagal memuat profil.";
                    return;
                }

                const user = data.user;
                const avatar = user.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(user.username)}&background=8B6914&color=fff`;
                
                // Populate Profile
                previewAvatar.src = avatar;
                previewUsername.textContent = user.username;
                previewLevel.textContent = user.level;
                previewBio.textContent = user.bio || "Melestarikan keanggunan Hanacaraka melalui latihan harian.";
                previewStreak.textContent = user.streak || 0;
                previewXp.textContent = (user.xp || 0).toLocaleString();

                // Reset detail board instructions
                detailBoardTitle.textContent = "Sentuh lencana pencapaian";
                detailBoardDesc.textContent = "Arahkan kursor atau sentuh ikon pencapaian di atas untuk melihat detail & tanggal perolehan.";
                detailBoardIconContainer.innerHTML = `<span class="material-symbols-outlined text-lg text-primary">info</span>`;
                detailBoardIconContainer.className = "w-9 h-9 rounded-full bg-outline-variant/20 flex items-center justify-center text-on-surface-variant shrink-0";

                // Populate Achievements
                previewBadgeGrid.innerHTML = "";
                let earnedCount = 0;
                const achievements = data.achievements;
                previewTotalCount.textContent = achievements.length;

                achievements.forEach(a => {
                    if (a.earned) earnedCount++;

                    const colors = {
                        primary: { bg: 'from-amber-400/20 to-yellow-600/30', text: 'text-amber-600', border: 'border-amber-400/40', accent: 'bg-amber-600' },
                        secondary: { bg: 'from-[#8C5A3C]/20 to-[#5C3A24]/30', text: 'text-[#8C5A3C]', border: 'border-[#8C5A3C]/40', accent: 'bg-[#8C5A3C]' },
                        tertiary: { bg: 'from-slate-400/20 to-slate-600/30', text: 'text-slate-500', border: 'border-slate-400/40', accent: 'bg-slate-500' }
                    };
                    const c = colors[a.color] || colors.primary;

                    const badgeDiv = document.createElement('div');
                    badgeDiv.className = `flex flex-col items-center justify-center p-2 rounded-2xl border transition-all duration-200 cursor-pointer relative achievement-shine select-none ${
                        a.earned 
                        ? `bg-gradient-to-br ${c.bg} ${c.border} hover:scale-105 active:scale-95 shadow-sm` 
                        : 'bg-surface-container/50 border-outline-variant/30 opacity-40 grayscale'
                    }`;

                    badgeDiv.innerHTML = `
                        <span class="material-symbols-outlined text-xl ${a.earned ? c.text : 'text-on-surface-variant'}" style="${a.earned ? "font-variation-settings: 'FILL' 1;" : ""}">
                            ${a.earned ? a.icon : 'lock'}
                        </span>
                        ${a.earned ? `
                        <span class="absolute -top-0.5 -right-0.5 w-3.5 h-3.5 ${c.accent} rounded-full flex items-center justify-center border border-white text-white">
                            <span class="material-symbols-outlined text-[8px] font-bold" style="font-variation-settings: 'FILL' 1;">check</span>
                        </span>
                        ` : ''}
                    `;

                    // Hover/Click to show detail
                    const updateDetail = () => {
                        detailBoardTitle.textContent = a.name + (a.earned ? '' : ' (Terkunci)');
                        detailBoardDesc.innerHTML = a.earned 
                            ? `<span class="text-amber-600 font-bold block text-[8px] uppercase tracking-wider mb-0.5">Diraih pada ${a.date}</span>${a.description}`
                            : a.description;
                        detailBoardIconContainer.innerHTML = `<span class="material-symbols-outlined text-lg ${a.earned ? c.text : 'text-on-surface-variant'}" style="${a.earned ? "font-variation-settings: 'FILL' 1;" : ""}">${a.earned ? a.icon : 'lock'}</span>`;
                        detailBoardIconContainer.className = `w-9 h-9 rounded-full flex items-center justify-center shrink-0 ${a.earned ? `bg-surface-container-high border ${c.border}` : 'bg-outline-variant/20'}`;
                    };
                    
                    badgeDiv.onmouseenter = updateDetail;
                    badgeDiv.onclick = updateDetail;
                    previewBadgeGrid.appendChild(badgeDiv);
                });

                previewEarnedCount.textContent = earnedCount;

                // Populate Actions CTA
                previewActions.innerHTML = "";
                const rel = user.relationship;

                if (rel === 'accepted') {
                    // Chat Button
                    const chatBtn = document.createElement('button');
                    chatBtn.className = "flex-grow py-2 bg-[#6B3A00] text-white text-xs font-bold rounded-xl hover:bg-[#8B5200] active:scale-95 transition-all shadow flex items-center justify-center gap-1.5";
                    chatBtn.innerHTML = `<span class="material-symbols-outlined text-sm">chat</span>Kirim Pesan`;
                    chatBtn.onclick = () => {
                        closeProfilePreview();
                        openChat(user.id, user.username, user.avatar_url);
                    };
                    previewActions.appendChild(chatBtn);
                } else if (rel === 'pending_sent') {
                    // Sent Request (Disabled)
                    const pendingBtn = document.createElement('button');
                    pendingBtn.disabled = true;
                    pendingBtn.className = "flex-grow py-2 bg-surface-container border border-outline-variant text-on-surface-variant text-xs font-bold rounded-xl flex items-center justify-center gap-1.5 cursor-not-allowed";
                    pendingBtn.innerHTML = `<span class="material-symbols-outlined text-sm">hourglass_empty</span>Permintaan Terkirim`;
                    previewActions.appendChild(pendingBtn);
                } else if (rel === 'pending_received') {
                    // Accept & Decline Buttons
                    const acceptBtn = document.createElement('button');
                    acceptBtn.className = "flex-grow py-2 bg-[#6B3A00] text-white text-xs font-bold rounded-xl hover:bg-[#8B5200] active:scale-95 transition-all shadow flex items-center justify-center gap-1";
                    acceptBtn.innerHTML = `<span class="material-symbols-outlined text-sm">check</span>Terima`;
                    acceptBtn.onclick = () => {
                        acceptFriendRequest(user.id);
                        setTimeout(() => openProfilePreview(user.id), 500);
                    };

                    const declineBtn = document.createElement('button');
                    declineBtn.className = "flex-grow py-2 bg-outline-variant/20 hover:bg-outline-variant/30 text-on-surface-variant text-xs font-bold rounded-xl active:scale-95 transition-all flex items-center justify-center gap-1";
                    declineBtn.innerHTML = `<span class="material-symbols-outlined text-sm">close</span>Tolak`;
                    declineBtn.onclick = () => {
                        declineFriendRequest(user.id);
                        setTimeout(() => openProfilePreview(user.id), 500);
                    };

                    previewActions.appendChild(acceptBtn);
                    previewActions.appendChild(declineBtn);
                } else {
                    // Add Friend Button
                    const addBtn = document.createElement('button');
                    addBtn.className = "flex-grow py-2 bg-[#6B3A00] text-white text-xs font-bold rounded-xl hover:bg-[#8B5200] active:scale-95 transition-all shadow flex items-center justify-center gap-1.5";
                    addBtn.innerHTML = `<span class="material-symbols-outlined text-sm">person_add</span>Tambah Teman`;
                    addBtn.onclick = () => {
                        sendFriendRequest(user.id);
                        setTimeout(() => openProfilePreview(user.id), 500);
                    };
                    previewActions.appendChild(addBtn);
                }
            })
            .catch(() => {
                detailBoardTitle.textContent = "Kesalahan";
                detailBoardDesc.textContent = "Gagal memuat profil karena kendala koneksi.";
            });
    }

    // Close Profile Preview
    function closeProfilePreview() {
        viewProfilePreview.classList.add('hidden');

        if (previousWidgetView === 'chatRoom') {
            viewChatRoom.classList.remove('hidden');
            panelHeaderChat.classList.remove('hidden');
        } else {
            viewFriendList.classList.remove('hidden');
            panelHeaderMain.classList.remove('hidden');
        }

        previousWidgetView = null;
    }

    // Toggle Chat Panel Open/Closed
    function toggleChatPanel() {
        chatPanelOpen = !chatPanelOpen;
        if (chatPanelOpen) {
            chatPanel.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-full', 'sm:translate-y-4', 'sm:scale-95');
            chatPanel.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0', 'sm:translate-y-0', 'sm:scale-100');
            loadFriendsData();
            // Start quick updates polling
            startPolling();
        } else {
            chatPanel.classList.add('opacity-0', 'pointer-events-none', 'translate-y-full', 'sm:translate-y-4', 'sm:scale-95');
            chatPanel.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0', 'sm:translate-y-0', 'sm:scale-100');
            closeChat();
            stopPolling();
        }
    }

    // Toggle panel view programmatically (used externally by sidebar clicks)
    window.openDirectChat = function(friendId, friendName, friendAvatar) {
        if (!chatPanelOpen) {
            toggleChatPanel();
        }
        openChat(friendId, friendName, friendAvatar);
    }

    // Switch view to chat room
    function openChat(friendId, friendName, friendAvatar) {
        activeFriendId = friendId;
        activeFriendName = friendName;
        activeFriendAvatar = friendAvatar || `https://ui-avatars.com/api/?name=${encodeURIComponent(friendName)}&background=8B6914&color=fff`;
        
        // Update header
        panelHeaderMain.classList.add('hidden');
        panelHeaderChat.classList.remove('hidden');
        chatFriendAvatar.src = activeFriendAvatar;
        chatFriendName.textContent = activeFriendName;

        // Switch panel views
        viewFriendList.classList.add('hidden');
        viewChatRoom.classList.remove('hidden');
        
        chatMessages.innerHTML = `<div class="text-center py-8 text-[11px] text-outline">Memuat obrolan...</div>`;
        chatInput.focus();

        // Fetch history
        fetch(`/api/chat/${friendId}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    renderChatHistory(data.messages);
                } else {
                    chatMessages.innerHTML = `<div class="text-center py-8 text-[11px] text-error">${data.message}</div>`;
                }
            })
            .catch(() => {
                chatMessages.innerHTML = `<div class="text-center py-8 text-[11px] text-error">Gagal memuat obrolan.</div>`;
            });
    }

    // Switch view back to Friend List
    function closeChat() {
        activeFriendId = null;
        activeFriendName = "";
        activeFriendAvatar = "";

        panelHeaderChat.classList.add('hidden');
        panelHeaderMain.classList.remove('hidden');
        viewChatRoom.classList.add('hidden');
        viewFriendList.classList.remove('hidden');
        
        chatMessages.innerHTML = "";
        chatInput.value = "";
        
        loadFriendsData();
    }

    // Render Chat History
    function renderChatHistory(messages) {
        chatMessages.innerHTML = "";
        if (messages.length === 0) {
            chatMessages.innerHTML = `<div class="text-center py-12 text-[10px] text-outline font-medium">Belum ada obrolan.<br>Ketik pesan di bawah untuk memulai!</div>`;
            return;
        }

        messages.forEach(m => {
            appendSingleMessage(m);
        });
        scrollToBottom();
    }

    // Append a single message to message box
    function appendSingleMessage(m) {
        const isMe = m.sender_id != activeFriendId;
        const msgDiv = document.createElement('div');
        msgDiv.className = `max-w-[75%] rounded-2xl px-3 py-2 text-xs flex flex-col gap-0.5 ${isMe ? 'self-end chat-bubble-sent rounded-br-none shadow-sm' : 'self-start chat-bubble-received rounded-bl-none shadow'}`;
        
        msgDiv.innerHTML = `
            <p class="leading-relaxed break-words">${escapeHTML(m.message)}</p>
            <span class="text-[8px] self-end opacity-70 mt-0.5 leading-none">${m.time}</span>
        `;
        chatMessages.appendChild(msgDiv);
    }

    // Send chat message
    function sendChatMessage() {
        const text = chatInput.value.trim();
        if (!text || !activeFriendId) return;

        chatInput.value = "";

        fetch(`/api/chat/${activeFriendId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: text })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // If this is the first message, clear the empty state
                if (chatMessages.querySelector('.text-outline')) {
                    chatMessages.innerHTML = "";
                }
                appendSingleMessage(data.message);
                scrollToBottom();
            } else {
                alert(data.message || 'Gagal mengirim pesan.');
            }
        })
        .catch(() => alert('Terjadi kesalahan jaringan. Gagal mengirim pesan.'));
    }

    // Load Friends and Pending Requests
    function loadFriendsData() {
        fetch('/api/friends')
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    renderFriendsList(data.friends);
                    renderPendingRequests(data.pending);
                }
            });
    }

    // Render Friends List
    function renderFriendsList(friends) {
        friendsList.innerHTML = "";
        if (friends.length === 0) {
            friendsListSection.classList.add('hidden');
            friendsEmptyState.classList.remove('hidden');
            return;
        }

        friendsListSection.classList.remove('hidden');
        friendsEmptyState.classList.add('hidden');

        friends.forEach(f => {
            const avatar = f.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(f.username)}&background=8B6914&color=fff`;
            const fItem = document.createElement('div');
            fItem.className = "flex items-center justify-between p-2 hover:bg-surface-container rounded-xl cursor-pointer transition-all duration-150 border border-transparent hover:border-outline-variant/30";
            fItem.onclick = () => openChat(f.id, f.username, f.avatar_url);

            fItem.innerHTML = `
                <div class="flex items-center gap-2.5 min-w-0">
                    <img src="${avatar}" onclick="openProfilePreview(${f.id}, event)" class="w-8 h-8 rounded-full object-cover shrink-0 border border-outline-variant/30 hover:scale-110 active:scale-95 transition-all cursor-pointer" title="Lihat Profil" />
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-on-surface truncate leading-snug">${f.username}</p>
                        <div class="flex items-center gap-2 text-[9px] text-on-surface-variant font-bold leading-none mt-0.5">
                            <span class="flex items-center gap-0.5 text-error">
                                <span class="material-symbols-outlined text-[10px]" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                                ${f.streak}
                            </span>
                            <span class="text-outline">·</span>
                            <span>Level ${f.level}</span>
                        </div>
                    </div>
                </div>
                {{-- User unread count badge --}}
                <div id="unread-badge-${f.id}" class="hidden bg-error text-white text-[8px] font-bold w-4 h-4 rounded-full flex items-center justify-center shrink-0">
                    0
                </div>
            `;
            friendsList.appendChild(fItem);
        });

        // Also update sidebar if we are on home.blade.php
        updateHomeSidebarFriends(friends);
    }

    // Render Pending Requests
    function renderPendingRequests(pending) {
        pendingRequestsList.innerHTML = "";
        if (pending.length === 0) {
            pendingRequestsSection.classList.add('hidden');
            return;
        }

        pendingRequestsSection.classList.remove('hidden');

        pending.forEach(p => {
            const avatar = p.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(p.username)}&background=8B6914&color=fff`;
            const pItem = document.createElement('div');
            pItem.className = "flex items-center justify-between p-2 bg-error/5 border border-error-container/30 rounded-xl";

            pItem.innerHTML = `
                <div class="flex items-center gap-2 min-w-0">
                    <img src="${avatar}" class="w-7 h-7 rounded-full object-cover shrink-0" />
                    <span class="text-xs font-bold text-on-surface truncate">${p.username}</span>
                </div>
                <div class="flex items-center gap-1 shrink-0">
                    <button onclick="acceptFriendRequest(${p.id}, event)" class="bg-[#6B3A00] text-white p-1 rounded-lg hover:bg-[#8B5200] transition-colors flex items-center justify-center" title="Terima">
                        <span class="material-symbols-outlined text-sm">check</span>
                    </button>
                    <button onclick="declineFriendRequest(${p.id}, event)" class="bg-outline-variant/20 hover:bg-outline-variant/40 text-on-surface-variant p-1 rounded-lg transition-colors flex items-center justify-center" title="Tolak">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
            `;
            pendingRequestsList.appendChild(pItem);
        });
    }

    // Add friend / accept / decline actions
    function acceptFriendRequest(friendId, event) {
        if(event) event.stopPropagation();
        fetch('/api/friends/accept', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ friend_id: friendId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadFriendsData();
            } else {
                alert(data.message);
            }
        });
    }

    function declineFriendRequest(friendId, event) {
        if(event) event.stopPropagation();
        if (!confirm('Apakah Anda yakin ingin menolak atau membatalkan pertemanan ini?')) return;
        
        fetch('/api/friends/decline', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ friend_id: friendId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                loadFriendsData();
            } else {
                alert(data.message);
            }
        });
    }

    function sendFriendRequest(friendId, event) {
        if(event) event.stopPropagation();
        fetch('/api/friends/request', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ friend_id: friendId })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                // Refresh search input
                triggerSearch(searchFriendInput.value);
            }
        });
    }

    // Search Friend Trigger
    searchFriendInput.addEventListener('input', () => {
        const query = searchFriendInput.value.trim();
        
        if (searchTimeout) clearTimeout(searchTimeout);
        
        if (query === "") {
            clearSearchBtn.classList.add('hidden');
            searchResultsSection.classList.add('hidden');
            pendingRequestsSection.classList.remove('hidden');
            friendsListSection.classList.remove('hidden');
            loadFriendsData();
            return;
        }

        clearSearchBtn.classList.remove('hidden');
        searchTimeout = setTimeout(() => triggerSearch(query), 300);
    });

    clearSearchBtn.addEventListener('click', () => {
        searchFriendInput.value = "";
        clearSearchBtn.classList.add('hidden');
        searchResultsSection.classList.add('hidden');
        loadFriendsData();
    });

    function triggerSearch(query) {
        fetch(`/api/users/search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    renderSearchResults(data.users);
                }
            });
    }

    // Render Search Results
    function renderSearchResults(users) {
        searchResultsList.innerHTML = "";
        searchResultsSection.classList.remove('hidden');
        
        // Hide standard friends/pending during active search
        friendsListSection.classList.add('hidden');
        pendingRequestsSection.classList.add('hidden');
        friendsEmptyState.classList.add('hidden');

        if (users.length === 0) {
            searchResultsList.innerHTML = `<div class="text-center py-6 text-[10px] text-outline font-medium">Pengguna tidak ditemukan.</div>`;
            return;
        }

        users.forEach(u => {
            const avatar = u.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(u.username)}&background=8B6914&color=fff`;
            const uItem = document.createElement('div');
            uItem.className = "flex items-center justify-between p-2 hover:bg-surface-container rounded-xl border border-transparent transition-all";
            
            let actionBtn = "";
            if (u.status === 'none') {
                actionBtn = `<button onclick="sendFriendRequest(${u.id}, event)" class="bg-[#6B3A00] text-white px-2.5 py-1 rounded-lg hover:bg-[#8B5200] transition-colors text-[9px] font-bold">Add</button>`;
            } else if (u.status === 'pending_sent') {
                actionBtn = `<span class="text-[9px] font-bold text-outline bg-surface-container px-2.5 py-1 rounded-lg">Pending</span>`;
            } else if (u.status === 'pending_received') {
                actionBtn = `<button onclick="acceptFriendRequest(${u.id}, event)" class="bg-error text-white px-2.5 py-1 rounded-lg hover:bg-error-container transition-colors text-[9px] font-bold">Accept</button>`;
            } else if (u.status === 'accepted') {
                actionBtn = `<span class="material-symbols-outlined text-primary text-base" title="Berteman">check_circle</span>`;
            }

            uItem.innerHTML = `
                <div class="flex items-center gap-2.5 min-w-0">
                    <img src="${avatar}" onclick="openProfilePreview(${u.id}, event)" class="w-8 h-8 rounded-full object-cover shrink-0 hover:scale-110 active:scale-95 transition-all cursor-pointer" title="Lihat Profil" />
                    <span class="text-xs font-bold text-on-surface truncate cursor-pointer hover:underline" onclick="openProfilePreview(${u.id}, event)" title="Lihat Profil">${u.username}</span>
                </div>
                <div class="shrink-0">
                    ${actionBtn}
                </div>
            `;
            searchResultsList.appendChild(uItem);
        });
    }

    // Polling Real-Time Updates
    function startPolling() {
        if (pollingIntervalId) clearInterval(pollingIntervalId);
        
        // Execute once immediately
        checkUpdates();
        
        pollingIntervalId = setInterval(checkUpdates, 3000); // Poll every 3 seconds
    }

    function stopPolling() {
        if (pollingIntervalId) {
            clearInterval(pollingIntervalId);
            pollingIntervalId = null;
        }
    }

    function checkUpdates() {
        let url = '/api/chat/updates';
        if (activeFriendId) {
            url += `?active_friend_id=${activeFriendId}`;
        }

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update global FAB badge
                    if (data.unread_total > 0) {
                        globalChatBadge.textContent = data.unread_total;
                        globalChatBadge.classList.remove('hidden');
                    } else {
                        globalChatBadge.classList.add('hidden');
                    }

                    // If active chat is open, append new incoming messages
                    if (activeFriendId && data.new_messages && data.new_messages.length > 0) {
                        // Clear memuat obrolan / empty state if it's there
                        if (chatMessages.querySelector('.text-outline')) {
                            chatMessages.innerHTML = "";
                        }
                        data.new_messages.forEach(m => {
                            appendSingleMessage(m);
                        });
                        scrollToBottom();
                    }

                    // Update badges next to friend items in the view list
                    document.querySelectorAll('[id^="unread-badge-"]').forEach(badge => {
                        const id = badge.id.split('unread-badge-')[1];
                        const count = data.active_chats[id] || 0;
                        if (count > 0 && id != activeFriendId) {
                            badge.textContent = count;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    });
                }
            })
            .catch(() => {
                console.log('Polling connection failed.');
            });
    }

    // Helper: Scroll chat box to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Helper: Escape HTML strings to prevent XSS
    function escapeHTML(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Helper: Update friend list in Home Sidebar (if sidebar exists)
    function updateHomeSidebarFriends(friends) {
        const sidebarFriendsContainer = document.getElementById('sidebarFriendsList');
        if (!sidebarFriendsContainer) return;

        sidebarFriendsContainer.innerHTML = "";
        
        if (friends.length === 0) {
            sidebarFriendsContainer.innerHTML = `
                <div class="text-center py-6">
                    <span class="material-symbols-outlined text-2xl text-outline-variant">people</span>
                    <p class="text-[10px] text-on-surface-variant font-medium mt-1">Belum memiliki teman.<br>Tambah lewat ikon chat di kanan bawah!</p>
                </div>
            `;
            return;
        }

        // Display up to 5 friends in the sidebar card
        friends.slice(0, 5).forEach(f => {
            const avatar = f.avatar_url || `https://ui-avatars.com/api/?name=${encodeURIComponent(f.username)}&background=8B6914&color=fff`;
            const item = document.createElement('div');
            item.className = "flex items-center justify-between p-2 hover:bg-surface-container rounded-xl cursor-pointer transition-all border border-transparent hover:border-outline-variant/30";
            item.onclick = () => window.openDirectChat(f.id, f.username, f.avatar_url);

            item.innerHTML = `
                <div class="flex items-center gap-2 min-w-0">
                    <img src="${avatar}" class="w-7.5 h-7.5 rounded-full object-cover shrink-0 border border-outline-variant/20" />
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-on-surface truncate leading-snug">${f.username}</p>
                        <p class="text-[9px] text-on-surface-variant font-medium leading-none mt-0.5">XP: ${f.points}</p>
                    </div>
                </div>
                <span class="material-symbols-outlined text-[#6B3A00] text-base opacity-0 group-hover:opacity-100 transition-opacity">chat</span>
            `;
            sidebarFriendsContainer.appendChild(item);
        });

        if (friends.length > 5) {
            const moreDiv = document.createElement('div');
            moreDiv.className = "text-center pt-2 border-t border-outline-variant/40";
            moreDiv.innerHTML = `
                <button onclick="toggleChatPanel()" class="text-[9px] font-bold text-primary hover:underline uppercase tracking-wider">
                    Lihat ${friends.length - 5} Teman Lainnya
                </button>
            `;
            sidebarFriendsContainer.appendChild(moreDiv);
        }
    }

    // Start polling automatically on page load to update global FAB unread badge
    document.addEventListener('DOMContentLoaded', () => {
        checkUpdates();
        setInterval(checkUpdates, 5000); // slow global background poll (5s) when panel is closed
    });
</script>

