import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router';
import Login from './pages/LoginPage.vue';
import Register from './pages/RegisterPage.vue';
import Home from './pages/HomePage.vue';
import Lobby from './pages/LobbyPage.vue';

const routes = [
  {path: '/', component: Home },
  { path: '/lobby', component: Lobby },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/home', component: Home },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
const app = createApp(App);
app.use(router); // 使用 router
app.mount('#app');
