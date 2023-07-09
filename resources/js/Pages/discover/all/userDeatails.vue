<template>

        <h1>more</h1>
        <div class="user-details">
    <h1>{{ user.name }}</h1>
    <h5>{{ user.title }}</h5>
    <p>{{ user.about }}</p>
    <!-- ... -->
    <button @click="$emit('close')">Close</button>
  </div>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'

</script>
<script>
import { ref } from 'vue'
import axios from 'axios'


const users = ref([])
export default {
    props: {
    user: {
      type: Object,
      required: true,
    },
    auth: {
      type: Object,
      required: true,
    },
  },
  emits: ['close'],
  mounted() {
      axios.get('/api/users')
        .then(response => {
            users.value = response.data;
            const currentUser =  this.auth.user.id;
        })
        .catch(error => {
          console.log(error);
        });

        axios.get('/api/portfolios')
    .then(response => {
      console.log(response.data);
      // Process the response data here
      this.portfolios = response.data.map(portfolio => ({
        id: portfolio.id,
        title: portfolio.title,
        description: portfolio.description,
        images: portfolio.imagesPath.map(path => ({ fullImagePath: `/portfolioImages/${path.split('/').pop()}` })),
        user_id: portfolio.user_id,
        user_name: portfolio.user_name,
      }));
    })
    .catch(error => {
      console.log(error);
    });

    },

}

</script>
