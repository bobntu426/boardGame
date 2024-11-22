
<template>
    <div class="players-data-div" >
        <div 
            class = 'player-data-div'
            v-for ="player in players"
        >
            <div class="player-data-div-1">
                <div class="name-div" >
                    {{player.user.name}}
                </div>
                <div v-for="data in playerDataArray1" class="player-data-div-2">
                    <img :src="`/images/resource/${data}.png`" :style="{position:'absolute',height:'80%'}">
                    <p :style="{position:'absolute',left:'40%'}">:{{  player[data]  }}</p>
                </div>
                
            </div>
            <div class="player-data-div-1">
                <div v-for="data in playerDataArray2" class="player-data-div-2">
                    <img :src="`/images/resource/${data}.png`" :style="{position:'absolute', height:'80%'}">
                    <p :style="{position:'absolute',left:'40%'}">:{{ player[data] }}</p>
                </div>
            </div>
        </div>  
    </div>
</template>
  
<script>
export default {
    data(){
        return{
            playerDataArray1:['belief','military','score'],
            playerDataArray2:['money','wood','rock','worker'],
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
 
    },
    methods: {
        
    },
    mounted(){

    },
};
</script>

<style scoped>
.players-data-div{
    position: relative;
    display: flex;
    flex-direction: column;
    row-gap: 1.3333%;
    width: 40%;
    
}
.player-data-div{
    display: flex;
    flex-direction: row;
    position: relative;
    height: 24%;
    border: 1px solid black;

}
.player-data-image{
    position: absolute;
    width: 100%;
}
.player-data-div-1{
    width: 50%;
    display: flex;
    flex-direction: column;

}
.player-data-div-2{
    position: relative;
    height: 25%;
    display: flex;
    align-items: center;
    flex-direction: row;

}
.name-div{
    position: relative;
    height: 20%;
    display: flex;
    justify-content:center;
    background-color:rgb(255, 157, 157);
    align-items: center;
    margin: 5%;
}
</style>
