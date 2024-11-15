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
    <div class = pillars-container>
      <button 
        class = pillar @click="choosePillar('red')"
        :class="{
          'choose-pillar': pillarColor === 'red',
          'unchoose-pillar': pillarColor !== 'red'
        }" 
      >
        <image src=""></image>
      </button>
      <button 
        class = pillar @click="choosePillar('black')"
        :class="{
          'choose-pillar': pillarColor === 'black',
          'unchoose-pillar': pillarColor !== 'black'
        }" 
      >
        <image src=""></image>
      </button>      
      <button 
        class = pillar @click="choosePillar('white')"
        :class="{
          'choose-pillar': pillarColor === 'white',
          'unchoose-pillar': pillarColor !== 'white'
        }" 
      >
        <image src=""></image>
      </button>      
      <button 
        class = pillar @click="choosePillar('pillar')"
        :class="{
          'choose-pillar': pillarColor === 'pillar',
          'unchoose-pillar': pillarColor !== 'pillar'
        }" 
      >
        <image src=""></image>
      </button>
    </div>
  </div>
</template>

<script>
import Card from './Card.vue'; // 引入 Card 組件

export default {
  data(){
    return{
      
    }
  },
  components: {
    Card
  },
  props: {
    player: {
      type: Object,
      required: true
    },
    pillarColor:{
      type:String
    }
  },
  methods:{
    useCard(card) {
      this.$emit('useCard', card);
    },
    choosePillar(color) {
      this.$emit('choosePillar',color,this.player); // 通过事件将信息传递给父组件
    },
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
.pillars-container {
  gap: 10px;
  
}
.pillar {
  width: 50px; /* 按钮宽度 */
  height: 50px; /* 按钮高度 */
  border-radius: 50%; /* 圆形按钮 */
  cursor: pointer;
  background-color: red;
  
}
.unchoose-pillar {
  border: none;
}
.choose-pillar {
  border: 2px solid rgb(92, 134, 196);
}
</style>
