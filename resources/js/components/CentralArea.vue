<template>
  <div class = "board">
    
      
    <div class="towers-div">
      <Tower
        :color="towers[0].color"
        :cards="filteredCards(towers[0].color)"
        @buyCard="buyCard"
        class="tower"
        :style="{
          left: '3.5%'
        }"
      />
      <Tower
        :color="towers[1].color"
        :cards="filteredCards(towers[1].color)"
        @buyCard="buyCard"
        class="tower"
        :style="{
          left: '27.5%'
        }"
      />
      <Tower
        :color="towers[2].color"
        :cards="filteredCards(towers[2].color)"
        @buyCard="buyCard"
        class="tower"
        :style="{
          left: '52%'
        }"
      />
      <Tower
        :color="towers[3].color"
        :cards="filteredCards(towers[3].color)"
        @buyCard="buyCard"
        class="tower"
        :style="{
          left: '76.5%'
        }"
      />
    </div>
      
    <OtherMove 
      @decideOrder="decideOrder"
      @production="production"
      @otherProduction="otherProduction"
      @earnMoney="earnMoney"
      @earnWorker ="earnWorker"
      @harvest="harvest"
      @otherHarvest="otherHarvest"
    />
      
  </div>
</template>

<script>
import Tower from './Tower.vue';
import OtherMove from './OtherMove.vue';

export default {
  components: {
    Tower,
    OtherMove
  },
  props: {
    cards: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      // 塔的结构，每座塔有四层
      towers: [
        {color:'green'},
        {color:'blue'},
        {color:'yellow'},
        {color:'purple'},
      ]
    };
  },
  methods: {
    // 购买卡片的处理函数
    buyCard(card) {
      this.$emit('buyCard', card);
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
  },
  
};
</script>

<style scoped>

.tower{
  width: 14%;
  height: 100%;
  position: absolute;
  display: flex;
  flex-direction: column-reverse; /* 垂直堆叠塔的层 */
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
  
  background-image: url('/images/board.jpg'); /* 设置背景图片 */
  background-size: contain; /* 确保背景图片完全适应容器 */
  background-position: center; /* 背景图片居中对齐 */
  background-repeat: no-repeat; /* 防止背景图片重复 */
  
  /* 可选：设置背景颜色 */
}
</style>

