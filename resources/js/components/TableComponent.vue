<template>
  <div class="table-box">
    <div class="table-content">
      桌號：{{ table.id }}
      <button 
        v-if="canEnterGame" 
        class="enter-game-button" 
        @click="enterGame">
        進入遊戲
      </button>
    </div>
    <div v-for="user in table.users" :key="user.id" class="table-content">
      玩家：{{ user.name }}
    </div>
    <div v-if="this.$state.isLogin" >
      <button 
        v-if="!isUserInTable" 
        class="join-table-button" 
        @click="joinTable">
        加入本桌
      </button>
      <button 
        v-if="isUserInTable" 
        class="leave-table-button" 
        @click="leaveTable">
        離開本桌
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    table: {
      type: Object,
      required: true
    },
    onJoinTable: {
      type: Function,
      required: true
    },
    onLeaveTable: {
      type: Function,
      required: true
    },
    userId: {
      type: Number,
      required: true
    }
  },
  computed: {
    isUserInTable() {
      return this.table.users.some(user => user.id === this.userId);
    },
    canEnterGame() {
      return this.table.users.length == this.table.playerNum; // 當用戶數等於所需的玩家數時，返回 true
    }
  },
  methods: {
    joinTable() {
      this.onJoinTable(this.table.id);
    },
    leaveTable() {
      this.onLeaveTable(this.table.id);
    },
    enterGame() {
      this.$router.push({ path: `/game/${this.table.id}` });
    }
  }
};
</script>

  
  <style scoped>
  .table-box {
    width: 200px; /* 方形 div 的寬度 */
    height: 300px; /* 方形 div 的高度 */
    background-color: white; /* 方形 div 的背景顏色 */
    border: 1px solid #aaa; /* 方形 div 的邊框 */
    display: flex; /* 使用 flexbox 來排列內容 */
    flex-direction: column; /* 垂直排列內容 */
    justify-content: space-between; /* 在上下之間平均分配空間 */
    border-radius: 8px; /* 圓角邊框 */
    position: relative; /* 讓子元素可以相對於此定位 */
  }
  
  .table-content {
    flex-grow: 1; /* 讓內容區域自動擴展 */
    display: flex;
    justify-content: center; /* 水平居中 */
    align-items: center; /* 垂直居中 */
  }
  
  .join-table-button,
  .leave-table-button {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .join-table-button {
    background-color: #007bff; /* 加入按鈕背景顏色 */
    color: white; /* 加入按鈕文字顏色 */
  }
  
  .join-table-button:hover {
    background-color: #0056b3; /* 加入按鈕懸停效果 */
  }
  
  .leave-table-button {
    background-color: #dc3545; /* 離開按鈕背景顏色 */
    color: white; /* 離開按鈕文字顏色 */
  }
  
  .leave-table-button:hover {
    background-color: #c82333; /* 離開按鈕懸停效果 */
  }
  </style>
  