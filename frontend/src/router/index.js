import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/',
    redirect: '/tasks'
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/components/Login.vue'),
    meta: { requiresAuth: false }
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('@/components/Register.vue'),
    meta: { requiresAuth: false }
  },
  {
    path: '/tasks',
    name: 'Tasks',
    component: () => import('@/components/TaskList.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/notifications',
    name: 'Notifications',
    component: () => import('@/components/Notifications.vue'),
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  
  if (to.meta.requiresAuth && !authStore.token) {
    next('/login')
  } else if (!to.meta.requiresAuth && authStore.token) {
    next('/tasks')
  } else {
    next()
  }
})

export default router