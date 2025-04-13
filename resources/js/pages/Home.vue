<!-- <template>
    <div>
      <h1>📌 Tâches en cours</h1>
      <ul v-if="tasks.length">
        <li v-for="task in tasks" :key="task.id" class="task">
          <h3>{{ task.title }}</h3>
          <p>{{ task.description }}</p>
          <small>À faire avant le : {{ task.due_date }}</small>
        </li>
      </ul>
      <p v-else>Aucune tâche en cours pour le moment ✅</p>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    name: 'Home',
    data() {
      return {
        tasks: [],
      };
    },
    async created() {
      try {
        const response = await axios.get('/api/tasks');
        this.tasks = response.data.filter(task => !task.is_completed);
      } catch (error) {
        console.error('Erreur lors de la récupération des tâches :', error);
      }
    },
  };
  </script>

  <style scoped>
  h1 {
    font-size: 24px;
    margin-bottom: 20px;
    font-family: sans-serif;
  }

  .task {
    background: white;
    padding: 15px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    margin-bottom: 15px;
    font-family: sans-serif;
  }

  .task h3 {
    margin: 0;
  }

  .task p {
    margin: 5px 0;
  }

  .task small {
    color: #888;
  }
  </style> -->








  <template>
    <div>
      <h1>📌 Tâches en cours</h1>
      <ul v-if="tasks.length">
        <li v-for="task in tasks" :key="task.id" class="task">
          <h3>{{ task.title }}</h3>
          <p>{{ task.description }}</p>
          <small>À faire avant le : {{ task.due_date }}</small>
        </li>
      </ul>
      <p v-else>Aucune tâche en cours pour le moment ✅</p>
    </div>
  </template>

  <script>
  import axios from 'axios'

  export default {
    name: 'Home',
    data() {
      return {
        tasks: [],
      }
    },
    async created() {
      try {
        // 👇 Récupération du cookie CSRF AVANT toute requête protégée
        await axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie', {
          withCredentials: true
        })

        // 👇 Appel à l'API avec l'authentification
        const response = await axios.get('http://127.0.0.1:8000/api/tasks', {
          withCredentials: true
        })

        this.tasks = response.data.filter(task => !task.is_completed)
      } catch (error) {
        console.error('Erreur lors de la récupération des tâches :', error)
      }
    },
  }
  </script>

  <style scoped>
  h1 {
    font-size: 24px;
    margin-bottom: 20px;
    font-family: sans-serif;
  }

  .task {
    background: white;
    padding: 15px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    margin-bottom: 15px;
    font-family: sans-serif;
  }

  .task h3 {
    margin: 0;
  }

  .task p {
    margin: 5px 0;
  }

  .task small {
    color: #888;
  }
  </style>
