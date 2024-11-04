<template>
    <div class="game-container">
      <CentralArea :cards="cards" />
    
      <div v-for="player in players" :key="player.id">
        <PlayerArea :player="player" />
      </div>
    </div>
  </template>
  
  <script>
  import CentralArea from '../components/CentralArea.vue';
  import PlayerArea from '../components/PlayerArea.vue';
  import { fetchCards, getTablePlayer } from '../api'; // 確保 api 中有 getTablePlayer 函數
  
  export default {
    components: {
      CentralArea,
      PlayerArea
    },
    data() {
      return {
        players: [], // 將 players 初始化為空陣列
        cards: [
          { id: 1, name: '堆A' },
          { id: 2, name: '堆B' }
        ]
      };
    },
    async mounted() {
      try {
        // 獲取玩家資訊
        const response = await getTablePlayer(201);
        console.log(response) // 假設此函數返回玩家數據
        this.players = response; // 將獲取的玩家數據賦值給 players
      } catch (error) {
        console.error("獲取玩家資訊失敗:", error);
      }
    }
  };
  </script>
  
  <style scoped>
  .game-container {
    display: flex;
    flex-direction: column; /* 使用縱向排列 */
    padding: 20px;
  }
  </style>
  