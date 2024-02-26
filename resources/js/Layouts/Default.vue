<script setup lang="ts">
import ChevronRight from '../Icons/ChevronRight.vue'
</script>
<template>
  <div class="drawer xl:drawer-open bg-default bg-cover h-screen">
    <input id="drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content w-full">
      <label
        for="drawer"
        class="drawer-button xl:hidden absolute z-50 top-1/2 -translate-y-1/2 p-2 ml-1 hover:bg-white/20 rounded-full"
        ><ChevronRight
      /></label>
      <slot />
    </div>
    <div class="drawer-side z-20 h-screen">
      <label for="drawer" aria-label="close sidebar" class="drawer-overlay" />
      <ul class="menu p-4 w-80 text-base-content glass h-screen">
        <div class="flex justify-center p-4">
          <img :src="'/logo.png'" class="w-24 rounded-full" />
        </div>
        <li>
          <Link
            href="/search"
            class="btn justify-start"
            :class="$page.component === 'Search' ? 'btn-primary' : 'btn-ghost'"
            >Cari</Link
          >
        </li>
        <li>
          <Link
            href="/"
            class="btn justify-start"
            :class="$page.component === 'Index' ? 'btn-primary' : 'btn-ghost'"
            >Obrolan</Link
          >
        </li>
        <li>
          <Link
            href="/profile"
            class="btn justify-start"
            :class="$page.component === 'Profile' ? 'btn-primary' : 'btn-ghost'"
            >Profil</Link
          >
        </li>
        <li>
          <Link
            href="/logout"
            as="button"
            method="post"
            class="btn btn-ghost justify-start"
            >Keluar</Link
          >
        </li>
      </ul>
    </div>
  </div>
</template>
