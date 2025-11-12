<template>
  <div class="mb-10">
    <!-- 🔍 Search Bar + Button -->
    <div class="flex justify-center mb-6 gap-3">
      <input
        v-model="filters.q"
        type="text"
        placeholder="Search by song, artist, or album..."
        class="px-4 py-2 w-1/2 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        @keyup.enter="emitSearch"
      />

      <button
        @click="emitSearch"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200"
      >
        Search
      </button>
    </div>

    <!-- 🎵 Genre Buttons -->
    <div class="genre-filters flex flex-wrap gap-3 justify-center">
      <button
        v-for="g in ['all', ...genres]"
        :key="g"
        @click="selectGenre(g)"
        :class="[
          'genre-btn px-4 py-2 rounded-full text-white font-medium transition duration-200',
          selectedGenre === g ? 'bg-indigo-600' : 'bg-gray-600 hover:bg-gray-700',
        ]"
      >
        {{ g.charAt(0).toUpperCase() + g.slice(1) }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "SongSearch",
  props: {
    genres: {
      type: Array,
      required: true,
    },
  },
  emits: ["search"],
  data() {
    return {
      filters: {
        q: "",
        genre: "all",
      },
      selectedGenre: "all",
    };
  },
  methods: {
    emitSearch() {
      // Update URL search params for genre and q
      const url = new URL(window.location);
      url.searchParams.set("genre", this.filters.genre || "");
      url.searchParams.set("q", this.filters.query || "");
      window.history.replaceState({}, "", url);


      // Emit event with current filters
      this.$emit("search", { ...this.filters });
    },
    selectGenre(genre) {
      this.filters.genre = genre;
      this.selectedGenre = genre;
      this.emitSearch();
    },
  },

  mounted() {
    // Optionally emit the initial search to load songs
    this.emitSearch();
  },
};
</script>
