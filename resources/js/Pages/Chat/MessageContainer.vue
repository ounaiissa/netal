
<template>
    <!-- <h1>Start the convo!</h1> -->
    <div class="message-container">
    <h1 class="message-container__placeholder">Start the convo!</h1>
    <div v-for="(message, index) in displayedMessages" :key="index">
      <MessageItem :message="message" />
    </div>
    <button v-if="canLoadMore" class="message-container__load-more" @click="loadMoreMessages()">
      Load More
    </button>
  </div>



</template>


<script>
import axios from 'axios';
import MessageItem from './MessageItem.vue';
    export default{
        components:{
            MessageItem,
        },
        props: ['messages'],
        data() {
    return {
      visibleMessageCount: 10,
    };
  },
  computed: {
    displayedMessages() {
      return this.messages.slice(0, this.visibleMessageCount);
    },
    canLoadMore() {
      return this.visibleMessageCount < this.messages.length;
    },
  },
  methods: {
    loadMoreMessages() {
      this.visibleMessageCount += 10;
    },
  },
    }
</script>
<style scoped>
.message-container {
  max-height: 400px;
  overflow-y: auto;
}

.message-container__placeholder {
  font-weight: bold;
  text-align: center;
  margin-bottom: 1rem;
}

.message-container div:not(:last-child) {
  margin-bottom: 0.5rem;
}
</style>
