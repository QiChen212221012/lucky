<x-app-layout>
    <!-- Hero Section -->
    <section class="hero" style="padding: 50px 0;">
        <div class="container mx-auto text-center" style="max-width: 800px; background-color: var(--card-bg); padding: 30px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="flex justify-between items-center">
                <h2 style="font-size: 2.5rem; font-weight: bold; color: var(--text-color);">Welcome to Lucky Blog</h2>
                <!-- Night Mode Toggle Button -->
                <button id="theme-toggle" class="btn theme-btn" style="font-size: 1rem; padding: 8px 16px; border: 1px solid var(--text-color);">🌙 Night Mode</button>
            </div>
            <p style="color: var(--text-muted); font-size: 1rem; margin-top: 10px;">
                Discover stories, insights, and inspiration for your daily life. Let luck guide your journey!
            </p>
            <a href="{{ route('about') }}" class="btn hero-btn" style="display: inline-block; margin-top: 20px; font-size: 1rem; font-weight: bold; padding: 10px 20px; background-color: var(--text-color); color: var(--bg-color); border-radius: 5px; transition: all 0.3s;">Learn More About Us</a>
        </div>
    </section>

    <!-- Lucky Journey Section -->
    <section id="lucky-journey" class="journey-section">
        <div class="container mx-auto">
            <h3 class="section-title">Lucky Journey</h3>
            <div class="journey-cards">
                <!-- Joyful Melody -->
                <div onclick="playMusic('joyful')" class="journey-card">
                    <img src="{{ asset('images/1.jpg') }}" alt="Joyful Melody" class="journey-img">
                    <h4 class="journey-title">Joyful Melody</h4>
                    <p class="journey-desc">Feel the rhythm of happiness and let your heart dance with joy.</p>
                </div>
                <!-- Peaceful Harmony -->
                <div onclick="playMusic('peaceful')" class="journey-card">
                    <img src="{{ asset('images/2.jpg') }}" alt="Peaceful Harmony" class="journey-img">
                    <h4 class="journey-title">Peaceful Harmony</h4>
                    <p class="journey-desc">Immerse yourself in serene tunes that bring you calm and luck.</p>
                </div>
                <!-- Uplifting Vibes -->
                <div onclick="playMusic('uplifting')" class="journey-card">
                    <img src="{{ asset('images/3.jpg') }}" alt="Uplifting Vibes" class="journey-img">
                    <h4 class="journey-title">Uplifting Vibes</h4>
                    <p class="journey-desc">Experience melodies that inspire and uplift your spirits.</p>
                </div>
            </div>
            <!-- Audio Elements -->
            <audio id="joyful" src="{{ asset('audio/1.mp3') }}"></audio>
            <audio id="peaceful" src="{{ asset('audio/2.mp3') }}"></audio>
            <audio id="uplifting" src="{{ asset('audio/3.mp3') }}"></audio>
        </div>
    </section>

    <style>
        /* CSS Variables for Light and Dark Themes */
        :root {
            --bg-color: #ffffff;
            --text-color: #000000;
            --text-muted: #555555;
            --card-bg: #ffffff;
            --section-bg: #f0f9ff;
        }

        .dark-mode {
            --bg-color: #121212;
            --text-color: #ffffff;
            --text-muted: #aaaaaa;
            --card-bg: #1e1e1e;
            --section-bg: #1a1a1a;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .hero {
            background-color: var(--card-bg);
            padding: 20px 0;
            text-align: center;
            color: var(--text-color);
        }

        .journey-section {
            background-color: var(--section-bg);
            padding: 40px 20px;
            text-align: center;
        }

        .section-title {
            font-size: 1.8rem;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .journey-cards {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .journey-card {
            width: 30%;
            min-width: 200px;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            background: var(--card-bg);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .journey-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .journey-img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .journey-title {
            font-size: 1.2rem;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .journey-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .btn {
            background-color: var(--text-color);
            color: var(--bg-color);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn:hover {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .theme-btn {
            padding: 8px 16px;
            background-color: var(--card-bg);
            border: 1px solid var(--text-color);
        }

        .theme-btn:hover {
            background-color: var(--text-color);
            color: var(--bg-color);
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButton = document.getElementById("theme-toggle");
            const currentTheme = localStorage.getItem("theme");

            // Initialize theme
            if (currentTheme === "dark") {
                document.body.classList.add("dark-mode");
                toggleButton.textContent = "☀️ Day Mode";
            }

            toggleButton.addEventListener("click", function () {
                document.body.classList.toggle("dark-mode");
                const theme = document.body.classList.contains("dark-mode") ? "dark" : "light";
                localStorage.setItem("theme", theme);
                toggleButton.textContent = theme === "dark" ? "☀️ Day Mode" : "🌙 Night Mode";
            });
        });

        function playMusic(id) {
            const audios = document.querySelectorAll('audio');
            audios.forEach(audio => {
                if (!audio.paused) {
                    audio.pause();
                    audio.currentTime = 0;
                }
            });

            const audio = document.getElementById(id);
            audio.play();
        }
    </script>
</x-app-layout>
