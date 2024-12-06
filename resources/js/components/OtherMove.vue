<!-- OtherMove.vue -->
  <template>
    <div class="other-move-div"> 

      <div v-for="buttonInfo in buttonInfoArray"
        class="button-div"
        :style="buttonInfo.divStyle"
      >
        <div class="pillar-image-div"
          v-if = "pillarInfo[buttonInfo.name].length > 0"
          v-for="(pillarInfo) in pillarInfo[buttonInfo.name]"
        >
          <img 
            :src = "getPillarSrc(pillarInfo)"
            class="pillar"
          ></img>
        </div>
        <button 
          v-if = "pillarInfo[buttonInfo.name].length == 0||buttonInfo.multiplayer"
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
      <div class="order-div">
        <img
          v-for = "(info,index) in this.gameInfo.orderColorInfo"
          class="order-circle" 
          :src = "`/images/circles/${info.color}.png`"
          :style="orderInfoArray[index].style"
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
            divStyle:{left:'46.8%',top: '-1%',width: '25%',height:'17%'},
            buttonClass: 'order-button',click:this.decideOrder,name:'order',multiplayer:true
          },
          {
            divStyle:{left:'6.5%',bottom: '29.5%',width: '8%',aspectRatio:'1/1'},
            buttonClass: 'circle-button',click:this.production,name:'production',multiplayer:false
          },
          {
            divStyle:{left:'6.5%',bottom: '10.5%',width: '8%',aspectRatio:'1/1'},
            buttonClass: 'circle-button',click:this.harvest,name:'harvest',multiplayer:false
          },
          {
            divStyle:{left:'17%',bottom: '29.5%',width: '20.5%',height: '13.5%'},
            buttonClass: 'oval-button', click:this.otherProduction,name:'otherProduction',multiplayer:true
          },
          {
            divStyle:{left:'17%',bottom: '10.5%',width: '20.5%',height: '13.5%'},
            buttonClass: 'oval-button', click:this.otherHarvest,name:'otherHarvest',multiplayer:true
          },
          {
            divStyle:{right:'39%',bottom: '33%',width:'8%',aspectRatio:'1/1'},
            buttonClass: 'circle-button', click:this.earnMoney,name:'earnMoney',multiplayer:false
          },
          {
            divStyle:{right:'30%',bottom: '33%',width:'8%',aspectRatio:'1/1'},
            buttonClass:'circle-button', click:this.earnWorker,name:'earnWorker',multiplayer:false
          },
          {
            divStyle:{right:'21.8%',bottom: '29%',width:'8%',aspectRatio:'1/1'},
            buttonClass: 'circle-button', click:this.earnMoneyMilitary,name:'earnMoneyMilitary',multiplayer:false
          },
          {
            divStyle:{right:'14.8%',bottom: '19%',width:'8%',aspectRatio:'1/1'},
            buttonClass:'circle-button', click:this.earnTwoReel,name:'earnTwoReel',multiplayer:false
          },
          
        ],
        diceInfoArray:[
          {style: {left: '1.5%'},src:`/images/dice/black/${this.gameInfo.blackDice}.png`},
          {style: {left: '38.2%'},src:`/images/dice/white/${this.gameInfo.whiteDice}.png`},
          {style: {left: '75%'},src:`/images/dice/red/${this.gameInfo.redDice}.png`}
        ],
        orderInfoArray:[
          {style: {top: '0%'}},
          {style: {top: '24%'}},
          {style: {top: '48%'}},
          {style: {top: '72%'}}
        ]
      }
    },
    props:{
      gameInfo: {
        type: Object,
        required: true
      },
      player:{
        type: Object,
        required: true
      },
      pillarInfo:{
        type: Object,
        required: true
      },
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
      earnMoneyMilitary() {
        this.$emit('earnMoneyMilitary');
      },
      earnTwoReel() {
        this.$emit('earnTwoReel');
      }
    }
  };
  </script>
  
  <style scoped>
  .order-button{
    position: absolute;
    width: 100%; /* 按钮宽度 */
    height: 100%;
    border-radius: 25%;
  }
  .other-move-div {
    position: absolute; 
    width: 100%; 
    height: 44%;
    background-color: rgba(255, 228, 196, 0);
    bottom:0%;
    z-index: 10;
    
  }
 
  .circle-button{
    width: 100%; 
    height: 100%;
    border-radius: 50%;
    
  }

  .oval-button{
    position: absolute;
    width: 100%; 
    height: 100%;
    border-radius: 30%;
    
  }

  .button-div{
    position: absolute;
    display: flex;
    justify-content: center; 
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
    position:absolute;
    width: 1.7vw; 
    aspect-ratio: 273/450;
    bottom:28%;
  }
  .pillar-image-div{
    position: relative;
    display: flex;
    justify-content: center;
    height: 100%;
    width:20% ;
  }
  .order-div{
    position:absolute;
    right: 18.5%;
    width: 4%;
    top: -5.3%;
    height:36%
  }
  .order-circle{
    position: absolute;
    width: 100%;
  }
  </style>
  