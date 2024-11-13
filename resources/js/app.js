import { createApp, reactive } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router';
import Login from './pages/LoginPage.vue';
import Register from './pages/RegisterPage.vue';
import Home from './pages/HomePage.vue';
import Lobby from './pages/LobbyPage.vue';
import Game from './pages/GamePage.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/lobby', component: Lobby },
  { path: '/login', component: Login},
  { path: '/register', component: Register },
  { path: '/home', component: Home },
  { path: '/game/:table_id', component: Game },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});
const globalState = reactive({
  isLogin: false,
  user: null
});
const app = createApp(App);
app.config.globalProperties.$state = globalState;
app.use(router); // 使用 router
app.mount('#app');
