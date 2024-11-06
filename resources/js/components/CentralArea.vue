<template>
  <div class="central-area">
    <h2>中央版面</h2>
    <p>排堆：</p>
    <div class="card-list">
      <!-- 使用 Card 組件來顯示每個卡片 -->
      <Card
        v-for="card in cards"
        :key="card.id"
        :card="card"
        :onBuyCard="handleBuyCard"
      />
    </div>
  </div>
</template>

<script>
import Card from './Card.vue'; // 引入 Card 組件

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
  methods: {
    handleBuyCard(card) {
      console.log('購買了卡片：', card);
      // 在這裡處理卡片購買的邏輯
    }
  }
};
</script>

<style scoped>
.central-area {
  width: 100%;
  border: 1px solid #aaa;
  border-radius: 8px;
  padding: 10px;
  background-color: #f0f0f0;
}

.card-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px; /* 讓卡片之間有間距 */
  justify-content: center;
}
</style>
