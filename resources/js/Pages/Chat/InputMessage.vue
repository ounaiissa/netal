<script>
    export default{
        props: ['room'],
        data: function(){
            return {
                message: ''
            }
        },
        methods: {
            sendMessages() {
                if(this.message == ''){
                    return;
                }
                window.location.reload();
                axios.post('/chat/room/' + this.room.id + '/message', {
                    message: this.message
                })
                .then( response=> {
                    if(response.status == 201){
                        this.message = '';
                        this.$emit('messagesent');
                        // this.getMessages();

                    }

                })
                .catch( error =>{
                    console.log( error);
                    console.log(error.response);
                })

                // console.log(this.room.id);
            }

        }
    }
</script>
<template>
    <div  class="input-message">
        <br>
        <input   class="input-message__input" type="text" v-model="message" @keyup.enter="sendMessages()" placeholder="Say something...">

        <button class=" pl-3 rounded-full place-self-end border-none bg-blue-2 w-10 h-10 hover:bg-blue-1 hover:border-blue-100 hover:border-x-2" @click="sendMessages() ">
            <svg SvgClass="px-6" style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16"> <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" fill="white"></path> </svg>
        </button>

        <button class="  rounded-full place-self-end border-none bg-blue-2 w-10 h-10 hover:bg-blue-1 hover:border-blue-100 hover:border-x-2" >
            <!-- <a href="http://127.0.0.1:8000/chatify/">o</a> -->
            <a :href="route('private')">o</a>
         </button>
    </div>
</template>

<style scoped>
.input-message {
  display: flex;
  gap: 0.5rem;
  margin-top: 1rem;
}

.input-message__input {
  flex-grow: 1;
  outline: none;
  border: none;
  border-radius: 0.375rem;
  padding: 0.25rem;
}

</style>
