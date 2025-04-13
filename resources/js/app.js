import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();


import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';



axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://127.0.0.1:8000'; // adapte selon ton cas

const app = createApp(App);


// Tu peux aussi le rendre global via provide/inject :
app.config.globalProperties.$axios = axios;

app.use(router);
app.mount('#app');




