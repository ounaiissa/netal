<template>
    <AuthenticatedLayout title="chat">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
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
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <MessageContainer :messages="messages.reverse()" />
            <InputMessage :room="currentRoom" v-on:messagesent="getMessages()" />


        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import MessageContainer from './MessageContainer.vue';
import InputMessage from './InputMessage.vue';
import ChatRoomSelection from './ChatRoomSelection.vue';

</script>

<script>


    export default{
        data: function() {
            return {
                chatRooms: [],
                currentRoom: [],
                messages: []
            }
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
