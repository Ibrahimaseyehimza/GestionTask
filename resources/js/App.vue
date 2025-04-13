<template>
    <div>
      <nav class="navbar">
        <div class="navbar-brand">🧠 TaskApp</div>
        <div class="navbar-links">
          <router-link to="/" exact-active-class="active">🏠 En cours</router-link>
          <router-link to="/tasks" active-class="active">📋 Toutes les tâches</router-link>
          <router-link to="/create" active-class="active">➕ Nouvelle tâche</router-link>
        </div>
      </nav>

      <main class="content">
        <router-view />
      </main>
    </div>
  </template>

<script>
export default {
  name: "App"
}
</script>

  <style scoped>
  /* BARRE DE NAVIGATION */


  .navbar {
    background-color: #007BFF;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    font-family: sans-serif;

  }

  .navbar-brand {
    font-size: 20px;
    font-weight: bold;
  }

  .navbar-links a {
    margin-left: 20px;
    text-decoration: none;
    color: white;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .navbar-links a:hover {
    background-color: rgba(255, 255, 255, 0.2);
  }

  .active-link {
    background-color: white;
    color: #007BFF;
  }

  /* CONTENU */
  .content {
    padding: 30px;
    background-color: #f4f6f8;
    min-height: 100vh;
  }
  </style>













