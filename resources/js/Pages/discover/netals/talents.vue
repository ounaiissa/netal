<template>
    <AuthenticatedLayout>
      <h1 class="title-blue">talents</h1>
      <!-- <div class="d-flex items-center px-2 my-5 bg-white w-[370px]" style="border-radius: 4px; ">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g id="Basic / Search">
        <path id="Vector" d="M21 21L16.6569 16.6569M16.6569 16.6569C18.1046 15.2091 19 13.2091 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19C13.2091 19 15.2091 18.1046 16.6569 16.6569Z" stroke="black" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </g>
        </svg>
      <input  type="text" v-model="searchTerm" placeholder="Search by title" />
      <button style="border-left: 1px solid ; font-size: 18px; font-weight: 500;" class=" pl-4 text-blue-1 hover:text-blue-2" @click="searchUsers">Search</button>
      </div> -->
      <div class="search-bar2">
    <svg class="search-icon2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g id="Basic / Search">
        <path id="Vector" d="M21 21L16.6569 16.6569M16.6569 16.6569C18.1046 15.2091 19 13.2091 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19C13.2091 19 15.2091 18.1046 16.6569 16.6569Z" stroke="black" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </g>
    </svg>
    <input type="text" v-model="searchTerm" placeholder="Search by title or username" class="search-input2" />
    <button class="search-button2" @click="searchUsers">Search</button>
  </div>

      <div class="grid grid-cols-4 gap-2">
        <v-card v-for="user in displayedUsers" :key="user.id" class="user-card" text="" variant="outlined" style="border-color: #1B73F8; background-color: #ffffff4f;">
          <img :src="getUserAvatarUrl(user.avatar)" alt="avatar.png">
          <h1>{{ user.name }}</h1>
          <h5>{{ user.title }}</h5>
          <p>{{ user.about }}</p>
          <div class="d-flex justify-between mx-3 mt-3 items-center">
            <p>{{ user.budget }} $/hr</p>
            <v-btn @click="openUserDetails(user.id)" class="custom-button"> See more</v-btn>
          </div>
        </v-card>
      </div>

      <UserDetails v-if="showUserDetails" :userId="selectedUser" @close="selectedUser = null"  />

    </AuthenticatedLayout>
  </template>

  <script setup>
  import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
  import UserDetails from '../all/userDeatails.vue';


  </script>

  <script>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router';
import { visit } from '@inertiajs/inertia-vue3';




const users = ref([])
const searchTerm = ref('')
const searchTriggered = ref(false)
// const displayedUsers = ref([])


  export default {
    props: {
    auth: {
      type: Object,
      required: true,
    },
    userId: null,
  },
    data() {
      return {
        name: '',
        selectedUser: null,

      };
    },
    mounted() {
      axios.get('/api/users')
        .then(response => {
            users.value = response.data;
            console.log(response.data);
            // console.log(users.value);
            const currentUser =  this.auth.user.id;
            // console.log(this.auth.user.name);
            // console.log(response.data);
//             for (let i = 0; i < response.data.length; i++) {
//                 const user = response.data[i];
//                 console.log(user.name);
// }

//           if (currentUser) {
//             this.name = currentUser.name;
//           }
        })
        .catch(error => {
          console.log(error);
        });

    },
    computed: {
        showUserDetails() {
    return this.selectedUser !== null;
  },
        displayedUsers() {
      if (searchTriggered.value) {
        if (!searchTerm.value) {
          return users.value;
        }
        // console.log('users value form computed', users.value);
        // console.log('searchTerm value form computed', searchTerm.value);

        const searchTermLower = searchTerm.value.toLowerCase();
        console.log(searchTermLower);

       // return users.value.filter(user =>user.title && user.title.toLowerCase().includes(searchTermLower));

       return users.value.filter(user =>
  (user.title && user.title.toLowerCase().includes(searchTermLower)) ||
  (user.name && user.name.toLowerCase().includes(searchTermLower))
);


      }

      return users.value;
    },
},


methods: {
    getUserAvatarUrl(avatarFilename) {
    return `/storage/users-avatar/${avatarFilename}`;
  },

  openUserDetails(user) {
  this.selectedUser = user;

  this.$inertia.visit('/userDeatails', {
  data: {
    userId: user,
  },
  props: {
    userId: user,
  },
  preserveState: true,
});

  console.log('this si the selcetd user',this.selectedUser);
  console.log('this si the  user',user);

//   this.$router.push(`/user-details/${user.id}`);

//   visit(`/user-details/${user.id}`)
//   visit(route('userDetails', { id: user.id }));
//   this.$router.push({ name: 'userDetails', params: { id: user.id } });
// router.push({ name: 'userDetails', params: { id: user.id } });
},
    searchUsers() {
        console.log('Search term:', searchTerm.value);
      searchTriggered.value = true;

    },
  },
//   setup() {
//   const router = useRouter();


//   const openModal = (user) => {
//     this.selectedUser = user;
//     router.push(`/user-details/${user.id}`);
//   };



//   return {
//     openModal,

//   };
// },
  }
  </script>
