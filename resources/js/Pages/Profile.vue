<script setup lang="ts">
import type { User } from '@/Types'
import { ref, computed } from 'vue'
import { useToggle, useDateFormat } from '@vueuse/core'
import Location from '@/Icons/Location.vue'
import Male from '@/Icons/Male.vue'
import Female from '@/Icons/Female.vue'
import Calender from '@/Icons/Calender.vue'
import Height from '@/Icons/Height.vue'
import Weight from '@/Icons/Weight.vue'
import Contact from '@/Icons/Contact.vue'
import Email from '@/Icons/Email.vue'
import Person from '@/Icons/Person.vue'
import Religion from '@/Icons/Religion.vue'
import Love from '@/Icons/Love.vue'
import formatText from '@/Utils/formatText'
import { useForm, type InertiaForm } from '@inertiajs/vue3'
import Close from '@/Icons/Close.vue'
const props = defineProps<{
  user: { data: User }
  errors: string[]
}>()
const user = computed(() => props.user.data)

type Form = Omit<User, 'avatar'> & { avatar: string | Blob }
const form: InertiaForm<Form> = useForm({
  name: user.value.name,
  address: user.value.address,
  gender: user.value.gender ? user.value.gender : '',
  birth: user.value.birth,
  height: user.value.height,
  weight: user.value.weight,
  phoneNumber: user.value.phoneNumber,
  username: user.value.username,
  religion: user.value.religion,
  loveLanguage: user.value.loveLanguage,
  avatar: '',
  bio: user.value.bio,
})

const [isEditing, toggleEditing] = useToggle(false)
const fileInputEl = ref<HTMLElement>()
const imagePreviewUrl = ref<string>(user.value.avatar)
const handleFileInput = () => {
  if (
    fileInputEl.value instanceof HTMLInputElement &&
    fileInputEl.value.files
  ) {
    const selectedFile: Blob = fileInputEl.value.files[0]
    if (
      !['image/png', 'image/jpeg', 'image/webp'].includes(
        fileInputEl.value?.files[0].type,
      )
    ) {
      return errors.value.push('Format avatar harus jpeg, png, jpg, atau webp.')
    }

    form.avatar = selectedFile
    imagePreviewUrl.value = URL.createObjectURL(selectedFile)
  }
}

const openfileInputEl = () => {
  if (fileInputEl.value) {
    fileInputEl.value.click()
  }
}
const errors = ref<string[]>([])
props.errors ? errors.value.push(...Object.values(props.errors)) : ''
</script>
<template>
  <div class="overflow-y-scroll h-screen">
    <div class="flex justify-center my-8">
      <div class="card card-compact w-[32rem]">
        <div class="flex card-body glass rounded-xl">
          <div class="space-y-2">
            <template v-if="!isEditing">
              <div class="avatar w-full">
                <div class="rounded-xl w-full">
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
                <span class="grow"
                  >{{ user.phoneNumber || 'Nomor telepon' }}
                </span>
              </label>
              <label class="input input-bordered flex items-center gap-2">
                <Religion />
                <span class="grow">{{ user.religion || 'Agama' }} </span>
              </label>
              <label class="input input-bordered flex items-center gap-2">
                <Love />
                <span class="grow"
                  >{{ user.loveLanguage || 'Bahasa cinta' }}
                </span>
              </label>
              <div
                class="textarea textarea-bordered"
                v-html="formatText(user.bio)"
                v-if="user.bio"
              />
              <div class="textarea textarea-bordered h-52" v-else>Bio</div>
              <button
                class="btn btn-primary mt-4 w-full"
                @click="toggleEditing()"
              >
                Edit
              </button>
            </template>
            <template v-else>
              <div
                class="avatar w-full cursor-pointer"
                @click="openfileInputEl()"
              >
                <div class="rounded-xl w-full">
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
              <input
                class="input input-primary w-full"
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
                <Email />
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
                class="textarea resize-none h-52 textarea-primary w-full"
                placeholder="Bio"
              />
              <div class="join flex mt-4">
                <button
                  class="btn btn-error join-item w-1/2"
                  @click="
                    toggleEditing(),
                      (imagePreviewUrl = user.avatar),
                      form.reset()
                  "
                >
                  Batal
                </button>
                <button
                  class="btn btn-primary join-item w-1/2"
                  @click="
                    toggleEditing(),
                      form.post('update', {
                        onStart: () => (errors = []),
                        onError: () => {
                          errors.push(...Object.values(form.errors))
                          isEditing = true
                        },
                        preserveScroll: true,
                      })
                  "
                  :disabled="form.processing"
                >
                  Simpan
                </button>
              </div>
            </template>
          </div>
          <div class="space-y-2"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="toast toast-end z-10">
    <div
      class="alert alert-error flex justify-between"
      v-for="(error, index) in errors"
      :key="index"
    >
      <span>{{ error }}</span>
      <div
        class="btn btn-xs btn-circle btn-ghost"
        @click="() => errors.splice(index, 1)"
      >
        <Close />
      </div>
    </div>
  </div>
</template>
