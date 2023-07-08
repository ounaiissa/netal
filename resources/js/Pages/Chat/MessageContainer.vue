
<template>
    <h1>Start the convo!</h1>
    <div v-for="(message, index) in messages" :key="index">
        <!-- <messageItem :message="message"/> -->
        <MessageItem :message="message" />
    </div>



</template>


<script>
import axios from 'axios';
import MessageItem from './MessageItem.vue';
    export default{
        components:{
            MessageItem,
        },
        props: ['messages']
    }
</script>
