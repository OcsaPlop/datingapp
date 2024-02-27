export interface User {
  id?: number
  name: string
  username: string
  address: string
  height: number
  weight: number
  gender: string
  birth: Date
  email?: string
  phoneNumber: number
  avatar: string
  religion: string
  loveLanguage: string
  bio: string
}

export interface Message {
  content: string
  senderId: number
  createdAt: Date
}
