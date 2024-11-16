<!-- Tower.vue -->
<template>
  <div>
    <div v-for="card in cards" :key="card.id" class="card-div">
      <Card
        :card="card"
      />
      
      <!-- 圆形按钮，使用绝对定位在每张卡片右侧 -->
      <button class="action-button circle-button" @click="buyCard(card)"></button>
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


.card-div {
  width: 100%;
  height: 25%;
  position: relative; /* 使得按钮可以相对于卡片定位 */
  background-color: rgba(0, 61, 115, 0.463);
  margin-bottom: 3%;
}

.action-button {
  position: absolute; /* 绝对定位按钮 */
  right: -53px; /* 调整按钮到塔的右侧，稍微超出 */
  top: 50%; /* 垂直居中于卡片 */
  transform: translateY(-50%); /* 确保按钮垂直居中 */
}


</style>
