<script setup lang="ts">
defineProps<{
  message: string
}>()
</script>
<template>
  <h1 class="text-3xl">{{ message }}</h1>
</template>
