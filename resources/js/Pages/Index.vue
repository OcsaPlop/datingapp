<script setup lang="ts">
import { computed } from 'vue'
import type { User } from '@/Types'

const props = defineProps<{
  rooms
  auth: { user: { data: User } }
}>()

const authId = computed(() => props.auth.user.data.id)
</script>
<template>
  <div v-for="room in props.rooms.data">
    <div class="mx-4 mt-4">
      <Link
        :href="
          room.user1.id === authId ? room.user2.username : room.user1.username
        "
        class="flex w-full p-4 rounded-xl items-center gap-4 glass"
      >
        <div class="avatar">
          <div class="rounded-full w-12">
            <img
              :src="
                room.user1.id === authId ? room.user2.avatar : room.user1.avatar
              "
            />
          </div>
        </div>
        <span class="font-semibold text-lg">
          {{ room.user1.id === authId ? room.user2.name : room.user1.name }}
        </span>
      </Link>
    </div>
  </div>
</template>
