import './bootstrap';
import { createApp } from "vue";
import SongSearch from "./components/SongSearch.vue";
import SongList from "./components/SongList.vue";
import MusicPlayer from "./components/MusicPlayer.vue";
import PlaylistList from './components/PlaylistList.vue';
import Pagination from './components/Pagination.vue';


createApp({
    components: {
        SongSearch, SongList, MusicPlayer, PlaylistList, Pagination
    },
    data() {
        return {
            songs: [], genres: [], currentSong: null, playlists: [], pagination: null,  
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
        },
        async fetchPlaylists() {
            const res = await fetch('/api/playlists', {
                credentials: 'include'  // if you need auth with Sanctum
            });
            const data = await res.json();
            this.playlists = data.data;  // assuming API returns { data: [...] }
            console.log('Fetched playlists:', this.playlists);
        },


    },
    mounted() {
        this.fetchSongs();
        this.fetchPlaylists();

    },

}).mount("#songs-app");
