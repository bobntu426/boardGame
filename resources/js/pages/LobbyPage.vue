<template>
  <div class="lobby">
    <h1>歡迎來到大堂</h1>
    <button class="join-lobby-button" @click="handleCreateTable">創建桌子</button>
    <div v-if="loading">加載中...</div>
    <div v-else-if="tables.length === 0">沒有找到桌子。</div>
    <div v-else>
      <h2>桌子列表</h2>
      <div class="table-list">
        <div v-for="table in tables" :key="table.id" class="table-box">
          <div class="table-content">
            {{ table.id }}
          </div>
          <div v-for="user in table.users" :key="user.id" class="table-content">
            {{ user.name}}
          </div>

          <button class="join-table-button" @click="handleJoinTable(table.id)">加入本桌</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {fetchTables,createTable,joinTable} from "../api"
import "../echo"




export default {
  data() {
    return {
      tables: [],   // 用於存儲桌子數據
      loading: true, // 用於指示加載狀態
    };
  },
  async mounted() {
    
    await this.loadTables();
    this.listenForTableCreated();
    this.listenForTableJoined();
  },
  methods: {
    async loadTables() {
      try {
        this.tables = await fetchTables(); // 調用 API 函數獲取桌子數據
      } catch (error) {
        console.error('獲取桌子數據時出錯:', error);
      } finally {
        this.loading = false; // 無論成功與否都設置 loading 為 false
      }
    },
    async handleCreateTable() {
      try {
        const newTable = await createTable(); // 調用 API 函數創建桌子
      } catch (error) {
        console.error('創建桌子時出錯:', error);
      }
    },
    async handleJoinTable(tableId) {
      try {
        const result = await joinTable(tableId); // 調用 API 函數加入桌子
        console.log('成功加入桌子:', result);
      } catch (error) {
        console.error('加入桌子時出錯:', error);
      }
    },
    listenForTableCreated() {
      window.Echo.channel('lobby')
        .listen('TableCreated', (e) => {
          console.log('接收到新桌子事件:', e);
          this.tables.push(e.table); // 將新桌子添加到 tables 陣列中
        });
      },
    listenForTableJoined() {
    window.Echo.channel('lobby')
      .listen('TableJoined', (e) => {
        console.log('接收到加入桌子事件:', e);
        const index = this.tables.findIndex(table=>table.id == e.table.id)
        this.tables[index].users.push(e.user)
      });
    },
    beforeUnmount() {
      window.Echo.leave('lobby');
    },
  }
};

</script>

<style scoped>
.lobby {
  padding: 20px;
  background-color: lightgreen;
  border: 1px solid #ccc;
  border-radius: 8px;
  position: relative; /* 為了定位右上方的按鈕 */
}

.join-lobby-button {
  position: absolute; /* 絕對定位 */
  top: 20px; /* 距離上方20像素 */
  right: 20px; /* 距離右方20像素 */
  padding: 10px 15px;
  background-color: #007bff; /* 按鈕背景顏色 */
  color: white; /* 按鈕文字顏色 */
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.join-lobby-button:hover {
  background-color: #0056b3; /* 按鈕懸停效果 */
}

.table-list {
  display: flex; /* 使用 flexbox 來排列方形 div */
  flex-wrap: wrap; /* 當空間不夠時換行 */
  gap: 10px; /* 方形 div 之間的間距 */
}

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

.join-table-button {
  padding: 5px 10px;
  background-color: #007bff; /* 按鈕背景顏色 */
  color: white; /* 按鈕文字顏色 */
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.join-table-button:hover {
  background-color: #0056b3; /* 按鈕懸停效果 */
}
</style>
