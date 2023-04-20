import { createApp } from 'vue';
import App from './App.vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import { createRouter, createWebHistory } from 'vue-router';
import { routes } from './routes';

export const API_URL = 'http://localhost:8000/api';

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp(App);

app.use(router);
app.use(VueAxios, axios);
app.mount('#app');

