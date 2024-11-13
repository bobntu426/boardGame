<template>
  <div class="player-area">
    <h2>{{ player.user.name }}</h2>
    <p>錢幣：{{ player.money }}</p>
    <p>石頭：{{ player.rock }}</p>
    <p>木頭：{{ player.wood }}</p>
    <p>工人：{{ player.worker }}</p>
    <p>持有的卡牌：</p>
    <div class="cards-container">
      <Card 
        v-for="card in player.cards" 
        :key="card.id" 
        :card="card" 
        :canUse="this.$state.user.id == this.player.user.id"
        @useCard="useCard"
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
    player: {
      type: Object,
      required: true
    }
  },
  methods:{
    useCard(card) {
      this.$emit('useCard', card);
    }
  },
  mounted(){
    
    //canUse = (this.$state.user.id == this.player.user.id)
  }
};
</script>

<style scoped>
.player-area {
  width: 100%;
  border: 1px solid #aaa;
  border-radius: 8px;
  padding: 10px;
  background-color: #f9f9f9;
  margin-top: 10px; /* 添加頂部間距 */
}

.cards-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}
</style>
