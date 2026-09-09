<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charitale 2K26</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brandPink: '#F3799F', pinkLight: '#FFD9DA',
                        brandPurple: '#7131B5', purpleLight: '#FF7FDF',
                        brandOrange: '#F06C2E', brandYellow: '#FFBB01'
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
        /* Premium Glassmorphism & Animations */
        .glass-card { background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-animated { background: linear-gradient(-45deg, #F3799F, #7131B5, #F06C2E, #FFBB01); background-size: 400% 400%; animation: gradientBG 15s ease infinite; }
        @keyframes gradientBG { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; transform: translateY(20px); }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
        .delay-1 { animation-delay: 0.1s; } .delay-2 { animation-delay: 0.2s; }
    </style>
</head>
<body class="bg-animated min-h-screen text-white font-body p-6 flex flex-col items-center justify-center">

    <!-- Header Logo -->
    <h1 class="font-heading text-5xl md:text-7xl font-bold mb-12 drop-shadow-lg tracking-wide text-center">Chari Tale</h1>

    <!-- View: Landing Page (Bento Grid) -->
    <div id="view-home" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl fade-in-up">
        <button onclick="switchView('view-donate')" class="glass-card p-10 rounded-3xl hover:scale-105 transition-transform duration-300 flex flex-col items-center justify-center group shadow-2xl">
            <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">💖</div>
            <h2 class="font-heading text-3xl font-semibold mb-2">Donate Now</h2>
            <p class="font-body font-medium text-pinkLight">Make an impact today.</p>
        </button>
        <button onclick="switchView('view-monitor')" class="glass-card p-10 rounded-3xl hover:scale-105 transition-transform duration-300 flex flex-col items-center justify-center group shadow-2xl">
            <div class="text-6xl mb-4 group-hover:scale-110 transition-transform">🏆</div>
            <h2 class="font-heading text-3xl font-semibold mb-2">Monitor Race</h2>
            <p class="font-body font-medium text-purpleLight">View live leaderboard.</p>
        </button>
    </div>

    <!-- View: Donation Form -->
    <div id="view-donate" class="hidden w-full max-w-md glass-card p-8 rounded-3xl shadow-2xl fade-in-up">
        <h2 class="font-heading text-3xl font-semibold mb-6 text-center">Support the Cause</h2>
        <form id="donateForm" onsubmit="submitDonation(event)" class="space-y-4">
            <div>
                <label class="block font-semibold mb-1">Nama Lengkap</label>
                <input type="text" id="name" required class="w-full p-3 rounded-xl bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-brandYellow">
            </div>
            <div>
                <label class="block font-semibold mb-1">Angkatan</label>
                <select id="angkatan" required class="w-full p-3 rounded-xl bg-white/20 border border-white/30 text-black focus:outline-none focus:ring-2 focus:ring-brandYellow">
                    <option value="MB13">MB13</option>
                    <option value="MB14">MB14</option>
                    <option value="MB 2025">MB 2025</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Jumlah Donasi (Rp)</label>
                <input type="number" id="amount" required class="w-full p-3 rounded-xl bg-white/20 border border-white/30 text-white focus:outline-none focus:ring-2 focus:ring-brandYellow">
            </div>
            <button type="submit" id="submitBtn" class="w-full py-4 mt-4 rounded-xl bg-gradient-to-r from-brandOrange to-brandPink font-bold text-lg hover:shadow-lg hover:scale-[1.02] transition-all flex justify-center items-center">
                <span id="btnText">Submit Donation</span>
                <svg id="loadingSpinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            </button>
        </form>
        <button onclick="switchView('view-home')" class="mt-4 text-sm text-center w-full opacity-80 hover:opacity-100">← Back to Home</button>
    </div>

    <script>
        function switchView(viewId) {
            ['view-home', 'view-donate', 'view-monitor'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            document.getElementById(viewId).classList.remove('hidden');
        }

        async function submitDonation(e) {
            e.preventDefault();
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('loadingSpinner');
            
            // Loading State Animation
            btnText.innerText = 'Processing...';
            spinner.classList.remove('hidden');

            // Collect Data
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('angkatan', document.getElementById('angkatan').value);
            formData.append('amount', document.getElementById('amount').value);

            // Fetch API call to PHP Backend
            try {
                const response = await fetch('donate.php', { method: 'POST', body: formData });
                const result = await response.json();
                if(result.success) { alert('Donation Successful!'); switchView('view-home'); document.getElementById('donateForm').reset(); }
            } catch (error) { console.error('Error:', error); }
            finally {
                btnText.innerText = 'Submit Donation';
                spinner.classList.add('hidden');
            }
        }
    </script>
</body>
</html>