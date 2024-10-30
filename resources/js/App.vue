<template>
  <div id="app">
    <h1>My App</h1>
    <nav>
      <router-link to="/login">Login</router-link>    
    </nav>
    <nav>
      <router-link to="/lobby">Lobby</router-link>    
    </nav>
    <!-- 這裡會顯示路由對應的內容 -->
    <router-view />
  </div>
</template>

<script>
import { getUsers } from './api'; // 確保正確導入

export default {
  data() {
    return {
      
      message: '' // 初始為空字串
    };
  },
  async mounted() {
    try {
      const users = await getUsers(); // 調用 getUsers 函數
      this.message = JSON.stringify(users); // 將用戶數據轉換為字串顯示
    } catch (error) {
      this.message = 'Failed to fetch users'; // 錯誤處理
    }
  }
};
</script>

<style></style>