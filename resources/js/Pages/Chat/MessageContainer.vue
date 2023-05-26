
<template>
    <h1>Start the convo!</h1>
    <div v-for="(message, index) in messages" :key="index">
        <!-- <messageItem :message="message"/> -->
        <MessageItem :message="message" />
    </div>
</template>

<script setup>
import MessageItem from './MessageItem.vue';</script>
<script>

    export default{
        props: ['messages']
    }
</script>
