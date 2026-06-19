<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $level->title }} — AksaraLoka</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Noto+Sans+Javanese:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css'])
</head>
<body class="bg-surface text-on-surface font-sans min-h-screen flex flex-col justify-between selection:bg-primary-fixed">

    <!-- Top Navigation Bar -->
    <header class="w-full max-w-5xl mx-auto px-6 py-6 flex items-center justify-between gap-6">
        <!-- Close Button -->
        <a href="{{ route('home') }}" class="p-2 rounded-full text-on-surface-variant hover:bg-surface-container-high transition-colors flex-shrink-0" id="btn-close">
            <span class="material-symbols-outlined text-2xl font-bold">close</span>
        </a>

        <!-- Progress Bar Track -->
        <div class="flex-grow h-4 bg-surface-container-highest rounded-full overflow-hidden border border-outline-variant shadow-inner p-0.5">
            <div id="progress-bar" class="h-full bg-primary rounded-full transition-all duration-500 ease-out" style="width: 0%"></div>
        </div>

        <!-- Streak Stats -->
        <div class="flex items-center gap-1.5 bg-secondary-container/30 px-3.5 py-1.5 rounded-full text-sm font-extrabold text-secondary border border-secondary/20 shadow-sm flex-shrink-0">
            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
            <span>{{ Auth::user()->streak_count ?? 0 }}</span>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow flex items-center justify-center py-8 w-full max-w-4xl mx-auto px-6">
        <!-- Question Screen Container -->
        <div id="question-container" class="w-full flex flex-col gap-8 transition-opacity duration-300">
            <!-- Instructions and Question Card -->
            <div class="bg-surface-container-lowest p-8 rounded-3xl border border-outline-variant shadow-sm tactile-card">
                <span class="text-[10px] font-extrabold text-primary uppercase tracking-widest" id="question-meta">UNIT 1, BAGIAN 1</span>
                <h2 class="font-headline text-3xl font-bold text-on-surface mt-2" id="question-title">Kosakata</h2>
                <p class="text-sm font-medium text-on-surface-variant mt-2 border-l-4 border-primary pl-3" id="question-instruction">
                    Ubah kata pada soal menjadi Basa Ngoko atau Bahasa Indonesia
                </p>
                <div class="mt-8 text-center py-6 bg-surface-container-low rounded-2xl border border-surface-container-high">
                    <p class="font-headline text-4xl font-extrabold text-on-surface tracking-wide" id="question-text">Makan</p>
                </div>
            </div>

            <!-- Choice Grid Container -->
            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-4 ml-1">Pilih jawaban yang benar:</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="choices-grid">
                    <!-- Template Choice Button (Generated Dynamically) -->
                    <button class="tactile-button bg-white text-on-surface p-5 rounded-2xl border-2 border-surface-container-highest text-center font-bold hover:bg-surface-container-low cursor-pointer transition-all text-base min-h-[72px] flex items-center justify-center">
                        Mangan
                    </button>
                </div>
            </div>
        </div>

        <!-- Success/Completion Screen Container (Hidden initially) -->
        <div id="completion-container" class="hidden w-full max-w-md bg-surface-container-lowest p-10 rounded-[2.5rem] border border-outline-variant shadow-2xl tactile-card text-center flex flex-col items-center gap-6 animate-float-up">
            <!-- Animated Trophy Circle -->
            <div class="w-24 h-24 bg-secondary-container/40 text-secondary rounded-full flex items-center justify-center border-4 border-secondary/20 shadow-md animate-bob">
                <span class="material-symbols-outlined text-[64px]" style="font-variation-settings: 'FILL' 1;">trophy</span>
            </div>

            <div class="space-y-2">
                <h2 class="font-headline text-3xl font-extrabold text-on-surface">Level Selesai! 🎉</h2>
                <p class="text-sm font-medium text-on-surface-variant">Luar biasa! Kamu berhasil menyelesaikan tantangan level ini.</p>
            </div>

            <!-- Rewards Cards -->
            <div class="grid grid-cols-2 gap-4 w-full mt-4">
                <!-- XP Earned Card -->
                <div class="bg-primary/5 border border-primary/20 rounded-2xl p-4 flex flex-col items-center shadow-inner">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">stars</span>
                    <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mt-2">XP Didapatkan</span>
                    <span class="text-xl font-headline font-extrabold text-primary mt-1" id="lbl-xp-earned">+{{ $level->xp_reward }} XP</span>
                    <span class="text-[10px] text-on-surface-variant mt-1 hidden" id="lbl-multiplier"></span>
                </div>
                <!-- Streak Card -->
                <div class="bg-secondary/5 border border-secondary/20 rounded-2xl p-4 flex flex-col items-center shadow-inner">
                    <span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                    <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mt-2" id="lbl-streak-label">Streak</span>
                    <span class="text-xl font-headline font-extrabold text-secondary mt-1" id="lbl-new-streak">{{ Auth::user()->streak_count ?? 0 }} Hari</span>
                </div>
            </div>

            <!-- Finish Button -->
            <button id="btn-finish" class="w-full py-4 mt-6 bg-primary text-on-primary font-bold rounded-2xl tactile-button flex items-center justify-center gap-2 hover:scale-[1.01] transition-transform">
                Selesai & Simpan
                <span class="material-symbols-outlined font-bold">arrow_forward</span>
            </button>
        </div>
    </main>

    <!-- Bottom Action Bar / Feedback Banner -->
    <footer class="w-full bg-surface-container-lowest border-t-2 border-surface-container-high py-8 transition-colors duration-300" id="feedback-footer">
        <div class="max-w-4xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6" id="footer-inner">
            <!-- Left Info Panel (For correctness details, hidden initially) -->
            <div class="flex items-center gap-4 hidden" id="feedback-info">
                <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0" id="feedback-icon-container">
                    <span class="material-symbols-outlined text-3xl font-extrabold" id="feedback-icon">check</span>
                </div>
                <div>
                    <h3 class="font-headline text-lg font-bold" id="feedback-title">Benar!</h3>
                    <p class="text-sm font-medium" id="feedback-desc">Jawaban kamu tepat sekali.</p>
                </div>
            </div>

            <!-- Right Buttons Panel -->
            <div class="flex items-center gap-4 w-full md:w-auto ml-auto">
                <button id="btn-skip" class="px-6 py-4 bg-transparent text-on-surface-variant font-bold hover:text-on-surface transition-all text-sm uppercase tracking-wider">
                    Lewati
                </button>
                <button id="btn-action" class="flex-grow md:flex-grow-0 px-10 py-4 bg-secondary text-white font-bold rounded-2xl border-b-[4px] border-[#5a4200] active:translate-y-[2px] active:border-b-[2px] transition-all text-sm uppercase tracking-wider flex items-center justify-center" disabled>
                    Periksa
                </button>
            </div>
        </div>
    </footer>

    <!-- Pass backend data to JS -->
    <script>
        const LEVEL_DATA = {
            id: @json($level->id),
            title: @json($level->title),
            chapterTitle: @json($level->subChapter->chapter->title ?? 'Unit 1'),
            subChapterOrder: @json($level->subChapter->order_index ?? 1),
            questions: @json($level->questions->load('options')),
            completeRoute: @json(route('level.complete', $level->id)),
            redirectUrl: @json(route('home'))
        };
    </script>

    <!-- Frontend Interactive Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentQuestionIndex = 0;
            let selectedOptionId = null;
            let selectedOptionText = '';
            let currentCorrectOption = null;
            let isAnswerChecked = false;
            let correctCount = 0;

            const progressBar = document.getElementById('progress-bar');
            const questionMeta = document.getElementById('question-meta');
            const questionTitle = document.getElementById('question-title');
            const questionInstruction = document.getElementById('question-instruction');
            const questionText = document.getElementById('question-text');
            const choicesGrid = document.getElementById('choices-grid');
            
            const feedbackFooter = document.getElementById('feedback-footer');
            const feedbackInfo = document.getElementById('feedback-info');
            const feedbackIconContainer = document.getElementById('feedback-icon-container');
            const feedbackIcon = document.getElementById('feedback-icon');
            const feedbackTitle = document.getElementById('feedback-title');
            const feedbackDesc = document.getElementById('feedback-desc');
            
            const btnSkip = document.getElementById('btn-skip');
            const btnAction = document.getElementById('btn-action');
            
            const questionContainer = document.getElementById('question-container');
            const completionContainer = document.getElementById('completion-container');
            const btnFinish = document.getElementById('btn-finish');
            const lblNewStreak = document.getElementById('lbl-new-streak');

            // Initialize level questions
            const questions = LEVEL_DATA.questions;
            if (!questions || questions.length === 0) {
                alert('Tingkat ini tidak memiliki pertanyaan.');
                window.location.href = LEVEL_DATA.redirectUrl;
                return;
            }

            // Shuffle questions to make it feel fresh
            questions.sort(() => Math.random() - 0.5);

            function updateProgressBar() {
                const percentage = (currentQuestionIndex / questions.length) * 100;
                progressBar.style.width = percentage + '%';
            }

            function loadQuestion() {
                isAnswerChecked = false;
                selectedOptionId = null;
                selectedOptionText = '';
                
                // Reset Footer styles
                feedbackFooter.className = 'w-full bg-surface-container-lowest border-t-2 border-surface-container-high py-8 transition-colors duration-300';
                feedbackInfo.classList.add('hidden');
                
                // Reset Buttons
                btnSkip.classList.remove('hidden');
                btnAction.disabled = true;
                btnAction.textContent = 'Periksa';
                btnAction.className = 'flex-grow md:flex-grow-0 px-10 py-4 bg-secondary text-white font-bold rounded-2xl border-b-[4px] border-[#5a4200] active:translate-y-[2px] active:border-b-[2px] cursor-not-allowed opacity-50 transition-all text-sm uppercase tracking-wider flex items-center justify-center';

                const question = questions[currentQuestionIndex];
                
                // Update text details
                questionMeta.textContent = `${LEVEL_DATA.chapterTitle.toUpperCase()}, LEVEL ${LEVEL_DATA.subChapterOrder}`;
                questionTitle.textContent = LEVEL_DATA.title;
                questionInstruction.textContent = question.instruction;
                questionText.textContent = question.question_text;

                // Render options
                choicesGrid.innerHTML = '';
                
                // Find correct option for later validation
                currentCorrectOption = question.options.find(o => o.is_correct === 1 || o.is_correct === true || o.is_correct === '1');

                // Shuffle options
                const shuffledOptions = [...question.options].sort(() => Math.random() - 0.5);

                shuffledOptions.forEach((option) => {
                    const btn = document.createElement('button');
                    btn.className = 'tactile-button bg-white text-on-surface p-5 rounded-2xl border-2 border-surface-container-highest hover:bg-surface-container-low cursor-pointer transition-all text-base min-h-[72px] flex items-center justify-center font-bold';
                    btn.textContent = option.option_text;
                    btn.addEventListener('click', () => {
                        if (isAnswerChecked) return;
                        selectOption(btn, option);
                    });
                    choicesGrid.appendChild(btn);
                });

                updateProgressBar();
            }

            function selectOption(buttonEl, option) {
                // Remove selected class from all buttons
                Array.from(choicesGrid.children).forEach(btn => {
                    btn.className = 'tactile-button bg-white text-on-surface p-5 rounded-2xl border-2 border-surface-container-highest hover:bg-surface-container-low cursor-pointer transition-all text-base min-h-[72px] flex items-center justify-center font-bold';
                });

                // Apply selected class to this button
                buttonEl.className = 'tactile-button bg-primary/5 text-primary p-5 rounded-2xl border-2 border-primary scale-[1.01] text-center font-extrabold cursor-pointer transition-all text-base min-h-[72px] flex items-center justify-center shadow-sm';
                
                selectedOptionId = option.id;
                selectedOptionText = option.option_text;

                // Enable action button
                btnAction.disabled = false;
                btnAction.className = 'flex-grow md:flex-grow-0 px-10 py-4 bg-secondary text-white font-bold rounded-2xl border-b-[4px] border-[#5a4200] active:translate-y-[2px] active:border-b-[2px] cursor-pointer hover:scale-[1.02] transition-all text-sm uppercase tracking-wider flex items-center justify-center';
            }

            function checkAnswer() {
                if (isAnswerChecked) {
                    // Go to next question
                    currentQuestionIndex++;
                    if (currentQuestionIndex < questions.length) {
                        loadQuestion();
                    } else {
                        showCompletionScreen();
                    }
                    return;
                }

                isAnswerChecked = true;
                btnSkip.classList.add('hidden');
                
                const isCorrect = currentCorrectOption && (selectedOptionId === currentCorrectOption.id);

                if (isCorrect) {
                    correctCount++;
                    // Show correct feedback
                    feedbackFooter.className = 'w-full bg-green-50 border-t-2 border-green-200 py-8 transition-colors duration-300 text-green-800';
                    feedbackIconContainer.className = 'w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm animate-bounce';
                    feedbackIcon.textContent = 'check';
                    feedbackTitle.textContent = 'Luar Biasa! 🎉';
                    feedbackDesc.textContent = 'Jawaban kamu benar dan sangat tepat.';
                    
                    btnAction.textContent = 'Lanjut';
                    btnAction.className = 'flex-grow md:flex-grow-0 px-10 py-4 bg-green-600 text-white font-bold rounded-2xl border-b-[4px] border-[#1b4332] active:translate-y-[2px] active:border-b-[2px] hover:bg-green-700 transition-all text-sm uppercase tracking-wider flex items-center justify-center';
                } else {
                    // Show incorrect feedback
                    feedbackFooter.className = 'w-full bg-red-50 border-t-2 border-red-200 py-8 transition-colors duration-300 text-red-800';
                    feedbackIconContainer.className = 'w-12 h-12 rounded-full bg-red-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm';
                    feedbackIcon.textContent = 'close';
                    feedbackTitle.textContent = 'Kurang Tepat 😢';
                    feedbackDesc.innerHTML = `Jawaban yang benar adalah: <strong>${currentCorrectOption ? currentCorrectOption.option_text : ''}</strong>`;
                    
                    btnAction.textContent = 'Lanjut';
                    btnAction.className = 'flex-grow md:flex-grow-0 px-10 py-4 bg-red-600 text-white font-bold rounded-2xl border-b-[4px] border-[#5c1d24] active:translate-y-[2px] active:border-b-[2px] hover:bg-red-700 transition-all text-sm uppercase tracking-wider flex items-center justify-center';
                }

                feedbackInfo.classList.remove('hidden');
            }

            function skipQuestion() {
                isAnswerChecked = true;
                btnSkip.classList.add('hidden');
                
                // Treat skip as incorrect and display correct answer
                feedbackFooter.className = 'w-full bg-red-50 border-t-2 border-red-200 py-8 transition-colors duration-300 text-red-800';
                feedbackIconContainer.className = 'w-12 h-12 rounded-full bg-amber-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm';
                feedbackIcon.textContent = 'info';
                feedbackTitle.textContent = 'Dilewati ⚠️';
                feedbackDesc.innerHTML = `Jawaban yang benar adalah: <strong>${currentCorrectOption ? currentCorrectOption.option_text : ''}</strong>`;
                
                btnAction.textContent = 'Lanjut';
                btnAction.disabled = false;
                btnAction.className = 'flex-grow md:flex-grow-0 px-10 py-4 bg-red-600 text-white font-bold rounded-2xl border-b-[4px] border-[#5c1d24] active:translate-y-[2px] active:border-b-[2px] hover:bg-red-700 transition-all text-sm uppercase tracking-wider flex items-center justify-center';
                
                feedbackInfo.classList.remove('hidden');
            }

            function showCompletionScreen() {
                updateProgressBar();
                // Set progress bar to full at the end
                progressBar.style.width = '100%';

                // Hide questions
                questionContainer.classList.add('hidden');
                
                // Show completion
                completionContainer.classList.remove('hidden');
                completionContainer.classList.add('flex');

                // Adjust bottom bar
                feedbackFooter.classList.add('hidden');
            }

            async function saveProgressAndClose() {
                const btnFinish = document.getElementById('btn-finish');
                btnFinish.disabled = true;
                btnFinish.innerHTML = '<span class="animate-spin inline-block mr-2">⏳</span> Menyimpan...';

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch(LEVEL_DATA.completeRoute, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token }
                    });
                    const data = await response.json();

                    if (data.success) {
                        // ── Update XP card ──────────────────────────────────
                        const lblXp = document.getElementById('lbl-xp-earned');
                        const lblMult = document.getElementById('lbl-multiplier');
                        if (data.already_done) {
                            lblXp.textContent = '+0 XP';
                            lblXp.classList.add('text-on-surface-variant');
                            lblMult.textContent = 'Level ini sudah pernah diselesaikan';
                            lblMult.classList.remove('hidden');
                        } else {
                            lblXp.textContent = `+${data.xp_earned} XP`;
                            if (data.multiplier > 1.0) {
                                lblMult.textContent = `🔥 Bonus streak ${data.multiplier}×`;
                                lblMult.classList.remove('hidden');
                            }
                        }

                        // ── Update streak card ──────────────────────────────
                        const lblStreak = document.getElementById('lbl-new-streak');
                        const lblStreakLabel = document.getElementById('lbl-streak-label');
                        lblStreak.textContent = `${data.new_streak} Hari`;
                        if (data.streak_broken) {
                            lblStreakLabel.textContent = 'Streak Reset 💔';
                            lblStreak.classList.add('text-red-500');
                        } else if (data.streak_changed) {
                            lblStreakLabel.textContent = `🔥 Streak +1!`;
                        } else {
                            lblStreakLabel.textContent = 'Streak (sudah aktif hari ini)';
                        }

                        // ── XP_CONFIG — threshold naik level user ───────────
                        const XP_CONFIG = { baseXP: 300, increment: 200, maxLevel: 50 };
                        function xpForLevel(n) {
                            return XP_CONFIG.baseXP + (n - 1) * XP_CONFIG.increment;
                        }
                        function getUserLevel(totalXp) {
                            let lvl = 1, cumulative = 0;
                            while (lvl < XP_CONFIG.maxLevel) {
                                cumulative += xpForLevel(lvl);
                                if (totalXp < cumulative) break;
                                lvl++;
                            }
                            return lvl;
                        }

                        // Deteksi level-up (bandingkan XP sebelum vs sesudah)
                        const xpBefore = data.new_xp - data.xp_earned;
                        const lvlBefore = getUserLevel(xpBefore);
                        const lvlAfter  = getUserLevel(data.new_xp);
                        if (lvlAfter > lvlBefore && !data.already_done) {
                            showLevelUpToast(lvlAfter);
                        }

                        // Redirect setelah 2s
                        setTimeout(() => { window.location.href = LEVEL_DATA.redirectUrl; }, 2200);
                    } else {
                        window.location.href = LEVEL_DATA.redirectUrl;
                    }
                } catch (err) {
                    console.error('Error saving progress:', err);
                    window.location.href = LEVEL_DATA.redirectUrl;
                }
            }

            function showLevelUpToast(newLevel) {
                const toast = document.createElement('div');
                toast.style.cssText = [
                    'position:fixed;top:1.5rem;left:50%;transform:translateX(-50%) translateY(-120%)',
                    'background:linear-gradient(135deg,#f4d7a1,#6b3f00)',
                    'color:#fff;padding:0.9rem 1.5rem;border-radius:1rem',
                    'font-family:Lexend,sans-serif;font-weight:700;font-size:1rem',
                    'box-shadow:0 8px 32px rgba(107,63,0,0.35)',
                    'display:flex;align-items:center;gap:0.6rem',
                    'transition:transform 0.5s cubic-bezier(0.34,1.56,0.64,1);z-index:9999',
                ].join(';');
                toast.innerHTML = `<span style="font-size:1.5rem">🎉</span> Selamat! Kamu naik ke Level <strong>${newLevel}</strong>!`;
                document.body.appendChild(toast);
                requestAnimationFrame(() => {
                    toast.style.transform = 'translateX(-50%) translateY(0)';
                });
                setTimeout(() => {
                    toast.style.transform = 'translateX(-50%) translateY(-120%)';
                    setTimeout(() => toast.remove(), 600);
                }, 3500);
            }

            // Bind click events
            btnAction.addEventListener('click', checkAnswer);
            btnSkip.addEventListener('click', skipQuestion);
            btnFinish.addEventListener('click', saveProgressAndClose);

            // Load first question
            loadQuestion();
        });
    </script>
</body>
</html>

