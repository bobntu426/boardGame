<template>
  <div v-if="loading">加載中...</div>
  <div v-else class="game-container">
    
    <div class="central-area-div">
      <!-- 中央版面 -->
      <CentralArea 
        :players="players"
        :cards="cards" 
        :gameInfo="gameInfo"
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
    
    
  

    <div class = "player-area-div">
      <div class = "choose-player-board-div">
        
          <button 
          v-for="player in players" 
          :key="player.id"
            @click = "handleChoosePlayerBoard(player)"
            :class = "`choose-player-board-button`" 
          >
          {{player.user.name}}
          </button>
        
      </div> 

      <PlayerArea 
        :player="playerBoard"
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
    PlayerArea,

  },
  
  computed:{
    
  },
  
  data() {
    return {
      players: [],
      cards: [],
      gameInfo:{},
      player:{},
      userId: null ,
      playerBoard:{},
      loading:true
    };
  },
  
  async mounted() {
    try {
    // 获取用户ID
      this.userId = await this.fetchUserId();
      
      // 获取玩家信息
      const playerResponse = await getTablePlayers(this.$route.params.table_id);
      this.players = this.sortPlayers(playerResponse);
      this.players.forEach(player => {
        player.chooseColor = null
      });
      
      if(this.userId){
        this.player = this.players.find(player => player.user.id === this.userId)
        this.playerBoard = this.player
      }
      
      else
        this.playerBoard = this.players[0]

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
      console.log(this.gameInfo)
      
    } catch (error) {
      console.error("初始化資料失敗:", error);
    }finally{
      this.loading = false
    }
   
  },
  methods: {
    handleDecideOrder() {
      const data = {
        "playerId": this.player.id,
      }
      console.log('搶先手', data);
      
    },
    handleBuyCard(card) {
      const data = {
        "playerId": this.player.id,
        "card": card
      }
      console.log('購買卡片:', data);
      //buyCard(data);
    },
    handleProduction() {
      const data = {
        
        "playerId": this.player.id,
      }
      console.log('執行生產', data);
      //buyCard(data);
    },
    handleOtherProduction() {
      const data = {
        
        "playerId": this.player.id,
      }
      console.log('執行其他生產', data);
      //buyCard(data);
    },
    handleHarvest() {
      const data = {
        
        "playerId": this.player.id,
      }
      console.log('執行收成', data);
      //buyCard(data);
    },
    handleOtherHarvest() {
      const data = {
        
        "playerId": this.player.id,
      }
      console.log('執行其他收成', data);
      //buyCard(data);
    },
    handleEarnMoney() {
      const data = {
        
        "playerId": this.player.id,
      }
      console.log('獲取金幣', data);
      //buyCard(data);
    },
    handleEarnWorker() {
      const data = {
        
        "playerId": this.player.id,
      }
      console.log('獲取工人', data);
      //buyCard(data);
    },
    handleUseCard(card) {
      const data = {
        
        "playerId": this.player.id,
        "card": card
      }
      console.log('使用卡片:', card);
      useCard(card);
    },
    handleChoosePillar(color,player) {
      console.log("choose",this.player)
      if(this.player==player){
        player.chooseColor = player.chooseColor != color?color:null
        console.log('選取柱子:', player.chooseColor);
      }
      else{
        player.chooseColor = null
      }
      
    },
    handleChoosePlayerBoard(player) {
      this.playerBoard = player
      console.log("chooseBoard",this.playerBoard)
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
  width : 100vw;
  display: flex;
  flex-direction: column;
  align-items: center;

}

.central-area-div {
  width : 70%;
 
  display: flex;
  flex-direction: row;
  margin-top: 5%;
  margin-bottom: 10%;
}

.player-area-div{
  position: relative;
  width : 90%;
  display: flex;
  
  flex-direction: column;
}
.choose-player-board-div{
  display: flex;
  position: absolute;
  height:6%;
  width:30%;
  left: 2%;
  top: -6%;
}
.choose-player-board-button{
  height:100%;
  width:100%;
}

</style>
