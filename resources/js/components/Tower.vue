<!-- Tower.vue -->
<template>
  <div>
    <div v-for="card in cards" :key="card.id" class="card-div">
      <Card
        :card="card"
      />
      
      <!-- 圆形按钮，使用绝对定位在每张卡片右侧 -->
      <button class="tower-button button circle" @click="buyCard(card)"></button>
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
  height: 24.6%;
  position: relative; /* 使得按钮可以相对于卡片定位 */
  background-color: rgba(0, 61, 115, 0.463);
  margin-bottom: 3%;
}

.tower-button {
  position: absolute; /* 绝对定位按钮 */
  width: 62%; /* 按钮宽度 */
  aspect-ratio: 1/1;
  left:104%;
  top: 32%; 
}


</style>
