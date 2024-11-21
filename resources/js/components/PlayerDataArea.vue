
<template>
    <div class="players-data-div" >
        <div 
            class = 'player-data-div'
            v-for ="player in players"
        >
            <!-- <img 
                class="player-data-image"
                v-for ="player in players"
                :src = "`/images/circles/${player.color}.png`"
            ></img> -->
        </div>

        
        
    </div>
</template>
  
<script>
export default {
    data(){
        return{
            
        }
    },
    components: {
        
    },
    props: {
        players: {
            type: Array,
            required: true
        },
    },
    computed:{
        playerFinalScoreStyle(){
            return this.playerScoreStyle
        }
    },
    methods: {
        
    },
    mounted(){
        console.log(this.players)
    },
};
</script>

<style scoped>
.players-data-div{
    position: relative;
    display: flex;
    flex-direction: column;
    row-gap: 1.3333%;
    width: 50%;
}
.player-data-div{
    position: relative;
    height: 24%;
    border: 1px solid black;
    aspect-ratio: 3/2;
}
.player-data-image{
    position: absolute;
    width: 100%;
}

</style>
