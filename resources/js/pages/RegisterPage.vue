<template>
    <div>
      <h2>Register</h2>
      <form @submit.prevent="registerUser">
        <!-- 用户名 -->
        <div>
          <label for="name">Name</label>
          <input v-model="form.name" id="name" type="text" required autofocus />
        </div>
  
        <!-- 邮箱 -->
        <div>
          <label for="email">Email</label>
          <input v-model="form.email" id="email" type="email" required />
        </div>
  
        <!-- 密码 -->
        <div>
          <label for="password">Password</label>
          <input v-model="form.password" id="password" type="password" required />
        </div>
  
        <!-- 确认密码 -->
        <div>
          <label for="password_confirmation">Confirm Password</label>
          <input v-model="form.password_confirmation" id="password_confirmation" type="password" required />
        </div>
  
        <!-- 提交按钮 -->
        <div>
          <button type="submit">Register</button>
        </div>
      </form>
  
      <p v-if="message">{{ message }}</p>
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
  /* 您可以在這裡加入 CSS 樣式 */
  </style>
  