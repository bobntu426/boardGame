<template>
  <div class="game-container">
    <div class="central-area-div">
      <!-- 中央版面 -->
      <CentralArea 
        :cards="cards" 
        @buyCard="handleBuyCard"
        class="central-area" 
      />
    </div>
    <!-- 玩家版面 -->
    <div v-for="player in players" :key="player.id">
      <PlayerArea 
        :player="player"
        @useCard="handleUseCard"
      />
    </div>
  </div>
</template>

<script>
import CentralArea from '../components/CentralArea.vue';
import PlayerArea from '../components/PlayerArea.vue';
import { getTablePlayers,fetchUser,getTableCards,getPlayerCards,buyCard,useCard } from '../api'; 

export default {
  components: {
    CentralArea,
    PlayerArea
  },
  data() {
    return {
      players: [],
      cards: [],
      userId: null 
    };
  },
  async mounted() {
    this.userId = await this.fetchUserId();
    
    try {
      const response = await getTablePlayers(this.$route.params.table_id);
      this.players = this.sortPlayers(response);
    } catch (error) {
      console.error("獲取玩家資訊失敗:", error);
    }

    try {
      const cardsResponse = await getTableCards(this.$route.params.table_id);
      this.cards = cardsResponse;
    } catch (error) {
      console.error("獲取卡片資訊失敗:", error);
    }

    try {
      for (const player of this.players) {
        try {
          const playerCards = await getPlayerCards(player.id);
          player.cards = playerCards;
        } catch (error) {
          console.error(`獲取玩家 ${player.id} 卡片資料失敗:`, error);
        }
      }
    } catch (error) {
      console.error("獲取卡片資訊失敗:", error);
    }

    console.log(this.$state.user)
  },
  methods: {
    handleBuyCard(card) {
      const data = {
        "playerId": this.players.find(player => player.user.id === this.userId).id,
        "card": card
      }
      console.log('購買卡片:', data);
      buyCard(data);
    },
    handleUseCard(card) {
      const data = {
        "playerId": this.players.find(player => player.user.id === this.userId).id,
        "card": card
      }
      console.log('使用卡片:', card);
      useCard(card);
    },
    sortPlayers(players) {
      const currentPlayerIndex = players.findIndex(player => player.user.id === this.userId);
      if (currentPlayerIndex === -1) return players;

      const currentPlayer = players[currentPlayerIndex];
      const otherPlayers = [
        ...players.slice(currentPlayerIndex + 1),
        ...players.slice(0, currentPlayerIndex)
      ];

      return [currentPlayer, ...otherPlayers];
    },
    async fetchUserId() {
      try {
        const user = await fetchUser();
        this.$state.user = user
        return user.id;
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
  flex-direction: column;
  
}

.central-area-div {
  /* 讓 central-area-div 隨內容變長 */
  display: flex;
  flex-direction: column;
  flex-grow: 1; /* 讓其佔據剩餘的空間 */
  margin-top: 20px;
  margin-bottom: 20px;
}




.player-area {
  margin-top: 20px;
  margin-bottom: 20px;
}
</style>
