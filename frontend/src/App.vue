<template>
  <div id="app">
    <nav v-if="authStore.user" class="navbar">
      <div class="nav-brand">To-Do App</div>
      <div class="nav-links">
        <router-link to="/tasks">Tâches</router-link>
        <router-link to="/notifications">Notifications</router-link>
        <button @click="handleLogout" class="btn-link">Déconnexion</button>
      </div>
    </nav>
    
    <main>
      <router-view />
    </main>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()

const handleLogout = async () => {
  try {
    await authStore.logout()
    router.push('/login')
  } catch (error) {
    console.error('Logout error:', error)
  }
}
</script>