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

                axios.post('/chat/room/' + this.room.id + '/message', {
                    message: this.message
                })
                .then( response=> {
                    if(response.status == 201){
                        this.message = '';
                        this.$emit('messagesent');
                    }
                })
                .catch( error =>{
                    console.log( error)
                })

                // console.log(this.room.id);
            }

        }
    }
</script>
<template>
    <div style="border-top: 1px solid " class="grid grid-cols-6">
        <input  style="color: #000;" class="col-spans-5 outline-none p-1" type="text" v-model="message" @keyup.enter="sendMessages()" placeholder="Say something...">
        <button class="place-self-end" @click="sendMessages() ">Send</button>
    </div>
</template>
