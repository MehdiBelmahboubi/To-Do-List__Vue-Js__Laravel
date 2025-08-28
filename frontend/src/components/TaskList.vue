<template>
  <div class="task-container">
    <div class="task-header">
      <h2>Mes Tâches</h2>
      <button @click="showAddForm = true" class="btn-primary">
        Ajouter une tâche
      </button>
    </div>

    <!-- Formulaire d'ajout -->
    <div v-if="showAddForm" class="task-form">
      <h3>Nouvelle tâche</h3>
      <form @submit.prevent="handleAddTask">
        <div class="form-group">
          <label for="title">Titre</label>
          <input
            type="text"
            id="title"
            v-model="newTask.title"
            required
          >
        </div>
        
        <div class="form-group">
          <label for="description">Description</label>
          <textarea
            id="description"
            v-model="newTask.description"
          ></textarea>
        </div>
        
        <div class="form-actions">
          <button type="submit" :disabled="taskStore.loading">
            Ajouter
          </button>
          <button type="button" @click="showAddForm = false">
            Annuler
          </button>
        </div>
      </form>
    </div>

    <!-- Liste des tâches -->
    <div v-if="taskStore.loading" class="loading">Chargement...</div>
    
    <div v-else-if="taskStore.tasks.length === 0" class="empty-state">
      Aucune tâche pour le moment
    </div>
    
    <div v-else class="task-list">
      <div v-for="task in taskStore.tasks" :key="task.id" class="task-item">
        <div class="task-info">
          <h3 :class="{ completed: task.completed }">{{ task.title }}</h3>
          <p v-if="task.description">{{ task.description }}</p>
        </div>
        
        <div class="task-actions">
          <input
            type="checkbox"
            :checked="task.completed"
            @change="toggleTaskCompletion(task)"
          >
          <button @click="editTask(task)" class="btn-secondary">
            Modifier
          </button>
          <button @click="deleteTask(task.id)" class="btn-danger">
            Supprimer
          </button>
        </div>
      </div>
    </div>

    <!-- Modal d'édition -->
    <div v-if="editingTask" class="modal">
      <div class="modal-content">
        <h3>Modifier la tâche</h3>
        <form @submit.prevent="handleUpdateTask">
          <div class="form-group">
            <label for="edit-title">Titre</label>
            <input
              type="text"
              id="edit-title"
              v-model="editingTask.title"
              required
            >
          </div>
          
          <div class="form-group">
            <label for="edit-description">Description</label>
            <textarea
              id="edit-description"
              v-model="editingTask.description"
            ></textarea>
          </div>
          
          <div class="form-group">
            <label>
              <input
                type="checkbox"
                v-model="editingTask.completed"
              >
              Complétée
            </label>
          </div>
          
          <div class="form-actions">
            <button type="submit" :disabled="taskStore.loading">
              Modifier
            </button>
            <button type="button" @click="editingTask = null">
              Annuler
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useTaskStore } from '@/stores/tasks'

const taskStore = useTaskStore()

const showAddForm = ref(false)
const editingTask = ref(null)
const newTask = ref({
  title: '',
  description: '',
  completed: false
})

onMounted(() => {
  taskStore.fetchTasks()
})

const handleAddTask = async () => {
  try {
    await taskStore.addTask(newTask.value)
    newTask.value = { title: '', description: '', completed: false }
    showAddForm.value = false
  } catch (error) {
    console.error('Error adding task:', error)
  }
}

const editTask = (task) => {
  editingTask.value = { ...task }
}

const handleUpdateTask = async () => {
  try {
    await taskStore.updateTask(editingTask.value.id, editingTask.value)
    editingTask.value = null
  } catch (error) {
    console.error('Error updating task:', error)
  }
}

const toggleTaskCompletion = async (task) => {
  try {
    await taskStore.updateTask(task.id, {
      ...task,
      completed: !task.completed
    })
  } catch (error) {
    console.error('Error toggling task:', error)
  }
}

const deleteTask = async (taskId) => {
  if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
    try {
      await taskStore.deleteTask(taskId)
    } catch (error) {
      console.error('Error deleting task:', error)
    }
  }
}
</script>