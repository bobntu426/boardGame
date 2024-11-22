<template>
    <div class="message-div">
        <h2 v-if="actionPlayer">{{ actionPlayer.user.name }}</h2>
        <h2 v-if="actionPlayer.needAction == 'putPillar'">{{ actionPlayer.needAction}}</h2>
        <div v-else-if="actionPlayer.needAction == 'chooseReel' " class = "choose-reel-div">
            <h2>{{ actionPlayer.needAction}}</h2>
            <div class="reels-div">
                
            </div>
        </div>
        
    </div>
</template>
<script>
    export default {
        data(){
            return{

            }
        },
        props:{
            eventObject: {
                type: Object,
                required: true
            },
            actionPlayer:{
                type:Object,
            }
        },
        mounted(){
            console.log(this.actionPlayer)
        },
        methods:{
            chooseReel(reels) {
                this.$emit('chooseReel', reels);
            },
        }
    }
</script>
<style scoped>
    .message-div{
        display: flex;
        border: 1px solid black;
        height: 7vh;
        width: 90%;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        background-color: rgb(197, 255, 109);
    }
    .reels-div{
        display: flex;
        border: 1px solid black;
        height: 90%;
        width: 50%;
    }
    .choose-reel-div{
        display: flex;
        flex-direction: row;
        border: 1px solid black;
        height: 90%;
        width: 40%;
        align-items: center;
    }
</style>