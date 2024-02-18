export interface User extends UserType {
  data: UserType
  value: UserType
}

interface UserType {
  id: number
  name: string
  username: string
  address: string
  height: number
  weight: number
  gender: string
  birth: Date
  email: string
  phoneNumber: number
  avatar: string
  religion: string
  loveLanguage: string
  bio: string
}

export interface Message extends MessageType {
  data: MessageType
  value: MessageType
}

export interface Messages {
  data: Message[]
  value: Message[]
}

interface MessageType {
  content: string
  senderId: number
  createdAt: Date
}

export interface Auth {
  user: User
}
