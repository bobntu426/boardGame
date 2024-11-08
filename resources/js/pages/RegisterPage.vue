<template>
  <div class="register-container">
    <h2>Register</h2>
    <form @submit.prevent="registerUser">
      <!-- 用户名 -->
      <div class="form-group">
        <label for="name">Name</label>
        <input v-model="form.name" id="name" type="text" required autofocus />
      </div>

      <!-- 邮箱 -->
      <div class="form-group">
        <label for="email">Email</label>
        <input v-model="form.email" id="email" type="email" required />
      </div>

      <!-- 密码 -->
      <div class="form-group">
        <label for="password">Password</label>
        <input v-model="form.password" id="password" type="password" required />
      </div>

      <!-- 确认密码 -->
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input v-model="form.password_confirmation" id="password_confirmation" type="password" required />
      </div>

      <!-- 提交按钮 -->
      <button type="submit" class="register-button">Register</button>
    </form>

    <p v-if="message">{{ message }}</p>
    <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
  </div>
</template>

<script>
import { register } from "../api";

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      message: '',
      errorMessage: '', // 添加用于错误消息的变量
    };
  },
  methods: {
    async registerUser() { // 确保方法名是 registerUser
      this.message = ''; // 清空之前的成功消息
      this.errorMessage = ''; // 清空错误消息
      try {
        const response = await register(this.form); // 使用 form 对象
        console.log('注册成功:', response);
        this.message = '注册成功！'; // 显示成功消息
        // 可以在注册成功后导航到登录或首页
        this.$router.push('/login'); // 假设成功后跳转到登录页
      } catch (error) {
        this.errorMessage = error.response?.data?.message || '注册失败，请重试。'; // 设置错误消息
        console.error('注册失败:', error);
      }
    },
  },
};
</script>

<style scoped>
.register-container {
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

.register-button {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  background-color: #42b983;
  color: white;
}

.register-button:hover {
  background-color: #369f71;
}

.error-message {
  color: red;
  margin-top: 10px;
  text-align: center;
}
</style>
