<script setup lang="ts">
import { computed, ref, reactive, onMounted, onUnmounted } from 'vue'
import axios from 'axios'
import type { User, Message } from '@/Types'
import Send from '@/Icons/Send.vue'
import formatText from '@/Utils/formatText'
import { useDateFormat, useScroll } from '@vueuse/core'

const props = defineProps<{
  user: { data: User }
  messages: { data: Message[] }
  auth: { user: { data: User } }
}>()

const user = computed(() => props.user.data)
const messages = ref(props.messages.data)

const form = reactive({
  content: '',
})

const isFetching = ref(false)
const submit = async () => {
  try {
    isFetching.value = true
    const { data } = await axios.post(`/send/${user.value.username}`, form)
    await messages.value.push(data)
  } finally {
    isFetching.value = false
    form.content = ''
    scrollDown()
  }
}

const messagesContainer = ref()
const { y } = useScroll(messagesContainer, { behavior: 'smooth' })
const scrollDown = () => {
  y.value =
    messagesContainer.value.scrollHeight - messagesContainer.value.clientHeight
}
onMounted(() => {
  // @ts-ignore
  Echo.private(`chat.${props.auth.user.data.id}`).listen(
    'SendMessage',
    async (e) => {
      await messages.value.push(e.message)
      scrollDown()
    },
  )
  scrollDown()
})
onUnmounted(() => {
  //@ts-ignore
  Echo.leave(`chat.${props.auth.user.data.id}`)
})
</script>
<template>
  <div class="flex flex-col max-h-screen">
    <div class="navbar glass gap-4 top-0 z-10">
      <div class="avatar">
        <div class="rounded-full w-12">
          <img :src="user.avatar" />
        </div>
      </div>
      <span class="font-semibold text-lg">
        {{ user.name }}
      </span>
    </div>
    <div class="grow p-2 h-screen overflow-y-scroll" ref="messagesContainer">
      <div v-for="message in messages">
        <div
          class="chat"
          :class="message.senderId === user.id ? 'chat-start' : 'chat-end mr-4'"
        >
          <div class="chat-bubble relative pb-6 pr-8">
            <span v-html="formatText(message.content)" />
            <span class="absolute bottom-1 text-xs right-2">
              {{ useDateFormat(message.createdAt, 'HH:mm').value }}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="glass p-4 gap-4 z-10">
      <form @submit.prevent="submit()">
        <div class="join w-full">
          <input
            class="input join-item w-full focus:outline-none disabled:cursor-progress"
            placeholder="Ketik pesan"
            v-model="form.content"
            :disabled="isFetching"
          />
          <button class="btn join-item" :disabled="isFetching"><Send /></button>
        </div>
      </form>
    </div>
  </div>
</template>
