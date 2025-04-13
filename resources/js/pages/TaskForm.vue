<!-- <template>
    <div class="create-task-container">
      <h2>➕ Nouvelle tâche</h2>

      <form @submit.prevent="submitTask">
        <div clas   s="form-group">
          <label for="title">Titre</label>
          <input v-model="task.title" type="text" id="title" required />
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea v-model="task.description" id="description" required></textarea>
        </div>

        <div class="form-group">
          <label for="due_date">Date limite</label>
          <input v-model="task.due_date" type="date" id="due_date" required />
        </div>

        <button type="submit">Créer la tâche</button>
      </form>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        task: {
          title: '',
          description: '',
          due_date: '',
        },
      };
    },
    methods: {
      async submitTask() {
        try {
          await axios.post('/api/tasks', this.task);
          this.$router.push('/tasks');
        } catch (error) {
          console.error('Erreur de création :', error);
        }
      },
    },
  };
  </script>

  <style scoped>



  .create-task-container {
    max-width: 500px;
    margin: auto;
    padding: 20px;
  }

  h2 {
    font-size: 22px;
    margin-bottom: 20px;
    text-align: center;
    font-family: sans-serif;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    font-family: sans-serif;
  }

  .form-group {
    display: flex;
    flex-direction: column;
  }

  label {
    margin-bottom: 5px;
    font-weight: bold;
  }

  input,
  textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  button {
    padding: 10px;
    background-color: #28a745;
    border: none;
    color: white;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
  }

  button:hover {
    background-color: #218838;
  }
  </style> -->












  <template>
    <div class="create-task-container">
      <h2>➕ Nouvelle tâche</h2>

      <form @submit.prevent="submitTask">
        <div class="form-group">
          <label for="title">Titre</label>
          <input v-model="task.title" type="text" id="title" required />
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea v-model="task.description" id="description" required></textarea>
        </div>

        <div class="form-group">
          <label for="due_date">Date limite</label>
          <input v-model="task.due_date" type="date" id="due_date" required />
        </div>

        <button type="submit">Créer la tâche</button>
      </form>

          <!-- Notification de succès -->
    <SuccessAlert v-if="successMessage" :message="successMessage" />

    </div>
  </template>


  <script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      task: {
        title: '',
        description: '',
        due_date: '',
      },
    }
  },
  methods: {
    async submitTask() {
      try {
        await axios.post('/api/tasks', this.task)

        // 💥 SweetAlert au lieu de alert()
        Swal.fire({
          icon: 'success',
          title: 'Tâche créée !',
          text: 'Votre tâche a été ajoutée avec succès ✅',
          timer: 3000,
          showConfirmButton: false,
          toast: true,
          position: 'top-end',
        })

        // Rediriger après un petit délai (optionnel)
        setTimeout(() => {
          window.location.href = '/tasks'
        }, 3000)
      } catch (error) {
        console.error('Erreur de création :', error)

        Swal.fire({
          icon: 'error',
          title: 'Erreur',
          text: "La tâche n'a pas pu être créée 😥",
        })
      }
    },
  },
}
</script>


  <style scoped>
  .create-task-container {
    max-width: 500px;
    margin: auto;
    padding: 20px;
  }

  h2 {
    font-size: 22px;
    margin-bottom: 20px;
    text-align: center;
    font-family: sans-serif;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    font-family: sans-serif;
  }

  .form-group {
    display: flex;
    flex-direction: column;
  }

  label {
    margin-bottom: 5px;
    font-weight: bold;
  }

  input,
  textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  button {
    padding: 10px;
    background-color: #28a745;
    border: none;
    color: white;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
  }

  button:hover {
    background-color: #218838;
  }
  </style>
