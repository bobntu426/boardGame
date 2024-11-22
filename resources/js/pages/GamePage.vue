<template>
  <div v-if="loading">加載中...</div>
  <div v-else class="game-container">
    
      <GameMessage 
        :actionPlayer = "actionPlayer"
        :eventObject = "eventObject"
        @chooseReel="handleChooseReel"
       />
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
        @earnMoneyMilitary="handleEarnMoneyMilitary"
        @earnTwoReel ="handleEarnTwoReel"
        @harvest="handleHarvest"
        @otherHarvest="handleOtherHarvest"
      />
    

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
        @choosePillar="handleChoosePillar"
      /> 
    </div>
    
    
  </div>
</template>

<script>
import CentralArea from '../components/CentralArea.vue';
import PlayerArea from '../components/PlayerArea.vue';
import GameMessage from '../components/GameMessage.vue';
import { getTablePlayers,fetchUser,getTableCards,getPlayerCards,buyCard,getGameInfo } from '../api'; 
export default {
  
  components: {
    CentralArea,
    PlayerArea,
    GameMessage
  },
  
  computed:{
    
  },
  
  data() {
    return {
      players: [],
      cards: [],
      gameInfo:{},
      player:{},
      actionPlayer:null,
      userId: null ,
      playerBoard:{},
      loading:true,
      eventObject:{}
    };
  },
  
  async mounted() {
    try {
    // 获取用户ID
      this.userId = await this.fetchUserId();

      //獲取玩家
      const playerResponse = await getTablePlayers(this.$route.params.table_id);
      this.players = this.sortPlayers(playerResponse);
      this.players.forEach(player => {
        player.chooseColor = null
        if(player.needAction != 'wait'){
          this.actionPlayer = player
        }
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

      //獲取遊戲資訊
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
      this.eventObject = {
        "playerId": this.player.id,
        "chooseColor":this.player.chooseColor,
        "action":'order'
      }
      console.log('搶先手',this.eventObject);
      
    },
    handleBuyCard(card,index) {
      this.eventObject = {
        "playerId": this.player.id,
        "card": card,
        "index":index,
        "chooseColor":this.player.chooseColor,
        "action":'buyCard'
      }
      console.log('購買卡片:',this.eventObject);
      //buyCard(data);
    },
    handleProduction() {
      this.eventObject = {
        "playerId": this.player.id,
        "chooseColor":this.player.chooseColor ,
        "action":'production'
      }
      console.log('執行生產',this.eventObject);
      //buyCard(data);
    },
    handleOtherProduction() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'otherProduction'
      }
      console.log('執行其他生產',this.eventObject);
      //buyCard(data);
    },
    handleHarvest() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'收成'
      }
      console.log('harvest',this.eventObject);
      //buyCard(data);
    },
    handleOtherHarvest() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'otherHarvest'
      }
      console.log('執行其他收成',this.eventObject);
      //buyCard(data);
    },
    handleEarnMoney() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnMoney'
      }
      console.log('獲取金幣',this.eventObject);
      //buyCard(data);
    },
    handleEarnWorker() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnWorker'
      }
      console.log('獲取工人',this.eventObject);
      //buyCard(data);
    },
    handleEarnMoneyMilitary() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnMoneyMilitary'
      }
      console.log('獲取錢+軍事值',this.eventObject);
      //buyCard(data);
    },
    handleEarnTwoReel() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnTwoReel'
      }
      console.log('獲取2卷軸',this.eventObject);
      //buyCard(data);
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
    handleChooseReel(reels) {
      this.eventObject = {
        "reel":reels,
        "playerId": this.player.id,
        "action":'chooseReel'
      }
      console.log(this.eventObject)
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

<style>
.game-container {
  width : 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
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
