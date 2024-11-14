<!-- OtherMove.vue -->
  <template>
    <div class="other-move">
      <div class="section">
          <!-- 抢先手顺序的按钮 -->
          <button class="button wide-button" @click="decideOrder">
            <image src=""/>
          </button>
      </div>
  
      <div class="bottom-section">
        <div class="section">
          <div class="row-div">
            <!-- 生產（圓形） -->
            <button class="circle-button" @click="handleProduction">
                <image src=""/>
            </button>

            <!-- 其餘生產（橫向操場型） -->
            <button class="button wide-button" @click="handleOtherProduction">
            其餘生產
            </button>
          </div>
          <div class="row-div">
            <!-- 賺錢（圓形） -->
            <button class="circle-button" @click="handleEarnMoney">
            賺錢
            </button>

            <!-- 賺工人（圓形） -->
            <button class="button circle-button" @click="handleEarnWorkers">
            賺工人
            </button>
          </div>
        </div>

    <!-- 下半区 -->
          <div class="section">
            <div class="row-div">
              <!-- 收成（圓形） -->
              <button class="button circle-button" @click="handleHarvest">
              收成
              </button>

              <!-- 其餘收成（橫向操場型） -->
              <button class="button wide-button" @click="handleOtherHarvest">
              其餘收成
              </button>
            </div>

              <!-- 骰子部分 -->
            <div class="row-div">
              <div class="dice">
                <image class="dice-button black-dice" />
                <image class="dice-button white-dice" />
                <image class="dice-button red-dice" />
              </div>
            </div>
          </div>
        </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      // 抢先手顺序的处理函数
    decideOrder() {
     this.$emit('decideOrder'); // 通过事件将信息传递给父组件
    },
    handleProduction() {
      console.log('執行生產');
      // 你可以在這裡寫對應的處理邏輯
    },
    handleOtherProduction() {
      console.log('執行其餘生產');
    },
    handleEarnMoney() {
      console.log('執行賺錢');
    },
    handleEarnWorkers() {
      console.log('執行賺工人');
    },
    handleHarvest() {
      console.log('執行收成');
    },
    handleOtherHarvest() {
      console.log('執行其餘收成');
    },
    }
  };
  </script>
  
  <style scoped>
  .other-move {
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
    background-color: #f0f0f0; /* 可选：设置背景颜色 */
  }
  
  
  .section {
    width: 100%;
    height: 150px; /* 设置容器的高度 */
    display: flex;
    justify-content: center; /* 水平居中 */
    align-items: center; /* 垂直居中 */
    
  }
  .row-div {
    width: 100%;
    height: 100px; /* 设置容器的高度 */
    display: flex;
    justify-content: center; /* 水平居中 */
    align-items: center; /* 垂直居中 */
    

  }
  
 
  
  /* 下半区 */
  .bottom-section {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 5px;
    
  }
  
  /* 底部按钮部分 */
  .bottom-buttons {
    display: flex;
    justify-content: space-around;
    gap: 20px;
  }
  
  .dice-section {
    display: flex;
    justify-content: space-around;
    gap: 20px;
  }
  
  .dice {
    display: flex;
    gap: 10px;
  }
  
  .dice-button {
    width: 50px;
    height: 50px;
    background-color: #ccc;
    border-radius: 4px;
  }
  
  .black-dice {
    background-color: black;
  }
  
  .white-dice {
    background-color: white;
  }
  
  .red-dice {
    background-color: red;
  }
  </style>
  