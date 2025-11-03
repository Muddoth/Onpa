<div id="musicPlayer"
    class="fixed bottom-0 left-[20%] w-[80%] bg-slate-800 border-t border-slate-700 z-50 shadow-lg rounded-t-xl">
    <div class="flex flex-col sm:flex-row items-center justify-between p-4 max-w-5xl mx-auto space-y-3 sm:space-y-0">

        <!-- Song Info -->
        <div class="flex items-center space-x-4">
            <img id="playerImage" src="{{ asset('images/song-icon.png') }}" alt="Album Cover"
                class="w-16 h-16 rounded-lg object-cover bg-gray-200 dark:bg-slate-700" />
            <div>
                <h3 id="playerTitle" class="text-white text-sm font-semibold">No song playing</h3>
                <p id="playerArtist" class="text-gray-400 text-xs">—</p>
            </div>
        </div>

        <!-- Audio Controls -->
        <div class="flex items-center space-x-4">
            <button id="prevBtn" class="text-gray-500 hover:text-pink-500">
                <svg width="24" height="24" fill="none">
                    <path d="M10 12L18 6v12l-8-6Z" fill="currentColor" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 6v12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            <button id="playPauseBtn"
                class="bg-pink-500 hover:bg-pink-600 text-white flex items-center justify-center rounded-full w-12 h-12">
                <svg id="playIcon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
                <svg id="pauseIcon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="6" y="4" width="4" height="16" />
                    <rect x="14" y="4" width="4" height="16" />
                </svg>
            </button>

            <button id="nextBtn" class="text-gray-500 hover:text-pink-500">
                <svg width="24" height="24" fill="none">
                    <path d="M14 12L6 6v12l8-6Z" fill="currentColor" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M18 6v12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

    <audio id="audioPlayer" class="hidden"></audio>
</div>

@push('styles')
<style>
    .hidden-audio::-webkit-media-controls {
        display: none !important;
    }
    .hidden-audio {
        outline: none;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const songs = Array.from(document.querySelectorAll('.song-item'));
        const audio = document.getElementById('audioPlayer');
        const playBtn = document.getElementById('playPauseBtn');
        const playIcon = document.getElementById('playIcon');
        const pauseIcon = document.getElementById('pauseIcon');
        const title = document.getElementById('playerTitle');
        const artist = document.getElementById('playerArtist');
        const image = document.getElementById('playerImage');
        let currentIndex = -1;

        function loadSong(index) {
            const song = songs[index];
            if (!song) return;
            title.textContent = song.dataset.name;
            artist.textContent = song.dataset.artist;
            image.src = song.dataset.image;
            audio.src = song.dataset.audio;
            currentIndex = index;
        }

        function playSong() {
            audio.play();
            playIcon.classList.add('hidden');
            pauseIcon.classList.remove('hidden');
        }

        function pauseSong() {
            audio.pause();
            playIcon.classList.remove('hidden');
            pauseIcon.classList.add('hidden');
        }

        songs.forEach((song, index) => {
            song.addEventListener('click', () => {
                loadSong(index);
                playSong();
            });
        });

        playBtn.addEventListener('click', () => {
            if (!audio.src) return;
            audio.paused ? playSong() : pauseSong();
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentIndex < songs.length - 1) {
                loadSong(currentIndex + 1);
                playSong();
            } else {
                loadSong(0);
                playSong();
            }
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentIndex > 0) {
                loadSong(currentIndex - 1);
                playSong();
            } else {
                loadSong(songs.length - 1);
                playSong();
            }
        });

        audio.addEventListener('ended', () => {
            if (currentIndex < songs.length - 1) {
                loadSong(currentIndex + 1);
                playSong();
            }
        });
    });
</script>
@endpush
