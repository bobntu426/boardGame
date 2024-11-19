<template>
  <div class="player-board-div">
    <img 
      class = side-bar
      :src = "`/images/side-bar/${player.sideBar}.png`"
    />
    <div 
      class="resource-div" 
      :style="{
        left:'2.5%',
        bottom:'11%',
      }"
    >
      <img 
        :src = "'/images/resource/money.png'"
        :style = "{
          height:'65%',
        }"
      ><p class = "resource-quantity"> {{ player.money }}</p>
      </img >
    </div>
    
    <div 
      class="resource-div" 
      :style="{
        left:'20%',
        bottom:'13%',
      }"
    >
      <img 
        :src = "'/images/resource/wood.png'"
        :style = "{
          height:'70%',
        }"
      ><p class = "resource-quantity"> {{ player.wood }}</p>
      </img >
    </div>
    <div 
      class="resource-div" 
      :style="{
        left:'36%',
        bottom:'13%',
      }"
    >
      <img 
        :src = "'/images/resource/rock.png'"
        :style = "{
          height:'70%',
        }"
      ><p class = "resource-quantity"> {{ player.rock }}</p>
      </img >
    </div>
    <div 
      class="resource-div" 
      :style="{
        left:'50.5%',
        bottom:'6%',
      }"
    >
      <img 
        :src = "'/images/resource/worker.png'"
        :style = "{
          height:'100%',
        }"
      ><p class = "resource-quantity"> {{ player.worker }}</p>
      </img >
    </div>


      <h2>{{ player.user.name }}</h2>
      


      <div class="cards-container">
        <Card 
          v-for="card in player.cards" 
          :key="card.id" 
          :card="card" 
          :canUse="this.$state.user.id == this.player.user.id"
          @useCard="useCard"
        />
      </div>


      <div class = pillars-div>
        
        <button v-for="color in ['black','white','red','pillar']"
          :class = "'pillar-button'"
          :style="getButtonStyle(color)" @click="choosePillar(color)"
        >
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
  computed: {
    // 动态计算按钮的样式
    
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
    getButtonStyle(color){
      return {
        height: '100%', // 设置按钮的高度
        width:'12.5%',
        backgroundImage: `url(/images/pillars/${this.player.color}-${color}.png)`,
        backgroundSize: 'contain', // 确保图片覆盖整个按钮
        backgroundPosition: 'center',
        border:this.player.chooseColor == color?'2px solid rgb(210, 1, 1)':'none'
      }
    },
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
  height:79.5%;
  left: -6.8%;
}
.resource-div{
  display: flex;
  justify-content: center; /* 水平居中 */
  align-items: center;    /* 垂直居中 */
  height: 10%;
  width: 11%;
  position: absolute
}
.resource-quantity{
  position:absolute;
}
.player-board-div {
  aspect-ratio: 1558 / 1049;
  width:90%;
  position: relative;
  left: 3%;
  background-image: url('/images/player-board.png'); /* 设置背景图片 */
  background-size: contain;
  background-repeat: no-repeat; /* 防止背景图片重复 */
  
}

.cards-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}
.pillars-div {
  position: absolute;
  display:flex;
  height: 15%;
  width: 50%;
  right:2%;
  top:-18%;
  gap:2%;
}
.pillar-button{
  background-color: rgba(0, 0, 0, 0) 
}
.pillar-button:hover {
  background-color: rgba(182, 190, 28, 0.46);
  cursor: pointer; /* 显示手形光标 */
}
</style>
