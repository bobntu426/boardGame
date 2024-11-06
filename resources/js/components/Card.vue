<template>
    <div class="card">
      <div class="card-info">
        <h3>{{ card.name }}</h3>
        <p><strong>價格：</strong>{{ (card.cost) }} </p>
        <p><strong>購買效果：</strong>{{ card.buyEffect }}</p>
        <p><strong>使用效果：</strong>{{ card.useEffect }}</p>
      </div>
  
      <!-- 買卡按鈕 -->
      <button class="buy-card-button" @click="buyCard">
        買這張卡
      </button>
    </div>
  </template>
  
  <script>
    
  export default {
    mounted() {

    },
    props: {
      card: {
        type: Object,
        required: true
      },
      onBuyCard: {
        type: Function,
        required: true
      }
    },
    methods: {
      buyCard() {
        // 當按下買卡按鈕時，觸發父組件的 buyCard 方法
        this.onBuyCard(this.card);
      }
    }
  };
  </script>
  
  <style scoped>
  .card {
    width: 200px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .card-info {
    text-align: center;
  }
  
  .card-info h3 {
    margin: 0;
  }
  
  .card-info p {
    margin: 5px 0;
  }
  
  .buy-card-button {
    margin-top: 10px;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .buy-card-button:hover {
    background-color: #0056b3;
  }
  </style>
  