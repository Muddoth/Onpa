<template>
  <div class="flex justify-center space-x-2 mt-6">
    <button
      :disabled="page <= 1"
      @click="$emit('change-page', page - 1)"
      class="px-3 py-1 rounded bg-gray-700 text-white disabled:opacity-50"
    >
      Previous
    </button>

    <span class="px-3 py-1 rounded bg-gray-800 text-white">
      Page {{ page }} of {{ totalPages }}
    </span>

    <button
      :disabled="page >= totalPages"
      @click="$emit('change-page', page + 1)"
      class="px-3 py-1 rounded bg-gray-700 text-white disabled:opacity-50"
    >
      Next
    </button>
  </div>
</template>

<script>
export default {
  props: {
    page: {
      type: Number,
      required: true,
    },
    totalPages: {
      type: Number,
      required: true,
    },
  },
};
</script>
