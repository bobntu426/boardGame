<template>
  <div class="game-container">
    <div class="central-area-div">
      <!-- 中央版面 -->
      <CentralArea 
        :cards="cards" 
        @buyCard="handleBuyCard"
        @decideOrder="handleDecideOrder"
        @production="handleProduction"
        @otherProduction="handleOtherProduction"
        @earnMoney="handleEarnMoney"
        @earnWorker ="handleEarnWorker"
        @harvest="handleHarvest"
        @otherHarvest="handleOtherHarvest"
      />
    </div>
    <!-- 玩家版面 -->
    <div v-for="player in players" :key="player.id">
      <PlayerArea 
        :player="player"
        :pillarColor = this.pillarColor
        @useCard="handleUseCard"
        @choosePillar="handleChoosePillar"
      />
    </div>
  </div>
</template>

<script>
import CentralArea from '../components/CentralArea.vue';
import PlayerArea from '../components/PlayerArea.vue';
import { getTablePlayers,fetchUser,getTableCards,getPlayerCards,buyCard,useCard,getGameInfo } from '../api'; 
export default {
  
  components: {
    CentralArea,
    PlayerArea
  },
  setup(){

  },
  data() {
    return {
      players: [],
      cards: [],
      gameInfo:{},
      playerId:null,
      userId: null ,
      pillarColor:null,
    };
  },
  
  async mounted() {
    try {
    // 获取用户ID
      this.userId = await this.fetchUserId();
      
      // 获取玩家信息
      const playerResponse = await getTablePlayers(this.$route.params.table_id);
      this.players = this.sortPlayers(playerResponse);
      if(this.userId)
        this.playerId = this.players.find(player => player.user.id === this.userId).id;

      // 获取卡片信息
      const cardsResponse = await getTableCards(this.$route.params.table_id);
      this.cards = cardsResponse;

      // 获取所有玩家的卡片信息
      const playerCardPromises = this.players.map(async player => {
        try {
          const playerCards = await getPlayerCards(player.id);
          player.cards = playerCards;
        } catch (error) {
          console.error(`獲取玩家 ${player.id} 卡片資料失敗:`, error);
        }
      });
      await Promise.all(playerCardPromises);

      // 获取游戏信息
      const gameInfoResponse = await getGameInfo(this.$route.params.table_id);
      this.gameInfo = gameInfoResponse;

      console.log(this.gameInfo);
    } catch (error) {
      console.error("初始化資料失敗:", error);
    }
  },
  methods: {
    handleDecideOrder() {
      const data = {
        "playerId": this.playerId,
        "color": this.pillarColor
      }
      console.log('搶先手', data);
      
    },
    handleBuyCard(card) {
      const data = {
        "playerId": this.playerId,
        "color": this.pillarColor,
        "card": card
      }
      console.log('購買卡片:', data);
      //buyCard(data);
    },
    handleProduction() {
      const data = {
        "color": this.pillarColor,
        "playerId": this.playerId,
      }
      console.log('執行生產', data);
      //buyCard(data);
    },
    handleOtherProduction() {
      const data = {
        "color": this.pillarColor,
        "playerId": this.playerId,
      }
      console.log('執行其他生產', data);
      //buyCard(data);
    },
    handleHarvest() {
      const data = {
        "color": this.pillarColor,
        "playerId": this.playerId,
      }
      console.log('執行收成', data);
      //buyCard(data);
    },
    handleOtherHarvest() {
      const data = {
        "color": this.pillarColor,
        "playerId": this.playerId,
      }
      console.log('執行其他收成', data);
      //buyCard(data);
    },
    handleEarnMoney() {
      const data = {
        "color": this.pillarColor,
        "playerId": this.playerId,
      }
      console.log('獲取金幣', data);
      //buyCard(data);
    },
    handleEarnWorker() {
      const data = {
        "color": this.pillarColor,
        "playerId": this.playerId,
      }
      console.log('獲取工人', data);
      //buyCard(data);
    },
    handleUseCard(card) {
      const data = {
        "color": this.pillarColor,
        "playerId": this.playerId,
        "card": card
      }
      console.log('使用卡片:', card);
      useCard(card);
    },
    handleChoosePillar(color) {
      this.pillarColor = this.pillarColor != color?color:null
      const data ={
        "playerId":this.playerId,
        "color":this.pillarColor
      }
      console.log('選取柱子:', data);
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
        return user?user.id:null
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
