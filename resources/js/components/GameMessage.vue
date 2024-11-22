<template>
    <div class="message-div">
        <h2 v-if="actionPlayer" :style="{fontSize:'1.7vw'}">{{ actionPlayer.user.name }}</h2>

        <h2 v-if="actionPlayer.needAction == 'putPillar'">必須放置家族柱</h2>

        <div v-else-if="actionPlayer.needAction.includes('chooseReel')" class = "choose-reel-div">
            <h2 :style="{fontSize:'1.7vw'}">需要選擇{{actionPlayer.needAction.slice(-1) }}個卷軸資源</h2>
            <div class="reels-div">
                <button 
                    v-for="(reel, index) in reels" 
                    class="reel-button"
                    :style="getButtonStyle(reel)"
                    :key="index" 
                    :disabled="isButtonSelected(reel)" 
                    @click="selectReel(reel)"> 
                </button>
            </div>
        <div class="submit-reselect-div">
            <button 
                @click="submitSelection" 
                :disabled="chooseReelArray.length != actionPlayer.needAction.slice(-1)"
            >確定
            </button>
            <button 
                @click="reselect" 
            >清除
            </button>
        </div>
           
        </div>
        
    </div>
</template>
<script>
    export default {
        data(){
            return{
                reels: ['resource', 'worker', 'money', 'military', 'belief'],
                chooseReelArray: []
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
            
        },
        methods:{
            getButtonStyle(reel){
                return {
                    backgroundImage: `url(/images/reels/1.png)`,
                    backgroundSize: 'contain', // 确保图片覆盖整个按钮
                    backgroundPosition: 'center',
                    border:this.chooseReelArray.includes(reel)?'2px solid rgb(210, 1, 1)':'none'
                }
            },
            selectReel(button) {
                if (this.chooseReelArray.length < 2 && !this.chooseReelArray.includes(button)) {
                    this.chooseReelArray.push(button);
                }
            },
            isButtonSelected(button) {
                return this.chooseReelArray.length >= this.actionPlayer.needAction.slice(-1) && !this.chooseReelArray.includes(button);
            },
            submitSelection() {
                this.$emit('chooseReel', this.chooseReelArray);
                this.reel = [];
            },
            reselect(){
                this.chooseReelArray = []
            }
        },
        

    }
    
</script>
<style scoped>
    .message-div{
        display: flex;
        height: 7vh;
        width: 90%;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        background-color: rgb(197, 255, 109);
    }
    .choose-reel-div{
        display: flex;
        flex-direction: row;
        height: 90%;
        width: 80%;
        align-items: center;
    }
    .reels-div{
        display: flex;
        height: 90%;
        width: 36%;
        align-items: center;
        justify-content: center;
        column-gap:2%;
        margin-left: 3%;
    }

    .reel-button{
        height: 90%;
        aspect-ratio: 1/1;
    }
    .reel-button:hover{
        height: 90%;
        aspect-ratio: 1/1;
        cursor: pointer;
    }
    .submit-reselect-div{
        display: flex;
       
        height: 90%;
        width: 20%;
        flex-direction: row-reverse;
    }
</style>