<template>
  <div >
    <img :src="`/${card.image}.png`" alt="Card Image" class = card-image />
  </div>
  
    <!-- <div class="card-info">
      <h3>{{ card.name }}</h3>
      <p><strong>價格：</strong>{{ card.cost }}</p>
      <p><strong>購買效果：</strong>{{ card.buyEffect }}</p>
      <p><strong>使用效果：</strong>{{ card.useEffect }}</p>
    </div> -->

</template>

<script>

export default {
  props: {
    card: {
      type: Object,
      required: true
    },

  },
  mounted(){
    
  },
  methods: {

  }

};
</script>

<style scoped>
.card-info {
  padding: 10px;
}
.card-image{
  width: 100%;  /* 寬度填滿父容器 */
  height: auto;
}

</style>
