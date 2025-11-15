import './bootstrap';
import { createApp } from "vue";
import SongSearch from "./components/SongSearch.vue";
import SongList from "./components/SongList.vue";
import MusicPlayer from "./components/MusicPlayer.vue";


createApp({
    components: { SongSearch, SongList, MusicPlayer },
    data() {
        return {
            songs: [],
            genres: [],  // pass this down to SongSearch in blade
            currentSong: null, // selected song
        };
    },
    methods: {
        handleSelectSong(song) {
            this.currentSong = song;
        },
        async fetchSongs(filters = {}) {
            const params = new URLSearchParams(filters);
            const res = await fetch(`/api/songs?${params.toString()}`, {
                credentials: "include"   // <-- THIS IS REQUIRED
            });


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
