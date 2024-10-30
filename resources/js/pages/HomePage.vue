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

    <h2>Cards</h2>
    <table>
      <thead>
        <tr>
          <th v-for="header in cardHeaders" :key="header">{{ header }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="card in cards" :key="card.id">
          <td>{{ card.name }}</td>
          <td>{{ formatCardCost(card) }}</td>
          <td>{{ formatBuyEffect(card) }}</td>
          <td>{{ formatUseEffect(card) }}</td>
          <td>
            <button @click="buyCard(card.id)">Buy</button>
          </td>
        </tr>
      </tbody>
    </table>

    <h2>My Cards</h2>
    <table>
      <thead>
        <tr>
          <th v-for="header in cardHeaders" :key="header">{{ header }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="myCard in myCards" :key="myCard.id">
          <td>{{ myCard.name }}</td>
          <td>{{ formatCardCost(myCard) }}</td>
          <td>{{ formatBuyEffect(myCard) }}</td>
          <td>{{ formatUseEffect(myCard) }}</td>
          <td>
            <button @click="useCard(myCard.id)">Use</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { fetchUser, fetchCards, fetchMyCards, buyCard, useCard } from '../api';

export default {
  data() {
    return {
      user: {},
      cards: [],
      myCards: [],
      userHeaders: ['ID', 'Name', 'Email', 'Created At', 'Updated At','tableNumber', 'Rock', 'Wood', 'Money', 'Worker'],
      cardHeaders: ['Name', 'Cost', 'Buy Effect', 'Effect', 'Action']
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
    async loadCards() {
      try {
        this.cards = await fetchCards();
      } catch (error) {
        console.error('Failed to load cards:', error);
      }
    },
    async loadMyCards() {
      try {
        this.myCards = await fetchMyCards();
      } catch (error) {
        console.error('Failed to load my cards:', error);
      }
    },
    async buyCard(cardId) {
      try {
        await buyCard(cardId);
        this.loadUserData();
        this.loadCards();
        this.loadMyCards();
      } catch (error) {
        console.error('Failed to buyCard:', error);
      }
    },
    async useCard(cardId) {
      try {
        await useCard(cardId);
        this.loadUserData();
        this.loadCards();
        this.loadMyCards();
      } catch (error) {
        console.error('Failed to useCard:', error);
      }
    },
    formatCardCost(card) {
      return `${-card.costMoney} coins, ${-card.costRock} rocks, ${-card.costWood} woods, ${-card.costWorker} workers`;
    },
    formatBuyEffect(card) {
      return `gain ${card.gainMoneyWhenBuy} coins, ${card.gainRockWhenBuy} rocks, ${card.gainWoodWhenBuy} woods, ${card.gainWorkerWhenBuy} workers`;
    },
    formatUseEffect(card) {
      return `gain ${card.gainMoneyWhenUse} coins, ${card.gainRockWhenUse} rocks, ${card.gainWoodWhenUse} woods, ${card.gainWorkerWhenUse} workers`;
    }
  },
  mounted() {
    this.loadUserData();
    this.loadCards();
    this.loadMyCards();
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
