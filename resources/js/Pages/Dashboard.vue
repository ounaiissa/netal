

<template>

    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <!-- <h2 class="text-xl font-semibold leading-tight">
                    Dashboard
                </h2> -->



            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h1 class="title-blue">Overview</h1>
            <P class="">Welcome back!</P>



      <div>
        <!-- <ul>
            <li v-for="type in userType" :key="type">{{ type }}</li>
        </ul> -->
        <p>Current user type: {{ this.auth.user.userType }}</p>
        <v-card class="w-[300px] h-[250px] flex item-center" text="" variant="outlined">

            <v-icon icon="fas fa-plus" />
            <a :href="route('portfolio')" class="title-blue-md">ADD PROJECT</a>
        </v-card>
      </div>
        </div>
        <div v-if="this.auth.user.userType === 'designer'|| this.auth.user.userType === 'developer'">
            <h1>heey you're a designer or a developer</h1>


        </div>
        <!-- <div v-else-if="this.auth.user.userType === 'developer'">
            <h1>heey you're a developer</h1>
        </div> -->
        <div v-else-if="this.auth.user.userType === 'company'">
            <h1>heey you're a company</h1>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import axios from 'axios';


// const { props } = usePage()
// const { auth } = props
// const isUserType = (userType) => {
//     console.log(form.userType);
// //   return auth.user && auth.user.userType === userType
// }

// const getUserType = () => {
//   if (auth && auth.user) {
//     return auth.user.userType
//   }
//   return ''
// }
</script>

<script>
import { usePage } from '@inertiajs/inertia-vue3'
import { reactive, onMounted } from 'vue'
// const { props } = usePage()
// const { auth } = props
export default {
  props: {
    auth: {
      type: Object,
      required: true
    }
  },
  data() {
  return {
    userType: ''
  };
},


//   mounted() {
//   axios.get('/api/users')
//     .then(response => {
//       this.userType = response.data.map(item => item.userType);
//     })
//     .catch(error => {
//       console.log(error);
//     });
// }
mounted() {
    axios.get('/api/users')
      .then(response => {
        const currentUser =  this.auth.user.id;
        // this.userType = response.data.find(user => user.id === this.auth.user.id)?.userType ?? '';
        // const currentUser = response.data.find(user => user.id === this.auth.user.id);
        // const currentUser = response.data.find(user => user.id === this.auth.user.id);


        // console.log(response.data);

        // console.log(this.auth.user.id);
        console.log(this.auth.user.userType);
        // console.log(currentUser);
        // console.log(currentUser.userType);
        if (currentUser) {
          this.userType = currentUser.userType;
        }
      })
      .catch(error => {
        console.log(error);
      });
  }
}

</script>
