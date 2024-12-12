<template>
    <div class="process-div">
        <h2 v-if="actionPlayer" :style="{fontSize:'1.7vw'}">{{ actionPlayer.user.name }}</h2>
        <!-- 顯示名字 -->

        <h2 :style="{fontSize:'1.7vw'}" v-if="actionPlayer != player&&actionPlayer.needAction=='sure'">需確認行動</h2>
        <h2 :style="{fontSize:'1.7vw'}" v-else-if="actionPlayer != player">正在執行動作</h2>
        <!-- 非行動玩家的版面 -->

        <h2 :style="{fontSize:'1.7vw'}" v-else-if="actionPlayer.needAction == 'putPillar'">必須放置家族成員</h2>

        <div v-else-if="actionPlayer.needAction == 'sure'" class="sure-div">
            <h2 :style="{fontSize:'1.7vw'}">需確認行動</h2>
            <button 
                :style="{position:'relative'}"
                @click="handleEndTurn" 
            >結束回合
            </button>
        </div>
        

        <ChooseReel 
            v-else-if="actionPlayer.needAction.includes('chooseReel')" 
            @chooseReel = "chooseReel"
            :actionPlayer = "actionPlayer"
        />
            
            
        <button 
            v-if="actionPlayer.id == player.id&&player.needAction =='sure' "
            :style="{position:'absolute',right:'10%'}"
            @click="handleReset" 
        >重置回合
        </button>
        <div v-if="actionPlayer.id == player.id&&player.needAction =='putPillar' " class="set-worker-div" >
            <button 
                :style="{}"
                @click="decreaseWorkerNum" 
                >-
            </button>
            <img 
                :src="'/images/resource/worker.png'" 
                :style="{height:'50%'}"
            />
            <h2>:{{workerNum}}</h2>
            <button 
                :style="{}"
                @click="increaseWorkerNum" 
                >+
            </button>
        </div>
        
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
            workerNum:{
                type:Number,
                required: true
            },
            actionPlayer:{
                type:Object,
            },
            handleReset:{
                type: Function,
                required: true
            },
            handleEndTurn:{
                type: Function,
                required: true
            },
            decreaseWorkerNum:{
                type: Function,
                required: true
            },
            increaseWorkerNum:{
                type: Function,
                required: true
            },
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
        position: relative;
        width: 90%;
        aspect-ratio: 30/1;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        background-color: rgb(197, 255, 109);
    }
    .set-worker-div{
        display: flex;
        position: absolute;
        right: 0%;
        width: 20%;
        height:100%;
        column-gap: 2%;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        
    }
    
</style>