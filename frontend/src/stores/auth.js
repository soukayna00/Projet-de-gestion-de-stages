import {defineStore} from 'pinia'
import { ref , computed } from 'vue'
import api from '../services/api'

export const useAuthStore = defineStore('auth', () => {
    const user = ref(JSON.parse(localStorage.getItem('user')) || null)
    const token = ref(localStorage.getItem('token') || null)

    const isAuthenticated = computed(() => !!token.value)
    const isAdmin = computed(() => user.value?.role === 'admin')
    const isEntreprise = computed(() => user.value?.role === 'entreprise')
    const isStagiaire = computed(() => user.value?.role === 'stagiaire')

    async function login(credentials) {
        const response = await api.post('/auth/login', credentials)
        token.value = response.data.token
        user.value = response.data.user
        localStorage.setItem('token', token.value)
        localStorage.setItem('user', JSON.stringify(user.value))
        return response.data.user
    }

    async function logout() {
        await api.post('/auth/logout')
        token.value = null
        user.value = null
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }

    async function fetchUser() {
        const response = await api.get('/auth/me')
        user.value = response.data
        localStorage.setItem('user', JSON.stringify(user.value))
    }

    return {
        user,
        token,
        isAuthenticated,
        isAdmin,
        isEntreprise,
        isStagiaire,
        login,
        logout,
        fetchUser
    }
})
  