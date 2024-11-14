<!-- Tower.vue -->
<template>
  <div class="tower">
    <div class="tower-layers">
      <!-- 每座塔的四层 -->
      <div class="tower-layer" >
        <div v-for="card in cards" :key="card.id" class="card-container">
          <Card
            :card="card"
          />
          
          <!-- 圆形按钮，使用绝对定位在每张卡片右侧 -->
          <button class="action-button circle-button" @click="buyCard(card)"></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Card from './Card.vue';

export default {
  components: {
    Card
  },
  props: {
    cards: {
      type: Array,
      required: true
    },
    color: {
      type: String
    }
  },
  methods: {
    buyCard(card) {
      this.$emit('buyCard', card);
    }
  }
};
</script>

<style scoped>
.tower {
  width: 150px;
  padding: 10px;
  background-color: #f0f0f0;
  border: 1px solid #aaa;
  border-radius: 8px;
  position: relative;
  display: flex;
  flex-direction: column-reverse; /* 垂直堆叠塔的层 */
  overflow: visible
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

.card-container {
  position: relative; /* 使得按钮可以相对于卡片定位 */
  
}

.action-button {
  position: absolute; /* 绝对定位按钮 */
  right: -40px; /* 调整按钮到塔的右侧，稍微超出 */
  top: 50%; /* 垂直居中于卡片 */
  transform: translateY(-50%); /* 确保按钮垂直居中 */
}


</style>
