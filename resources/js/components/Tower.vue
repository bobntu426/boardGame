<!-- Tower.vue -->
<template>
    <div class="tower">
      
      <div class="tower-layers">
        <!-- 每座塔的四层 -->
        <div  class="tower-layer">
          <Card
            v-for="card in cards"
            :key="card.id"
            :card="card"
            :canUse="false"
            @buyCard="buyCard"
          /> 
         
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
      color:{
        type:String,
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
  