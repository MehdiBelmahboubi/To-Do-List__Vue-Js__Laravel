<template>
  <div class="notifications-container">
    <h2>Notifications</h2>
    
    <div v-if="notifications.length === 0" class="empty-state">
      Aucune notification
    </div>
    
    <div v-else class="notifications-list">
      <div 
        v-for="notification in notifications" 
        :key="notification.id" 
        class="notification-item"
      >
        <div class="notification-content">
          <p>{{ notification.message }}</p>
          <small>{{ formatDate(notification.timestamp) }}</small>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import echo from '@/config/echo'

const authStore = useAuthStore()
const notifications = ref([])

onMounted(() => {
  // Écouter les notifications en temps réel
  echo.private(`tasks.${authStore.user.id}`)
    .listen('TaskCreated', (e) => {
      notifications.value.unshift({
        id: Date.now(),
        message: e.message,
        timestamp: new Date(),
        task: e.task
      })
    })
})

onUnmounted(() => {
  // Se désabonner des channels
  echo.leave(`tasks.${authStore.user.id}`)
})

const formatDate = (date) => {
  return new Intl.DateTimeFormat('fr-FR', {
    hour: '2-digit',
    minute: '2-digit',
    day: '2-digit',
    month: '2-digit',
    year: 'numeric'
  }).format(date)
}
</script>