<template>
    <div
        class="fixed bottom-0 left-[20%] w-[80%] bg-slate-800 border-t border-slate-700 z-50 shadow-lg rounded-t-xl">

        <div class="flex flex-col sm:flex-row items-center justify-between p-4 max-w-5xl mx-auto space-y-3 sm:space-y-0">

            <!-- Song Info -->
            <div class="flex items-center space-x-4">
                <img
                    :src="song?.image_path ?? defaultImage"
                    class="w-16 h-16 rounded-lg object-cover bg-gray-200 dark:bg-slate-700" />

                <div>
                    <h3 class="text-white text-sm font-semibold">
                        {{ song?.name ?? "No song playing" }}
                    </h3>
                    <p class="text-gray-400 text-xs">
                        {{ song?.artist?.name ?? "—" }}
                    </p>
                </div>
            </div>

            <!-- Controls -->
            <div class="flex items-center space-x-4">

                <button @click="prevSong" class="text-gray-500 hover:text-pink-500">
                    <svg width="24" height="24" fill="none">
                        <path d="M10 12L18 6v12l-8-6Z"
                              fill="currentColor" stroke="currentColor"
                              stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M6 6v12"
                              stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <button
                    @click="togglePlay"
                    class="bg-pink-500 hover:bg-pink-600 text-white flex items-center justify-center rounded-full w-12 h-12">

                    <!-- Play Icon -->
                    <svg v-if="isPaused" xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>

                    <!-- Pause Icon -->
                    <svg v-else xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="6" y="4" width="4" height="16" />
                        <rect x="14" y="4" width="4" height="16" />
                    </svg>
                </button>

                <button @click="nextSong" class="text-gray-500 hover:text-pink-500">
                    <svg width="24" height="24" fill="none">
                        <path d="M14 12L6 6v12l8-6Z"
                              fill="currentColor" stroke="currentColor"
                              stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path d="M18 6v12"
                              stroke="currentColor" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        <audio ref="audio" class="hidden"></audio>
    </div>
</template>

<script>
export default {
    props: {
        song: Object,          // Selected song from SongList
        playlist: Array        // Optional: allow next/prev from a list
    },

    data() {
        return {
            currentSong: null,
            currentIndex: -1,
            isPaused: true,
            defaultImage: "/images/onpa-logo.png",
        };
    },

    watch: {
        song(newSong) {
            if (!newSong) return;

            // update playback
            this.currentSong = newSong;
            this.loadAudio(newSong);
            this.play();
        }
    },

    methods: {
        loadAudio(song) {
            this.$refs.audio.src = song.file_path;
        },

        play() {
            this.$refs.audio.play();
            this.isPaused = false;
        },

        pause() {
            this.$refs.audio.pause();
            this.isPaused = true;
        },

        togglePlay() {
            this.isPaused ? this.play() : this.pause();
        },

        nextSong() {
            if (!this.playlist) return;
            this.currentIndex = (this.currentIndex + 1) % this.playlist.length;
            this.selectFromPlaylist();
        },

        prevSong() {
            if (!this.playlist) return;
            this.currentIndex =
                this.currentIndex > 0
                    ? this.currentIndex - 1
                    : this.playlist.length - 1;
            this.selectFromPlaylist();
        },

        selectFromPlaylist() {
            const song = this.playlist[this.currentIndex];
            this.$emit("select-song", song);     // Updates parent
        }
    }
};
</script>
