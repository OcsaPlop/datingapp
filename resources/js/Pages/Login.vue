<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import Guest from '../Layouts/Guest.vue'

const form = useForm({
  email: '',
  password: '',
})
defineOptions({
  layout: Guest,
})
</script>
<template>
  <div
    class="card glass w-96 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
  >
    <div class="card-body">
      <div class="text-2xl font-semibold text-center">Masuk</div>
      <form @submit.prevent="form.post('/login')">
        <div class="relative group mt-8">
          <input
            type="text"
            required
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
            type="password"
            required
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
</template>
