<template>
  <div class="card">
    <div class="card-info">
      <h3>{{ card.name }}</h3>
      <p><strong>價格：</strong>{{ card.cost }}</p>
      <p><strong>購買效果：</strong>{{ card.buyEffect }}</p>
      <p><strong>使用效果：</strong>{{ card.useEffect }}</p>
    </div>

    <!-- 動態顯示按鈕 -->
    <button v-if="!canUse" class="buy-card-button" @click="buyCard">
      買這張卡
    </button>
    <button v-else class="use-card-button" @click="useCard">
      使用卡片
    </button>
  </div>
</template>

<script>
export default {
  props: {
    card: {
      type: Object,
      required: true
    },
    canUse: {
      type: Boolean,
      required: true
    },
  },
  methods: {
    buyCard() {
      // 當按下「買卡片」按鈕時，觸發事件並傳遞卡片資訊
      this.$emit('buyCard', this.card);
    },
    useCard() {
      // 當按下「使用」按鈕時，觸發事件並傳遞卡片資訊
      this.$emit('useCard', this.card);
    }
  }
};
</script>

<style scoped>
.card {
  border: 1px solid #aaa;
  border-radius: 8px;
  padding: 10px;
  background-color: #fff;
  margin-bottom: 10px;
}

.card-info {
  margin-bottom: 10px;
}

.buy-card-button,
.use-card-button {
  padding: 5px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.buy-card-button {
  background-color: #007bff;
  color: white;
}

.use-card-button {
  background-color: #28a745;
  color: white;
}
</style>
