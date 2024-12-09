<template>
  <div class="central-area-div">
    <div class = "board">
      <div class="towers-div">
        <Tower
          v-for = "(tower,index) in towersInfo"
          :key = "index"
          :pillarPosition = tower.pillarPosition
          :cards="filteredCards(tower.color)"
          @buyCard="buyCard"
          class="tower"
          :style=tower.style
        />
      </div>
        
      <OtherMove 
        :gameInfo = "gameInfo"
        :pillarInfo = "pillarInfo"
        :player = "player"
        @decideOrder="decideOrder"
        @production="production"
        @otherProduction="otherProduction"
        @earnMoney="earnMoney"
        @earnWorker ="earnWorker"
        @harvest="harvest"
        @otherHarvest="otherHarvest"
        @earnMoneyMilitary="earnMoneyMilitary"
        @earnTwoReel ="earnTwoReel"
      />
    </div>
    
    <PlayerDataArea 
      :players="players"
    /> 
  </div>
</template>

<script>
import Tower from './Tower.vue'
import OtherMove from './OtherMove.vue'
import PlayerDataArea from './PlayerDataArea.vue'
export default {
  data(){
    return{
      towersInfo: [
        {color:'green',pillarPosition:this.pillarInfo.green,style:{left:'3.5%'}},
        {color:'blue',pillarPosition:this.pillarInfo.blue,style:{left:'27.5%'}},
        {color:'yellow',pillarPosition:this.pillarInfo.yellow,style:{left:'52%'}},
        {color:'purple',pillarPosition:this.pillarInfo.purple,style:{left:'76.5%'}},
      ],
    }
  },
  components: {
    Tower,
    OtherMove,
    PlayerDataArea
  },
  props: {
    cards: {
      type: Array,
      required: true
    },
    gameInfo:{
      type: Object,
      required: true
    },
    players:{
      type:Array,
      required:true
    },
    player:{
      type: Object,
      required: true
    },
    pillarInfo:{
      type: Object,
      required: true
    },
    
  },
  

  methods: {
    buyCard(card,index) {
      this.$emit('buyCard', card,index);
    },
    decideOrder() {
      this.$emit('decideOrder');
    },
    filteredCards(color) {
      return this.cards.filter(card => card.color === color);
    },
    production() {
        this.$emit('production');
    },
    otherProduction() {
      this.$emit('otherProduction');
    },
    earnMoney() {
      this.$emit('earnMoney');
    },
    earnWorker() {
      this.$emit('earnWorker');
    },
    harvest() {
      this.$emit('harvest');
    },
    otherHarvest() {
      this.$emit('otherHarvest');
    },
    earnMoneyMilitary() {
      this.$emit('earnMoneyMilitary');
    },
    earnTwoReel() {
      this.$emit('earnTwoReel');
    },
  },
  
};
</script>

<style scoped>
.central-area-div {
  width : 70%;
  display: flex;
  flex-direction: row;
  margin-top: 5%;
  margin-bottom: 10%;
}
.tower{
  width: 14%;
  height: 100%;
  position: absolute;
  display: flex;
  flex-direction: column-reverse;
}
.towers-div {
  display: flex;
  left: 5%;
  top: 5%;
  position: absolute;
  width: 78%;
  height: 50%;
  justify-content: space-around;
}


.board {
  position: relative;
  width: 100%;
  aspect-ratio: 1108 / 1477;
  margin-right: 10%;
  background-image: url('/images/board.jpg'); /* 设置背景图片 */
  background-size: contain; /* 确保背景图片完全适应容器 */
  background-position: center; /* 背景图片居中对齐 */
  background-repeat: no-repeat; /* 防止背景图片重复 */
}

</style>

