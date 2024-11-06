<template>
  <div class="game-container">
    <!-- 中央版面 -->
    <CentralArea :cards="cards" />
    
    <!-- 玩家版面 -->
    <div v-for="player in players" :key="player.id">
      <PlayerArea :player="player" />
    </div>
  </div>
</template>

<script>
import CentralArea from '../components/CentralArea.vue';
import PlayerArea from '../components/PlayerArea.vue';
import { getTablePlayers,fetchUser,getTableCards,getPlayerCards } from '../api'; // 確保 api 中有 getTablePlayer 函數

export default {
  components: {
    CentralArea,
    PlayerArea
  },
  data() {
    return {
      players: [], // 將 players 初始化為空陣列
      cards: [],
      userId: null 
    };
  },
  async mounted() {
    this.userId = await this.fetchUserId(); 
    try {
      // 獲取玩家資訊
      const response = await getTablePlayers(this.$route.params.table_id);
      this.players = this.sortPlayers(response); // 將獲取的玩家數據賦值給 players 並排序
    } catch (error) {
      console.error("獲取玩家資訊失敗:", error);
    }
    try {
      // 獲取卡片資訊
      const cardsResponse = await getTableCards(this.$route.params.table_id);
      this.cards = cardsResponse;
    } catch (error) {
      console.error("獲取卡片資訊失敗:", error);
    }
    try {
      for (const player of this.players) {
        try {
          const playerCards = await getPlayerCards(player.id);  // 假設 getPlayerCards 根據 player.id 獲取該玩家的卡片
          player.cards = playerCards; // 將卡片資料放入玩家物件
        } catch (error) {
          console.error(`獲取玩家 ${player.id} 卡片資料失敗:`, error);
        }
      }
    } catch (error) {
      console.error("獲取卡片資訊失敗:", error);
    }
    
  },
  methods: {
    sortPlayers(players) {
      
      const currentPlayerIndex = players.findIndex(player => player.user.id === this.userId);

      if (currentPlayerIndex === -1) return players; // 如果找不到本地玩家，返回原始陣列

      // 將本地玩家移到最上面，並將其他玩家放到後面
      const currentPlayer = players[currentPlayerIndex];
      const otherPlayers = [
        ...players.slice(currentPlayerIndex + 1), // 當前玩家後面的所有玩家
        ...players.slice(0, currentPlayerIndex)  // 當前玩家前面的所有玩家
      ];

      return [currentPlayer, ...otherPlayers];
    },
    async fetchUserId() {
      try {
        let user = await fetchUser();
        return user.id 
      } catch (error) {
        console.error('取得使用者資料出錯:', error);
      }
    },
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

  