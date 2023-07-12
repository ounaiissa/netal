<template>
    <div class="user-details">
        <!-- {{ userId }} -->
<div v-if="this.userId !== null">
    {{ this.userId }}
 <!-- <h1>{{ this.user.name }}</h1>
      <h5>{{ this.user.title }}</h5>
      <p>{{ this.user.about }}</p> -->
    </div>
<div v-else>loading...</div>

    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    props: {
      userId: {
        type: Number,
        default: null,
        required: true,
      },
    },
    data() {
      return {
        user: null,
        loading: true,
        error: null,
      };
    },
    mounted() {
        // const userId = this.$inertia.page.props.userId;
    //   this.fetchUserDetails(this.userId);
    if (this.userId !== null) {
    this.fetchUserDetails(this.userId);
  }
    },
    methods: {
      async fetchUserDetails(userId) {
        try {
            // const userId = this.userId;

          const response = await axios.get(`/api/users/${userId}`);
          console.log('userId', userId);
          this.user = response.data;
          console.log(' this.user', this.user);
          console.log('user name', this.user.name);
        //   console.log('user name', user.name);

          this.loading = false;
          return userId;
        } catch (error) {
          console.log(error);
          this.error = 'Failed to fetch user details.';
          this.loading = false;
        }
      },
    },
  };
  </script>
