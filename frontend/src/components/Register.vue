<template>
  <div class="register-container">
    <form @submit.prevent="handleRegister" class="register-form" enctype="multipart/form-data">
      <h2>Inscription</h2>
      
      <div class="form-group">
        <label for="fullName">Nom complet</label>
        <input
          type="text"
          id="fullName"
          v-model="form.full_name"
          required
        >
      </div>
      
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          v-model="form.email"
          required
        >
      </div>
      
      <div class="form-group">
        <label for="phone">Téléphone</label>
        <input
          type="tel"
          id="phone"
          v-model="form.phone_number"
          required
        >
      </div>
      
      <div class="form-group">
        <label for="address">Adresse</label>
        <textarea
          id="address"
          v-model="form.address"
          required
        ></textarea>
      </div>
      
      <div class="form-group">
        <label for="image">Photo de profil</label>
        <input
          type="file"
          id="image"
          @change="handleImageUpload"
          accept="image/*"
        >
      </div>
      
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input
          type="password"
          id="password"
          v-model="form.password"
          required
        >
      </div>
      
      <div class="form-group">
        <label for="passwordConfirmation">Confirmation du mot de passe</label>
        <input
          type="password"
          id="passwordConfirmation"
          v-model="form.password_confirmation"
          required
        >
      </div>
      
      <button type="submit" :disabled="loading">
        {{ loading ? 'Inscription...' : 'S\'inscrire' }}
      </button>
      
      <p v-if="error" class="error">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import axios from 'axios'

const router = useRouter()
const authStore = useAuthStore()

const form = ref({
  full_name: '',
  email: '',
  phone_number: '',
  address: '',
  image: null,
  password: '',
  password_confirmation: ''
})
const loading = ref(false)
const error = ref('')

const handleImageUpload = (event) => {
  form.value.image = event.target.files[0]
}

const handleRegister = async () => {
  try {
    loading.value = true
    error.value = ''
    
    const formData = new FormData()
    Object.keys(form.value).forEach(key => {
      if (form.value[key] !== null) {
        formData.append(key, form.value[key])
      }
    })
    
    const response = await axios.post('/api/auth/register', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    
    authStore.setToken(response.data.token)
    authStore.setUser(response.data.user)
    
    router.push('/tasks')
  } catch (err) {
    error.value = err.response?.data?.message || 'Erreur d\'inscription'
  } finally {
    loading.value = false
  }
}
</script>