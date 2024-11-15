<template>
  <div class="card">
    <div class="card-info">
      <h3>{{ card.name }}</h3>
      <p><strong>價格：</strong>{{ card.cost }}</p>
      <p><strong>購買效果：</strong>{{ card.buyEffect }}</p>
      <p><strong>使用效果：</strong>{{ card.useEffect }}</p>
    </div>

    <!-- 動態顯示按鈕 -->
  </div>
</template>

<script>
import { inject } from "vue";
export default {
  props: {
    card: {
      type: Object,
      required: true
    },

  },
 
  methods: {

  }

};
</script>

<style scoped>
.card {
  width: 120px; /* 固定寬度 */
  height: 180px; /* 固定高度 */
  border: 2px solid #aaa;
  border-radius: 8px;
  background-color: #fff;
  margin-bottom: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* 增加陰影效果 */
  overflow: hidden; /* 防止內容超出 */
}

.card-info {
  padding: 10px;
  overflow-y: auto;
}

.buy-card-button,
.use-card-button {
  width: 100%; /* 按鈕寬度和卡片寬度一致 */
  padding: 5px 0;
  border: none;
  border-radius: 0 0 8px 8px; /* 下方圓角 */
  cursor: pointer;
}

.buy-card-button {
  background-color: #007bff;
  color: white;
  border-top: 1px solid #ddd; /* 添加上邊框，分隔信息與按鈕 */
}

.use-card-button {
  background-color: #28a745;
  color: white;
}

h3, p {
  font-size: 12px; /* 調整字體大小，使內容適應卡片 */
  margin: 0;
  padding: 3px 0;
}
</style>
