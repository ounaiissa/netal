<template>
    <AuthenticatedLayout title="chat">
        <template #header>
            <div class=" flex-col md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    <ChatRoomSelection
                        v-if="currentRoom.id"
                        :rooms="chatRooms"
                        :currentRoom="currentRoom"
                        v-on:roomchanged="setRoom( $event )"
                    />
                </h2>

            </div>
        </template>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 w-[1000px]">
            <MessageContainer :messages="messages.reverse()"  />
            <InputMessage :room="currentRoom" v-on:messagesent="getMessages()" />


        </div>
    </AuthenticatedLayout>
</template>



<script>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MessageContainer from './MessageContainer.vue';
import InputMessage from './InputMessage.vue';
import ChatRoomSelection from './ChatRoomSelection.vue';
import axios from 'axios';
 export default{
    components: {
    AuthenticatedLayout,
    MessageContainer,
    InputMessage,
    ChatRoomSelection,
  },
  data() {
    return {
      chatRooms: [],
      currentRoom: [],
      messages: [],
    };
  },
        watch:{
            currentRoom( val, oldVal){
                if( oldVal.id){
                    this.disconnect(oldVal);
                }
                this.connect();
            }
        },
        methods: {
            connect(){
                if(this.currentRoom.id){
                    let vm =this;
                    this.getMessages();
                    window.Echo.private("chat." + this.currentRoom.id)
                    .listen('.message.new', e=>{
                        vm.getMessages();
                    })
                }
            },
            disconnect(room){
                window.Echo.leave("chat." + this.currentRoom.id)
            },
            getRooms() {
                axios.get('/chat/rooms')
                .then( response => {
                    this.chatRooms = response.data;
                    this.setRoom(response.data[0]);

                })
                .catch( error=>{
                    console.log(error);
                } )
            },
            setRoom( room ) {
                this.currentRoom = room;
                // this.currentRoom = this.chatRooms.find(room => room.id === roomId);
                // this.getMessages();
                console.log(room);
            },
            // async setRoom(room) {
            //     this.currentRoom = room;
            //     await this.$nextTick(); // Wait for Vue to update the current room
            //     await new Promise(resolve => setTimeout(resolve, 100)); // Introduce a slight delay
            //     this.getMessages();
            //     },
            getMessages() {
                axios.get('/chat/room/' + this.currentRoom.id + '/messages')
                .then(response => {
                this.messages = response.data;

                })
                .catch( error => {
                    console.log(error);
                })
            },

    },
    created(){
                this.getRooms();
            },
    };
</script>
<style scoped>
.chat-container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 1rem;
}

.chat-container .header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.chat-container .message-container {
  max-height: 400px;
  overflow-y: auto;
}

.chat-container .input-message {
  display: flex;
  gap: 0.5rem;
  margin-top: 1rem;
}

.chat-container .input-message input[type="text"] {
  flex-grow: 1;
  outline: none;
  border: none;
  border-radius: 0.375rem;
  padding: 0.25rem;
}

.chat-container .input-message button {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 2.5rem;
  height: 2.5rem;
  border: none;
  border-radius: 50%;
  background-color: #7289da;
  color: white;
  cursor: pointer;
}
</style>
