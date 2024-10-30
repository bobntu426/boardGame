<template>
    <div>
      <h2>Login</h2>
      <form @submit.prevent="login">
        <div>
          <label for="email">Email:</label>
          <input v-model="email" type="email" id="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input v-model="password" type="password" id="password" required />
        </div>
        <button type="submit">Login</button>
      </form>
      <button @click="goToRegister">Register</button>
    </div>
  </template>
  
  <script>
  import {login} from "../api"
  export default {
    data() {
      return {
        email: '',
        password: '',
      };
    },
    methods: {
      async login() {
      try {
        const response = await login({ email: this.email, password: this.password });
        console.log('登入成功:', response);
        // 登入成功後的操作，例如導向到主頁或顯示成功訊息
        this.$router.push('/home'); // 假設成功登入後跳轉到 home 頁面
      } catch (error) {
        this.errorMessage = error.message; // 設置錯誤訊息
      }
    },
      goToRegister() {
        this.$router.push('/register');
      },
    },
  };
  </script>
  
  <style scoped>
  /* 可在這裡添加樣式 */
  </style>
  