<!-- OtherMove.vue -->
  <template>
    <div class="other-move-div">
      
      <!-- 抢先手顺序的按钮 -->
      <button class="button order-button" @click="decideOrder"></button>

      <div v-for="buttonInfo in buttonInfoArray"
        class="button-div"
        :style="buttonInfo.divStyle"
      >
        <img 
          v-if = "gameInfo.pillarInfo[buttonInfo.name].length > 0"
          v-for="(pillarInfo) in gameInfo.pillarInfo[buttonInfo.name]"
          :src = "getPillarSrc(pillarInfo)"
          class="pillar"
        ></img>

        <button v-else
          @click="buttonInfo.click"
          :class="buttonInfo.buttonClass+' button'" 
        ></button>
        
      </div>

      <div class="dice-div">
        <img
          v-for = "diceInfo in diceInfoArray"
          class="dice" 
          :src = "diceInfo.src"
          :style="diceInfo.style"
        />
      </div>

    </div>
  </template>
  
  <script>
  export default {
    data(){
      return{
        buttonInfoArray:[
          {
            divStyle:{left:'6.5%',bottom: '29.5%',width: '8%',aspectRatio:'1/1'},
            buttonClass: 'circle-button',click:this.production,name:'production'
          },
          {
            divStyle:{left:'6.5%',bottom: '10.5%',width: '8%',aspectRatio:'1/1'},
            buttonClass: 'circle-button',click:this.harvest,name:'harvest'
          },
          {
            divStyle:{left:'17%',bottom: '29.5%',width: '20.5%',height: '13.5%'},
            buttonClass: 'oval-button', click:this.otherProduction,name:'otherProduction'
          },
          {
            divStyle:{left:'17%',bottom: '10.5%',width: '20.5%',height: '13.5%'},
            buttonClass: 'oval-button', click:this.otherHarvest,name:'otherHarvest'
          },
          {
            divStyle:{right:'39%',bottom: '33%',width:'8%',aspectRatio:'1/1'},
            buttonClass: 'circle-button', click:this.earnMoney,name:'earnMoney'
          },
          {
            divStyle:{right:'30%',bottom: '33%',width:'8%',aspectRatio:'1/1'},
            buttonClass:'circle-button', click:this.earnWorker,name:'earnWorker'
          },
          
        ],
        diceInfoArray:[
          {style: {left: '1.5%'},src:`/images/dice/black/${this.gameInfo.blackDice}.png`},
          {style: {left: '38.2%'},src:`/images/dice/white/${this.gameInfo.whiteDice}.png`},
          {style: {left: '75%'},src:`/images/dice/red/${this.gameInfo.redDice}.png`}
        ]
      }
    },
    mounted(){
      console.log(this.gameInfo.pillarInfo['harvest'][0]);

    },
    props:{
      gameInfo: {
        type: Object,
        required: true
      }
    },
    methods: {
      getPillarSrc(posInfo){     
        return `/images/pillars/${posInfo.playerColor}-${posInfo.color}.png`
      },
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
 
  .circle-button{
    width: 100%; 
    height: 100%;
    border-radius: 50%;
  }

  .oval-button{
    width: 100%; 
    height: 100%;
    border-radius: 30%;
  }

  .button-div{
    position: absolute;
    display: flex;
    justify-content: center;  /* 水平置中 */
    
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
  .pillar{
    position: absolute;
    width: 2.5vw; 
    bottom:25%;
  }
  </style>
  