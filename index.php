<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charitale 2K26</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,6..72,400&display=swap" rel="stylesheet">
    
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brandPink: '#F3799F', pinkLight: '#FFD9DA',
                        brandPurple: '#7131B5', purpleLight: '#FF7FDF',
                        brandOrange: '#F06C2E', brandYellow: '#FFBB01',
                        bgLight: '#fbfbfd', bgDark: '#0a0a0c',
                        textMainLight: '#1e293b', textMutedLight: '#64748b',
                    },
                    fontFamily: {
                        heading: ['Transcity', 'sans-serif'], 
                        body: ['Newsreader', 'serif']
                    }
                }
            }
        }
    </script>
    <style>
        body { transition: background-color 0.5s ease, color 0.5s ease; }
        
        .spotlight-card { 
            position: relative;
            backdrop-filter: blur(40px); -webkit-backdrop-filter: blur(40px);
            overflow: visible; transition: background-color 0.5s ease, border-color 0.5s ease, box-shadow 0.5s ease;
            background: rgba(255, 255, 255, 0.7); border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 20px 40px rgba(0,0,0, 0.05), 0 1px 3px rgba(0,0,0, 0.02);
        }
        .dark .spotlight-card {
            background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 30px 60px rgba(0,0,0, 0.5);
        }

        .spotlight-card::before {
            content: ""; position: absolute; inset: 0; border-radius: inherit; z-index: 0; pointer-events: none; transition: opacity 0.5s; opacity: 0;
            background: radial-gradient(800px circle at var(--mouse-x) var(--mouse-y), rgba(113, 49, 181, 0.04), transparent 40%);
        }
        .dark .spotlight-card::before { background: radial-gradient(600px circle at var(--mouse-x) var(--mouse-y), rgba(255, 187, 1, 0.08), transparent 40%); }
        .spotlight-card:hover::before { opacity: 1; }

        .noise-bg { mix-blend-mode: multiply; opacity: 0.02; transition: opacity 0.5s; }
        .dark .noise-bg { mix-blend-mode: overlay; opacity: 0.04; }

        .mask-container { overflow: hidden; display: block; }
        .mask-up { display: block; transform: translateY(110%); animation: slideUp 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes slideUp { to { transform: translateY(0); } }
        
        .fade-in { animation: fadeIn 1.2s ease-out forwards; opacity: 0; }
        @keyframes fadeIn { to { opacity: 1; } }
        .delay-1 { animation-delay: 0.1s; } .delay-2 { animation-delay: 0.2s; } .delay-3 { animation-delay: 0.3s; }
        
        .grow-line { animation: growRight 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; width: 0; }
        @keyframes growRight { to { width: 30%; } }
        
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); }

        .image-blend { -webkit-mask-image: linear-gradient(to bottom, black 70%, transparent 100%); mask-image: linear-gradient(to bottom, black 70%, transparent 100%); }
        .dark .image-blend { mix-blend-mode: lighten; -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%); mask-image: linear-gradient(to bottom, black 60%, transparent 100%); }
    </style>
</head>
<body class="bg-bgLight dark:bg-bgDark text-textMainLight dark:text-white font-body overflow-x-hidden flex items-center selection:bg-brandPink dark:selection:bg-brandYellow selection:text-white dark:selection:text-bgDark relative transition-colors duration-500 min-h-screen">

    <!-- Theme Toggle -->
    <button onclick="toggleTheme()" class="fixed top-6 right-6 md:top-10 md:right-10 z-[100] w-12 h-12 rounded-full bg-white/50 dark:bg-black/30 backdrop-blur-md border border-slate-200 dark:border-white/10 flex items-center justify-center shadow-lg hover:scale-110 transition-all duration-300 text-textMainLight dark:text-brandYellow group">
        <svg class="w-6 h-6 hidden dark:block group-hover:rotate-45 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        <svg class="w-5 h-5 block dark:hidden group-hover:-rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
    </button>

    <div class="pointer-events-none fixed inset-0 z-50 noise-bg">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"><filter id="noiseFilter"><feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/></filter><rect width="100%" height="100%" filter="url(#noiseFilter)"/></svg>
    </div>

    <!-- Ambient Glow -->
    <div class="fixed top-[-5%] left-[-10%] w-[300px] md:w-[60vw] h-[300px] md:h-[60vh] bg-brandPink dark:bg-brandPurple rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] md:blur-[180px] opacity-20 dark:opacity-30 animate-pulse pointer-events-none transition-colors duration-700"></div>
    <div class="fixed bottom-[-5%] right-[-10%] w-[350px] md:w-[70vw] h-[350px] md:h-[70vh] bg-brandOrange dark:bg-brandPink rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] md:blur-[200px] opacity-15 dark:opacity-20 pointer-events-none transition-colors duration-700"></div>
    
    <!-- View: Landing Page -->
    <div id="view-home" class="relative w-full px-6 md:px-16 lg:px-24 py-10 md:py-12 min-h-screen flex items-center justify-center">
        <div class="relative z-10 w-full max-w-6xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-16 pt-8 lg:pt-0">
            <div class="lg:w-1/2 flex flex-col justify-center text-center lg:text-left items-center lg:items-start">
                <div class="mask-container mb-3 md:mb-4"><p class="mask-up font-body italic text-lg md:text-2xl text-brandPurple dark:text-pinkLight tracking-wide font-medium dark:font-light transition-colors">Change the life, Change the world</p></div>
                
                <h1 class="font-heading text-5xl sm:text-6xl md:text-8xl lg:text-[110px] font-bold leading-[0.9] tracking-tighter mb-6 md:mb-8 text-textMainLight dark:text-white drop-shadow-sm dark:drop-shadow-2xl flex flex-col transition-colors">
                    <span class="mask-container"><span class="mask-up">Every Good</span></span>
                    <span class="mask-container"><span class="mask-up delay-1">Act Is A</span></span>
                    <span class="mask-container"><span class="mask-up delay-2">Charity.</span></span>
                </h1>
                
                <div class="w-full max-w-[200px] lg:max-w-xs h-[2px] dark:h-[1px] bg-slate-200 dark:bg-white/10 mb-8 md:mb-10 flex rounded-full overflow-hidden fade-in delay-2 transition-all">
                    <div class="h-full bg-gradient-to-r from-brandOrange to-brandPink dark:from-brandYellow dark:to-brandOrange grow-line shadow-none dark:shadow-[0_0_15px_#FFBB01]"></div>
                </div>
                
                <div class="mask-container mb-10 md:mb-12 max-w-md"><p class="mask-up delay-2 font-body text-base md:text-xl text-textMutedLight dark:text-white/60 leading-relaxed font-normal dark:font-light transition-colors">Charitale 2K26. Join us in our race to make a difference. Veniam quis nostrud exercitation sed ullamco laboris.</p></div>
                
                <div class="flex flex-col sm:flex-row flex-wrap gap-4 w-full sm:w-auto relative z-20 fade-in delay-3">
                    <button onclick="switchView('view-donate')" class="relative overflow-hidden w-full sm:w-auto justify-center bg-brandOrange dark:bg-brandYellow text-white dark:text-bgDark font-bold py-4 px-10 rounded-full flex items-center gap-3 text-[11px] tracking-[0.2em] uppercase hover:-translate-y-1 hover:shadow-lg dark:hover:shadow-[0_10px_30px_rgba(255,187,1,0.25)] transition-all duration-300">
                        Donasi Sekarang
                    </button>
                    <button onclick="switchView('view-monitor')" class="w-full sm:w-auto justify-center bg-white dark:bg-transparent border border-slate-200 dark:border-white/20 text-textMainLight dark:text-white font-bold py-4 px-10 rounded-full flex items-center gap-3 hover:border-brandPurple hover:text-brandPurple dark:hover:bg-white/5 dark:hover:border-white/40 text-[11px] tracking-[0.2em] uppercase transition-all shadow-sm hover:-translate-y-1">
                        Klasemen Donasi
                    </button>
                </div>
            </div>
            
            <div class="lg:w-1/2 flex justify-center items-center fade-in delay-2 relative w-full h-[350px] sm:h-[400px] lg:h-[500px] mt-8 lg:mt-0 pointer-events-none">
                <img src="logo.png" alt="Charity Silhouette" id="parallaxImg" class="w-full max-w-[280px] sm:max-w-sm lg:max-w-md object-contain opacity-90 dark:opacity-80 image-blend transition-transform duration-700 ease-out">
            </div>
        </div>
    </div>

    <!-- View: Donation Form (STEP 1) -->
    <div id="view-donate" class="hidden w-full max-w-md mx-auto spotlight-card p-6 md:p-10 rounded-[2rem] fade-in relative z-20 my-10">
        <div class="relative z-20">
            <h2 class="font-heading text-3xl md:text-4xl font-semibold mb-6 md:mb-8 text-center tracking-tight text-textMainLight dark:text-white/90 transition-colors">Support the Cause</h2>
            
            <form id="donateFormStep1" onsubmit="proceedToPayment(event)" class="space-y-5 md:space-y-6">
                <div>
                    <label class="block mb-2 text-[10px] uppercase tracking-[0.2em] text-textMutedLight dark:text-white/50 font-bold dark:font-semibold transition-colors">Nama Lengkap</label>
                    <input type="text" id="name" required class="w-full p-3 md:p-4 rounded-xl md:rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-textMainLight dark:text-white placeholder-slate-400 dark:placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-brandPurple/20 dark:focus:ring-brandYellow/20 focus:border-brandPurple dark:focus:border-brandYellow transition-all duration-300 text-sm shadow-sm dark:shadow-none font-normal dark:font-light">
                </div>
                
                <div class="relative" id="customDropdown">
                    <label class="block mb-2 text-[10px] uppercase tracking-[0.2em] text-textMutedLight dark:text-white/50 font-bold dark:font-semibold transition-colors">Angkatan</label>
                    <input type="hidden" id="angkatan" required>
                    <button type="button" id="dropdownBtn" class="w-full p-3 md:p-4 rounded-xl md:rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-400 dark:text-white/40 focus:outline-none focus:ring-2 focus:ring-brandPurple/20 dark:focus:ring-brandYellow/20 focus:border-brandPurple dark:focus:border-brandYellow transition-all duration-300 text-sm flex justify-between items-center text-left shadow-sm dark:shadow-none font-normal dark:font-light">
                        <span id="dropdownText">Pilih Angkatan...</span>
                        <svg class="w-4 h-4 text-slate-400 dark:text-white/50 transition-transform duration-300" id="dropdownIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="dropdownMenu" class="absolute z-[100] w-full mt-2 rounded-xl md:rounded-2xl bg-white dark:bg-[#121214] border border-slate-100 dark:border-white/10 shadow-xl dark:shadow-2xl opacity-0 invisible transform -translate-y-2 transition-all duration-300 overflow-hidden">
                        <div class="p-2 space-y-1">
                            <div class="dropdown-option p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-white/10 hover:text-brandPurple dark:hover:text-brandYellow text-textMainLight dark:text-white/90 text-sm cursor-pointer transition-colors font-normal dark:font-light" data-value="MB13">MB13</div>
                            <div class="dropdown-option p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-white/10 hover:text-brandPurple dark:hover:text-brandYellow text-textMainLight dark:text-white/90 text-sm cursor-pointer transition-colors font-normal dark:font-light" data-value="MB14">MB14</div>
                            <div class="dropdown-option p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-white/10 hover:text-brandPurple dark:hover:text-brandYellow text-textMainLight dark:text-white/90 text-sm cursor-pointer transition-colors font-normal dark:font-light" data-value="MB 2025">MB 2025</div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-[10px] uppercase tracking-[0.2em] text-textMutedLight dark:text-white/50 font-bold dark:font-semibold transition-colors">Jumlah Donasi (Rp)</label>
                    <div class="flex gap-2 mb-3">
                        <button type="button" onclick="setQuickAmount(50000)" class="flex-1 py-2 rounded-lg bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-[11px] font-bold text-textMutedLight dark:text-white/60 hover:text-brandPurple dark:hover:text-brandYellow hover:border-brandPurple dark:hover:border-brandYellow transition-colors">50k</button>
                        <button type="button" onclick="setQuickAmount(100000)" class="flex-1 py-2 rounded-lg bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-[11px] font-bold text-textMutedLight dark:text-white/60 hover:text-brandPurple dark:hover:text-brandYellow hover:border-brandPurple dark:hover:border-brandYellow transition-colors">100k</button>
                        <button type="button" onclick="setQuickAmount(500000)" class="flex-1 py-2 rounded-lg bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-[11px] font-bold text-textMutedLight dark:text-white/60 hover:text-brandPurple dark:hover:text-brandYellow hover:border-brandPurple dark:hover:border-brandYellow transition-colors">500k</button>
                    </div>
                    <input type="text" id="amount" required class="w-full p-3 md:p-4 rounded-xl md:rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-textMainLight dark:text-white focus:outline-none focus:ring-2 focus:ring-brandPurple/20 dark:focus:ring-brandYellow/20 focus:border-brandPurple dark:focus:border-brandYellow transition-all duration-300 text-sm shadow-sm dark:shadow-none font-bold" placeholder="0">
                </div>
                
                <button type="submit" class="w-full py-4 mt-6 md:mt-8 rounded-full bg-brandOrange dark:bg-brandYellow text-white dark:text-bgDark font-bold text-[10px] tracking-[0.2em] uppercase hover:-translate-y-1 hover:shadow-lg dark:hover:shadow-[0_10px_20px_rgba(255,187,1,0.2)] transition-all duration-300">
                    Proceed to Payment →
                </button>
            </form>
            
            <button onclick="switchView('view-home')" class="mt-6 md:mt-8 pt-4 text-[10px] text-center w-full text-textMutedLight dark:text-white/40 hover:text-textMainLight dark:hover:text-white uppercase tracking-[0.2em] font-bold bg-transparent border-none transition-colors duration-300 group">
                <span class="inline-block transition-transform duration-300 group-hover:-translate-x-1">←</span> Return
            </button>
        </div>
    </div>

    <!-- QRIS PAYMENT MODAL -->
    <div id="qrisModal" class="fixed inset-0 z-[200] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500">
        <div class="absolute inset-0 bg-white/60 dark:bg-black/60 backdrop-blur-md" onclick="closeQrisModal()"></div>
        <div id="qrisCard" class="relative w-full max-w-sm mx-4 bg-white dark:bg-[#151518] border border-slate-200 dark:border-white/10 p-8 rounded-[2rem] shadow-2xl transform scale-95 transition-transform duration-500">
            <button onclick="closeQrisModal()" class="absolute top-6 right-6 text-slate-400 hover:text-brandPurple dark:hover:text-brandYellow transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <h3 class="font-heading text-2xl font-bold text-center text-textMainLight dark:text-white mb-2">Scan QRIS</h3>
            <p class="text-center text-[10px] uppercase tracking-widest text-textMutedLight dark:text-white/50 font-bold mb-6">Total Tagihan: <span id="qrisDisplayAmount" class="text-brandPurple dark:text-brandYellow">Rp 0</span></p>
            <div class="w-full aspect-square bg-white border-2 border-dashed border-slate-200 dark:border-white/20 rounded-2xl flex items-center justify-center mb-6 overflow-hidden p-4">
                <img src="qris.png" alt="">
            </div>
            <form id="finalSubmitForm" onsubmit="submitFinalDonation(event)">
                <label for="proof" class="flex flex-col items-center justify-center w-full h-24 border-2 border-slate-200 dark:border-white/10 border-dashed rounded-xl cursor-pointer bg-slate-50 dark:bg-white/5 hover:bg-white dark:hover:bg-white/10 transition-colors group mb-4">
                    <div class="flex flex-col items-center justify-center pt-3 pb-4">
                        <svg class="w-5 h-5 mb-2 text-slate-400 dark:text-white/40 group-hover:text-brandPurple dark:group-hover:text-brandYellow transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <p class="text-[10px] text-textMutedLight dark:text-white/60"><span class="font-bold text-brandPurple dark:text-brandYellow">Upload Bukti</span></p>
                    </div>
                    <input id="proof" type="file" accept="image/*" class="hidden" required onchange="previewFileName(this)" />
                </label>
                <p id="fileName" class="mb-4 text-[10px] text-center text-brandPurple dark:text-brandYellow hidden font-bold"></p>
                <button type="submit" id="finalBtn" class="w-full py-4 rounded-full bg-brandOrange dark:bg-brandYellow text-white dark:text-bgDark font-bold text-[10px] tracking-[0.2em] uppercase hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                    Verify & Submit
                </button>
            </form>
        </div>
    </div>

    <!-- View: FULLSCREEN Monitor Race -->
    <div id="view-monitor" class="hidden w-full min-h-screen pt-24 pb-12 px-6 md:px-12 lg:px-24 fade-in relative z-20 flex flex-col justify-center">
        <button onclick="switchView('view-home')" class="absolute top-8 left-6 md:top-12 md:left-12 text-[10px] text-textMutedLight dark:text-white/50 hover:text-textMainLight dark:hover:text-white uppercase tracking-[0.2em] font-bold bg-white/50 dark:bg-black/30 backdrop-blur-md px-6 py-3 rounded-full border border-slate-200 dark:border-white/10 transition-all duration-300 group flex items-center gap-2 shadow-sm">
            <span class="inline-block transition-transform duration-300 group-hover:-translate-x-1">←</span> Return to Home
        </button>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 h-full w-full max-w-7xl mx-auto">
            
            <!-- KIRI: Progress & Race Bar -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <div class="mb-10 lg:mb-16">
                    <p class="text-xs md:text-sm text-textMutedLight dark:text-white/50 font-bold uppercase tracking-[0.3em] mb-4">Total Collected</p>
                    <h3 id="grandTotal" class="text-6xl md:text-8xl lg:text-[120px] font-bold text-transparent bg-clip-text bg-gradient-to-r from-brandOrange to-brandPink dark:from-brandYellow dark:to-brandOrange tracking-tighter tabular-nums leading-none">Rp 0</h3>
                </div>
                
                <div class="mb-12 p-6 rounded-[1.5rem] bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm transition-colors">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-[10px] md:text-xs uppercase tracking-[0.2em] font-bold text-textMainLight dark:text-white/80">Goal Progress</span>
                        <span id="targetPercentage" class="text-sm md:text-base font-bold text-brandPurple dark:text-brandYellow">0%</span>
                    </div>
                    <div class="w-full bg-slate-200 dark:bg-black/50 rounded-full h-3 overflow-hidden shadow-inner">
                        <div id="targetBar" class="h-3 rounded-full transition-all duration-1000 ease-out bg-gradient-to-r from-brandPurple to-brandPink dark:from-brandYellow dark:to-brandOrange" style="width: 0%"></div>
                    </div>
                    <p class="text-[10px] text-textMutedLight dark:text-white/40 mt-4 text-right uppercase tracking-widest font-bold">Target: Rp 50.000.000</p>
                </div>
                
                <div>
                    <p class="text-[10px] md:text-xs text-textMutedLight dark:text-white/50 font-bold uppercase tracking-[0.2em] mb-6">Angkatan Race</p>
                    <div id="angkatanRaceContainer" class="space-y-3">
                        <!-- Bar JS disuntikkan ke sini -->
                    </div>
                </div>
            </div>

            <!-- KANAN: Unified Leaderboard Container -->
            <div class="lg:col-span-5 flex flex-col h-full lg:pl-10">
                <p class="text-[10px] md:text-xs text-textMutedLight dark:text-white/50 font-bold uppercase tracking-[0.2em] mb-6">Top Donors</p>
                
                <div class="w-full bg-slate-50 dark:bg-[#121214] border border-slate-200 dark:border-white/5 rounded-3xl overflow-hidden shadow-sm flex flex-col">
                    <div id="leaderboardList" class="flex-1 overflow-y-auto font-body custom-scrollbar max-h-[50vh] lg:max-h-[65vh]">
                        <!-- List JS disuntikkan ke sini -->
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        const TARGET_DONASI = 50000000; 
        let cachedFormData = new FormData(); 

        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark'); localStorage.theme = 'light';
            } else {
                html.classList.add('dark'); localStorage.theme = 'dark';
            }
            if(!document.getElementById('view-monitor').classList.contains('hidden')) loadLeaderboard();
        }

        const dropdownBtn = document.getElementById('dropdownBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownIcon = document.getElementById('dropdownIcon');
        const dropdownText = document.getElementById('dropdownText');
        const hiddenInput = document.getElementById('angkatan');

        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (!dropdownMenu.classList.contains('invisible')) closeDropdown();
            else {
                dropdownMenu.classList.remove('invisible', 'opacity-0', '-translate-y-2');
                const isDark = document.documentElement.classList.contains('dark');
                dropdownIcon.classList.add('rotate-180', isDark ? 'text-brandYellow' : 'text-brandPurple');
                dropdownBtn.classList.add(isDark ? 'border-brandYellow' : 'border-brandPurple', 'ring-2', isDark ? 'ring-brandYellow/20' : 'ring-brandPurple/20');
            }
        });

        document.querySelectorAll('.dropdown-option').forEach(option => {
            option.addEventListener('click', () => {
                hiddenInput.value = option.getAttribute('data-value');
                dropdownText.textContent = option.textContent;
                dropdownText.classList.remove('text-slate-400', 'dark:text-white/40');
                dropdownText.classList.add('text-textMainLight', 'dark:text-white');
                closeDropdown();
            });
        });
        document.addEventListener('click', (e) => { if (!document.getElementById('customDropdown').contains(e.target)) closeDropdown(); });

        function closeDropdown() {
            dropdownMenu.classList.add('invisible', 'opacity-0', '-translate-y-2');
            dropdownIcon.classList.remove('rotate-180', 'text-brandPurple', 'text-brandYellow');
            dropdownBtn.classList.remove('border-brandPurple', 'border-brandYellow', 'ring-2', 'ring-brandPurple/20', 'ring-brandYellow/20');
        }

        const amountInput = document.getElementById('amount');
        amountInput.addEventListener('input', function(e) {
            let value = this.value.replace(/[^0-9]/g, '');
            this.value = value ? parseInt(value, 10).toLocaleString('id-ID') : '';
        });

        function setQuickAmount(amount) {
            amountInput.value = parseInt(amount, 10).toLocaleString('id-ID');
        }

        document.addEventListener('mousemove', (e) => {
            const img = document.getElementById('parallaxImg');
            if(img && !document.getElementById('view-home').classList.contains('hidden')) {
                img.style.transform = `translate(${(window.innerWidth / 2 - e.pageX) / 40}px, ${(window.innerHeight / 2 - e.pageY) / 40}px)`;
            }
        });

        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = 'Rp ' + Math.floor((1 - Math.pow(1 - progress, 4)) * (end - start) + start).toLocaleString('id-ID');
                if (progress < 1) window.requestAnimationFrame(step);
            };
            window.requestAnimationFrame(step);
        }

        function fireAlert(title, text, icon) {
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                title: title, text: text, icon: icon,
                background: isDark ? 'rgba(15, 15, 18, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                color: isDark ? '#fff' : '#1e293b',
                backdrop: isDark ? 'rgba(0,0,0,0.8)' : 'rgba(0,0,0,0.4)',
                customClass: { 
                    popup: `rounded-3xl border ${isDark ? 'border-white/10' : 'border-white'} backdrop-blur-2xl shadow-2xl`, 
                    confirmButton: `bg-brandOrange dark:bg-brandYellow text-white dark:text-bgDark px-8 py-3 rounded-full font-bold uppercase tracking-widest text-xs outline-none shadow-md transition-transform hover:-translate-y-1`, 
                    title: 'font-heading text-3xl' 
                },
                buttonsStyling: false
            });
        }

        let realtimeInterval; let currentGrandTotal = 0; 

        function switchView(viewId) {
            ['view-home', 'view-donate', 'view-monitor'].forEach(id => document.getElementById(id).classList.add('hidden'));
            const selectedView = document.getElementById(viewId);
            selectedView.classList.remove('hidden');
            
            if(viewId === 'view-home') {
                selectedView.querySelectorAll('.mask-up').forEach(el => { el.style.animation = 'none'; el.offsetHeight; el.style.animation = null; });
            } else {
                selectedView.classList.remove('fade-in'); void selectedView.offsetWidth; selectedView.classList.add('fade-in');
            }
            
            if(viewId === 'view-monitor') {
                loadLeaderboard(); realtimeInterval = setInterval(loadLeaderboard, 3000); 
            } else { clearInterval(realtimeInterval); }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function proceedToPayment(e) {
            e.preventDefault();
            if (!hiddenInput.value) { fireAlert('Oops!', 'Silakan pilih angkatan terlebih dahulu.', 'warning'); return; }

            cachedFormData = new FormData();
            cachedFormData.append('name', document.getElementById('name').value);
            cachedFormData.append('angkatan', hiddenInput.value);
            
            let rawAmount = document.getElementById('amount').value.replace(/\./g, '');
            cachedFormData.append('amount', rawAmount);

            const modal = document.getElementById('qrisModal');
            const card = document.getElementById('qrisCard');
            document.getElementById('qrisDisplayAmount').innerText = 'Rp ' + parseInt(rawAmount).toLocaleString('id-ID');
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            card.classList.remove('scale-95');
        }

        function closeQrisModal() {
            const modal = document.getElementById('qrisModal');
            const card = document.getElementById('qrisCard');
            modal.classList.add('opacity-0', 'pointer-events-none');
            card.classList.add('scale-95');
        }

        function previewFileName(input) {
            const display = document.getElementById('fileName');
            if (input.files && input.files[0]) {
                display.textContent = 'File: ' + input.files[0].name; display.classList.remove('hidden');
            } else { display.classList.add('hidden'); }
        }

        function triggerConfetti() {
            var duration = 4000; var end = Date.now() + duration;
            (function frame() {
                confetti({ particleCount: 5, angle: 60, spread: 55, origin: { x: 0 }, colors: ['#F3799F', '#7131B5', '#F06C2E', '#FFBB01'] });
                confetti({ particleCount: 5, angle: 120, spread: 55, origin: { x: 1 }, colors: ['#F3799F', '#7131B5', '#F06C2E', '#FFBB01'] });
                if (Date.now() < end) requestAnimationFrame(frame);
            }());
        }

        async function submitFinalDonation(e) {
            e.preventDefault();
            const btn = document.getElementById('finalBtn');
            const originalText = btn.innerText; btn.innerText = 'Uploading...';
            
            const fileInput = document.getElementById('proof');
            if(fileInput.files.length > 0) cachedFormData.append('proof', fileInput.files[0]);

            try {
                const response = await fetch('donate.php', { method: 'POST', body: cachedFormData });
                const result = await response.json();
                
                if(result.success) { 
                    closeQrisModal();
                    triggerConfetti();
                    setTimeout(() => { fireAlert('Thank You!', 'Donasi dan bukti pembayaran Anda telah kami terima.', 'success'); }, 500);
                    
                    switchView('view-home'); 
                    document.getElementById('donateFormStep1').reset();
                    document.getElementById('finalSubmitForm').reset();
                    hiddenInput.value = '';
                    dropdownText.textContent = 'Pilih Angkatan...';
                    dropdownText.className = 'text-slate-400 dark:text-white/40';
                    document.getElementById('fileName').classList.add('hidden');
                } else { fireAlert('Oops!', result.error, 'error'); }
            } catch (error) { fireAlert('Error!', 'Gagal menghubungi server.', 'error'); } 
            finally { btn.innerText = originalText; }
        }

        async function loadLeaderboard() {
            try {
                const res = await fetch('leaderboard.php');
                const data = await res.json();
                const newTotal = parseInt(data.grand_total || 0);
                
                if(newTotal !== currentGrandTotal) {
                    animateValue(document.getElementById('grandTotal'), currentGrandTotal, newTotal, 2000);
                    currentGrandTotal = newTotal;
                    
                    const targetPercentage = Math.min((newTotal / TARGET_DONASI) * 100, 100);
                    document.getElementById('targetPercentage').innerText = targetPercentage.toFixed(1) + '%';
                    document.getElementById('targetBar').style.width = targetPercentage + '%';
                }
                
                const isDark = document.documentElement.classList.contains('dark');
                
                // 1. ANGKATAN RACE (SLEEK BARS)
                const raceContainer = document.getElementById('angkatanRaceContainer');
                raceContainer.innerHTML = '';
                const maxAmount = data.angkatan_race.length > 0 ? Math.max(...data.angkatan_race.map(i => i.total_amount)) : 0;
                
                const gradients = isDark 
                    ? ['from-brandPink/60 to-brandPurple/60', 'from-brandPurple/60 to-brandOrange/60', 'from-brandOrange/60 to-brandYellow/60'] 
                    : ['from-brandPink/50 to-brandOrange/50', 'from-brandOrange/50 to-brandYellow/50', 'from-brandYellow/50 to-brandPink/50'];

                data.angkatan_race.forEach((item, index) => {
                    const percentage = maxAmount > 0 ? (item.total_amount / maxAmount) * 100 : 0;
                    const gradient = gradients[index % gradients.length];
                    const isFirst = index === 0;
                    const rankIcon = isFirst ? '👑' : `<span class="text-[10px] font-bold opacity-50">${index + 1}</span>`;
                    
                    raceContainer.innerHTML += `
                        <div class="relative w-full h-12 md:h-14 rounded-[1rem] overflow-hidden bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/5 group">
                            <div class="absolute inset-y-0 left-0 bg-gradient-to-r ${gradient} transition-all duration-[2000ms] ease-out" style="width: ${percentage}%"></div>
                            <div class="absolute inset-0 flex justify-between items-center px-4 md:px-5">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-6 h-6">${rankIcon}</div>
                                    <span class="font-bold text-xs md:text-sm text-textMainLight dark:text-white tracking-wide z-10 drop-shadow-sm">${item.angkatan}</span>
                                </div>
                                <span class="font-bold text-xs md:text-sm text-brandPurple dark:text-brandYellow tabular-nums tracking-wide z-10 drop-shadow-sm">
                                    Rp ${parseInt(item.total_amount).toLocaleString('id-ID')}
                                </span>
                            </div>
                        </div>
                    `;
                });

                // 2. TOP DONORS (UNIFIED iOS SETTING STYLE LIST)
                const list = document.getElementById('leaderboardList');
                list.innerHTML = '';
                data.leaderboard.forEach((item, index) => {
                    const isTop1 = index === 0;
                    const rankStyle = isDark ? (isTop1 ? 'text-brandYellow drop-shadow-md' : 'text-white/30') : (isTop1 ? 'text-brandOrange drop-shadow-sm' : 'text-slate-400');
                    const angkatanStyle = isTop1 ? (isDark ? 'text-brandYellow' : 'text-brandOrange') : 'text-brandPink';

                    list.innerHTML += `
                        <div class="flex items-center justify-between p-4 md:p-5 border-b border-slate-200 dark:border-white/5 last:border-0 hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                            <div class="flex items-center gap-4">
                                <span class="font-heading font-bold text-lg md:text-xl w-6 text-center ${rankStyle}">${index + 1}</span>
                                <div>
                                    <div class="font-bold text-sm text-textMainLight dark:text-white/90 truncate max-w-[150px] sm:max-w-[200px]">${item.name}</div>
                                    <div class="text-[9px] ${angkatanStyle} font-bold mt-0.5 uppercase tracking-widest">${item.angkatan}</div>
                                </div>
                            </div>
                            <div class="font-semibold text-sm text-brandPurple dark:text-brandYellow tabular-nums text-right">
                                Rp ${parseInt(item.total_amount).toLocaleString('id-ID')}
                            </div>
                        </div>
                    `;
                });
            } catch (error) { console.error("Gagal polling data:", error); }
        }
    </script>
</body>
</html>