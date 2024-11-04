<template>
  <div id="app">
    <h1>My App</h1>
    <nav>
      <router-link to="/home">Home</router-link>    
    </nav>
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
export default {
  data() {
    return {
      
    };
  },
};
</script>

<style></style>