<template>
  <div class="lobby">
    <h1>歡迎來到大堂</h1>
    <button class="join-lobby-button" @click="handleCreateTable">創建桌子</button>
    <div v-if="loading">加載中...</div>
    <div v-else-if="tables.length === 0">沒有找到桌子。</div>
    <div v-else>
      <h2>桌子列表</h2>
      <div class="table-list">
        <TableComponent
          v-for="table in tables"
          :key="table.id"
          :table="table"
          :onJoinTable="handleJoinTable"
          :onLeaveTable="handleLeaveTable"
          :userId="userId"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { fetchTables, createTable, joinTable,fetchUser,leaveTable } from "../api";
import "../echo";
import TableComponent from '../components/TableComponent.vue'; // 引入新元件

export default {
  components: {
    TableComponent // 註冊新元件
  },
  data() {
    return {
      tables: [], // 用於存儲桌子數據
      loading: true, // 用於指示加載狀態
      userId:null
    };
  },
  async mounted() {
    this.userId = await this.fetchUserId(); 
    await this.loadTables();
    this.listenForTableCreated();
    this.listenForTableJoined();
    this.listenForTableLeaved();
    
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
    async handleLeaveTable(tableId) {
      try {
        const result = await leaveTable(tableId); // 調用 API 函數加入桌子
        console.log('成功離開桌子:', result);
      } catch (error) {
        console.error('離開桌子時出錯:', error);
      }
    },
    async fetchUserId() {
      try {
        let user = await fetchUser();
        return user.id 
      } catch (error) {
        console.error('取得使用者資料出錯:', error);
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
          const index = this.tables.findIndex(table => table.id == e.table.id);
          this.tables[index].users.push(e.user);
        });
    },
    listenForTableLeaved() {
      window.Echo.channel('lobby')
        .listen('TableLeaved', (e) => {
          console.log('接收到離開桌子事件:', e);
          const index = this.tables.findIndex(table => table.id == e.table.id);
          let users = this.tables[index].users
          users = users.filter(user => user.id != e.user.id)
          console.log(users)
          if(users.length == 0){
             this.tables.splice(index,1)
          }else{
              this.tables[index].users = users
          }
        });
    },

  },
  beforeUnmount() {
      window.Echo.leave('lobby');
      console.log("leave")
  },
};
</script>

<style scoped>
/* 原有樣式保持不變 */
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
</style>
