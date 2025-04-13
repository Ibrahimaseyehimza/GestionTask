// import { createRouter, createWebHistory } from 'vue-router';
// import Home from './views/Home.vue';
// import Tasks from './views/Tasks.vue';

// const routes = [
//   { path: '/', name: 'home', component: Home },
//   { path: '/tasks', name: 'tasks', component: Tasks },
// ];

// const router = createRouter({
//   history: createWebHistory(),
//   routes,
// });

// export default router;






import { createRouter, createWebHistory } from 'vue-router';
import Home from './pages/Home.vue';
import TaskList from './pages/TaskList.vue';
import TaskForm from './pages/TaskForm.vue';

const routes = [
  { path: '/', name: 'home', component: Home },
  { path: '/tasks', name: 'tasks', component: TaskList },
  { path: '/create', name: 'create-task', component: TaskForm },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
