<!-- OtherMove.vue -->
  <template>
    <div class="other-move-div">
      
      <!-- 抢先手顺序的按钮 -->
      <button class="button order-button" @click="decideOrder"></button>
      
      <!-- 生產（圓形） -->
      <button 
        class="button circle trigger-card-button" 
        @click="production"
        :style="{
          left: '6.5%',
          bottom: '29.5%'
        }"
      >
      </button>

      <!-- 收成（圓形） -->
      <button 
        class="button circle trigger-card-button" 
        @click="harvest"
        :style="{
          left: '6.5%',
          bottom: '10.5%'
        }"
      ></button>

      <!-- 其餘生產（橫向操場型） -->
      <button 
        class="button trigger-other-card-button"
        @click="otherProduction"
        :style="{
          left: '17%',
          bottom: '29.5%'
        }"
      >
      </button>
    
        <!-- 其餘收成（橫向操場型） -->
      <button 
        class="button trigger-other-card-button"
        @click="otherHarvest"
        :style="{
          left: '17%',
          bottom: '10.5%'
        }"
      >
      </button>
    
      <!-- 賺錢（圓形） -->
      <button 
        class="circle button gain-resource-button" 
        @click="earnMoney"
        :style="{
          right: '39%',
          bottom: '33%'
        }"
      >
      </button>

      <!-- 賺工人（圓形） -->
      <button 
        class="circle button gain-resource-button"
        @click="earnWorker"
        :style="{
          right: '30%',
          bottom: '33%'
        }"
      >  
      </button>

      <div class="dice-div">
        <img
          class="dice" 
          :src = "`/images/dice/black/${gameInfo.blackDice}.png`"
          :style="{
            left: '1.5%',
          }"
        />
        <img
          class="dice" 
          :src = "`/images/dice/white/${gameInfo.whiteDice}.png`"
          :style="{
            left: '38.2%',
          }"
        />
        <img
          class="dice" 
          :src = "`/images/dice/red/${gameInfo.redDice}.png`"
          :style="{
            left: '75%',
          }"
        />
      </div>
            
          
        
    </div>
  </template>
  
  <script>
  export default {
    mounted(){
        console.log(this.gameInfo.blackDice)
    },
    props:{
      gameInfo: {
        type: Object,
        required: true
      }
    },
    methods: {
      // 抢先手顺序的处理函数
      decideOrder() {
        this.$emit('decideOrder'); // 通过事件将信息传递给父组件
      },
      production() {
        this.$emit('production');
      },
      otherProduction() {
        this.$emit('otherProduction');
      },
      earnMoney() {
        this.$emit('earnMoney');
      },
      earnWorker() {
        this.$emit('earnWorker');
      },
      harvest() {
        this.$emit('harvest');
      },
      otherHarvest() {
        this.$emit('otherHarvest');
      },
    }
  };
  </script>
  
  <style scoped>
  .order-button{
    position: absolute; 
    left: 46.8%;
    top:-1%;
    width: 25%; /* 按钮宽度 */
    height: 17%;
    border-radius: 25%;
  }
  .other-move-div {
    position: absolute; 
    width: 100%; /* 按钮宽度 */
    height: 44%;
    background-color: rgba(255, 228, 196, 0);
    bottom:0%;
    
  }
  .trigger-card-button{
    position: absolute; /* 绝对定位按钮 */
    width: 8%; /* 按钮宽度 */
    aspect-ratio: 1/1;
  }

  .trigger-other-card-button{
    position: absolute; /* 绝对定位按钮 */
    width: 20.5%; /* 按钮宽度 */
    height: 13.5%;
    border-radius: 30%;
  }

  .gain-resource-button{
    position: absolute; /* 绝对定位按钮 */
    width: 8%; /* 按钮宽度 */
    aspect-ratio: 1/1;
  }
  
  .dice-div {
    background-color: rgba(255, 255, 255, 0);
    right: 23%;
    position: absolute;
    bottom:9%;
    height: 12%;
    width: 25%;
  }
  
  .dice{
    position: absolute;
    bottom:8%;
    height: 82%;
    aspect-ratio: 1/1;
  }
  </style>
  