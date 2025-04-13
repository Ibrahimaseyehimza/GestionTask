


  <template>
  <div class="max-w-xl mx-auto p-4">
    <!-- Boutons de navigation -->
    <div class="flex justify-between mb-4">
      <button @click="mode = 'form'" class="bg-green-600 text-white px-4 py-2 rounded">+ Nouvelle tâche</button>
      <button @click="mode = 'list'" class="bg-blue-600 text-white px-4 py-2 rounded">📋 Voir les tâches</button>
    </div>

    <!-- Formulaire -->
    <div v-if="mode === 'form'">
      <h2 class="text-xl font-bold mb-3">
        {{ editingTaskId ? "Modifier la tâche" : "Ajouter une nouvelle tâche" }}
      </h2>

      <form @submit.prevent="addTask" class="space-y-3 mb-6">
        <input v-model="newTask.title" type="text" placeholder="Titre" class="w-full border p-2 rounded" required />
        <textarea v-model="newTask.description" placeholder="Description" class="w-full border p-2 rounded" required></textarea>
        <input v-model="newTask.due_date" type="date" class="w-full border p-2 rounded" required />

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          {{ editingTaskId ? "Mettre à jour" : "Ajouter" }}
        </button>

        <button v-if="editingTaskId" @click="resetForm" type="button" class="ml-2 text-gray-500 underline">
          Annuler l’édition
        </button>
      </form>
    </div>

    <!-- Liste des tâches -->
    <div v-if="mode === 'list'">
      <h2 class="text-xl font-bold mb-3">Toutes les tâches</h2>
      <ul class="space-y-4">
        <li v-for="task in filteredTasks" :key="task.id" class="border p-4 rounded bg-white shadow">
          <!-- <h3 class="text-lg font-semibold">{{ task.title }}</h3> -->
          <h3
            :class="{
                'text-lg font-semibold': true,
                'line-through text-gray-400': task.is_completed
            }"
            >
            {{ task.title }}
            </h3>

          <p class="text-sm text-gray-600">{{ task.description }}</p>
          <p class="text-xs text-gray-400">À faire pour le : {{ task.due_date }}</p>

           <!-- ✅ Checkbox -->
           <input type="checkbox" :checked="task.is_completed" @change="toggleCompleted(task)" class="ml-4 mt-1 w-5 h-5" />Terminée

          <div class="mt-2 space-x-2">
            <button @click="editTask(task)" class="text-blue-600 hover:underline">Modifier</button>
            <button @click="deleteTask(task.id)" class="text-red-600 hover:underline">Supprimer</button>

            <button @click="filter = 'all'">Toutes</button>
            <button @click="filter = 'todo'">À faire</button>
            <button @click="filter = 'done'">Terminées</button>



          </div>
        </li>
      </ul>
    </div>
  </div>
</template>




<script>
export default {
  data() {
    return {
      tasks: [],
      mode: 'list',
      filter: 'all',
      newTask: {
        title: '',
        description: '',
        due_date: '',
      },
      editingTaskId: null,
    };
  },

  computed: {
    filteredTasks() {
      if (this.filter === 'done') return this.tasks.filter(t => t.is_completed);
      if (this.filter === 'todo') return this.tasks.filter(t => !t.is_completed);
      return this.tasks;
    }
  },

  methods: {
    async getTasks() {
      const response = await axios.get('/api/tasks');
      this.tasks = response.data;
    },
    async addTask() {
      if (this.editingTaskId) {
        await this.updateTask();
        return;
      }

      const response = await axios.post('/api/tasks', this.newTask);
      this.tasks.push(response.data);
      this.resetForm();
      this.mode = 'list';
    },
    async updateTask() {
      const response = await axios.put(`/api/tasks/${this.editingTaskId}`, this.newTask);
      const index = this.tasks.findIndex(task => task.id === this.editingTaskId);
      this.tasks[index] = response.data;
      this.resetForm();
      this.mode = 'list';
    },
    async deleteTask(id) {
      await axios.delete(`/api/tasks/${id}`);
      this.tasks = this.tasks.filter(task => task.id !== id);
    },
    editTask(task) {
      this.newTask = { ...task };
      this.editingTaskId = task.id;
      this.mode = 'form';
    },
    resetForm() {
      this.newTask = { title: '', description: '', due_date: '' };
      this.editingTaskId = null;
    },

    // Marquer une tache comme terminée
    async toggleCompleted(task) {
        try {
            task.is_completed = !task.is_completed;

            await axios.put(`/api/tasks/${task.id}`, {
            title: task.title,
            description: task.description,
            due_date: task.due_date,
            is_completed: task.is_completed,
            });
        } catch (error) {
            console.error('Erreur lors de la mise à jour :', error);
        }
        }




  },
  created() {
    this.getTasks();
  },
};
</script>



  <style scoped>
  /* Ajoute ici ton style CSS pour les tâches */
h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 30px;
}

input, textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  padding: 10px;
  background-color: #2c3e50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #1a242f;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  padding: 15px;
  border: 1px solid #eee;
  border-radius: 8px;
  margin-bottom: 10px;
  background-color: #f9f9f9;
}
</style>


