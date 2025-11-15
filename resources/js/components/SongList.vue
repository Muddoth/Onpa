<template>
  <div class="w-full space-y-8 pb-60">
    <div
      v-if="songs.length"
      class="bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-700 flex w-11/12 overflow-hidden mx-auto"
    >
      <div class="flex flex-col w-full">
        <ul role="list" class="divide-y divide-white/5">
          <li
            v-for="song in songs"
            :key="song.id"
            class="song-item flex justify-between items-center gap-x-6 py-5 hover:scale-105 transition-transform duration-300 hover:shadow-xl rounded-lg px-3 border-b border-gray-700"
            :data-name="song.name"
            :data-artist="song.artist.name"
            :data-image="song.image_path"
            :data-audio="song.file_path"
            @click="selectSong(song)"
          >
            <!-- Left side: Song details -->
            <div class="flex items-center gap-x-4">
              <img
                :src="song.image_path || '/images/song-icon.png'"
                alt="Song Icon"
                class="w-20 h-20 object-cover rounded-full bg-gray-700"
              />

              <div class="min-w-0">
                <p>
                  <span class="text-lg font-semibold text-purple-500">{{
                    song.name
                  }}</span>
                  <span class="text-sm text-white">
                    by {{ song.artist?.name || "Unknown Artist" }}</span
                  >
                </p>
                <p class="mt-1 truncate text-xs text-white">
                  {{
                    Array.isArray(song.genre) ? song.genre.join(", ") : song.genre || ""
                  }}
                </p>
                <p class="text-sm text-white">Album: {{ song.album }}</p>
              </div>
            </div>

            <!-- Right side: Buttons -->
            <div class="flex gap-3 items-center">
              <a
                :href="`/songs/${song.id}`"
                class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-purple-500 hover:bg-purple-600 text-white shadow-md transition duration-200"
              >
                View
              </a>

              <a
                v-if="song.can_update"
                :href="`/songs/${song.id}/edit`"
                class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-pink-400 hover:bg-pink-500 text-white shadow-md transition duration-200"
              >
                Edit
              </a>

              <form
                v-if="song.can_delete"
                :action="`/songs/${song.id}`"
                method="POST"
                @submit.prevent="confirmDelete(song.id)"
              >
                <button
                  type="submit"
                  class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-md transition duration-200"
                >
                  Delete
                </button>
              </form>
            </div>
          </li>
        </ul>
        <!-- pagination controls
        <div class="pagination">
          <button @click="$emit('prev-page')" :disabled="page <= 1">Previous</button>
          <button @click="$emit('next-page')" :disabled="page >= totalPages">Next</button>
        </div> -->
      </div>
      <!-- //here -->
    </div>

    <div v-else class="text-center text-gray-400 w-full py-10">
      No songs available yet.
    </div>
  </div>
</template>

<script>
export default {
  name: "SongList",

  props: {
    songs: {
      type: Array,
      required: true,
    },
  },

  emits: ["select-song", "refresh"],

  methods: {
    confirmDelete(id) {
      if (confirm("Delete this song?")) {
        fetch(`/songs/${id}`, {
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
          },
        }).then(() => this.$emit("refresh"));
      }
    },

    selectSong(song) {
      this.$emit("select-song", song);
    },
  },

  watch: {
    song(newSong) {
      if (!newSong) return;

      this.currentSong = newSong;

      // ➤ Set current index based on playlist
      if (this.playlist && Array.isArray(this.playlist)) {
        this.currentIndex = this.playlist.findIndex((s) => s.id === newSong.id);
      }

      this.loadAudio(newSong);
      this.play();
    },
  },
};
</script>
