import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useTaskStore = defineStore('tasks', () => {
  const tasks = ref([])
  const loading = ref(false)
  const error = ref(null)

  const fetchTasks = async () => {
    try {
      loading.value = true
      const response = await axios.get('/api/tasks')
      tasks.value = response.data
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to fetch tasks'
    } finally {
      loading.value = false
    }
  }

  const addTask = async (taskData) => {
    try {
      loading.value = true
      const response = await axios.post('/api/tasks', taskData)
      tasks.value.push(response.data)
      return response.data
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to add task'
      throw err
    } finally {
      loading.value = false
    }
  }

  const updateTask = async (id, taskData) => {
    try {
      loading.value = true
      const response = await axios.put(`/api/tasks/${id}`, taskData)
      const index = tasks.value.findIndex(task => task.id === id)
      if (index !== -1) {
        tasks.value[index] = response.data
      }
      return response.data
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to update task'
      throw err
    } finally {
      loading.value = false
    }
  }

  const deleteTask = async (id) => {
    try {
      loading.value = true
      await axios.delete(`/api/tasks/${id}`)
      tasks.value = tasks.value.filter(task => task.id !== id)
    } catch (err) {
      error.value = err.response?.data?.message || 'Failed to delete task'
      throw err
    } finally {
      loading.value = false
    }
  }

  return {
    tasks,
    loading,
    error,
    fetchTasks,
    addTask,
    updateTask,
    deleteTask
  }
})