<template>
  <div>
    <h1>User Profile</h1>
    <table>
      <thead>
        <tr>
          <th v-for="header in userHeaders" :key="header">{{ header }}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td v-for="(value, key) in user" :key="key">{{ value }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { fetchUser} from '../api';

export default {
  data() {
    return {
      user: {},
      userHeaders: ['ID', 'Name', 'Email', 'Created At', 'Updated At'],
    };
  },
  methods: {
    async loadUserData() {
      try {
        this.user = await fetchUser();
      } catch (error) {
        console.error('Failed to load user data:', error);
      }
      delete this.user.email_verified_at;
      delete this.user.remember_token;
    },
  },
  mounted() {
    this.loadUserData();
  }
};
</script>

<style scoped>
body {
  font-family: Arial, sans-serif;
  margin: 20px;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}
table, th, td {
  border: 1px solid black;
}
th, td {
  padding: 10px;
  text-align: left;
}
th {
  background-color: #f2f2f2;
}
.action-buttons {
  display: flex;
  justify-content: flex-end; /* 右對齊 */
  margin-top: 10px;
}
.action-buttons button {
  margin-left: 10px; /* 按鈕之間的間距 */
}
</style>
