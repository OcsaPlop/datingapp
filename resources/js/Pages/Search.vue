<script setup lang="ts">
import type { User } from '../Types'
import { computed } from 'vue'
import Location from '../Icons/Location.vue'
import Male from '../Icons/Male.vue'
import Female from '../Icons/Female.vue'
import Height from '../Icons/Height.vue'
import Weight from '../Icons/Weight.vue'
import Person from '../Icons/Person.vue'
import Religion from '../Icons/Religion.vue'
import Love from '../Icons/Love.vue'
import X from '../Icons/X.vue'
import Heart from '../Icons/Heart.vue'
import formatText from '../Utils/formatText'
const props = defineProps<{
  user: User
}>()

const user = computed(() => props.user.data)
</script>
<template>
  <div class="flex justify-around items-center h-full">
    <div class="card card-compact w-96 shrink-0 shadow-xl glass">
      <div class="card-body space-y-2">
        <div class="avatar">
          <div class="rounded-xl w-96">
            <img :src="user.avatar" />
          </div>
        </div>
        <span class="flex items-center justify-center font-bold text-xl">
          {{ user.name }}
        </span>
        <label class="input input-bordered flex items-center gap-2">
          <Location />
          <span class="grow">{{ user.address || 'Alamat' }}</span>
        </label>
        <label class="input input-bordered flex items-center gap-2">
          <template v-if="user.gender === 'L'">
            <Male />
            <span class="grow">Laki-laki</span>
          </template>
          <template v-else-if="user.gender === 'P'">
            <Female />
            <span class="grow">Perempuan</span>
          </template>
          <template v-else>
            <span class="text-sm"> Jenis kelamin </span>
          </template>
        </label>
        <div
          class="textarea textarea-bordered"
          v-html="formatText(user.bio)"
          v-if="user.bio"
        />
        <div class="textarea textarea-bordered h-52" v-else>Tidak ada bio</div>
      </div>
    </div>
    <div class="space-y-32">
      <div class="card card-compact w-96 shadow-xl glass">
        <div class="card-body space-y-2 my-1">
          <label class="input input-bordered flex items-center gap-2">
            <Person />
            <span class="grow">{{ user.username || 'Username' }}</span>
          </label>
          <label class="input input-bordered flex items-center gap-2">
            <Height />
            <span class="grow">{{
              user.height ? user.height + ' cm' : 'Tinggi badan'
            }}</span>
          </label>
          <label class="input input-bordered flex items-center gap-2">
            <Weight />
            <span class="grow">{{
              user.weight ? user.weight + ' kg' : 'Berat badan'
            }}</span>
          </label>
          <label class="input input-bordered flex items-center gap-2">
            <Religion />
            <span class="grow">{{ user.religion || 'Agama' }} </span>
          </label>
          <label class="input input-bordered flex items-center gap-2">
            <Love />
            <span class="grow">{{ user.loveLanguage || 'Bahasa cinta' }} </span>
          </label>
        </div>
      </div>
      <div class="card card-compact w-96 shadow-xl glass">
        <div class="card-body">
          <div class="flex gap-8 justify-around">
            <Link class="btn btn-circle h-32 w-32 p-6" href="">
              <X />
            </Link>
            <Link
              class="btn btn-circle h-32 w-32 p-6"
              :href="`/${user.username}`"
            >
              <Heart />
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
