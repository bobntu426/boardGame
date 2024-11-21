<!-- Tower.vue -->
<template>
  <div>
    <div 
      v-for="(card,index) in cards" 
      :key="card.id" 
      class="card-div"
    >
      <Card
        :card="card"
      />
      <img 
        v-if = pillarPosition[index] 
        :src = "getPillarSrc(pillarPosition[index])"
        class="pillar"
      >
      </img>
      <button
        v-else
        class="tower-button button circle" 
        @click="buyCard(card)" >
      </button>

    </div>
  </div>
</template>

<script>
import Card from './Card.vue';

export default {
  components: {
    Card
  },
  props: {
    cards: {
      type: Array,
      required: true
    },
    pillarPosition:{
      type: Array,
      required: true
    }
  },
  computed:{
    
  },
  methods: {
    buyCard(card) {
      this.$emit('buyCard', card);
    },
    getPillarSrc(posInfo){     
      return `/images/pillars/${posInfo.playerColor}-${posInfo.color}.png`
    },
    
  }
};
</script>

<style scoped>


.card-div {
  width: 100%;
  height: 24.6%;
  position: relative; /* 使得按钮可以相对于卡片定位 */
  background-color: rgba(0, 61, 115, 0.463);
  margin-bottom: 3%;
}

.tower-button {
  position: absolute; 
  width: 62%; 
  aspect-ratio: 1/1;
  left:104%;
  top: 32%; 
}
.pillar{
  position: absolute;
  width:2vw; 
  left:117%;
  top: 22%; 
}

</style>
