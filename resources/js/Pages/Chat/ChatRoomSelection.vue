<template>
    <div class="flex flex-col-1 items-center">
        <div class="font-bold text-xl ml-7">
            {{ selected.name }} Chat
        </div>
        <div >
            <select

                label="Select"
                v-model="selected"

                @change="$emit('roomchanged', selected)"
                class="ml-[600px] text-gray border rounded"
            >
            <!-- <template v-slot:item="{ item }">
                    {{ item.name }}
            </template> -->
                <option
                    v-for="(room, index) in rooms"
                    :key="index"
                    :value="room"

                >
                    {{ room.name }}
                </option>
            </select>
        </div>

    </div>
</template>

<script>
  export default{
        props: ['rooms', 'currentRoom'],
        data: function(){
            return {
                selected: ''
            }
        },
        created(){
            this.selected = this.currentRoom;
        },

    }
</script>

