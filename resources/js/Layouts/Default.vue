<script setup lang="ts"></script>
<template>
  <div class="drawer drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
      <slot />
    </div>
    <div class="drawer-side glass">
      <div class="flex justify-center p-4">
        <img :src="'/logo.png'" class="w-24 rounded-full" />
      </div>
      <ul class="menu p-4 w-80 text-base-content">
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
            href="/settings"
            class="btn justify-start"
            :class="
              $page.component === 'Settings' ? 'btn-primary' : 'btn-ghost'
            "
            >Pengaturan</Link
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
