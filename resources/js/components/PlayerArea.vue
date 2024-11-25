<template>
  <div class="player-board-div">
    <img class = side-bar :src = "`/images/side-bar/${player.sideBar}.png`"/>

    <div class="resource-div" :style="{left:'2.5%',bottom:'11%',}">
      <img :src = "'/images/resource/money.png'":style = "{height:'65%',}">
        <p class = "resource-quantity"> {{ player.money }}</p>
      </img >
    </div>
    
    <div 
      class="resource-div" :style="{left:'20%',bottom:'13%',}">
      <img :src = "'/images/resource/wood.png'":style = "{height:'70%',}">
        <p class = "resource-quantity"> {{ player.wood }}</p>
      </img >
    </div>

    <div class="resource-div" :style="{left:'36%',bottom:'13%',}">
      <img :src = "'/images/resource/rock.png'":style = "{height:'70%',}">
        <p class = "resource-quantity"> {{ player.rock }}</p>
      </img >
    </div>

    <div class="resource-div" :style="{left:'50.5%',bottom:'6%',}">
      <img :src = "'/images/resource/worker.png'":style = "{height:'100%'}">
        <p class = "resource-quantity"> {{ player.worker }}</p>
      </img >
    </div>
    <div  
    :style="{
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
        position: 'absolute',
        top: '-10%',
        left: '70%',
        height: '10%'
    }"
    >
      <h2>{{ player.user.name }}</h2>
    </div>
     
      
      <div class="green-yellow-cards-div" :style="{top:'0.6%'}">
        <div v-for="card in yellowCards"  class="green-yellow-card-div">
          <Card 
            :key="card.id" 
            :card="card" 
            :canUse="this.$state.user.id == this.player.user.id"
          />
        </div>
      </div>

      <div class="green-yellow-cards-div" :style="{bottom:'21.1%'}">
        <div v-for="card in greenCards"  class="green-yellow-card-div">
          <Card 
            :key="card.id" 
            :card="card" 
            :canUse="this.$state.user.id == this.player.user.id"
          />
        </div>
      </div>

      <div class="blue-purple-cards-div" :style="{top:'0.4%'}">
        <div v-for="card in purpleCards"  class="blue-purple-card-div">
          <Card 
            :key="card.id" 
            :card="card" 
            :canUse="this.$state.user.id == this.player.user.id"
          />
          </div>
      </div>

      <div class="blue-purple-cards-div" :style="{bottom:'23%'}">
        <div v-for="card in blueCards"  class="blue-purple-card-div">
          <Card 
            :key="card.id" 
            :card="card" 
            :canUse="this.$state.user.id == this.player.user.id"
          />
        </div>
      </div>


      <div class = pillars-div>
        <button v-for="color in playerPillars"
          :class = "'pillar-button'"
          :style="getButtonStyle(color)" @click="choosePillar(color)"
        >
        </button>
      </div>
    <div>
      
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
    playerPillars(){
      const pillarArrayPos = [
        {'pos':this.player.blackPillar,'color':'black'},
        {'pos':this.player.whitePillar,'color':'white'},
        {'pos':this.player.redPillar,'color':'red'},
        {'pos':this.player.normalPillar,'color':'normal'}
      ]
      let playerPillarArray = [] 
      pillarArrayPos.forEach(element => {
        if(element.pos == 'hand'){
          playerPillarArray.push(element.color)
        }
      });
      return playerPillarArray
    },
    greenCards(){
      return this.player.cards.filter(item => item.color === 'green');
    },
    blueCards(){
      return this.player.cards.filter(item => item.color === 'blue');
    },
    yellowCards(){
      return this.player.cards.filter(item => item.color === 'yellow');
    },
    purpleCards(){
      return this.player.cards.filter(item => item.color === 'purple');
    },

    
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
        height: '99.5%', // 设置按钮的高度
        width:'12.2%',
        backgroundImage: `url(/images/pillars/${this.player.color}-${color}.png)`,
        backgroundSize: 'contain', // 确保图片覆盖整个按钮
        backgroundPosition: 'center',
        border:this.player.chooseColor == color?'2px solid rgb(210, 1, 1)':'none'
      }
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
  width:60%;
  position: relative;
  left: 3%;
  background-image: url('/images/player-board.png'); /* 设置背景图片 */
  background-size: contain;
  background-repeat: no-repeat; /* 防止背景图片重复 */
  
}

.green-yellow-cards-div {
  padding-left: 1.2%;
  position: absolute;
  width: 96%;
  height: 34.8%;
  display: flex;
  flex-direction: row;
}
.green-yellow-card-div {
  margin-right: 1.55%;
  position: relative;
  width: 15.3%;
  height: 100%;
}
.blue-purple-cards-div {
  left: 100%;
  position: absolute;
  height: 33.2%;
  display: flex;
  flex-direction: row;
  
}
.blue-purple-card-div {
  margin-right: 0.3vw;
  position: relative;
  aspect-ratio: 239 / 365;
  height: 100%;

}
.pillars-div {
  position: absolute;
  display:flex;
  height: 15%;
  width: 50%;
  right:-35%;
  bottom:105%;
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
