<script setup lang="ts">
import type { User } from '../Types'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { useToggle, useDateFormat } from '@vueuse/core'
import Location from '../Icons/Location.vue'
import Male from '../Icons/Male.vue'
import Female from '../Icons/Female.vue'
import Calender from '../Icons/Calender.vue'
import Height from '../Icons/Height.vue'
import Weight from '../Icons/Weight.vue'
import Contact from '../Icons/Contact.vue'
import Email from '../Icons/Email.vue'
import Person from '../Icons/Person.vue'
import Religion from '../Icons/Religion.vue'
import Love from '../Icons/Love.vue'

const { user } = defineProps<{
  user: User
}>()

const form: any = useForm({
  name: user.name,
  address: user.address,
  gender: user.gender ? user.gender : '',
  birth: user.birth,
  height: user.height,
  weight: user.weight,
  phoneNumber: user.phoneNumber,
  username: user.username,
  religion: user.religion,
  loveLanguage: user.loveLanguage,
  avatar: null,
  bio: user.bio,
})

const [isEditing, toggleEditing] = useToggle(false)
const fileInputEl = ref<any>()
const imagePreviewUrl = ref<string>(user.avatar)
const handleFileInput = () => {
  if (
    !['image/png', 'image/jpeg', 'image/webp'].includes(
      fileInputEl.value?.files[0].type,
    )
  ) {
    return console.error('File format not supported')
  }

  form.avatar = fileInputEl.value?.files[0]
  imagePreviewUrl.value = URL.createObjectURL(form.avatar)
}

const openfileInputEl = () => {
  fileInputEl.value.click()
}
</script>
<template>
  <div class="flex gap-32 p-16">
    <div class="card card-compact w-96 shrink-0 shadow-xl glass">
      <div class="card-body space-y-4">
        <template v-if="!isEditing">
          <div class="avatar">
            <div class="rounded-xl w-96">
              <img :src="user.avatar" />
            </div>
          </div>
          <span
            class="input flex items-center justify-center font-semibold text-xl"
          >
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
          <label class="input input-bordered flex items-center gap-2">
            <Calender />
            <span class="grow">{{
              user.birth
                ? useDateFormat(user.birth, 'D MMM YYYY').value
                : 'Tanggal lahir'
            }}</span>
          </label>
          <button class="btn btn-primary" @click="toggleEditing()">Edit</button>
        </template>
        <template v-else>
          <div class="avatar" @click="openfileInputEl()">
            <div class="rounded-xl w-96">
              <img :src="imagePreviewUrl" />
            </div>
          </div>
          <input
            type="file"
            ref="fileInputEl"
            @change="handleFileInput()"
            accept=".jpg, .jpeg, .png, .webp"
            class="hidden"
          />
          <progress
            v-if="form.progress"
            :value="form.progress.percentage"
            max="100"
          >
            {{ form.progress.percentage }}%
          </progress>
          <input
            class="input input-primary"
            v-model="form.name"
            placeholder="Nama"
          />
          <label class="input input-primary flex items-center gap-2">
            <Location />
            <input
              type="text"
              class="grow"
              v-model="form.address"
              placeholder="Alamat"
            />
          </label>
          <select
            class="select select-bordered select-primary w-full"
            v-model="form.gender"
          >
            <option disabled selected value="">Jenis kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
          <label class="input input-primary flex items-center gap-2">
            <Calender />
            <input type="date" class="grow" v-model="form.birth" />
          </label>
          <div class="join flex">
            <button
              class="btn btn-error join-item w-1/2"
              @click="
                form.reset(), toggleEditing(), (imagePreviewUrl = user.avatar)
              "
            >
              Batal
            </button>
            <button
              class="btn btn-primary join-item w-1/2"
              @click="toggleEditing(), form.post('/update')"
              :disabled="form.processing"
            >
              Simpan
            </button>
          </div>
        </template>
      </div>
    </div>
    <div class="card card-compact w-96 shrink-0 shadow-xl glass">
      <div class="card-body space-y-4">
        <template v-if="!isEditing">
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
            <Email />
            <span class="grow">{{ user.email }} </span>
          </label>
          <label class="input input-bordered flex items-center gap-2">
            <Contact />
            <span class="grow">{{ user.phoneNumber || 'Nomor telepon' }} </span>
          </label>
          <label class="input input-bordered flex items-center gap-2">
            <Religion />
            <span class="grow">{{ user.religion || 'Agama' }} </span>
          </label>
          <label class="input input-bordered flex items-center gap-2">
            <Love />
            <span class="grow">{{ user.loveLanguage || 'Bahasa cinta' }} </span>
          </label>
          <div
            class="textarea textarea-bordered h-52"
            v-html="user.bio"
            v-if="user.bio"
          />
          <div class="textarea textarea-bordered h-52" v-else>Bio</div>
        </template>
        <template v-else>
          <label class="input input-primary flex items-center gap-2">
            <Person />
            <input
              type="text"
              class="grow"
              v-model="form.username"
              placeholder="Username"
            />
          </label>
          <label class="input input-primary flex items-center gap-2">
            <Height />
            <input
              type="text"
              class="grow"
              v-model="form.height"
              placeholder="Tinggi badan"
            />
            cm
          </label>
          <label class="input input-primary flex items-center gap-2">
            <Weight />
            <input
              type="text"
              class="grow"
              v-model="form.weight"
              placeholder="Berat badan"
            />kg
          </label>
          <label
            class="input input-primary input-disabled flex items-center gap-2"
          >
            <Contact />
            <input
              disabled
              type="text"
              class="grow input-disabled"
              v-model="user.email"
              placeholder="Email"
            />
          </label>
          <label class="input input-primary flex items-center gap-2">
            <Contact />
            <input
              type="text"
              class="grow"
              v-model="form.phoneNumber"
              placeholder="Nomor telepon"
            />
          </label>
          <label class="input input-primary flex items-center gap-2">
            <Religion />
            <input
              type="text"
              class="grow"
              v-model="form.religion"
              placeholder="Agama"
            />
          </label>
          <label class="input input-primary flex items-center gap-2">
            <Love />
            <input
              type="text"
              class="grow"
              v-model="form.loveLanguage"
              placeholder="Love language"
            />
          </label>
          <textarea
            v-model="form.bio"
            class="textarea resize-none h-52 textarea-primary"
            placeholder="Bio"
          />
        </template>
      </div>
    </div>
  </div>
</template>
