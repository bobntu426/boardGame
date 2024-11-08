<template>
  <div id="app">
    <header class="navbar">
      <div class="navbar-left">
        <button @click="navigateToHome">Home</button>
        <button @click="navigateToLobby">Lobby</button>
      </div>
      <div class="navbar-right">
        <a @click="handleAuth">{{ isLogin ? '登出' : '登入' }}</a>
      </div>
    </header>
    <!-- 這裡會顯示路由對應的內容 -->
    <router-view />
  </div>
</template>

<script>
import { checkLogin, logout } from './api';

export default {
  data() {
    return {
       
    };
  },
  computed: {
    isLogin() {
      console.log(this.$state.isLogin);
      return this.$state.isLogin;
    },
  },
  methods: {
    navigateToHome() {
      this.$router.push('/home');
    },
    navigateToLobby() {
      this.$router.push('/lobby');
    },
    async handleAuth() {
      if (this.isLogin) {
        try {
          const success = await logout();
          if (success) {
            this.$state.isLogin = false; // 假设登出成功，设置 isLogin 为 false
            this.$router.push('/login');
            
          } else {
            console.error('Logout failed');
          }
        } catch (error) {
          console.error('Error during logout:', error);
        }
      } else {
        // 重定向到登录页面
        this.$router.push('/login');
      }
    }
  },
  async mounted() {
    try {
      this.$state.isLogin = await checkLogin();
      console.log(this.$isLogin);
      
    } catch (error) {
      console.error('Failed to check login status', error);
    }
  }
};
</script>


<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #42b983;
  padding: 10px 20px;
  color: white;
}

.navbar-left button {
  margin-right: 10px;
  background-color: transparent;
  border: none;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

.navbar-left button:hover {
  text-decoration: underline;
}

.navbar-right a {
  cursor: pointer;
  text-decoration: none;
  color: white;
  font-size: 16px;
}

.navbar-right a:hover {
  text-decoration: underline;
}
</style>
