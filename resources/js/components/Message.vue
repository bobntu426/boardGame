<template>
    <div class="message-div">
        <div v-for="message in messageArray" class="message">
            <h3 :style="{margin:'1%'}">{{message}}</h3>
        </div>
    </div>
</template>
<script>
    export default {
        
        components: {
            
        },
        props:{
            messageArray:{
                type:Array,
                required:true
            }
        },
        mounted(){
            
        },
        methods:{

        },
        

    }
    
</script>
<style scoped>
    .message-div{
        position: absolute;
        display: flex;
        flex-direction: column;
        width: 90%;
        align-items: center;
        justify-content: center;
        background-color: rgb(255, 34, 34);
        z-index: 11;
    }
    .message{
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        z-index: 12;
    }
    
</style>