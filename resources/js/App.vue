<template>
  <div id="app">
    <header class="navbar">
      <div class="navbar-left">
        <button @click="navigateToHome">Home</button>
        <button @click="navigateToLobby">Lobby</button>
      </div>
      <div class="navbar-right">
        {{ this.$state.user ? this.$state.user.name:'guest' }}
        <a @click="handleAuth">{{ this.$state.isLogin ? '登出' : '登入' }}</a>
      </div>
    </header>
    <!-- 這裡會顯示路由對應的內容 -->
    <router-view />
  </div>
</template>

<script>
import { checkLogin, logout,fetchUser } from './api';

export default {
  data() {
    return {
       
    };
  },
  computed: {
    
  },
  methods: {
    navigateToHome() {
      this.$router.push('/home');
    },
    navigateToLobby() {
      this.$router.push('/lobby');
    },
    async handleAuth() {
      if (this.$state.isLogin) {
        try {
          const success = await logout();
          if (success) {
            this.$state.isLogin = false; // 假设登出成功，设置 isLogin 为 false
            this.$state.user = null
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
      this.$state.user = await fetchUser();
    } catch (error) {
      console.error('Failed to check login status', error);
    } 
  }
};
</script>


<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
 
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
