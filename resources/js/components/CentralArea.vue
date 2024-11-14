<!-- CentralArea.vue -->
<template>
  <div class="central-area">
    <h2>中央版面</h2>
    <p>排堆：</p>

    <div class="towers">
      <!-- 四座塔 -->
      <Tower
        v-for="(tower, towerIndex) in towers"
        :key="towerIndex"
        :color="tower.color"
        :cards="filteredCards(tower.color)"
        @buyCard="buyCard"
      />
    </div>
  </div>
</template>

<script>
import Tower from './Tower.vue'; // 引入 Tower 组件
import {getTableCards}  from '../api'; 
export default {
  components: {
    Tower
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
    filteredCards(color) {
      return this.cards.filter(card => card.color === color);
    }
  }
};
</script>

<style scoped>
.central-area {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.towers {
  display: flex;
  justify-content: space-around;
  gap: 30px;
}
</style>

