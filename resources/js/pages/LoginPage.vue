<template>
  <div class="login-container">
    <h2>Login</h2>
    <form @submit.prevent="login">
      <div class="form-group">
        <label for="email">Email:</label>
        <input v-model="email" type="email" id="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input v-model="password" type="password" id="password" required />
      </div>
      <button type="submit" class="login-button">Login</button>
    </form>
    <button @click="goToRegister" class="register-button">Register</button>
  </div>
</template>

<script>
import { login } from "../api";

export default {
  data() {
    return {
      email: '',
      password: '',
      errorMessage: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await login({ email: this.email, password: this.password });
        console.log('登入成功:', response);
        this.$state.isLogin = true
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
.login-container {
  width: 300px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  background-color: #f9f9f9;
}

h2 {
  text-align: center;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

.login-button,
.register-button {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login-button {
  background-color: #42b983;
  color: white;
}

.register-button {
  background-color: #ccc;
}

.login-button:hover {
  background-color: #369f71;
}

.register-button:hover {
  background-color: #bbb;
}
</style>
