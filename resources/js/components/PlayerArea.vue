<!-- PlayerArea.vue -->
<template>
    <div class="player-area">
      <h2>{{ player.user.name }}</h2>
      <p>錢幣：{{ player.coins }}</p>
      <p>石頭：{{ player.stones }}</p>
      <p>木頭：{{ player.woods }}</p>
      <p>工人：{{ player.workers }}</p>
      <p>持有的卡牌：</p>
      <ul>
        <li v-for="card in player.cards" :key="card.id">{{ card.name }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      player: {
        type: Object,
        required: true
      }
    }
  };
  </script>
  
  <style scoped>
  .player-area {
    width: 100%;
    border: 1px solid #aaa;
    border-radius: 8px;
    padding: 10px;
    background-color: #f9f9f9;
    margin-top: 10px; /* 添加頂部間距 */
  }
  </style>
  