<style>
    .music-card {
        transform: scale(1.5);
    }

    .status-cards {
        transform: scale(0.9);
    }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #ec4899;
        /* Tailwind pink-500 */
        border-radius: 9999px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #db2777;
        /* Tailwind pink-600 */


    }

    .fade-image {
        transition: opacity 0.4s ease-in-out;
    }

    .fade-out {
        opacity: 0;
    }

    .fade-in {
        opacity: 1;
    }


    .bg-turquoise {
        background-color: #37a5af;
    }

    #progress-container:hover {
        background-color: #a0f0f7;
    }
</style>

<x-layout title="Dashboard">
    @slot('headerButton')
    <a href="{{ route('songs.create') }}"
        class="bg-teal-500 hover:bg-teal-500 text-white font-semibold px-4 py-2 rounded-lg transition">
        Add Song
    </a>


    @endslot


    <!-- Status Cards -->
    <div class="status-cards grid grid-cols-3 gap-6 mb-5">
        <div
            class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 p-6 flex justify-between items-center">
            <div>
                <h2 class="text-white  text-sm uppercase">Total Songs</h2>
                <p class="text-3xl font-bold text-pink-500">{{ $totalSongs }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19V6l12-2v13M9 19l-6-2V4l6 2m0 13l6 2m0 0V6M15 21V8" />
            </svg>
        </div>
        <div
            class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 p-6 flex justify-between items-center">
            <div>
                <h2 class="text-white text-sm uppercase">Total Playlist</h2>
                <p class="text-3xl font-bold text-pink-500">{{ $totalSongs }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19V6l12-2v13M9 19l-6-2V4l6 2m0 13l6 2m0 0V6M15 21V8" />
            </svg>
        </div>
        <div
            class="bg-gray-800 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 hover:shadow-xl border border-gray-700 p-6 flex justify-between items-center">
            <div>
                <h2 class="text-white text-sm uppercase">Total Genres</h2>
                <p class="text-3xl font-bold text-pink-500">{{ $totalGenres }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0l7 7-7 7" />
            </svg>
        </div>
    </div>

    <!-- Music Player Card -->
    <div class="w-full pb-20">
        <div
            class='bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-700 flex w-11/12  overflow-hidden mx-auto mb-10'>
            <div class="flex flex-col w-full">


                <div class="flex flex-col sm:flex-row items-center">
                    <!-- Music Card-->
                    <div class="p-10 bg-transparent flex rounded-lg justify-center items-center h-fit music-card">
                        <div class="p-2 rounded-lg w-40">
                            <!-- Album Cover -->
                            <div
                                class="w-36 h-36 rounded-full overflow-hidden flex justify-center items-center bg-gray-700">
                                <img id="player-image" src=""
                                    class="fade-image w-full h-full object-cover rounded-full aspect-square" />
                            </div>

                            <!-- Song Info -->
                            <p class="text-center mt-1">
                                <span id="player-name" class="text-pink text-md font-semibold"></span><br>
                                <span id="player-artist" class="text-white text-xs"></span>
                            </p>

                            <!-- Progress Bar -->
                            <div id="progress-container"
                                class="w-full h-2 bg-gray-300 rounded-full mt-4 cursor-pointer">
                                <div id="progress-bar" class="h-2 bg-turquoise rounded-full" style="width: 0%;"></div>
                            </div>

                            <!-- Controls -->
                            <div class="mt-3 flex justify-center items-center">
                                <button id="prev-btn"
                                    class="p-1.5 rounded-full bg-purple-200 hover:bg-purple-300 focus:outline-none">
                                    <!-- previous SVG -->
                                    <svg viewBox="0 0 24 24" class="w-2.5 h-2.5 text-white-600" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" transform="matrix(-1, 0, 0, 1, 0, 0)">
                                        <path
                                            d="M16.6598 14.6474C18.4467 13.4935 18.4467 10.5065 16.6598 9.35258L5.87083 2.38548C4.13419 1.26402 2 2.72368 2 5.0329V18.9671C2 21.2763 4.13419 22.736 5.87083 21.6145L16.6598 14.6474Z"
                                            fill="#000000"></path>
                                        <path
                                            d="M22.75 5C22.75 4.58579 22.4142 4.25 22 4.25C21.5858 4.25 21.25 4.58579 21.25 5V19C21.25 19.4142 21.5858 19.75 22 19.75C22.4142 19.75 22.75 19.4142 22.75 19V5Z"
                                            fill="#000000"></path>
                                    </svg>
                                </button>

                                <button id="play-btn"
                                    class="p-2 rounded-full bg-purple-200 hover:bg-purple-300 focus:outline-none mx-2">
                                    <svg id="play-icon" viewBox="0 0 24 24" class="w-3.5 h-3.5 text-white-600"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.6598 14.6474C18.4467 13.4935 18.4467 10.5065 16.6598 9.35258L5.87083 2.38548C4.13419 1.26402 2 2.72368 2 5.0329V18.9671C2 21.2763 4.13419 22.736 5.87083 21.6145L16.6598 14.6474Z"
                                            fill="#000000"></path>
                                    </svg>
                                </button>

                                <button id="next-btn"
                                    class="p-1.5 rounded-full bg-purple-200 hover:bg-purple-300 focus:outline-none">
                                    <!-- next SVG -->
                                    <svg viewBox="0 0 24 24" class="w-2.5 h-2.5 text-white-600" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.6598 14.6474C18.4467 13.4935 18.4467 10.5065 16.6598 9.35258L5.87083 2.38548C4.13419 1.26402 2 2.72368 2 5.0329V18.9671C2 21.2763 4.13419 22.736 5.87083 21.6145L16.6598 14.6474Z"
                                            fill="#000000"></path>
                                        <path
                                            d="M22.75 5C22.75 4.58579 22.4142 4.25 22 4.25C21.5858 4.25 21.25 4.58579 21.25 5V19C21.25 19.4142 21.5858 19.75 22 19.75C22.4142 19.75 22.75 19.4142 22.75 19V5Z"
                                            fill="#000000"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Hidden Audio -->
                            <audio id="audio-player"></audio>
                        </div>
                    </div>


                    <!-- Playlist Container -->
                    <div
                        class="flex flex-col w-full h-96 overflow-y-auto overflow-x-hidden custom-scrollbar ml-auto px-10">
                        <h2 class="bold text-white text-2xl">Recently Added</h2>
                        <ul role="list" class="divide-y divide-white/5">
                            @foreach ($latestSongs as $song)
                                <li>
                                    <a href="javascript:void(0);"
                                        class="song-item flex justify-between gap-x-6 py-5 hover:scale-105 transition-transform duration-300 hover:shadow-xl rounded-lg block px-3"
                                        data-name="{{ $song->name }}" data-artist="{{ $song->artist_name }}"
                                        data-image="{{ asset($song->image_path ?? 'images/song-icon.png') }}"
                                        data-audio="{{ asset($song->file_path) }}">



                                        <div class="flex min-w-0 gap-x-4">

                                            <img src="{{ asset($song->image_path ?? 'images/song-icon.png') }}"
                                                alt="Song Icon" class="w-20 h-20 object-cover rounded-full bg-gray-700" />
                                            <div class="min-w-0 flex-auto">
                                                <p>
                                                    <span
                                                        class="text-lg font-semibold text-purple-500">{{ $song->name }}</span>
                                                    <span class="text-sm text-white"> by {{ $song->artist_name }}</span>
                                                </p>
                                                <p class="mt-1 truncate text-xs/5 text-white">{{ $song->genre }}</p>
                                            </div>
                                        </div>
                                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                            <p class="text-sm/6 text-white">Album: {{ $song->album }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('songs.index') }}"
                            class="text-pink-400 hover:text-pink-300 hover:underline hover:-translate-y-1 transform font-semibold self-end mt-4 transition-all duration-300">
                            Other Songs >>
                        </a>


                    </div>

                </div>
            </div>




        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const songItems = document.querySelectorAll('.song-item');
            const playerImage = document.getElementById('player-image');
            const playerName = document.getElementById('player-name');
            const playerArtist = document.getElementById('player-artist');
            const audioPlayer = document.getElementById('audio-player');
            const playBtn = document.getElementById('play-btn');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const progressContainer = document.getElementById('progress-container');
            const progressBar = document.getElementById('progress-bar');
            const songs = @json($latestSongs);



            let currentSongIndex = -1;
            let isPlaying = false;

            function loadSong(index) {
                const song = songItems[index];
                if (!song) return;

                // Fade animation for image
                playerImage.classList.add('fade-out');
                setTimeout(() => {
                    playerImage.src = song.dataset.image;
                    playerImage.classList.remove('fade-out');
                    playerImage.classList.add('fade-in');
                    setTimeout(() => playerImage.classList.remove('fade-in'), 400);
                }, 200);

                // Update name & artist
                playerName.textContent = song.dataset.name;
                playerArtist.textContent = "by " + song.dataset.artist;

                // Load and play the song
                audioPlayer.src = song.dataset.audio;
                audioPlayer.play();
                isPlaying = true;
                currentSongIndex = index;

                // Update play button icon to pause
                document.getElementById('play-icon').innerHTML = `
            <path d="M2 6C2 4.11438 2 3.17157 2.58579 2.58579C3.17157 2 4.11438 2 6 2C7.88562 2 8.82843 2 9.41421 2.58579C10 3.17157 10 4.11438 10 6V18C10 19.8856 10 20.8284 9.41421 21.4142C8.82843 22 7.88562 22 6 22C4.11438 22 3.17157 22 2.58579 21.4142C2 20.8284 2 19.8856 2 18V6Z"
                fill="#000000"></path>
            <path d="M14 6C14 4.11438 14 3.17157 14.5858 2.58579C15.1716 2 16.1144 2 18 2C19.8856 2 20.8284 2 21.4142 2.58579C22 3.17157 22 4.11438 22 6V18C22 19.8856 22 20.8284 21.4142 21.4142C20.8284 22 19.8856 22 18 22C16.1144 22 15.1716 22 14.5858 21.4142C14 20.8284 14 19.8856 14 18V6Z"
                fill="#000000"></path>`;
            }

            // Click a song in playlist
            songItems.forEach((song, index) => {
                song.addEventListener('click', e => {
                    e.preventDefault();
                    loadSong(index);
                });
            });

            // Play / Pause button
            playBtn.addEventListener('click', () => {
                if (!audioPlayer.src) return;

                const playIcon = document.getElementById('play-icon');

                if (isPlaying) {
                    audioPlayer.pause();
                    // Change to play icon
                    playIcon.innerHTML = `
                <path d="M16.6598 14.6474C18.4467 13.4935 18.4467 10.5065 16.6598 9.35258L5.87083 2.38548C4.13419 1.26402 2 2.72368 2 5.0329V18.9671C2 21.2763 4.13419 22.736 5.87083 21.6145L16.6598 14.6474Z"
                    fill="#000000"></path>`;
                } else {
                    audioPlayer.play();
                    // Change to pause icon
                    playIcon.innerHTML = `
                <path d="M2 6C2 4.11438 2 3.17157 2.58579 2.58579C3.17157 2 4.11438 2 6 2C7.88562 2 8.82843 2 9.41421 2.58579C10 3.17157 10 4.11438 10 6V18C10 19.8856 10 20.8284 9.41421 21.4142C8.82843 22 7.88562 22 6 22C4.11438 22 3.17157 22 2.58579 21.4142C2 20.8284 2 19.8856 2 18V6Z"
                    fill="#000000"></path>
                <path d="M14 6C14 4.11438 14 3.17157 14.5858 2.58579C15.1716 2 16.1144 2 18 2C19.8856 2 20.8284 2 21.4142 2.58579C22 3.17157 22 4.11438 22 6V18C22 19.8856 22 20.8284 21.4142 21.4142C20.8284 22 19.8856 22 18 22C16.1144 22 15.1716 22 14.5858 21.4142C14 20.8284 14 19.8856 14 18V6Z"
                    fill="#000000"></path>`;
                }

                isPlaying = !isPlaying;
            });

            // Previous song
            prevBtn.addEventListener('click', () => {
                if (currentSongIndex > 0) loadSong(currentSongIndex - 1);
            });

            // Next song
            nextBtn.addEventListener('click', () => {
                if (currentSongIndex < songItems.length - 1) loadSong(currentSongIndex + 1);
            });

            // Auto-play next when a song ends
            audioPlayer.addEventListener('ended', () => {
                if (currentSongIndex < songItems.length - 1) loadSong(currentSongIndex + 1);
            });

            // Update progress bar as the song plays
            audioPlayer.addEventListener('timeupdate', () => {
                if (audioPlayer.duration) {
                    const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                    progressBar.style.width = `${progressPercent}%`;
                }
            });

            // Allow clicking on progress bar to seek
            progressContainer.addEventListener('click', (e) => {
                const duration = audioPlayer.duration;

                // Prevent seeking if song isn't loaded yet
                if (!duration || isNaN(duration)) return;

                const width = progressContainer.clientWidth;
                const clickX = e.offsetX;
                const newTime = (clickX / width) * duration;

                // Seek smoothly
                audioPlayer.currentTime = newTime;
            });

            if (songs.length === 0) return;

            // Take the first song
            const firstSong = songs[0];

            // Update the UI
            playerName.textContent = firstSong.name;
            playerArtist.textContent = firstSong.artist ?? ''; // optional
            playerImage.src = firstSong.image_path
                ? `/images/songs/${firstSong.image_path}`
                : '/images/default.jpg';

            // Set the audio source
            audioPlayer.src = `/audio/audio/${firstSong.file_name}`;


        });

    </script>
</x-layout>