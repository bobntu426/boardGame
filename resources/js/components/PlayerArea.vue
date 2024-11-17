<template>
  <div class="player-board-div">
    <img 
      class = side-bar
      :src = "`/images/sideBar/1.png`"
      :style = {}
    />
    
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
            'choose-pillar': player.chooseColor === 'red',
            'unchoose-pillar': player.chooseColor !== 'red'
          }" 
        >
          <image src=""></image>
        </button>
        <button 
          class = pillar @click="choosePillar('black')"
          :class="{
            'choose-pillar': player.chooseColor === 'black',
            'unchoose-pillar': player.chooseColor !== 'black'
          }" 
        >
          <image src=""></image>
        </button>      
        <button 
          class = pillar @click="choosePillar('white')"
          :class="{
            'choose-pillar': player.chooseColor === 'white',
            'unchoose-pillar': player.chooseColor !== 'white'
          }" 
        >
          <image src=""></image>
        </button>      
        <button 
          class = pillar @click="choosePillar('pillar')"
          :class="{
            'choose-pillar': player.chooseColor === 'pillar',
            'unchoose-pillar': player.chooseColor !== 'pillar'
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
.side-bar{
  position: absolute;
  height:35.9%;
  left: -6.9%;
}

.player-board-div {
  aspect-ratio: 1049 / 1558;
  width:90%;
  position: relative;
  left: 3%;
  background-image: url('/images/playerBoard.png'); /* 设置背景图片 */
  background-size: contain;
  background-repeat: no-repeat; /* 防止背景图片重复 */
  
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
