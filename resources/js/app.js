import './bootstrap';
import { createApp } from "vue";
import SongSearch from "./components/SongSearch.vue";
import SongList from "./components/SongList.vue";
import MusicPlayer from "./components/MusicPlayer.vue";


createApp({
    components: {
        SongSearch, SongList, MusicPlayer
    },
    data() {
        return {
            songs: [], genres: [], currentSong: null, // selected song
        };
    },
    methods: {
        handleSelectSong(song) {
            this.currentSong = song;
        },

        handleRefresh(deletedSongId) {
            this.fetchSongs().then(() => {
                // If deleted song was playing, clear currentSong
                if (this.currentSong && this.currentSong.id === deletedSongId) {
                    this.currentSong = null;  // stop music player
                }
            });
        },
        async fetchSongs(filters = {}) {
            const params = new URLSearchParams(filters);
            const res = await fetch(`/api/songs?${params.toString()}`, {
                credentials: "include"   // <-- THIS IS REQUIRED, authenticated by Sanctum      
            });

            //to get data from response object
            const data = await res.json();
            this.songs = [...data.data];
            this.genres = data.genres || [];

            console.log("Fetched songs in parent:", this.songs);
        }

    },
    mounted() {
        this.fetchSongs();
    },

}).mount("#songs-app");
