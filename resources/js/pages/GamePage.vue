<template>
  <div v-if="loading">加載中...</div>
  <div v-else class="game-container">
    
      <GameProcess 
        :actionPlayer = "players.find(player=>player.needAction != 'wait')"
        :eventObject = "eventObject"
        :player = "players.find(player => player.user.id === userId)"
        :handleReset = "handleReset"
        :handleEndTurn="handleEndTurn"
        :workerNum = "workerNum"
        :decreaseWorkerNum = "decreaseWorkerNum"
        :increaseWorkerNum = "increaseWorkerNum"
        :ignoreExtraDice = ignoreExtraDice
        @chooseReel="handleChooseReel"
        
       />
      <ErrorMessage
        :errorMessageArray = "errorMessageArray"
       />
      <!-- 中央版面 -->
      <CentralArea 
        :players="players"
        :cards="cards" 
        :gameInfo="gameInfo"
        :pillarInfo = "pillarInfo"
        :player="players.find(player => player.user.id === userId)"
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
import GameProcess from '../components/GameProcess.vue';
import ErrorMessage from '../components/ErrorMessage.vue';
import { getTablePlayers,fetchUser,getTableCards,getPlayerCards,reset,getGameInfo,endTurn} from '../api'; 
import { decideOrderMethod } from '../methods/decideOrderMethod';
import { chooseReelMethod } from '../methods/chooseReelMethod';
import { buyCardMethod,computeNeedPoint } from '../methods/buyCardMethod';
import { checkMove } from '../methods/checkMove';
import { listenForOrderEvent,listenForToNextPlayer,listenForResetEvent } from '../methods/listenEvent';
import { getBoardPillarInfo } from '../methods/getBoardInfo';

export default {
  
  components: {
    CentralArea,
    PlayerArea,
    GameProcess,
    ErrorMessage
  },
  computed:{
    player(){
      return  this.players.find(player => player.id === this.playerId)
    },
    pillarInfo(){
      return  getBoardPillarInfo(this.players)
    }
  },
 
  
  data() {
    return {
      players: [],
      cards: [],
      gameInfo:{},
      playerId:null,
      userId: null ,
      playerBoard:{},
      loading:true,
      eventObject:{},
      errorMessageArray : [],
      workerNum:0
    };
  },
  
  
  methods: {
    handleDecideOrder() {
      checkMove(this.$data,this.workerNum,1,{},decideOrderMethod)
    },
    handleBuyCard(card,index) {
      checkMove(this.$data,this.workerNum,computeNeedPoint(index),{'card':card,'index':index},buyCardMethod)
    },
    handleProduction() {
      this.eventObject = {
        "playerId": this.player.id,
        "chooseColor":this.player.chooseColor ,
        "action":'production'
      }
      console.log('執行生產',this.eventObject);
      
    },
    handleOtherProduction() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'otherProduction'
      }
      console.log('執行其他生產',this.eventObject);
      
    },
    handleHarvest() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'收成'
      }
      console.log('harvest',this.eventObject);
      
    },
    handleOtherHarvest() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'otherHarvest'
      }
      console.log('執行其他收成',this.eventObject);
      
    },
    handleEarnMoney() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnMoney'
      }
      console.log('獲取金幣',this.eventObject);
      
    },
    handleEarnWorker() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnWorker'
      }
      console.log('獲取工人',this.eventObject);
      
    },
    handleEarnMoneyMilitary() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnMoneyMilitary'
      }
      console.log('獲取錢+軍事值',this.eventObject);
      
    },
    handleEarnTwoReel() {
      this.eventObject = {
        "chooseColor":this.player.chooseColor,
        "playerId": this.player.id,
        "action":'earnTwoReel'
      }
      console.log('獲取2卷軸',this.eventObject);
      
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
    increaseWorkerNum(){
      if(this.player.worker>this.workerNum)
        this.workerNum++
    },
    decreaseWorkerNum(){
      if(this.workerNum>0)
        this.workerNum--
    },
    handleChoosePlayerBoard(player) {
      this.playerBoard = player
      console.log("chooseBoard",this.playerBoard)
    },
    handleChooseReel(reels) {
      chooseReelMethod(this.$data,reels)
    },
    handleReset(){
      reset({"playerId":this.playerId})
    },
    handleEndTurn(){
       endTurn({"playerId":this.playerId})
    },
    ignoreExtraDice(){
      buyCardMethod()
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
  },
  async mounted() {
    listenForOrderEvent(this.$route.params.table_id,this.$data)
    listenForToNextPlayer(this.$route.params.table_id,this.$data)
    listenForResetEvent(this.$route.params.table_id,this.$data)
  
    try {
    // 获取用户ID
      this.userId = await this.fetchUserId();

      //獲取玩家
      const playerResponse = await getTablePlayers(this.$route.params.table_id);
      this.players = this.sortPlayers(playerResponse);
      this.players.forEach(player => {
        player.chooseColor = null
        // if(player.needAction != 'wait'){
        //   this.actionPlayer = player
        // }
      });
      
      if(this.userId){
        const player = this.players.find(player => player.user.id === this.userId)
        this.playerId = player.id
        this.playerBoard = player
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
    this.gameInfo.pillarInfo = getBoardPillarInfo(this.players)
  },
  beforeUnmount() {
      window.Echo.leave(`table.${this.$route.params.table_id}`);
  },
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
