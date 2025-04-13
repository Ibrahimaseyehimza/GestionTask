<template>
    <div class="task-list-container">
      <h2>📝 Liste des tâches</h2>

      <!-- Filtres -->
      <div class="filters">
        <button @click="filter = 'all'" :class="{ active: filter === 'all' }">Tous</button>
        <button @click="filter = 'incomplete'" :class="{ active: filter === 'incomplete' }">En cours</button>
        <button @click="filter = 'completed'" :class="{ active: filter === 'completed' }">Terminées</button>
      </div>

      <!-- Liste des tâches -->
      <ul class="task-list">
        <li v-for="task in filteredTasks" :key="task.id" class="task-item">
          <input type="checkbox" :checked="task.is_completed" @change="toggleCompleted(task)" />
          <span :class="{ done: task.is_completed }">{{ task.title }}</span>
        </li>
      </ul>
    </div>
  </template>

  <script>
  import axios from 'axios';
  import Swal from 'sweetalert2';

  export default {
    data() {
      return {
        tasks: [],
        filter: 'all',
      };
    },
    computed: {
      filteredTasks() {
        if (this.filter === 'completed') {
          return this.tasks.filter(task => task.is_completed);
        } else if (this.filter === 'incomplete') {
          return this.tasks.filter(task => !task.is_completed);
        }
        return this.tasks;
      },
    },
    methods: {
      async fetchTasks() {
        const res = await axios.get('/api/tasks');
        this.tasks = res.data;
      },
      async toggleCompleted(task) {
        try {
          await axios.put(`/api/tasks/${task.id}`, {
            ...task,
            is_completed: !task.is_completed,
          });

          task.is_completed = !task.is_completed;

          // 🎉 Affichage SweetAlert si la tâche est terminée
          if (task.is_completed) {
            Swal.fire({
              title: 'Super ! 🎉',
              text: 'Tâche marquée comme terminée.',
              icon: 'success',
              confirmButtonText: 'OK'
            });
          }
        } catch (error) {
          console.error(error);
          Swal.fire({
            title: 'Oups 😢',
            text: 'Une erreur est survenue.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      },
    },
    created() {
      this.fetchTasks();
    },
  };
  </script>

  <style scoped>
  .task-list-container {
    padding: 20px;
    max-width: 600px;
    margin: auto;
  }

  h2 {
    font-size: 22px;
    margin-bottom: 20px;
    text-align: center;
    font-family: sans-serif;
  }

  .filters {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
  }

  .filters button {
    padding: 8px 12px;
    border: 1px solid #ccc;
    background-color: #f5f5f5;
    cursor: pointer;
    border-radius: 4px;
  }

  .filters button.active {
    background-color: #007bff;
    color: white;
  }

  .task-list {
    list-style: none;
    padding: 0;
  }

  .task-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-bottom: 1px solid #eee;
    font-family: sans-serif;
  }

  .task-item .done {
    text-decoration: line-through;
    color: gray;
  }
  </style>
