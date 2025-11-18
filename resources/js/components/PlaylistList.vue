<template>
  <div class="main-content relative pb-40">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <div
        v-for="playlist in playlists"
        :key="playlist.id"
        class="bg-gray-800 border border-gray-700 rounded-2xl shadow-md p-5 hover:shadow-xl transition relative group cursor-pointer"
        @click="goToPlaylist(playlist.id)"
      >
        <div class="flex justify-between items-center">
          <h2 class="text-xl font-semibold text-purple-400 truncate">
            {{ playlist.name }}
          </h2>
        </div>

        <div class="border-t border-gray-600 my-4"></div>

        <div class="max-h-48 overflow-y-auto custom-scrollbar pr-2 space-y-2">
          <div
            v-for="song in playlist.songs"
            :key="song.id"
            class="song-item flex justify-between items-center bg-gray-700 hover:bg-gray-600 p-2 rounded-md transition"
            @click.stop="playSong(song)"
          >
            <span class="text-white text-sm truncate">{{ song.name }}</span>
            <span class="text-xs text-gray-300">▶</span>
          </div>
          <p
            v-if="playlist.songs.length === 0"
            class="text-gray-400 text-sm text-center"
          >
            No songs in this playlist
          </p>
        </div>
      </div>
    </div>

    <div class="mt-6">
      <pagination
        v-if="pagination"
        :links="pagination.links"
        @change-page="fetchPlaylists"
      />
    </div>

    <MusicPlayer />
  </div>
</template>

<script>
import MusicPlayer from "@/components/MusicPlayer.vue";
import Pagination from "@/components/Pagination.vue";

export default {
  components: { MusicPlayer, Pagination },
  props: {
    playlists: {
      type: Array,
      required: true,
    },
    pagination: {
      type: Object,
      required: false,
    },
  },
  methods: {
    goToPlaylist(id) {
      window.location.href = `/playlists/${id}`;
    },
    playSong(song) {
      // You need to implement this method to play song,
      // maybe emit event or use a global event bus/store
      console.log("Play song", song);
    },
    fetchPlaylists(url) {
      // Optional: implement fetching playlists for pagination
      // this.$emit('fetch-playlists', url);
    },
  },
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background-color: #ec4899;
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
</style>
