<template>
    <div class="process-div">
        <h2 v-if="actionPlayer" :style="{fontSize:'1.7vw'}">{{ actionPlayer.user.name }}</h2>
        <h2 :style="{fontSize:'1.7vw'}" v-if="actionPlayer != player">正在執行動作</h2>
        <h2 :style="{fontSize:'1.7vw'}" v-else-if="actionPlayer.needAction == 'putPillar'">必須放置家族成員</h2>

        <ChooseReel 
            v-else-if="actionPlayer.needAction.includes('chooseReel')" 
            @chooseReel = "chooseReel"
            :actionPlayer = "actionPlayer"
        />
            
            
        <button 
            v-if="actionPlayer == player"
            :style="{position:'absolute',right:'10%'}"
            @click="back" 
        >重置回合
        </button>
    </div>
</template>
<script>
import ChooseReel from './ChooseReel.vue';
    export default {
        data(){
            return{
                reels: ['resource', 'worker', 'money', 'military', 'belief'],
                chooseReelArray: []
            }
        },
        components: {
            ChooseReel,
        },
        props:{
            player:{
                type:Object,
                required: true
            },
            actionPlayer:{
                type:Object,
            },
            back:{
                type: Function,
                required: true
            }
        },
        mounted(){
            
        },
        methods:{
            chooseReel(chooseReelArray) {
                this.$emit('chooseReel',chooseReelArray);
            },
        },
        

    }
    
</script>
<style scoped>
    .process-div{
        display: flex;
        
        width: 90%;
        aspect-ratio: 30/1;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        background-color: rgb(197, 255, 109);
    }
    
</style>