<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import Guest from '@/Layouts/Guest.vue'
import Close from '@/Icons/Close.vue'
import { ref } from 'vue'

const form = useForm({
  email: '',
  password: '',
})
defineOptions({
  layout: Guest,
})
const errors = ref<string[]>([])
</script>
<template>
  <div
    class="card glass w-96 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
  >
    <div class="card-body">
      <div class="text-2xl font-semibold text-center">Masuk</div>
      <form
        @submit.prevent="
          form.post('/login', {
            onStart: () => (errors = []),
            onError: () => errors.push(...Object.values(form.errors)),
          })
        "
      >
        <div class="relative group mt-8">
          <input
            required
            type="text"
            class="peer flex mt-2 input w-full"
            v-model="form.email"
          />
          <label
            class="absolute top-0 left-0 flex items-center h-full pl-2 text-sm transition-all transform group-focus-within:text-xs peer-valid:text-xs group-focus-within:h-1/2 peer-valid:h-1/2 group-focus-within:-translate-y-full peer-valid:-translate-y-full group-focus-within:pl-0 peer-valid:pl-0 pointer-events-none"
            >Email</label
          >
        </div>
        <div class="relative group mt-8">
          <input
            required
            type="password"
            class="peer flex mt-2 input w-full"
            v-model="form.password"
          />
          <label
            class="absolute top-0 left-0 flex items-center h-full pl-2 text-sm transition-all transform group-focus-within:text-xs peer-valid:text-xs group-focus-within:h-1/2 peer-valid:h-1/2 group-focus-within:-translate-y-full peer-valid:-translate-y-full group-focus-within:pl-0 peer-valid:pl-0 pointer-events-none"
            >Sandi</label
          >
        </div>
        <button
          type="submit"
          :disabled="form.processing"
          class="mt-6 btn btn-block btn-primary"
        >
          Masuk
        </button>
      </form>
      <div>
        Belum memiliki akun?
        <Link href="/register" class="text-blue-400 link-hover">Register</Link>
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
