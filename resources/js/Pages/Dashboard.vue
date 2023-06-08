

<template>

    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Dashboard
                </h2>
                <!-- <div>{{ auth.user.userType }}</div> -->
                <!-- <div>{{ getUserType() }}</div> -->


            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            You're logged in!

            <!-- <div>
        <ul>
          <li v-for="userType in userTypes" :key="userType.id">{{ userType }}</li>
        </ul>
      </div> -->

      <div>
        <!-- <ul>
            <li v-for="type in userType" :key="type">{{ type }}</li>
        </ul> -->
        <p>Current user type: {{ userType }}</p>
      </div>
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
        // const currentUser =  this.auth.user.id;
        // this.userType = response.data.find(user => user.id === this.auth.user.id)?.userType ?? '';
        const currentUser = response.data.find(user => user.id === this.auth.user.id);
        console.log(response.data);

        console.log(this.auth.user.id);
        console.log(currentUser);
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
