<template>
  <div class="central-area">
    <h2>中央版面</h2>
    <p>排堆：</p>
    
    <div class="towers">
      <!-- 四座塔 -->
      <div class="tower" v-for="(tower, towerIndex) in towers" :key="towerIndex">
        <h3>塔 {{ towerIndex + 1 }}</h3>
        <div class="tower-layers">
          <!-- 每座塔的四层 -->
          <div
            v-for="(layer, layerIndex) in tower"
            :key="layerIndex"
            class="tower-layer"
          >
            
            <Card 
              v-for="card in cards.slice(layerIndex, layerIndex + 1)"
              :key="card.id"
              :card="card"
              :canUse="false"
              @buyCard="buyCard"
            />
            <p v-if="cards.slice(layerIndex, layerIndex + 1).length === 0">空</p> <!-- 如果没有卡片，显示空 -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Card from './Card.vue'; // 引入 Card 组件

export default {
  components: {
    Card
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
        [{}, {}, {}, {}], // 第一座塔
        [{}, {}, {}, {}], // 第二座塔
        [{}, {}, {}, {}], // 第三座塔
        [{}, {}, {}, {}]  // 第四座塔
      ]
    };
  },
  methods: {
    // 购买卡片的处理函数
    buyCard(card) {
      this.$emit('buyCard', card);
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

.tower {
  width: 150px;
  padding: 10px;
  background-color: #f0f0f0;
  border: 1px solid #aaa;
  border-radius: 8px;
  position: relative;
  display: flex;
  flex-direction: column-reverse; /* 垂直堆叠塔的层 */
  overflow-y: auto;  /* 允许溢出的内容显示滚动条 */
}

.tower-layers {
  display: flex;
  flex-direction: column-reverse; /* 垂直堆叠 */
  gap: 5px;
  justify-content: flex-end;
}

.tower-layer {
  display: flex;
  flex-direction: column;
  align-items: center; /* 居中卡片 */
}

p {
  text-align: center;
  color: gray;
}
</style>
