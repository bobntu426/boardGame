<!-- CentralArea.vue -->
<template>
    <div class="central-area">
      <h2>中央版面</h2>
      <p>排堆：</p>
      <ul>
        <li v-for="card in cards" :key="card.id">{{ card.name }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  
  export default {
    props: {
      cards: {
        type: Array,
        required: true
      }
    }
  };
  </script>
  
  <style scoped>
  .central-area {
    width: 100%;
    border: 1px solid #aaa;
    border-radius: 8px;
    padding: 10px;
    background-color: #f0f0f0;
  }
  </style>
  