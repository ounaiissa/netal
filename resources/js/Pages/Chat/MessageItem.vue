
<template>

    <div class="message-item">
       <div class="message-item__username">{{ message.user.name }} :</div> <div class="message-item__content"> {{ message.message }}</div>
    </div>
</template>

<script>
    export default{
        props: ['message', 'currentRoom'],
        created() {
        console.log(this.message.user.name);

    },
    }

</script>

<style scoped>
.message-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.message-item__username {
  font-weight: bold;
}

.message-item__content {
  flex-grow: 1;
  overflow-wrap: break-word;
}
</style>
